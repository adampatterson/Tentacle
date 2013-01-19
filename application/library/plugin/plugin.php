<?
/**
 * Function: plugin_enabled
 * Returns whether the given plugin is enabled or not.
 *
 * Parameters:
 *     $name - The folder name of the plugin.
 *
 * Returns:
 *     Whether or not the requested plugin is enabled.
 */
function plugin_enabled( $name ) {
    return in_array( $name, enabled_plugin() );
}


/**
 * Function: enabled_plugin
 * Returns an array of enabled plugins.
 *
 */
function enabled_plugin() {
    return unserialize(ACTIVE_PLUGINS);
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
 * Function: init_extensions
 * Initialize all Plugins
 */
function init_extensions() {

    //$plugins = new Plugins();

    $enabled_plugins  = event::get_plugins();

    foreach ($enabled_plugins['enabled_plugins'] as $plugin => $info ) {

        if (!file_exists(TENTACLE_PLUGIN."/".$plugin."/".$plugin.".php")) {
            unset($enabled_plugins[$plugin]);
            continue;
        }

        require TENTACLE_PLUGIN."/".$plugin."/".$plugin.".php";

//        foreach (YAML::load(TENTACLE_PLUGIN."/".$plugin."/info.yaml") as $key => $val)
//            event::$instances[$plugin]->$key = (is_string($val)) ? $val : $val ;
    }


}


/**
 * Class: event
 */
class event {

    static $_instances = array();
    static $_cancled = array();
    static $_events = array();
    static $priorities = array();


    /**
     * Function: on
     * Allows a plugin to respond to a trigger with multiple functions and custom priorities.
     *
     * Parameters:
     *     $event - Name of the trigger to respond to.
     *     $callback - Name of the class function to respond with.
     *     $priority - Priority of the response.
     */
    static function on(){

        $args = func_get_args();

        if (!array_key_exists(2, $args))
            $args[2] = 9;

        $callback = array(
            'event'    => $args[0],
            'callback' => $args[1],
            'priority' => $args[2]
        );

        // if the arguments are valid, register the event
        if (isset($callback['event']) and is_string($callback['event']) and isset($callback['callback']) and is_callable($callback['callback']))
        {
            // make sure we have an array for this event
            isset(self::$_events[$callback['event']]) or self::$_events[$callback['event']] = array();

            // store the callback on the call stack
            if (empty($callback[3]))
            {
                array_unshift(self::$_events[$callback['event']], $callback);
            }
            else
            {
                self::$_events[$callback['event']][] = $callback;
            }

            // and report success
            return true;
        }
        else
        {
            // can't register the event
            return false;
        }
    }


    /**
     * Function: off
     * Unregisters a given $event from a $callback.
     *
     * Parameters:
     *     $event - The trigger to unregister from.
     *     $callback - The action name.
     */
    static function off( $event = null, $callback = null )
    {

        // When an event name is given, only fetch that stack.
        $events = $event ? self::$_events[$event] : self::$_events;

        foreach ($events as $k => $e):

            if ( $event != null and $callback != null )
            {
                # Removes a callback within an event
                if ($event == $e['event'] and $callback == $e['callback'])
                    unset(self::$_events[$event][$k]);

            } elseif ( $event != null )
            {
                # Removes the whole event
                if ($event == $e['event'])
                    unset(self::$_events[$event]);

            } elseif ( $callback != null )
            {

                foreach ($e as $kk => $ee)
                    # Removes a callback within all events
                    if ($callback == $ee['callback'])
                        unset(self::$_events[$k][$kk]);

            }

        endforeach;

    }


    /**
     * Function: exists
     * Checks if there are any actions for a given $trigger.
     *
     * Parameters:
     *     $event
     *     $callback
     *
     * Returns:
     *     @true@ or @false@
     */
    static function exists( $event = null, $callback = null )
    {
        if (isset(self::$_events[$event]) and count(self::$_events[$event]) > 0)
        {
            return true;
        }
        return false;
    }


    /**
     * Function: trigger
     * Calls a trigger, passing any additional arguments to it.
     *
     * Parameters:
     *     $trigger_event - The name of the trigger, or an array of triggers to call.
     *     $data
     */
    static function trigger( $trigger_event, $data = null )
    {
        if (!event::exists($trigger_event))
            return false;

        $events = self::$_events[$trigger_event];

        usort( $events, function( $a, $b )
        {
            if ( $a['priority'] >= $b['priority'] )
            {
                return 1;
            }

            return -1;
        });

        foreach ($events as $key => $event):

            if ( is_callable( $event['callback'] ) )
                call_user_func( $event['callback'], $data );

        endforeach;

    }


    /**
     * Function: filter
     * Calls a trigger, and filters any additional arguments throught the callback methods.
     *
     * Parameters:
     *     $trigger_event - The name of the trigger, or an array of triggers to call.
     *     $data
     */
    static function filter ( $trigger_event, $data = null )
    {
        if (!self::exists($trigger_event))
            return false;

        $events = self::$_events[$trigger_event];

        $arguments = func_get_args();
        array_shift($arguments);
        array_shift($arguments);

        usort( $events, function( $a, $b )
        {
            if ( $a['priority'] >= $b['priority'] )
            {
                return 1;
            }

            return -1;
        });

        foreach ($events as $key => $event):

            if ( is_callable( $event['callback'] ) )
            {
                $call = call_user_func( $event['callback'], $data );

                $data = fallback($call, $data);
            }

        endforeach;

        return $call;
    }

    # Was the event called?
    static function called( )
    {

    }


    static function get_plugins(){
        $context["enabled_plugins"] = $context["disabled_plugins"] = array();

        $classes = array();
        // Move to the plugin folder
        chdir(TENTACLE_PLUGIN);
        $plugin_path = array_filter(glob('*'), 'is_dir');

        // Reset to the app root
        chdir(APP_ROOT);

        foreach ($plugin_path as $folder) {
            if (!file_exists(TENTACLE_PLUGIN."/".$folder."/".$folder.".php") or !file_exists(TENTACLE_PLUGIN."/".$folder."/info.yaml")) continue;

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
                    if (!plugin_enabled($dependency)) {
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
                '<a href="'.string::fix($info["author"]["url"]).'">'.string::fix($info["author"]["name"]).'</a>' :
                $info["author"]["name"] ;

            $category = (plugin_enabled($folder)) ? "enabled_plugins" : "disabled_plugins" ;
            $context[$category][$folder] = array("name" => $info["name"],
                "version" => $info["version"],
                "url" => $info["url"],
                "description" => $info["description"],
                "author" => $info["author"],
                "help" => $info["help"],
                "classes" => $classes[$folder],
                "dependencies_needed" => $dependencies_needed);
        }

        foreach ($context["enabled_plugins"] as $plugin => &$attrs)
            $attrs["classes"] = $classes[$plugin];

        foreach ($context["disabled_plugins"] as $plugin => &$attrs)
            $attrs["classes"] = $classes[$plugin];


        return $context;
    }
}