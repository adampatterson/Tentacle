<?php if ( !defined('DINGO') ) { die('External Access to File Denied'); }
/**
* Class: Assets
*/
class assets 
{
	
	// {{ 'style.css' | asset_url | stylesheet_tag }}
	// {{ 'style.js' | asset_url | script_tag }}
	
	/**
	* Function: render
	* 	assets() will accept an comma separated string of files that will relate to bundle files in the 
	* 	tentacle admin folder, as well as an output format for normal or minify and asset type.
	*
	* 	assets() will be passed a comma separated string from the load::view that sets the header file.
	*
	* Parameters:
	*	$assets - string
	*	$format - null
	*	$type - JavaScript or CSS
	*
	* Returns:
	*	$asset_list - HTML
	*
	* See Also:
	*	<build>
	*/
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
	* Function: build
	*	Builds the HTML from the bundle
	*
	* Parameters:
	*	$file - bundle file to load
	*
	* Returns:
	*	HTML
	*
	* See Also:
	*	<load>
	*/
	public static function build ( $file = NULL ) 
	{
		$file = self::load($file);
		
		if (file_exists($file))
		    include($file);
		elseif (DEBUG == TRUE)
		    echo '<!-- Could not find: '. $file .'-->';
	}


	/**
	* Function: load
	*	Loads the single bundle file
	*
	* Parameters:
	*	$load_file - File name sent from build()
	*
	* Returns:
	*	String
	*/
	public static function load ( $load_file = NULL ) 
	{				
		// Old admin setting ( not using at the moment )
		//return ADMIN_BUNDLE.$load_file.'.php';
		
		return PATH_URI.'/bundles/'.$load_file.'.php';
	}
	
} // END class assets
?>