<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Input Library For Dingo Framework
 *
 * @Author          Evan Byrne
 * @Copyright       2008 - 2010
 * @Project Page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/form-data-library
 */

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