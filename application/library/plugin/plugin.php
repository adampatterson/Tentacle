<?

/**
 * Based off the Event class from Fuel php 1.0
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2012 Fuel Development Team
 * @link       http://fuelphp.com
 */




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
class event
{
    /**
     * @var  array  $instances  Event_Instance container
     */
    static $instances = array();

    /**
     * Event instance forge.
     *
     * @param   array   $events  events array
     * @return  object  new Event_Instance instance
     */
    public static function forge(array $events = array())
    {
        return new Event_Instance($events);
    }

    /**
     * Multiton Event instance.
     *
     * @param   string  $name    instance name
     * @param   array   $events  events array
     * @return  object  Event_Instance object
     */
    public static function instance( $name = '', array $events = array() )
    {
        if ( ! array_key_exists($name, static::$instances))
        {
            $events = array_merge(get::option('event.'.$name, array()), $events);
            $instance = static::forge($events);
            static::$instances[$name] = &$instance;
        }

        return static::$instances[$name];
    }

    // --------------------------------------------------------------------

    /**
     * method called by register_shutdown_event
     *
     * @access	public
     * @param	void
     * @return	void
     */
    public static function shutdown()
    {
        $instance = static::instance();
        if ($instance->has_events('shutdown'))
        {
            // trigger the shutdown events
            $instance->trigger('shutdown', '', 'none', true);
        }
    }

    /**
     * Static call forwarder
     *
     * @param   string  $func  method name
     * @param   array   $args  passed arguments
     * @return
     */
    public static function __callStatic($func, $args)
    {
        $instance = static::instance();
        if (method_exists($instance, $func))
        {
            return call_user_func_array(array($instance, $func), $args);
        }
        dingo_error(E_USER_ERROR, 'Call to undefined method: '.get_called_class().'::'.$func);
    }

    /**
     * Load events config
     */
    public static function _init()
    {
        //
    }
}


/**
 * Class: Event_Instance
 */
class Event_Instance
{
    /**
     * @var	array	An array of listeners
     */
    protected $_events = array();

    protected $_priorities = array();

    /**
     * Constructor, sets all initial events.
     *
     * @param  array  $events  events array
     */
    public function __construct(array $events = array())
    {
        foreach($events as $event => $callback)
        {
            $this->register($event, $callback);
        }
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

    static function aasort (&$array, $key) {
        $sorter=array();
        $ret=array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii]=$va[$key];
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii]=$array[$ii];
        }

        return $ret;
    }

    // --------------------------------------------------------------------

    /**
     * Register
     *
     * Registers a Callback for a given event
     *
     * @access	public
     * @param	string	The name of the event
     * @param	mixed	callback information
     * @return	void
     */
    public function register()
    {
        // get any arguments passed
        $callback = func_get_args();

        if(!array_key_exists(2, $callback)) {
            $callback[2] = 9;
        }

        $callback = array(
            'event'    => $callback[0],
            'callback' => $callback[1],
            'priority' => $callback[2]
        );

        // if the arguments are valid, register the event
        if (isset($callback['event']) and is_string($callback['event']) and isset($callback['callback']) and is_callable($callback['callback']))
        {
            // make sure we have an array for this event
            isset($this->_events[$callback['event']]) or $this->_events[$callback['event']] = array();

            // store the callback on the call stack
            if (empty($callback[3]))
            {
                array_unshift($this->_events[$callback['event']], $callback);
            }
            else
            {
                $this->_events[$callback['event']][] = $callback;
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

    public function multi_sort(&$array, $key, $asc=true)
    {
        $sorter = new array_sorter($array, $key, $asc);
        return $sorter->sortit();
    }

    // --------------------------------------------------------------------

    /**
     * Unregister/remove one or all callbacks from event
     *
     * @param   string   $event     event to remove from
     * @param   mixed    $callback  callback to remove [optional, null for all]
     * @return  boolean  wether one or all callbacks have been removed
     */
    public function unregister($event, $callback = null)
    {
        if (isset($this->_events[$event]))
        {
            if ($callback === true)
            {
                $this->_events = array();
                return true;
            }

            foreach ($this->_events[$event] as $i => $arguments)
            {
                if($callback === $arguments['callback'])
                {
                    unset($this->_events[$event][$i]);
                    return true;
                }
            }
        }

        return false;
    }

    // --------------------------------------------------------------------

    /**
     * Trigger
     *
     * Triggers an event and returns the results.  The results can be returned
     * in the following formats:
     *
     * 'array'
     * 'json'
     * 'serialized'
     * 'string'
     *
     * @access	public
     * @param	string	 The name of the event
     * @param	mixed	 Any data that is to be passed to the listener
     * @param	string	 The return type
     * @param   boolean  Wether to fire events ordered LIFO instead of FIFO
     * @return	mixed	 The return of the listeners, in the return type
     */
    public function trigger($event, $data = '', $return_type = 'string', $reversed = false)
    {
        $calls = array();

        // check if we have events registered
        if ($this->has_events($event))
        {
            //$events = $reversed ? array_reverse($this->_events[$event], true) : $this->_events[$event];

            $events = self::aasort($this->_events[$event], "priority");

            // process them
            foreach ($events as $arguments)
            {
                // get the callback method
                $callback = $arguments['callback'];

                // call the callback event
                if (is_callable($callback))
                {
                    $calls[] = call_user_func($callback, $data, $arguments);
                }
            }
        }

        return $this->_format_return($calls, $return_type);
    }


    // --------------------------------------------------------------------

    /**
     * Has Listeners
     *
     * Checks if the event has listeners
     *
     * @access	public
     * @param	string	The name of the event
     * @return	bool	Whether the event has listeners
     */
    public function has_events($event)
    {
        if (isset($this->_events[$event]) and count($this->_events[$event]) > 0)
        {
            return true;
        }
        return false;
    }

    // --------------------------------------------------------------------

    /**
     * Format Return
     *
     * Formats the return in the given type
     *
     * @access	protected
     * @param	array	The array of returns
     * @param	string	The return type
     * @return	mixed	The formatted return
     */
    protected function _format_return(array $calls, $return_type)
    {
        switch ($return_type)
        {
            case 'array':
                return $calls;
                break;
            case 'json':
                return json_encode($calls);
                break;
            case 'none':
                return;
            case 'serialized':
                return serialize($calls);
                break;
            case 'string':
                $str = '';
                foreach ($calls as $call)
                {
                    $str .= $call;
                }
                return $str;
                break;
            default:
                return $calls;
                break;
        }

        return false;
    }
}