<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Dingo Framework Bootstrap Class
 *
 * @Author          Evan Byrne
 * @Copyright       2008 - 2010
 * @Project Page    http://www.dingoframework.com
 */

class bootstrap
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
        $url = (empty($_SERVER['ORIG_PATH_INFO'])) ? $url : $_SERVER['ORIG_PATH_INFO'];

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
        foreach(array('library','helper') as $type)
        {
            $property = "autoload_$type";

            foreach(config::get($property) as $class)
            {
                load::$type($class);
            }

            if(!empty($controller->$property) AND is_array($controller->$property))
            {
                foreach($controller->$property as $class)
                {
                    load::$type($class);
                }
            }
        }
    }


    // Run
    // ---------------------------------------------------------------------------
    public static function run()
    {
        define('DINGO_VERSION','0.7.1');

        // Start buffer
        ob_start();


        // Load core files
        //require_once(SYSTEM.'/core/core.php');
        //require_once(SYSTEM.'/core/config.php');
        //require_once(SYSTEM.'/core/api.php');
        //require_once(SYSTEM.'/core/route.php');
        //require_once(SYSTEM.'/core/load.php');
        //require_once(SYSTEM.'/core/input.php');
        //require_once(SYSTEM.'/core/error.php');
        require_once(APPLICATION.'/'.CONFIG.'/'.CONFIGURATION.'/config.php');


        set_error_handler('dingo_error');
        set_exception_handler('dingo_exception');


        config::set('system',APPLICATION);
        config::set('application',APPLICATION);
        config::set('config',CONFIG);


        // Load route configuration
        require_once(APPLICATION.'/'.CONFIG.'/'.CONFIGURATION.'/route.php');


        // Get route
        $uri = route::get(bootstrap::get_request_url());


        // Set current page
        define('CURRENT_PAGE',$uri['string']);

        // Validate
        if(!route::valid($uri))
        {
            load::error('general','Invalid URL','The requested URL contains invalid characters.');
        }


        // Load Controller
        //----------------------------------------------------------------------------------------------

        // If controller does not exist, give 404 error
        if(!file_exists(APPLICATION.'/'.config::get('folder_controllers')."/{$uri['controller']}.php"))
        {
            load::error('404');
        }


        // Include controller
        require_once(APPLICATION.'/'.config::get('folder_controllers')."/{$uri['controller']}.php");

        // Initialize controller
        $tmp = "{$uri['controller_class']}_controller";
        $controller = new $tmp();
        unset($tmp);


        // Check if using valid REST API
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


        // Autoload Components
        bootstrap::autoload($controller);

        // Load the modules here so that we can set route's, and use the Hooks in all areas of the application.
        // Check to see if we are installed so we dont explode.
        if (class_exists('get') && get::option('is_blog_installed')) {
            load::library('YAML');
            load::helper('module');
            init_extensions();
        }

        // Check to see if function exists
        if(!is_callable(array($controller,$uri['function'])))
        {
            // Try replacing underscores with dashes
            $minus_function_name = str_replace('-', '_', $uri['function']);

            if(!is_callable(array($controller,$minus_function_name)))
            {
                load::error('404');
            }
            else
            {
                $uri['function'] = $minus_function_name;
            }

        }

        // Run Function
        call_user_func_array(array($controller,$uri['function']),$uri['arguments']);


        // Display echoed content
        ob_end_flush();
    }
}


class dingo{}

class cookie
{
    // Set Cookie
    // ---------------------------------------------------------------------------
    public static function set($settings)
    {

        if(!isset($settings['path'])){$settings['path']='/';}
        if(!isset($settings['domain'])){$settings['domain']=FALSE;}
        if(!isset($settings['secure'])){$settings['secure']=FALSE;}
        if(!isset($settings['httponly'])){$settings['httponly']=FALSE;}
        if(!isset($settings['expire']))
        {
            $ex = new DateTime();
            $time = $ex->format('U');
        }
        else
        {
            $ex = new DateTime();
            $ex->modify($settings['expire']);
            $time = $ex->format('U');
        }

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


    // Delete Cookie
    // ---------------------------------------------------------------------------
    public static function delete($settings)
    {
        if(!isset($settings['path'])){$settings['path']='/';}
        if(!isset($settings['domain'])){$settings['domain']=FALSE;}
        if(!isset($settings['secure'])){$settings['secure']=FALSE;}
        if(!isset($settings['httponly'])){$settings['httponly']=FALSE;}

        // If given array of settings
        if(is_array($settings))
        {
            return setcookie(
                $settings['name'],
                '',
                time()-3600,
                $settings['path'],
                $settings['domain'],
                $settings['secure'],
                $settings['httponly']
            );
        }
        // Else, just the cookie name was given
        else
        {
            return setcookie($settings,'',time()-3600);
        }
    }
}

class config
{
    private static $x = array();


