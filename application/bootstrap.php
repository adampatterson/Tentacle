<?php if (!defined('DINGO')) {
    die('External Access to File Denied');
}
/**
 * Dingo Framework Bootstrap Class
 *
 * @Author          Evan Byrne
 * @Copyright       2008 - 2010
 * @Project Page    http://www.dingoframework.com
 */


/**
 * Class: dingo
 */
class dingo
{

}


/**
 * Class: bootstrap
 */
class bootstrap extends dingo
{
    // Get the requested URL, parse it, then clean it up
    // ---------------------------------------------------------------------------
    public static function get_request_url()
    {
        // Get the filename of the currently executing script relative to docroot
        $url = (empty($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '/';

        // Get the current script name (eg. /index.php)
        $script_name = (isset($_SERVER['SCRIPT_NAME'])) ? $_SERVER['SCRIPT_NAME'] : $url;

        // Parse URL, check for PATH_INFO and ORIG_PATH_INFO server params respectively
        $url = (0 !== stripos($url, $script_name)) ? $url : substr($url, strlen($script_name));
        $url = (empty($_SERVER['PATH_INFO'])) ? $url : $_SERVER['PATH_INFO'];
        //$url = (empty($_SERVER['ORIG_PATH_INFO'])) ? $url : $_SERVER['ORIG_PATH_INFO'];

        // Check for GET __dingo_page
        $url = (input::get('__dingo_page')) ? input::get('__dingo_page') : $url;

        //Tidy up the URL by removing trailing slashes
        $url = (!empty($url)) ? rtrim($url, '/') : '/';

        return $url;
    }


    // Autoload
    // ---------------------------------------------------------------------------
    public static function autoload($controller)
    {
        foreach (array('library', 'helper') as $type) {
            $property = "autoload_$type";

            foreach (config::get($property) as $class)
                load::$type($class);

            if (!empty($controller->$property) AND is_array($controller->$property))
                foreach ($controller->$property as $class)
                    load::$type($class);
        }
    }


    /**
     * Function: run
     *    Starts application.
     */
    public static function run()
    {
        define('DINGO_VERSION', '0.7.1');

        // Start buffer
        ob_start();

        require_once(APPLICATION . '/' . CONFIG . '/' . CONFIGURATION . '/config.php');

        set_error_handler('dingo_error');
        set_exception_handler('dingo_exception');

        config::set('system', APPLICATION);
        config::set('application', APPLICATION);
        config::set('config', CONFIG);

        // Load route configuration
        require_once(APPLICATION . '/' . CONFIG . '/' . CONFIGURATION . '/route.php');

        // @todo get routs set in any plugins

        // Get route
        $uri = route::get(bootstrap::get_request_url());

        // Set current page
        define('CURRENT_PAGE', $uri['string']);

        // Validate
        if (!route::valid($uri))
            load::error('general', 'Invalid URL', 'The requested URL contains invalid characters.');

        // Load Controller
        //----------------------------------------------------------------------------------------------

        // If controller does not exist, give 404 error
        if (!file_exists(APPLICATION . '/' . config::get('folder_controllers') . "/{$uri['controller']}.php"))
            load::error('404');

        // Include controller
        require_once(APPLICATION . '/' . config::get('folder_controllers') . "/{$uri['controller']}.php");

        // Initialize controller
        $tmp = "{$uri['controller_class']}_controller";
        $controller = new $tmp();
        unset($tmp);


        // Check if using valid REST API
        /*
            if(api::get())
            {
                if(!empty($controller->controller_api) and
                    is_array($controller->controller_api) and
                        !empty($controller->controller_api[$uri['function']]) and
                            is_array($controller->controller_api[$uri['function']]))
                {
                    foreach($controller->controller_api[$uri['function']] as $e)
                    {
                        api::permit($e);
                    }

                    if(!api::allowed(api::get()))
                    {
                        load::error('404');
                    }
                }
                else
                {
                    // Turned this off so that .html files would work in the URL
                    //load::error('404');
                }
            }
        */

        // Autoload Components
        bootstrap::autoload($controller);


        // Load the plugins here so that we can set route's, and use the Hooks in all areas of the application.
        // Check to see if we are installed so we dont explode.
        if (class_exists('get') && get::option('is_blog_installed')):
            define('ACTIVE_PLUGINS', get::option('active_plugins'));

            load::library('Spyc');
            load::library('event');
            load::library('plugin');
            init_extensions();
        endif;

        // Check to see if function exists
        if (!is_callable(array($controller, $uri['function']))):
            // Try replacing underscores with dashes
            $minus_function_name = str_replace('-', '_', $uri['function']);

            if (!is_callable(array($controller, $minus_function_name)))
                load::error('404');
            else
                $uri['function'] = $minus_function_name;
        endif;

        // Run Function
        call_user_func_array(array($controller, $uri['function']), $uri['arguments']);

        // Display echoed content
        ob_end_flush();
    }
}


/**
 * Class: cookie
 */
class cookie extends dingo
{
    /**
     * Function: set
     *    Sets a cookie with $settings
     *
     * Parameters:
     *    $settings - array
     *
     * Returns:
     *    setcookie with $settings
     */
    public static function set($settings)
    {

        if (!isset($settings['path']))
            $settings['path'] = '/';

        if (!isset($settings['domain']))
            $settings['domain'] = FALSE;

        if (!isset($settings['secure']))
            $settings['secure'] = FALSE;

        if (!isset($settings['httponly']))
            $settings['httponly'] = FALSE;

        if (!isset($settings['expire'])):
            $ex = new DateTime();
            $time = $ex->format('U');
        else:
            $ex = new DateTime();
            $ex->modify($settings['expire']);
            $time = $ex->format('U');
        endif;

        return setcookie(
            $settings['name'],
            $settings['value'],
            $time,
            $settings['path'],
            $settings['domain'],
            $settings['secure'],
            $settings['httponly']
        );
    }


    /**
     * Function: set
     *    Sets a cookie that will expire.
     *
     * Parameters:
     *    $settings - array
     *
     * Returns:
     *    setcookie with $settings
     */
    public static function delete($settings)
    {
        if (!isset($settings['path']))
            $settings['path'] = '/';

        if (!isset($settings['domain']))
            $settings['domain'] = FALSE;

        if (!isset($settings['secure']))
            $settings['secure'] = FALSE;

        if (!isset($settings['httponly']))
            $settings['httponly'] = FALSE;

        // If given array of settings
        if (is_array($settings)):
            return setcookie(
                $settings['name'],
                '',
                time() - 3600,
                $settings['path'],
                $settings['domain'],
                $settings['secure'],
                $settings['httponly']
            );
        // Else, just the cookie name was given
        else:
            return setcookie($settings, '', time() - 3600);
        endif;
    }
}


/**
 * Class: config
 */
class config extends dingo
{
    # Array: $x
    # Hodls all of the configuratiuon settings.
    public static $x = array();


    /**
     * Function: set
     *    sets an array index of $name with the value of $val
     *
     * Parameters:
     *    $name - String
     *    $val - Mixed
     *
     * Returns:
     *    Array
     */
    public static function set($name, $val)
    {
        self::$x[$name] = $val;
    }


    /**
     * Function: get
     *    Looks in the config array for $name
     *
     * Parameters:
     *    $name - String
     *
     * Returns:
     *    Mixed if TRUE / FALSE
     */
    public static function get($name)
    {
        if (isset(self::$x[$name]))
            return (self::$x[$name]);
        else
            return FALSE;
    }


    /**
     * Function: remove
     *    unsets $name from the config array
     *
     * Parameters:
     *    $name - string
     */
    public static function remove($name)
    {
        if (isset(self::$x[$name]))
            unset(self::$x[$name]);
    }


    /**
     * Function: rename
     *    unsets $old and sets $new
     *
     * Parameters:
     *    $old - string
     *    $new - string
     */
    public static function rename($old, $new)
    {
        self::$x[$new] = self::$x[$old];
        unset(self::$x[$old]);
    }
}


/**
 * class api
 * {
 * private static $_reg = array();
 * private static $_current = FALSE;
 *
 *
 * // Permit
 * // ---------------------------------------------------------------------------
 * public static function permit()
 * {
 * foreach(func_get_args() as $e)
 * {
 * self::$_reg[] = $e;
 * }
 * }
 *
 *
 * // Allowed
 * // ---------------------------------------------------------------------------
 * public static function allowed($api)
 * {
 * return in_array($api,self::$_reg);
 * }
 *
 *
 * // Register
 * // ---------------------------------------------------------------------------
 * public static function set($api)
 * {
 * self::$_current = $api;
 * }
 *
 *
 * // Current
 * // ---------------------------------------------------------------------------
 * public static function get()
 * {
 * return self::$_current;
 * }
 * }
 */

/**
 * Class: route
 */
class route extends dingo
{
    # Array: rout
    static $route = array();

    # Array: current
    private static $current = array();

    /**
     * Function: valid
     *    Tests to see if the rout contains allowed characters, by default 'ALLOWED_CHARS' is set to '/^[ \!\,\~\&\.\:\+\@\-_a-zA-Z0-9]+$/'
     *
     * Parameters:
     *    $r - string - rout
     *
     * Returns:
     *    Boolean
     */
    public static function valid($r)
    {
        foreach ($r['segments'] as $segment)
            if (!preg_match(ALLOWED_CHARS, $segment))
                return FALSE;

        return TRUE;
    }


    /**
     * Function: set
     *    Routs are set in route.php
     *
     * Parameters:
     *    $url - url - string with regex
     *    $r - rout - string with regex
     *
     * Returns:
     *    $route - array
     */
    public static function set($url, $r)
    {
        self::$route[$url] = $r;
    }


    /**
     * Function: get
     *    Returns an array containing the details of a rout stored in the route.php
     *
     * Parameters:
     *    $url - the string used in rout::set
     *
     * Returns:
     *    array
     *
     * See Also:
     *    <set>
     */
    public static function get($url)
    {
        $url = preg_replace('/^(\/)/', '', $url);
        $new_url = $url;

        // REST API
        /*
                if(preg_match('/\.([\-_a-zA-Z]+)$/',$new_url))
                {
                    $split = explode('.',$new_url);
                    api::set(array_pop($split));
                    $new_url = implode('.',$split);
                }
        */
        // Static routes
        if (!empty(self::$route[$url])) {
            $new_url = self::$route[$url];
        }

        // Regex routes
        $route_keys = array_keys(self::$route);

        foreach ($route_keys as $okey) {
            $key = ('/^' . str_replace('/', '\\/', $okey) . '$/');

            if (preg_match($key, $url)) {
                if (!is_array(self::$route[$okey])) {
                    $new_url = preg_replace($key, self::$route[$okey], $url);
                } else {
                    /* Run regex replace on keys */
                    $new_url = self::$route[$okey];

                    // Controller
                    if (isset($new_url['controller'])) {
                        $new_url['controller'] = preg_replace($key, $new_url['controller'], $url);
                    }

                    // Function
                    if (isset($new_url['function'])) {
                        $new_url['function'] = preg_replace($key, $new_url['function'], $url);
                    }

                    // Arguments
                    if (isset($new_url['arguments'])) {
                        $x = 0;
                        while (isset($new_url['arguments'][$x])) {
                            $new_url['arguments'][$x] = preg_replace($key, $new_url['arguments'][$x], $url);
                            $x += 1;
                        }
                    }
                }
            }

        }

        // If URL is empty use default route
        if (empty($new_url) OR $new_url == '/') {
            $new_url = self::$route['default_route'];
        }

        // Turn into array
        if (!is_array($new_url)) {
            // Remove the /index.php/ at the beginning
            //$new_url = preg_replace('/^(\/)/','',$url);

            $tmp_url = explode('/', $new_url);
            $new_url = array('controller' => $tmp_url[0], 'function' => 'index', 'arguments' => array(), 'string' => $new_url, 'segments' => $tmp_url);

            // Function
            if (!empty($tmp_url[1])) {
                $new_url['function'] = $tmp_url[1];
            }

            // Arguments
            $x = 2;
            while (isset($tmp_url[$x])) {
                $new_url['arguments'][] = $tmp_url[$x];
                $x += 1;
            }
        } // If already array
        else {
            // Add missing keys
            if (!isset($new_url['function'])) {
                $new_url['function'] = 'index';
            }

            if (!isset($new_url['arguments'])) {
                $new_url['arguments'] = array();
            }

            // Build string key for URL array
            // Controller
            $s = $new_url['controller'];

            // Function
            if (isset($new_url['function'])) {
                $s .= "/{$new_url['function']}";
            }

            // Arguments
            foreach ($new_url['arguments'] as $arg) {
                $s .= "/$arg";
            }

            $new_url['string'] = $s;


            // Add segments key
            $new_url['segments'] = explode('/', $new_url['string']);
        }


        // Controller class
        $new_url['controller_class'] = explode('/', $new_url['controller']);
        $new_url['controller_class'] = end($new_url['controller_class']);


        self::$current = $new_url;
        return $new_url;
    }


    /**
     * Function: controller
     *    Returns the loaded controller for the current route.
     *
     * Parameters:
     *    $path - String
     *
     * Returns:
     *
     */
    public static function controller($path = FALSE)
    {
        return ($path) ? self::$current['controller'] : self::$current['controller_class'];
    }


    /**
     * Function: method
     *    Returns the loaded method for the current route.
     *
     * Parameters:
     *
     *
     * Returns:
     *
     */
    public static function method()
    {
        return self::$current['function'];
    }


    /**
     * Function: arguments
     *    Returns the arguments passed to the loaded method for the current route.
     *
     * Parameters:
     *
     *
     * Returns:
     *
     */
    public static function arguments()
    {
        return self::$current['arguments'];
    }
}

/**
 * Class: new_rout
 */
class new_rout extends dingo
{

    static $route = array();
    static $current = array();
    static $pattern = array(
        'int' => '/^([0-9]+)$/',
        'numeric' => '/^([0-9\.]+)$/',
        'alpha' => '/^([a-zA-Z]+)$/',
        'alpha-int' => '/^([a-zA-Z0-9]+)$/',
        'alpha-numeric' => '/^([a-zA-Z0-9\.]+)$/',
        'words' => '/^([_a-zA-Z0-9\- ]+)$/',
        'any' => '/^(.*?)$/',
        'extension' => '/^([a-zA-Z]+)\.([a-zA-Z]+)$/',
        'plugin' => '/^([_a-zA-Z0-9\- ]+)\.([a-zA-Z]+)$/',
    );


    // Validate
    // ---------------------------------------------------------------------------
    public static function valid($r)
    {

        foreach ($r['segments'] as $segment) {

            if (!preg_match(ALLOWED_CHARS, $segment)) {

                return FALSE;

            }

        }

        return TRUE;

    }


    // Pattern
    // ---------------------------------------------------------------------------
    public static function pattern($name, $regex)
    {

        self::$pattern[$name] = $regex;

    }


    // Post
    // ---------------------------------------------------------------------------
    public static function add($routes)
    {

        foreach ($routes as $key => $val) {

            self::$route[$key] = explode('.', $val);

        }

    }

    // Get
    // ---------------------------------------------------------------------------
    public static function get($url)
    {

        $controller = false;
        $method = false;

        $url = preg_replace('/^(\/)/', '', $url); // Remove beginning slash
        $segments = explode('/', $url);         // Split into segments


        // 1) Default route
        if (empty($segments[0])) {

            // Get
            if (isset(self::$route['/'])) {

                return array('controller' => self::$route['/'][0], 'method' => self::$route['/'][1], 'args' => array());

            } // No default route
            else {

                die('No default route set. WTF'); // TODO: remove this

            }

        }


        // 2) Loops routes
        foreach (self::$route as $pattern => $location) {

            // Skip default route
            if ($pattern != '/') {

                $pattern_segments = explode('/', $pattern);

                // Skip if segment count doesn't match
                // TODO: Add checks for special segment types
                if (count($pattern_segments) == count($segments)) {

                    $args = array();

                    // Loop pattern segments
                    for ($i = 0; $i < count($pattern_segments); $i++) {

                        // Pattern segment
                        if (preg_match('/^:/', $pattern_segments[$i])) {

                            // Check to see if they don't match pattern
                            if (!preg_match(self::$pattern[substr($pattern_segments[$i], 1)], $segments[$i])) {

                                // Skip to next route entry
                                continue 2;

                            } else {

                                // Add to arguments array
                                $args[] = $segments[$i];

                            }

                            // Regular segment
                        } else {

                            // Check to see if they don't match
                            if ($segments[$i] != $pattern_segments[$i]) {

                                // Skip to next route entry
                                continue 2;

                            }

                        }

                    }

                    // If it gets to here, then everything matches
                    return array('controller' => $location[0], 'method' => $location[1], 'args' => $args);

                }

            }

        }

        die('No route found'); // TODO: change to 404

    }


    // Controller
    // ---------------------------------------------------------------------------
    public static function controller($path = FALSE)
    {
        return ($path) ? self::$current['controller'] : self::$current['controller_class'];
    }


    // Method
    // ---------------------------------------------------------------------------
    public static function method()
    {
        return self::$current['function'];
    }


    // Arguments
    // ---------------------------------------------------------------------------
    public static function arguments()
    {
        return self::$current['arguments'];
    }
}


/**
 * Class: url_map
 */
class url_map extends new_rout
{

    // Get
    // ---------------------------------------------------------------------------
    public static function get($url)
    {

        $controller = false;
        $method = false;

        $url = preg_replace('/^(\/)/', '', $url); // Remove beginning slash
        $segments = explode('/', $url);         // Split into segments


        // 1) Default route
        if (empty($segments[0])) {

            // Get
            if (isset(parent::$route['/'])) {

                return array('controller' => parent::$route['/'][0], 'method' => parent::$route['/'][1], 'args' => array());

            } // No default route
            else {

                die('No default route set. WTF'); // TODO: remove this

            }

        }

        // 2) Loops routes
        foreach (parent::$route as $pattern => $location) {

            // Skip default route
            if ($pattern != '/') {

                $pattern_segments = explode('/', $pattern);

                // Skip if segment count doesn't match
                // TODO: Add checks for special segment types
                if (count($pattern_segments) == count($segments)) {

                    $args = array();

                    // Loop pattern segments
                    for ($i = 0; $i < count($pattern_segments); $i++) {

                        // Pattern segment
                        if (preg_match('/^:/', $pattern_segments[$i])) {

                            // Check to see if they don't match pattern
                            if (!preg_match(parent::$pattern[substr($pattern_segments[$i], 1)], $segments[$i])):

                                // Skip to next route entry
                                continue 2;

                            else:

                                // Add to arguments array
                                $args[] = $segments[$i];

                            endif;

                            // Regular segment
                        } else {

                            // Check to see if they don't match
                            if ($segments[$i] != $pattern_segments[$i])
                                // Skip to next route entry
                                continue 2;

                        }

                    }

                    // If it gets to here, then everything matches
                    //return array('controller'=>$location[0], 'method'=>$location[1], 'args'=>$args);
                    return $location[0] . '_' . $location[1];
                }

            }

        }

        return null;
    }
}


/**
 * Class: load
 */
class load extends dingo
{
    /**
     * Function: file
     *    Used to load various files in the application.
     *
     * Parameters:
     *    $folder - string
     *    $file - string
     *    $name - string ( controller, configuration, language, library, helper, ORM )
     *
     * Returns:
     *    Exception
     *    require_once $folder/$file
     */
    public static function file($folder, $file, $name = '')
    {
        try {
            // If file does not exist display error
            if (!file_exists("$folder/$file.php")) {
                //dingo_error(E_USER_ERROR,"The requested $name ($folder/$file.php) could not be found.");
                $error = "The requested $name ($folder/$file.php) could not be found.";
                throw new Exception($error);
                return FALSE;
            } else {
                require_once("$folder/$file.php");
                return TRUE;
            }
        } catch (Exception $ex) {
            dingo_exception($ex);
        }
    }


    /**
     * Function: controller
     *    Controllers display pages, make database queries, and pass data to Views.
     *    Controllers provide the core functionality to the applications.
     *
     * Parameters:
     *    $controller - string
     *
     * Returns:
     *    require_once $controller
     *
     * See Also:
     *    <parent_controller>
     */
    public static function controller($controller)
    {
        return self::file(APPLICATION . '/' . config::get('folder_controllers'), $controller, 'controller');
    }


    /**
     * Function: parent_controller
     *    it is possible to make controller classes extend from other controller classes.
     *
     * Parameters:
     *    $controller - string
     *
     * Returns:
     *    require_once $controller
     *
     * See Also:
     *    <controller>
     */
    public static function parent_controller($controller)
    {
        return self::controller($controller);
    }


    /**
     * Function: model
     *    Used to load models for the app.
     *    If the model class does not exist then and if the model can be found it will be required.
     *    If not an error is returned.
     *
     *    If the model class exists then we create a new instance of it.
     *
     * Parameters:
     *    $model - string ( can be a path under the application folder )
     *
     * Returns:
     *    FALSE
     *    require_once $path
     *    new $model_class()
     */
    public static function model($model)
    {
        // Model class
        $model_class = explode('/', $model);
        $model_class = end($model_class) . '_model';


        if (!class_exists($model_class)) {
            $path = config::get('application') . "/" . config::get('folder_models') . "/$model.php";

            // If model does not exist display error
            if (!file_exists($path)) {
                dingo_error(E_USER_ERROR, "The requested model ($path) could not be found.");
                return FALSE;
            } else {
                require_once($path);
            }
        }

        // Return model class
        return new $model_class();
    }


    /**
     * Function: parent_model
     *    In Dingo, it is possible to make model classes extend from other model classes.
     *    For example you may have a model that looks like this:
     *
     * Parameters:
     *
     *
     * Returns:
     *    FALSE
     *    require_once $path / TRUE
     *
     * See Also:
     *    <model>
     */
    public static function parent_model($model)
    {
        // Model class
        $model_class = explode('/', $model);
        $model_class = end($model_class) . '_model';


        if (!class_exists($model_class)) {
            $path = config::get('application') . "/" . config::get('folder_models') . "/$model.php";

            // If model does not exist display error
            if (!file_exists($path)) {
                dingo_error(E_USER_ERROR, "The requested model ($path) could not be found.");
                return FALSE;
            } else {
                require_once($path);
                return TRUE;
            }
        }
    }


    /**
     * Function: error
     *    Used to load error views for the app.
     *
     * Parameters:
     *    $type - string
     *    $title - string
     *    $message - string
     */
    public static function error($type = 'general', $title = NULL, $message = NULL)
    {
        ob_clean();
        require_once(config::get('application') . '/view/error' . "/$type.php");
        ob_end_flush();
        exit;
    }


    // Config
    // ---------------------------------------------------------------------------
    public static function config($file)
    {
        return self::file(APPLICATION . '/' . CONFIG . '/' . CONFIGURATION, $file, 'configuration');
    }


    /**
     * Function: language
     *    A wrapper for require_once, It loads a file from application/language
     *
     * Parameters:
     *    $helper - string
     */
    public static function language($language)
    {
        return self::file(APPLICATION . '/' . config::get('folder_languages'), $language, 'language');
    }


    /**
     * Function: plugin_view
     *    Used to load views that are located inside a plugin for the admin app.
     *
     * Parameters:
     *    $path - String
     *    $data - Mixed
     *
     * Returns:
     *    FALSE
     */
    public static function plugin_view($path = '', $data = '')
    {

        // If plugin does not exist display error
        if (!file_exists(TENTACLE_PLUGIN . "/$path.php")) {
            dingo_error(E_USER_WARNING, 'The requested plugin view (' . TENTACLE_PLUGIN . "/$path.php) could not be found.");
            return FALSE;
        } // if
        else {
            // If data is array, convert keys to variables
            if (is_array($data)) {
                extract($data, EXTR_OVERWRITE);
            }

            require(TENTACLE_PLUGIN . "/$path.php");
            return FALSE;
        } // else
    }


    /**
     * Function: view
     *    Used to load views in the admin and install app.
     *
     * Parameters:
     *    $view - String - The view to be loaded
     *    $data - Mixed - Data that will be available to the view.
     *
     * Returns:
     *    FALSE
     */
    public static function view($view, $data = NULL)
    {
        // If view does not exist display error
        if (!file_exists(config::get('application') . '/' . config::get('folder_views') . "/$view.php")) {
            dingo_error(E_USER_WARNING, 'The requested view (' . config::get('application') . '/' . config::get('folder_views') . "/$view.php) could not be found.");
            return FALSE;
        } else {
            // If data is array, convert keys to variables
            if (is_array($data)) {
                extract($data, EXTR_OVERWRITE);
            }

            require(config::get('application') . '/' . config::get('folder_views') . "/$view.php");
            return FALSE;
        }
    }


    /**
     * Function: library
     * Loads libraries used in the core framework as well as for Tentacle.
     * $folder is both the folder and the file to load unless the library requires a different name.
     *
     * Parameters:
     *     $file - string
     *     $folder - String
     *
     * Returns:
     *     Required library
     */
    public static function library($folder, $file = '')
    {

        if (file_exists(APPLICATION . '/library/' . $folder . '/' . $file . '.php')):
            return self::file(APPLICATION . '/library/' . $folder, $file, 'library');

        elseif (file_exists(APPLICATION . '/library/' . $folder . '/' . $folder . '.php')):
            return self::file(APPLICATION . '/library/' . $folder, $folder, 'library');

        else:
            return self::file(APPLICATION . '/library', $folder, 'library');
        endif;
    }


    // Driver
    // ---------------------------------------------------------------------------
    /*
    public static function driver($library,$driver)
    {
        return self::file(SYSTEM."/driver/$library",$driver,'drver');
    }
    */


    /**
     * Function: helper
     *    A wrapper for require_once, It loads a file from application/helper
     *
     * Parameters:
     *    $helper - string
     */
    public static function helper($helper)
    {
        return self::file(APPLICATION . '/' . config::get('folder_helpers'), $helper, 'helper');
    }


    // ORM Class
    // ---------------------------------------------------------------------------
    public static function orm_class($orm)
    {
        return self::file(APPLICATION . '/' . config::get('folder_orm'), $orm, 'ORM');
    }


    // ORM
    // ---------------------------------------------------------------------------
    public static function orm($orm)
    {
        self::orm_class($orm);

        // ORM class
        $orm_class = explode('/', $orm);
        $orm_class = end($orm_class) . '_orm';
        return new $orm_class();
    }


    // Parent ORM
    // ---------------------------------------------------------------------------
    public static function parent_orm($orm)
    {
        return self::orm($orm);
    }
}

/**
 * Class: input
 */
class input extends dingo
{
    /**
     * Function: post
     *    Wrapper for $_POST
     *
     * Parameters:
     *    $field - $_POST
     *
     * Returns:
     *    $_POST or false
     */
    public static function post($field)
    {
        return (isset($_POST[$field])) ? $_POST[$field] : false;
    }


    /**
     * Function: get
     *    Wrapper for $_GET
     *
     * Parameters:
     *    $field - $_GET
     *
     * Returns:
     *    $_GET or false
     */
    public static function get($field)
    {
        return (isset($_GET[$field])) ? $_GET[$field] : false;
    }


    /**
     * Function: cookie
     *    Wrapper for $_COOKIE
     *
     * Parameters:
     *    $field - $_COOKIE
     *
     * Returns:
     *    $_COOKIE or false
     */
    public static function cookie($field)
    {
        return (isset($_COOKIE[$field])) ? $_COOKIE[$field] : false;
    }


    /**
     * Function: files
     *    Wrapper for $_FILES
     *
     * Parameters:
     *    $field - $_FILES
     *
     * Returns:
     *    $_FILES or false
     */
    public static function files($field)
    {
        return (isset($_FILES[$field])) ? $_FILES[$field] : false;
    }


    /**
     * Function: request
     *    Wrapper for $_REQUEST
     *
     * Parameters:
     *    $field - $_REQUEST
     *
     * Returns:
     *    $_REQUEST or false
     */
    public static function request($field)
    {
        return (isset($_REQUEST[$field])) ? $_REQUEST[$field] : false;
    }
}


/**
 * Function: dingo_error
 *    Loads the correct Error view, Will use log.txt if ERROR_LOGGING == TRUE ( set in index.php )
 *
 * Parameters:
 *    $level - constant http://www.php.net/manual/en/errorfunc.constants.php
 *    $message - String
 *    $file - String
 *    $line - Int/String
 *    $backtrace - String
 *    $code - String
 *
 * See Also:
 *    <dingo_error_log>
 */
function dingo_error($level, $message, $file = 'current file', $line = '(unknown)', $backtrace = '', $code = '')
{
    $fatal = false;
    $exception = false;

    require_once(APP_ROOT . '/application/helper/get_set.php');
    require_once(APP_ROOT . '/application/helper/tentacle.php');

    switch ($level) {
        case('exception'): {
            $prefix = 'Uncaught Exception';
            $exception = true;
        }
            break;
        case(E_RECOVERABLE_ERROR): {
            $prefix = 'Recoverable Error';
            $fatal = true;
        }
            break;
        case(E_USER_ERROR): {
            $prefix = 'Fatal Error';
            $fatal = true;
        }
            break;
        case(E_NOTICE):
        case(E_USER_NOTICE): {
            $prefix = 'Notice';
        }
            break;
        /* E_DEPRECATED & E_USER_DEPRECATED, available as of PHP 5.3 - Use their numbers here to prevent redefining them and two E_NOTICE's */
        case(8192):
        case(16384): {
            $prefix = 'Deprecated';
        }
        case(E_STRICT): {
            $prefix = 'Strict Standards';
        }
            break;
        default: {
            $prefix = 'Warning';
        }
    }

    $error = array(
        'level' => $level,
        'prefix' => $prefix,
        'message' => $message,
        'file' => $file,
        'line' => $line,
        'backtrace' => $backtrace,
        'code' => $code
    );

    if ($fatal) {
        ob_clean();

        if (file_exists(ERROR_VIEW . 'fatal.php')) {
            require(ERROR_VIEW . 'fatal.php');
        } else {
            echo 'Dingo could not locate error file at ' . ERROR_VIEW . 'fatal.php';
        }
        ob_end_flush();

        if (ERROR_LOGGING) {
            dingo_error_log($error, 3);
        }

        exit;
    } elseif ($exception) {
        ob_clean();

        if (file_exists(ERROR_VIEW . 'exception.php')) {
            require(ERROR_VIEW . 'exception.php');
        } else {
            echo 'Dingo could not locate exception file at ' . ERROR_VIEW . 'exception.php';
        }

        ob_end_flush();

        if (ERROR_LOGGING) {
            dingo_error_log($error, 2);
        }


        exit;
    } elseif (DEBUG) {
        if (file_exists(ERROR_VIEW . 'nonfatal.php')) {
            require(ERROR_VIEW . 'nonfatal.php');
        } else {
            echo 'Dingo could not locate error file at ' . ERROR_VIEW . 'nonfatal.php';
        }

        if (ERROR_LOGGING) {
            dingo_error_log($error, 1);
        }

    }
}


/**
 * Function: dingo_exception
 *    Applies the Dingo Exception on dingo_error()
 *
 * Parameters:
 *    $ex - Object
 *
 * See Also:
 *    <dingo_error>
 */
function dingo_exception($ex)
{
    dingo_error('exception', $ex->getMessage(), $ex->getFile(), $ex->getLine(), $ex->getTrace(), $ex->getCode());
}


/**
 * Function: dingo_error_log
 *    Simply writes to the log.
 *
 * Parameters:
 *    $error - Array
 *   $level - Int
 *
 * See Also:
 *    <dingo_error>
 */
function dingo_error_log($error, $level = null)
{
    $error_message = "{$error['message']} IN {$error['file']} ON LINE {$error['line']}";

    logger::file($error['prefix'], $error_message, $level);
}
