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
		require_once(SYSTEM.'/core/core.php');
		require_once(SYSTEM.'/core/config.php');
		require_once(SYSTEM.'/core/api.php');
		require_once(SYSTEM.'/core/route.php');
		require_once(SYSTEM.'/core/load.php');
		require_once(SYSTEM.'/core/input.php');
		require_once(SYSTEM.'/core/error.php');
		require_once(APPLICATION.'/'.CONFIG.'/'.CONFIGURATION.'/config.php');
		
		
		set_error_handler('dingo_error');
		set_exception_handler('dingo_exception');
		
		
		config::set('system',SYSTEM);
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
        load::helper('module');
        init_extensions();


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

