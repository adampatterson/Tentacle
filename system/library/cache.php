<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Page Cache Library For Dingo Framework
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/cache-library
 */

class cache
{
	public static $location;
	private static $cached;
	
	
	// Create
	// ---------------------------------------------------------------------------
	public static function create()
	{
		if(!is_dir(self::$location))
		{
			mkdir(self::$location,0777,TRUE);
		}
		
		$fh = fopen(self::$location.'.html','w');
		fwrite($fh,ob_get_contents());
		fclose($fh);
	}
	
	
	// Delete
	// ---------------------------------------------------------------------------
	public static function delete($page)
	{
		$file = config::get('application').'/cache/'.$page.'.html';
		
		if(file_exists($file))
		{
			unlink($file);
		}
	}
	
	
	// Start
	// ---------------------------------------------------------------------------
	public static function start($loc=FALSE)
	{
		if($loc)
		{
			self::$location = config::get('application')."/cache/$loc";
		}
		
		
		if(file_exists(self::$location.'.html'))
		{
			self::$cached = TRUE;
			//header('Dingo:cache-loaded');
			require_once(self::$location.'.html');
			exit;
		}
		else
		{
			self::$cached = FALSE;
		}
	}
	
	
	// End
	// ---------------------------------------------------------------------------
	public static function end()
	{
		if(!self::$cached)
		{
			self::create();
		}
	}
}


cache::$location = config::get('application').'/cache/'.CURRENT_PAGE;