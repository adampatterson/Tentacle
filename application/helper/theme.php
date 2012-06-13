<?php if(!defined('DINGO')){die('External Access to File Denied');}
/**
* File: Theme
*/


/**
* Function: _cleanup_header_comment
* 	Converts a given string to camel-case.
*
* Returns:
*     String
*/
function _cleanup_header_comment($str) 
{
	return trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $str));
}


/**
* Function: current_theme
* 	Returns HTML for the current active theme ( sets Bootstrap Label )
*
* Parameters:
*     $theme_id = INT
*
* Returns:
*     HTML
*/
function current_theme( $theme_id = '' ) 
{
	$options = load::model( 'settings' );
	
	if ( $theme_id == $options->get( 'appearance' ) )
	{
		echo '<span class="label success">Active</span>';
	}
}


/**
* Function: get_themes
* 	Returns an array of theme data.
*
* Returns:
*     $themes - Array
*
* See Also:
*     <get_templates>
*/
function get_themes()
{
  	$themes = array();
	$dir = THEMES_DIR;
	if ($handle = opendir($dir))
	{
		while (false !== ($file = readdir($handle)))
		{
			if (strpos($file, '.') !== 0 && is_dir($dir.$file))
			{

				$theme_index = glob(THEMES_DIR.$file.'/index.php');
				if (empty($theme_index)) {
					$theme_index = array();	
					$theme_index[0] = NULL;
				}

				$theme_screenshot = glob(THEMES_DIR.$file.'/screenshot.png');	
				if (empty($theme_screenshot)) {
					$theme_screenshot = array();
					$theme_screenshot[0] = 'http://placehold.it/210x150';
				} else {
					$theme_screenshot[0] = THEMES_URL.'/'.$file.'/screenshot.png';
				}
				
				$theme_style = glob(THEMES_DIR.'/'.$file.'/style.css');
				if (empty($theme_style)) {
					$theme_style = array();								
					$theme_style[0] = NULL;
				} else {
					$theme_style[0] = THEMES_URL.'/'.$file.'/style.css';
				}

				$themes[$file]['index'] = $theme_index[0];
				$themes[$file]['screenshot'] = $theme_screenshot[0];
				$themes[$file]['style'] = $theme_style[0];
				$themes[$file]['theme_name'] = humanize($file);
				$themes[$file]['theme_id'] = $file;
			}
		}
		closedir($handle);
	}
	asort($themes);
	
	return(array_to_object($themes));
}// Get Themes


/**
* Function: get_settings
* 	Returns an array of themes settings parsed from style.css
*
* Parameters:
*     $style_path - String ( theme name )
*
* Returns:
*     $theme - Array
*/
function get_settings ( $style_path = 'default' )
{
	$style_file = THEMES_DIR.$style_path.'/style.css';
	if ( file_exists( $style_file ) ) 
	{
		$file = get_data($style_file, 'theme');
		
		$theme[$style_file]['theme_name'] = $file['Name'];
		$theme[$style_file]['theme_uri'] = $file['URI'];
		$theme[$style_file]['theme_description'] = $file['Description'];
		$theme[$style_file]['theme_author'] = $file['Author'];
		$theme[$style_file]['theme_version'] = $file['Version'];
	} else {
		$theme[$style_file]['theme_description'] = 'This theme has a missing style sheet.';
	}
	
	return( array_to_object( $theme ) );
} // Get Settings


/**
* Function: get_templates
* Returns a list of template files located in $theme_folder
*
* Parameters:
*     $theme_folder - String
*
* Returns:
*     $template - Array
*
* See Also:
*     <get_themes>
*/
function get_templates ( $theme_folder ) 
{
	$php_files = glob(THEMES_DIR.$theme_folder.'/*.php');	

	foreach ($php_files as $php_file):
	
		$file = get_data($php_file, 'template');
		
		$file_name = basename( $php_file );
		$file_id = explode( '.', $file_name );
		
		if ( $file['Name'] != '' ):
			$template[$php_file]['template_id'] = $file_id[0];
			$template[$php_file]['template_name'] = $file['Name'];
			$template[$php_file]['template_uri'] = $file['URI'];
			$template[$php_file]['template_description'] = $file['Description'];
			$template[$php_file]['template_author'] = $file['Author'];
			$template[$php_file]['template_version'] = $file['Version'];
		endif;
	endforeach;

	return( array_to_object( $template ) );
	
} // Get Templates


/**
* Function: get_post_type
*
* Parameters:
*     $theme_folder - String
*
* Returns:
*     $template - Array
*
* See Also:
*     <get_templates> <get_themes>
*/
function get_post_type ( $theme_folder )
{
	$php_files = glob(THEMES_DIR.'/'.$theme_folder.'/type-*.php');	

	foreach ($php_files as $php_file):
	
		$file = get_data($php_file, 'post_type');
		
		$file_name = basename( $php_file );
		$file_id = explode( '.', $file_name );
		
		if ( $file['Type'] != '' ):
			$template[$php_file]['part_id'] = $file_id[0];
			$template[$php_file]['part_name'] = $file['Type'];
		endif;
	endforeach;
	
	return( $template );
} // Get Post Type