    // Set
    // ---------------------------------------------------------------------------
    public static function set($name,$val)
    {
        self::$x[$name] = $val;
    }


    // Get
    // ---------------------------------------------------------------------------
    public static function get($name)
    {
        if(isset(self::$x[$name]))
        {
            return(self::$x[$name]);
        }
        else
        {
            return FALSE;
        }
    }


    // Remove
    // ---------------------------------------------------------------------------
    public static function remove($name)
    {
        if(isset(self::$x[$name]))
        {
            unset(self::$x[$name]);
        }
    }


    // Rename
    // ---------------------------------------------------------------------------
    public static function rename($old,$new)
    {
        self::$x[$new] = self::$x[$old];
        unset(self::$x[$old]);
    }
}

class api
{
    private static $_reg = array();
    private static $_current = FALSE;


    // Permit
    // ---------------------------------------------------------------------------
    public static function permit()
    {
        foreach(func_get_args() as $e)
        {
            self::$_reg[] = $e;
        }
    }


    // Allowed
    // ---------------------------------------------------------------------------
    public static function allowed($api)
    {
        return in_array($api,self::$_reg);
    }


    // Register
    // ---------------------------------------------------------------------------
    public static function set($api)
    {
        self::$_current = $api;
    }


    // Current
    // ---------------------------------------------------------------------------
    public static function get()
    {
        return self::$_current;
    }
}


class route
{
    static $route = array();
    private static $current = array();


    // Validate
    // ---------------------------------------------------------------------------
    public static function valid($r)
    {
        foreach($r['segments'] as $segment)
        {
            if(!preg_match(ALLOWED_CHARS,$segment))
            {
                return FALSE;
            }
        }

        return TRUE;
    }


    // Set
    // ---------------------------------------------------------------------------
    public static function set($url,$r)
    {
        self::$route[$url] = $r;
    }


    // Get
    // ---------------------------------------------------------------------------
    public static function get($url)
    {
        $url = preg_replace('/^(\/)/','',$url);
        $new_url = $url;

        // REST API
        if(preg_match('/\.([\-_a-zA-Z]+)$/',$new_url))
        {
            $split = explode('.',$new_url);
            api::set(array_pop($split));
            $new_url = implode('.',$split);
        }

        // Static routes
        if(!empty(self::$route[$url]))
        {
            $new_url = self::$route[$url];
        }

        // Regex routes
        $route_keys = array_keys(self::$route);

        foreach($route_keys as $okey)
        {
            $key = ('/^'.str_replace('/','\\/',$okey).'$/');

            if(preg_match($key,$url))
            {
                if(!is_array(self::$route[$okey]))
                {
                    $new_url = preg_replace($key,self::$route[$okey],$url);
                }
                else
                {
                    /* Run regex replace on keys */
                    $new_url = self::$route[$okey];

                    // Controller
                    if(isset($new_url['controller']))
                    {
                        $new_url['controller'] = preg_replace($key,$new_url['controller'],$url);
                    }

                    // Function
                    if(isset($new_url['function']))
                    {
                        $new_url['function'] = preg_replace($key,$new_url['function'],$url);
                    }

                    // Arguments
                    if(isset($new_url['arguments']))
                    {
                        $x = 0;
                        while(isset($new_url['arguments'][$x]))
                        {
                            $new_url['arguments'][$x] = preg_replace($key,$new_url['arguments'][$x],$url);
                            $x += 1;
                        }
                    }
                }
            }

        }

        // If URL is empty use default route
        if(empty($new_url) OR $new_url == '/')
        {
            $new_url = self::$route['default_route'];
        }

        // Turn into array
        if(!is_array($new_url))
        {
            // Remove the /index.php/ at the beginning
            //$new_url = preg_replace('/^(\/)/','',$url);

            $tmp_url = explode('/',$new_url);
            $new_url = array('controller'=>$tmp_url[0],'function'=>'index','arguments'=>array(),'string'=>$new_url,'segments'=>$tmp_url);

            // Function
            if(!empty($tmp_url[1]))
            {
                $new_url['function'] = $tmp_url[1];
            }

            // Arguments
            $x = 2;
            while(isset($tmp_url[$x]))
            {
                $new_url['arguments'][] = $tmp_url[$x];
                $x += 1;
            }
        }

        // If already array
        else
        {
            // Add missing keys
            if(!isset($new_url['function']))
            {
                $new_url['function'] = 'index';
            }

            if(!isset($new_url['arguments']))
            {
                $new_url['arguments'] = array();
            }


            // Build string key for URL array
            // Controller
            $s = $new_url['controller'];

            // Function
            if(isset($new_url['function']))
            {
                $s .= "/{$new_url['function']}";
            }

            // Arguments
            foreach($new_url['arguments'] as $arg)
            {
                $s .= "/$arg";
            }

            $new_url['string'] = $s;


            // Add segments key
            $new_url['segments'] = explode('/',$new_url['string']);
        }


        // Controller class
        $new_url['controller_class'] = explode('/',$new_url['controller']);
        $new_url['controller_class'] = end($new_url['controller_class']);


        self::$current = $new_url;
        return $new_url;
    }


