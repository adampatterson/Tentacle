<?php if ( !defined('DINGO') ) { die('External Access to File Denied'); }
/**
 * assets class
 *
 * @package default
 * @author Adam Patterson
 **/
class assets 
{
	
	// {{ 'style.css' | asset_url | stylesheet_tag }}
	// {{ 'style.js' | asset_url | script_tag }}
	
/**
 * assets function
 *
 * @author Adam Patterson
 * assets() will accept an comma separated string of files that will relate to bundle files in the 
 * tentacle admin folder, as well as an output format for normal or minify and asset type.
 *
 * assets() will be passed a comma separated string from the load::view that sets the header file.
 *
 * @example assets( @array, minify, css)
 **/
	public static function render ($assets = '', $format = null, $type = null) 
	{
		$exploded_assets = explode(',', $assets);

		// Setup the return List
		$asset_list = '';
		
		foreach ($exploded_assets as $asset):
			$asset_list .= self::build($asset);
		endforeach;
		
		 echo $asset_list;
	}
	
	
/**
 * build function
 *
 * @return html
 * @author Adam Patterson
 **/
	public static function build ( $file = NULL ) 
	{
		$file = self::load($file);
		
		if (file_exists($file))
		    include($file);
		elseif (DEBUG == TRUE)
		    echo '<!-- Could not find: '. $file .'-->';
	}


/**
 * load function
 *
 * @return string
 * @author Adam Patterson
 **/
	public static function load ( $load_file = NULL ) 
	{				
		// Old admin setting ( not using at the moment )
		//return ADMIN_BUNDLE.$load_file.'.php';
		
		return PATH_URI.'/bundles/'.$load_file.'.php';
	}
	
} // END class assets
?>