/*
function get_resources( $index_path = '' )
{	
	$index_file = $index_path.'/index.php';
	
	if ( file_exists( $index_file ) ):
		include $index_file;
		
		if ( isset( $resource_assets ) ):
			return $resource_assets;
		else:
			return NULL;
		endif;
	else:
		return NULL;
	endif;	
} // Get Resources
*/


/**
* Function: get_file_data
* 	Retrieve metadata from a file.
* 	Modified from WordPress
*
* Parameters:
*     $file - 
*	  $default_headers - 
*
* Returns:
*     $file_data - Array
*/
function get_file_data( $file, $default_headers )
{
	// We don't need to write to the file, so just open for reading.
	$fp = fopen( $file, 'r' );

	// Pull only the first 8kiB of the file in.
	$file_data = fread( $fp, 8192 );

	// PHP will close file handle, but we are good citizens.
	fclose( $fp );

	$all_headers = $default_headers;

	foreach ( $all_headers as $field => $regex ):
		preg_match( '/^[ \t\/*#@]*' . preg_quote( $regex, '/' ) . ':(.*)$/mi', $file_data, ${$field});
		if ( !empty( ${$field} ) )
			${$field} = _cleanup_header_comment( ${$field}[1] );
		else
			${$field} = '';
	endforeach;

	$file_data = compact( array_keys( $all_headers ) );

	return $file_data;
} // get_file_data


/**
* Function: get_data
*
* Parameters:
*     $theme_file - String
*	  $data_type - theme / template / post_type
*
* Returns:
*     $theme_data - Array
*/
function get_data( $theme_file, $data_type ) 
{
	if ( $data_type == 'template' ) {

		$default_headers = array(
			'Name' => 'Name',
			'URI' => 'URI',
			'Description' => 'Description',
			'Author' => 'Author',
			'AuthorURI' => 'Author URI',
			'Version' => 'Version',
			'Template' => 'Template',
			'Status' => 'Status'
			);
			
		$theme_data = get_file_data( $theme_file, $default_headers );

		$theme_data['Name'] = $theme_data['Title'] = $theme_data['Name'];
		$theme_data['URI'] = $theme_data['URI'];
		$theme_data['Description'] = $theme_data['Description'];
		$theme_data['AuthorURI'] = $theme_data['AuthorURI'];
		$theme_data['Template'] = $theme_data['Template'];
		$theme_data['Version'] = $theme_data['Version'];

		if ( $theme_data['Status'] == '' ):
			$theme_data['Status'] = 'publish';
		else:
			$theme_data['Status'] = $theme_data['Status'];
		endif;

		if ( $theme_data['Author'] == '' ):
			$theme_data['Author'] = $theme_data['AuthorName'] = 'Anonymous';
		else:
			$theme_data['AuthorName'] = $theme_data['Author'];
			if ( empty( $theme_data['AuthorURI'] ) ):
				$theme_data['Author'] = $theme_data['AuthorName'];
			else:
				$theme_data['Author'] = sprintf( '<a href="%1$s" title="%2$s">%3$s</a>', $theme_data['AuthorURI'], esc_attr__( 'Visit author homepage' ), $theme_data['AuthorName'] );
			endif;
		endif;
			
		// need to cean out invalid files.
		return $theme_data;
		
	} elseif ( $data_type == 'theme' ) {
		
			$default_headers = array(
				'Name' => 'Name',
				'URI' => 'URI',
				'Description' => 'Description',
				'Author' => 'Author',
				'AuthorURI' => 'Author URI',
				'Version' => 'Version',
				'Template' => 'Template',
				'Status' => 'Status'
				);

			$theme_data = get_file_data( $theme_file, $default_headers );

			$theme_data['Name'] = $theme_data['Title'] = $theme_data['Name'];
			$theme_data['URI'] = $theme_data['URI'];
			$theme_data['Description'] = $theme_data['Description'];
			$theme_data['AuthorURI'] = $theme_data['AuthorURI'];
			$theme_data['Template'] = $theme_data['Template'];
			$theme_data['Version'] = $theme_data['Version'];

			if ( $theme_data['Status'] == '' ):
				$theme_data['Status'] = 'publish';
			else:
				$theme_data['Status'] = $theme_data['Status'];
			endif;

			if ( $theme_data['Author'] == '' ):
				$theme_data['Author'] = $theme_data['AuthorName'] = 'Anonymous';
			else:
				$theme_data['AuthorName'] = $theme_data['Author'];
				if ( empty( $theme_data['AuthorURI'] ) ):
					$theme_data['Author'] = $theme_data['AuthorName'];
				else:
					$theme_data['Author'] = sprintf( '<a href="%1$s" title="%2$s">%3$s</a>', $theme_data['AuthorURI'], esc_attr__( 'Visit author homepage' ), $theme_data['AuthorName'] );
				endif;
			endif;

			// need to cean out invalid files.
			return $theme_data;

		} elseif ( $data_type == 'post_type' ) {
		
		$default_headers = array(
			'Type' => 'Type'
			);	
			
		$theme_data = get_file_data( $theme_file, $default_headers );

		$theme_data['Type'] = $theme_data['Type'];
		
		// need to cean out invalid files.
		return $theme_data;
	}

}// Get Theme Data