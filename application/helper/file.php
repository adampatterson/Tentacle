<?
/**
 * File: File
 */

/**
* Function: delete_dir
*	Deletes a directory
*
* Parameters:
*	$dir - String
*
* Returns:
*	Boolean
*/
function delete_dir($dir) { 
   if (substr($dir, strlen($dir)-1, 1) != '/') 
       $dir .= '/'; 

   if ($handle = opendir($dir)) 
   { 
       while ($obj = readdir($handle)) 
       { 
           if ($obj != '.' && $obj != '..') 
           { 
               if (is_dir($dir.$obj)) 
               { 
                   if (!delete_dir($dir.$obj)) 
                       return false; 
               } 
               elseif (is_file($dir.$obj)) 
               { 
                   if (!unlink($dir.$obj)) 
                       return false; 
               } 
           } 
       } 

       closedir($handle); 

       if (!@rmdir($dir)) 
           return false; 
       return true; 
   } 
   return false; 
}


/**
* Function: recursive_glob
*	Recursively goes through a folder and returns all files.
*
* Parameters:
*	$pattern - String
*	$flags - Boolean
*	$path - String
*
* Returns:
*	$files - Array
*/
function recursive_glob($pattern='*', $flags = 0, $path='')
{
    $paths = glob($path.'*', GLOB_MARK|GLOB_ONLYDIR|GLOB_NOSORT);

    $files = glob($path.$pattern, $flags);
    
	foreach ($paths as $path) { 
		$files=array_merge($files,recursive_glob($pattern, $flags, $path));
	}
	
    return $files;
}


/**
* Function: string_to_parts
*	Takes a file path and returns a mix of pieces.
*
* Parameters:
*	$file - String
*
* Returns:
*	$file_clean - Array
*/
function string_to_parts($file) {

	$file_parts = explode('/', $file);

	$file_name = end($file_parts);

	$path_parts = array();
	foreach ($file_parts as $key => $value) {
		if ($file_name != $value) {
			$path_parts[] = $value;
		}
	}
	
	$file_path = '';
	foreach ($path_parts as $part) {
		$file_path .= $part.'/';
	}
	
	$file_clean['path'] = $file_path;
	$file_clean['name'] = $file_name;
	$file_clean['full'] = $file_path.$file_name;

	return $file_clean;
}


/**
* Function: array_clean
*	Deletes empty Keys
*
* Parameters:
*	$source - Array
*
* Returns:
*	$source - Array
*/
function array_clean($source)
{
    foreach ($source as $key => $val) {
        if ($val == '') {
            unset($source[$key]);
        }
    }

    return $source;
}


/**
 * Get the size of a directory.
 *
 * A helper function that is used primarily to check whether
 * a blog has exceeded its allowed upload space.
 *
 * @since MU
 * @uses recurse_dirsize()
 *
 * @param string $directory
 * @return int
 */
function get_dirsize( $directory ) {
	$dirsize = get_transient( 'dirsize_cache' );
	if ( is_array( $dirsize ) && isset( $dirsize[ $directory ][ 'size' ] ) )
		return $dirsize[ $directory ][ 'size' ];

	if ( false == is_array( $dirsize ) )
		$dirsize = array();

	$dirsize[ $directory ][ 'size' ] = recurse_dirsize( $directory );

	set_transient( 'dirsize_cache', $dirsize, 3600 );
	return $dirsize[ $directory ][ 'size' ];
}


/**
 * Get the size of a directory recursively.
 *
 * Used by get_dirsize() to get a directory's size when it contains
 * other directories.
 *
 * @since MU
 *
 * @param string $directory
 * @return int
 */
function recurse_dirsize( $directory ) {
	$size = 0;

	$directory = un_slash( $directory );

	if ( !file_exists($directory) || !is_dir( $directory ) || !is_readable( $directory ) )
		return false;

	if ($handle = opendir($directory)) {
		while(($file = readdir($handle)) !== false) {
			$path = $directory.'/'.$file;
			if ($file != '.' && $file != '..') {
				if (is_file($path)) {
					$size += filesize($path);
				} elseif (is_dir($path)) {
					$handlesize = recurse_dirsize($path);
					if ($handlesize > 0)
						$size += $handlesize;
				}
			}
		}
		closedir($handle);
	}
	return $size;
}


/**
* Function: get_url_contents
* Wrapper function for CURL, alternative to the some times disabled function file_get_contents() on some hosting environments.
*
* Parameters:
*	$url - string
*
* Returns:
*	$output - curl contents
*/
function get_url_contents ( $url ) {
    if (!function_exists('curl_init'))
        die('CURL is not installed!');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);

    return $output;
}