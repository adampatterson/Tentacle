<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Benchmark Library For Dingo Framework
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/benchmark-helper
 */

class bench
{
	public static $markers = array();
	
	
	// Mark
	// ---------------------------------------------------------------------------
	public static function mark($name)
	{
		self::$markers[$name] = microtime();
	}
	
	
	// Time
	// ---------------------------------------------------------------------------
	public static function time($mark1,$mark2)
	{
		return self::$markers[$mark2] - self::$markers[$mark1];
	}
	
	
	// Clear
	// ---------------------------------------------------------------------------
	public static function clear()
	{
		self::$markers = array();
	}
}