<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Dingo Framework URL Library
 *
 * @Author          Evan Byrne
 * @Copyright       2008 - 2010
 * @Project Page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/url-helper
 */

class url
{
	// Base URL
	// ---------------------------------------------------------------------------
	public static function base($ShowIndex = FALSE)
	{
		if($ShowIndex AND !MOD_REWRITE)
		{
			// Include "index.php"
			return(BASE_URL.'index.php/');
		}
		else
		{
			// Don't include "index.php"
			return(BASE_URL);
		}
	}
	
	
	// Page URL
	// ---------------------------------------------------------------------------
	public static function page($path = FALSE)
	{
		if(MOD_REWRITE)
		{
			return(url::base().$path);
		}
		else
		{
			return(url::base(TRUE).$path);
		}
	}
	
	
	// Redirect
	// ---------------------------------------------------------------------------
	public static function redirect($url = '')
	{
		header('Location: '.url::base(TRUE).$url);
		exit;
	}
}