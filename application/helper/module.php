<?
/**
* Function: init_extensions
* Initialize all Modules and Feathers.
*/
function init_extensions() {

	$modules = new Modules();

	$enabled_modules  = $modules->get_modules();
	
	foreach ($enabled_modules['enabled_modules'] as $module => $info ) {
		
		require TENTACLE_PLUGIN."/".$module."/".$module.".php";

		$camelized = camelize($module);
		if (!class_exists($camelized))
			continue;

		Modules::$instances[$module] = new $camelized;
		Modules::$instances[$module]->safename = $module;

		foreach (Modules::$instances as $module)
			if (method_exists($module, "__init"))
			$module->__init();
	}
}


/**
 * Function: fallback
 * Sets a given variable if it is not set.
 *
 * The last of the arguments or the first non-empty value will be used.
 *
 * Parameters:
 *     &$variable - The variable to return or set.
 *
 * Returns:
 *     The value of whatever was chosen.
 */
function fallback(&$variable) {
    if (is_bool($variable))
        return $variable;

    $set = (!isset($variable) or (is_string($variable) and trim($variable) === "") or $variable === array());

    $args = func_get_args();
    array_shift($args);
    if (count($args) > 1) {
        foreach ($args as $arg) {
            $fallback = $arg;

            if (isset($arg) and (!is_string($arg) or (is_string($arg) and trim($arg) !== "")) and $arg !== array())
                break;
        }
    } else
        $fallback = isset($args[0]) ? $args[0] : null ;

    if ($set)
        $variable = $fallback;

    return $set ? $fallback : $variable ;
}


/**
 * Function: module_enabled
 * Returns whether the given module is enabled or not.
 *
 * Parameters:
 *     $name - The folder name of the module.
 *
 * Returns:
 *     Whether or not the requested module is enabled.
 */
function module_enabled($name) {
    return in_array($name, enabled_module());
}


/**
 * Function: enabled_module
 * Returns an array of enabled modules.
 *
 */
function enabled_module() {
    return unserialize(get_option('active_modules'));
}


/**
 * Class: Modules
 * Contains various functions, acts as the backbone for all modules.
 */
class Modules {
    # Array: $instances
    # Holds all Module instantiations.
    static $instances = array();

    # Boolean: $cancelled
    # Is the module's execution cancelled?
    public $cancelled = false;

    # Array: $context
    # Contains the context for various admin pages, to be passed to the Twig templates.
    public $context = array();


    /**
     * Function: setPriority
     * Sets the priority of an action for the module this function is called from.
     *
     * Parameters:
     *     $name - Name of the trigger to respond to.
     *     $priority - Priority of the response.
     */
    protected function setPriority($name, $priority) {
        Trigger::current()->priorities[$name][] = array("priority" => $priority, "function" => array($this, $name));
    }


    /**
     * Function: addAlias
     * Allows a module to respond to a trigger with multiple functions and custom priorities.
     *
     * Parameters:
     *     $name - Name of the trigger to respond to.
     *     $function - Name of the class function to respond with.
     *     $priority - Priority of the response.
     */
    protected function addAlias($name, $function, $priority = 10) {
        Trigger::current()->priorities[$name][] = array("priority" => $priority, "function" => array($this, $function));
    }


