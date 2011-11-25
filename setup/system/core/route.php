<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Dingo Framework Router Class
 *
 * @Author          Evan Byrne
 * @Copyright       2008 - 2010
 * @Project Page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/routes
 */

class route
{
	private static $route = array();
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