    // Controller
    // ---------------------------------------------------------------------------
    public static function controller($path=FALSE)
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


class load
{
    // File
    // ---------------------------------------------------------------------------
    public static function file($folder,$file,$name)
    {

        try {
            // If file does not exist display error
            if(!file_exists("$folder/$file.php"))
            {
                //dingo_error(E_USER_ERROR,"The requested $name ($folder/$file.php) could not be found.");
                $error = "The requested $name ($folder/$file.php) could not be found.";
                throw new Exception($error);
                return FALSE;
            }
            else
            {
                require_once("$folder/$file.php");
                return TRUE;
            }
        } catch (Exception $ex) {
            dingo_exception($ex);
        }
    }


    // Controller
    // ---------------------------------------------------------------------------
    public static function controller($controller)
    {
        return self::file(APPLICATION.'/'.config::get('folder_controllers'),$controller,'controller');
    }


    // Parent Controller
    // ---------------------------------------------------------------------------
    public static function parent_controller($controller)
    {
        return self::controller($controller);
    }


    // Model
    // ---------------------------------------------------------------------------
    public static function model($model,$args=array())
    {
        // Model class
        $model_class = explode('/',$model);
        $model_class = end($model_class).'_model';


        if(!class_exists($model_class))
        {
            $path = config::get('application')."/".config::get('folder_models')."/$model.php";

            // If model does not exist display error
            if(!file_exists($path))
            {
                dingo_error(E_USER_ERROR,"The requested model ($path) could not be found.");
                return FALSE;
            }
            else
            {
                require_once($path);
            }
        }

        // Return model class
        return new $model_class();
    }


    // Parent Model
    // ---------------------------------------------------------------------------
    public static function parent_model($model)
    {
        // Model class
        $model_class = explode('/',$model);
        $model_class = end($model_class).'_model';


        if(!class_exists($model_class))
        {
            $path = config::get('application')."/".config::get('folder_models')."/$model.php";

            // If model does not exist display error
            if(!file_exists($path))
            {
                dingo_error(E_USER_ERROR,"The requested model ($path) could not be found.");
                return FALSE;
            }
            else
            {
                require_once($path);
                return TRUE;
            }
        }
    }


    // Error
    // ---------------------------------------------------------------------------
    public static function error($type = 'general',$title = NULL,$message = NULL)
    {
        ob_clean();
        require_once(config::get('application').'/view/error'."/$type.php");
        ob_end_flush();
        exit;
    }


    // Config
    // ---------------------------------------------------------------------------
    public static function config($file)
    {
        return self::file(APPLICATION.'/'.CONFIG.'/'.CONFIGURATION,$file,'configuration');
    }


    // Language
    // ---------------------------------------------------------------------------
    public static function language($language)
    {
        return self::file(APPLICATION.'/'.config::get('folder_languages'),$language,'language');
    }


    // View
    // ---------------------------------------------------------------------------
    public static function view($view,$data = NULL)
    {
        // If view does not exist display error
        if(!file_exists(config::get('application').'/'.config::get('folder_views')."/$view.php"))
        {
            dingo_error(E_USER_WARNING,'The requested view ('.config::get('application').'/'.config::get('folder_views')."/$view.php) could not be found.");
            return FALSE;
        }
        else
        {
            // If data is array, convert keys to variables
            if(is_array($data))
            {
                extract($data, EXTR_OVERWRITE);
            }

            require(config::get('application').'/'.config::get('folder_views')."/$view.php");
            return FALSE;
        }
    }


    /**
     * Function: library
     * Loads libraries specific to Tentacle
     * $file is both the folder and the file to load unless the library requires a different name.
     *
     * Parameters:
     *     $file - string
     *     $folder - String
     *
     * Returns:
     *     Required library
     */
    public static function library($folder, $file ='')
    {

        if( file_exists(APPLICATION.'/library/'.$folder.'/'.$folder.'.php' ) ):
           return self::file(APPLICATION.'/library/'.$folder,$folder,'library');

        elseif( file_exists(APPLICATION.'/library/'.$folder.'/'.$file.'.php' ) ):
           return self::file(APPLICATION.'/library/'.$folder,$file,'library');

        else:
           return self::file(APPLICATION.'/library',$folder,'library');
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


    // Helper
    // ---------------------------------------------------------------------------
    public static function helper($helper)
    {
        return self::file(APPLICATION.'/'.config::get('folder_helpers'),$helper,'helper');
    }


    // ORM Class
    // ---------------------------------------------------------------------------
    public static function orm_class($orm)
    {
        return self::file(APPLICATION.'/'.config::get('folder_orm'),$orm,'ORM');
    }


    // ORM
    // ---------------------------------------------------------------------------
    public static function orm($orm)
    {
        self::orm_class($orm);

        // ORM class
        $orm_class = explode('/',$orm);
        $orm_class = end($orm_class).'_orm';

        return new $orm_class();
    }


    // Parent ORM
    // ---------------------------------------------------------------------------
    public static function parent_orm($orm)
    {
        return self::orm($orm);
    }
}


class input
{
    // Post
    // ---------------------------------------------------------------------------
    public static function post($field)
    {
        return (isset($_POST[$field])) ? $_POST[$field] : false;
    }


