<?
/**
 * Class: event
 */
class event {

    static $_events = array();


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

                if ( is_array($call))
                   $return[] = $call;

                if ($data != '' )
                    $data = fallback($call, $data);
            }

        endforeach;

            if ( isset($return) and is_array($return) )
                return $return;
            else
                return $call;
    }

    # Was the event called?
    static function called( ) { }
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