	public function get_modules(){
		$context["enabled_modules"] = $context["disabled_modules"] = array();

		if (!$open = @opendir(un_slash(TENTACLE_PLUGIN)))
		    return trigger_error("Could not read modules directory.",E_USER_ERROR);

		$classes = array();

		while (($folder = readdir($open)) !== false) {
		    if (!file_exists(TENTACLE_PLUGIN."/".$folder."/".$folder.".php") or !file_exists(TENTACLE_PLUGIN."/".$folder."/info.yaml")) continue;
			
			/*
		    if (file_exists(TENTACLE_PLUGIN."/".$folder."/locale/".$config->locale.".mo"))
		        load_translator($folder, TENTACLE_PLUGIN."/".$folder."/locale/".$config->locale.".mo");
			*/
				
		    if (!isset($classes[$folder]))
		        $classes[$folder] = array($folder);
		    else
		        array_unshift($classes[$folder], $folder);

		    $info = YAML::load(TENTACLE_PLUGIN."/".$folder."/info.yaml");

		    $info["conflicts_true"] = array();
		    $info["depends_true"] = array();

		    if (!empty($info["conflicts"])) {
		        $classes[$folder][] = "conflict";

		        foreach ((array) $info["conflicts"] as $conflict)
		            if (file_exists(TENTACLE_PLUGIN."/".$conflict."/".$conflict.".php"))
		                $classes[$folder][] = "conflict_".$conflict;
		    }

		    $dependencies_needed = array();
		    if (!empty($info["depends"])) {
		        $classes[$folder][] = "depends";

		        foreach ((array) $info["depends"] as $dependency) {
		            if (!module_enabled($dependency)) {
		                if (!in_array("missing_dependency", $classes[$folder]))
		                    $classes[$folder][] = "missing_dependency";

		                $classes[$folder][] = "needs_".$dependency;

		                $dependencies_needed[] = $dependency;
		            }

		            $classes[$folder][] = "depends_".$dependency;

		            fallback($classes[$dependency], array());
		            $classes[$dependency][] = "depended_by_".$folder;
		        }
		    }

		    fallback($info["name"], $folder);
		    fallback($info["version"], "0");
		    fallback($info["url"]);
		    fallback($info["description"]);
		    fallback($info["author"], array("name" => "", "url" => ""));
		    fallback($info["help"]);

		    $info["description"] = $info["description"];
		    $info["description"] = preg_replace(array("/<code>(.+)<\/code>/se", "/<pre>(.+)<\/pre>/se"),
		                                        array("'<code>'.fix('\\1').'</code>'", "'<pre>'.fix('\\1').'</pre>'"),
		                                        $info["description"]);

		    $info["author"]["link"] = !empty($info["author"]["url"]) ?
		                                  '<a href="'.fix($info["author"]["url"]).'">'.fix($info["author"]["name"]).'</a>' :
		                                  $info["author"]["name"] ;

		    $category = (module_enabled($folder)) ? "enabled_modules" : "disabled_modules" ;
		    $context[$category][$folder] = array("name" => $info["name"],
		                                               "version" => $info["version"],
		                                               "url" => $info["url"],
		                                               "description" => $info["description"],
		                                               "author" => $info["author"],
		                                               "help" => $info["help"],
		                                               "classes" => $classes[$folder],
		                                               "dependencies_needed" => $dependencies_needed);
		}
		
		foreach ($context["enabled_modules"] as $module => &$attrs)
		    $attrs["classes"] = $classes[$module];

		foreach ($context["disabled_modules"] as $module => &$attrs)
		    $attrs["classes"] = $classes[$module];
		
		
		return $context;
	}

}



