<?php if(!defined('DINGO')){die('External Access to File Denied');}
	
function _cleanup_header_comment($str) 
{
	return trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $str));
}

function get_themes()
{
  	$themes = array();
	$dir = THEMES_DIR.'/';
	if ($handle = opendir($dir))
	{
		while (false !== ($file = readdir($handle)))
		{
			if (strpos($file, '.') !== 0 && is_dir($dir.$file))
			{

				$theme_index = glob(THEMES_DIR.'/'.$file.'/index.php');
				if (empty($theme_index)) {
					$theme_index = array();	
					$theme_index[0] = NULL;
				}

				$theme_screenshot = glob(THEMES_URL.'/'.$file.'/screenshot.png');	
				if (empty($theme_screenshot)) {
					$theme_screenshot = array();
					$theme_screenshot[0] = NULL;
				}
				
				$theme_style = glob(THEMES_URL.'/'.$file.'/style.css');
				if (empty($theme_style)) {
					$theme_style = array();								
					$theme_style[0] = NULL;
				}

				$themes[$file]['index'] = $theme_index[0];
				$themes[$file]['screenshot'] = $theme_screenshot[0];
				$themes[$file]['style'] = $theme_style[0];
				$themes[$file]['theme-name'] = inflector::humanize($file);
				
			}
		}
		closedir($handle);
	}
	asort($themes);
	
	return($themes);
}// Get Themes

# @todo Consider using the same method of loading template files for themes.
function get_settings( $index_path = '' )
{
	
	$index_file = $index_path.'/index.php';
	
	if ( file_exists( $index_file ) ) 
	{
		# @todo Load the file don't include it.
		include $index_file;
		
		if ( isset( $settings ) ) 
		{
			return $settings;
		} 
		else 
		{
			return NULL;
		}
		
	} 
	else 
	{
		return NULL;
	}
	
} // Get Settings


function get_resources( $index_path = '' )
{
	
	$index_file = $index_path.'/index.php';
	
	if ( file_exists( $index_file ) ) 
	{
		include $index_file;
		
		if ( isset( $resource_assets ) ) 
		{
			return $resource_assets;
		} 
		else 
		{
			return NULL;
		}
		
	} 
	else 
	{
		return NULL;
	}
	
} // Get Resources


/**
* Retrieve metadata from a file.
* Modified from WordPress
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

	foreach ( $all_headers as $field => $regex ) {
		preg_match( '/^[ \t\/*#@]*' . preg_quote( $regex, '/' ) . ':(.*)$/mi', $file_data, ${$field});
		if ( !empty( ${$field} ) )
			${$field} = _cleanup_header_comment( ${$field}[1] );
		else
			${$field} = '';
	}

	$file_data = compact( array_keys( $all_headers ) );

	return $file_data;
} // get_file_data


function get_data( $theme_file, $context = '' ) 
{

	if ( $context = '' ) {
		
		$default_headers = array(
			'Name' => 'Theme Name',
			'URI' => 'Theme URI',
			'Description' => 'Description',
			'Author' => 'Author',
			'AuthorURI' => 'Author URI',
			'Version' => 'Version',
			'Template' => 'Theme',
			'Status' => 'Status'
			);
			
	} else {

		$default_headers = array(
			'Name' => 'Template Name',
			'URI' => 'Template URI',
			'Description' => 'Description',
			'Author' => 'Author',
			'AuthorURI' => 'Author URI',
			'Version' => 'Version',
			'Template' => 'Template',
			'Status' => 'Status'
			);
	}


	$theme_data = get_file_data( $theme_file, $default_headers, 'theme' );

	$theme_data['Name'] = $theme_data['Title'] = $theme_data['Name'];

	$theme_data['URI'] = $theme_data['URI'];

	$theme_data['Description'] = $theme_data['Description'];

	$theme_data['AuthorURI'] = $theme_data['AuthorURI'];

	$theme_data['Template'] = $theme_data['Template'];

	$theme_data['Version'] = $theme_data['Version'];

	if ( $theme_data['Status'] == '' )
		$theme_data['Status'] = 'publish';
	else
		$theme_data['Status'] = $theme_data['Status'];

	if ( $theme_data['Author'] == '' ) {
		$theme_data['Author'] = $theme_data['AuthorName'] = 'Anonymous';
	} else {
		$theme_data['AuthorName'] = $theme_data['Author'];
		if ( empty( $theme_data['AuthorURI'] ) ) {
			$theme_data['Author'] = $theme_data['AuthorName'];
		} else {
			$theme_data['Author'] = sprintf( '<a href="%1$s" title="%2$s">%3$s</a>', $theme_data['AuthorURI'], esc_attr__( 'Visit author homepage' ), $theme_data['AuthorName'] );
		}
	}

	return $theme_data;
}// Get Theme Data


function get_templates ( $theme_folder ) 
{
	$php_files = glob($theme_folder.'/*.php');	

	foreach ($php_files as $php_file)
	{
		$file = get_data($php_file, 'template');
		
		if ($file['Name'] != '') {
			$template[$php_file]['template_name'] = $file['Name'];
			$template[$php_file]['template_author'] = $file['Author'];
		}
	}

	return($template);
	
} // Get Templates