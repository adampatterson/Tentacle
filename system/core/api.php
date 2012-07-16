<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * API Class For Dingo Framework
 *
 * @Author          Evan Byrne
 * @Copyright       2008 - 2010
 * @Project Page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/rest-api
 */

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