/**
  * Class: Trigger
  * Controls and keeps track of all of the Triggers and events.
  */
 class Trigger {
     # Array: $priorities
     # Custom prioritized callbacks.
     public $priorities = array();

     # Array: $called
     # Keeps track of called Triggers.
     private $called = array();

     # Array: $exists
     # Caches trigger exist states.
     private $exists = array();

     /**
      * Function: cmp
      * Sorts actions by priority when used with usort.
      */
     private function cmp($a, $b) {
         if (empty($a) or empty($b)) return 0;
         return ($a["priority"] < $b["priority"]) ? -1 : 1 ;
     }

     /**
      * Function: call
      * Calls a trigger, passing any additional arguments to it.
      *
      * Parameters:
      *     $name - The name of the trigger, or an array of triggers to call.
      */
     public function call($name) {
         if (is_array($name)) {
             $return = null;

             foreach ($name as $index => $call) {
                 $args = func_get_args();
                 $args[0] = $call;
                 if ($index + 1 == count($name))
                     return $this->exists($call) ? call_user_func_array(array($this, "call"), $args) : $return ;
                 else
                     $return = $this->exists($call) ? call_user_func_array(array($this, "call"), $args) : $return ;
             }
         }

         if (!$this->exists($name))
             return false;

         $arguments = func_get_args();
         array_shift($arguments);

         $return = null;

         $this->called[$name] = array();
         if (isset($this->priorities[$name])) { # Predefined priorities?
             usort($this->priorities[$name], array($this, "cmp"));

             foreach ($this->priorities[$name] as $action) {
                 $return = call_user_func_array($action["function"], $arguments);
                 $this->called[$name][] = $action["function"];
             }
         }

         foreach (Modules::$instances as $module)
             if (!in_array(array($module, $name), $this->called[$name]) and is_callable(array($module, $name)))
                 $return = call_user_func_array(array($module, $name), $arguments);

         return $return;
     }

     /**
      * Function: filter
      * Filters a variable through a trigger's actions. Similar to <call>, except this is stackable and is intended to
      * modify something instead of inject code.
      *
      * Any additional arguments passed to this function are passed to the function being called.
      *
      * Parameters:
      *     &$target - The variable to filter.
      *     $name - The name of the trigger.
      *
      * Returns:
      *     $target, filtered through any/all actions for the trigger $name.
      */
     public function filter(&$target, $name) {
         if (is_array($name))
             foreach ($name as $index => $filter) {
                 $args = func_get_args();
                 $args[0] =& $target;
                 $args[1] = $filter;
                 if ($index + 1 == count($name))
                     return $target = call_user_func_array(array($this, "filter"), $args);
                 else
                     $target = call_user_func_array(array($this, "filter"), $args);
             }

         if (!$this->exists($name))
             return $target;

         $arguments = func_get_args();
         array_shift($arguments);
         array_shift($arguments);

         $this->called[$name] = array();

         if (isset($this->priorities[$name]) and usort($this->priorities[$name], array($this, "cmp")))
             foreach ($this->priorities[$name] as $action) {
                 $call = call_user_func_array($this->called[$name][] = $action["function"],
                                              array_merge(array(&$target), $arguments));
                 $target = fallback($call, $target);
             }

         foreach (Modules::$instances as $module)
             if (!in_array(array($module, $name), $this->called[$name]) and is_callable(array($module, $name))) {
                 $call = call_user_func_array(array($module, $name),
                                              array_merge(array(&$target), $arguments));
                 $target = fallback($call, $target);
             }

         return $target;
     }

     /**
      * Function: remove
      * Unregisters a given $action from a $trigger.
      *
      * Parameters:
      *     $trigger - The trigger to unregister from.
      *     $action - The action name.
      */
     public function remove($trigger, $action) {
         foreach ($this->actions[$trigger] as $index => $func) {
             if ($func == $action) {
                 unset($this->actions[$trigger][$key]);
                 return;
             }
         }
         $this->actions[$trigger]["disabled"][] = $action;
     }

     /**
      * Function: exists
      * Checks if there are any actions for a given $trigger.
      *
      * Parameters:
      *     $trigger - The trigger name.
      *
      * Returns:
      *     @true@ or @false@
      */
     public function exists($name) {
         if (isset($this->exists[$name]))
             return $this->exists[$name];

         foreach (Modules::$instances as $module)
             if (is_callable(array($module, $name)))
                 return $this->exists[$name] = true;

         if (isset($this->priorities[$name]))
             return $this->exists[$name] = true;

         return $this->exists[$name] = false;
     }

     /**
      * Function: current
      * Returns a singleton reference to the current class.
      */
     public static function & current() {
         static $instance = null;
         return $instance = (empty($instance)) ? new self() : $instance ;
     }
 }