    // Get
    // ---------------------------------------------------------------------------
    public static function get($field)
    {
        return (isset($_GET[$field])) ? $_GET[$field] : false;
    }


    // Cookie
    // ---------------------------------------------------------------------------
    public static function cookie($field)
    {
        return (isset($_COOKIE[$field])) ? $_COOKIE[$field] : false;
    }


    // Files
    // ---------------------------------------------------------------------------
    public static function files($field)
    {
        return (isset($_FILES[$field])) ? $_FILES[$field] : false;
    }


    // Request
    // ---------------------------------------------------------------------------
    public static function request($field)
    {
        return (isset($_REQUEST[$field])) ? $_REQUEST[$field] : false;
    }
}


// Errors
// ---------------------------------------------------------------------------
function dingo_error($level,$message,$file='current file',$line='(unknown)',$backtrace='', $code ='')
{
    $fatal = false;
    $exception = false;

    switch($level)
    {
        case('exception'):
        {
            $prefix = 'Uncaught Exception';
            $exception = true;
        }
            break;
        case(E_RECOVERABLE_ERROR):
        {
            $prefix = 'Recoverable Error';
            $fatal	 = true;
        }
            break;
        case(E_USER_ERROR):
        {
            $prefix = 'Fatal Error';
            $fatal	 = true;
        }
            break;
        case(E_NOTICE):
        case(E_USER_NOTICE):
        {
            $prefix = 'Notice';
        }
            break;
        /* E_DEPRECATED & E_USER_DEPRECATED, available as of PHP 5.3 - Use their numbers here to prevent redefining them and two E_NOTICE's */
        case(8192):
        case(16384):
        {
            $prefix = 'Deprecated';
        }
        case(E_STRICT):
        {
            $prefix = 'Strict Standards';
        }
            break;
        default:
            {
            $prefix = 'Warning';
            }
    }

    $error = array(
        'level'=>$level,
        'prefix'=>$prefix,
        'message'=>$message,
        'file'=>$file,
        'line'=>$line,
        'backtrace'=>$backtrace,
        'code'=>$code
    );

    if($fatal)
    {
        ob_clean();

        if(file_exists(APPLICATION.'/view/error/fatal.php'))
        {
            require(APPLICATION.'/view/error/fatal.php');
        }
        else
        {
            echo 'Dingo could not locate error file at '.APPLICATION.'/view/error/fatal.php';
        }

        ob_end_flush();
        exit;
    }
    elseif($exception)
    {
        ob_clean();

        if(file_exists(APPLICATION.'/view/error/exception.php'))
        {
            require(APPLICATION.'/view/error/exception.php');
        }
        else
        {
            echo 'Dingo could not locate exception file at '.APPLICATION.'/view/error/exception.php';
        }

        ob_end_flush();
        exit;
    }
    elseif(DEBUG)
    {
        if(file_exists(APPLICATION.'/view/error/nonfatal.php'))
        {
            require(APPLICATION.'/view/error/nonfatal.php');
        }
        else
        {
            echo 'Dingo could not locate error file at '.APPLICATION.'/view/error/nonfatal.php';
        }
    }

    if(ERROR_LOGGING)
    {
        dingo_error_log($error);
    }
}


// Exceptions
// ---------------------------------------------------------------------------
function dingo_exception($ex)
{
    dingo_error('exception',$ex->getMessage(),$ex->getFile(),$ex->getLine(), $ex->getTrace(), $ex->getCode() );
    //echo "<p>Uncaught exception in {$exception->getFile()} on line {$exception->getLine()}: <strong>{$exception->getMessage()}</strong></p>";
}


// Error Logging
// ---------------------------------------------------------------------------
function dingo_error_log($error)
{
    $date = date('g:i A M d Y');

    $fh = fopen(ERROR_LOG_FILE,'a');
    flock($fh,LOCK_EX);
    fwrite($fh,"[$date] {$error['prefix']}: {$error['message']} IN {$error['file']} ON LINE {$error['line']}\n");
    flock($fh,LOCK_UN);
    fclose($fh);
}