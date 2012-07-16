<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Dingo Framework Config Class
 *
 * @Author          Evan Byrne
 * @Copyright       2008 - 2010
 * @Project Page    http://www.dingoframework.com
 */


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