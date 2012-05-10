<?php 
// Tentacle Globals
// ---------------------------------------------------------------------------

/**
 * Create a URI ( anything after the domain/folder/ )
 */
define ( 'URI'			, tentacle::get_request_url() );
define ( 'ACTIVE_THEME' , get_option( 'appearance' ) );
define ( 'PATH'			, THEMES_URL.'/'.ACTIVE_THEME );
define ( 'PATH_URI'  	, THEMES_DIR.ACTIVE_THEME );
define ( 'HISTORY' 		, BASE_URL.URI.'/' );
define ( 'IMAGE_T', get_option( 'image_thumb_size_w' ) );
define ( 'IMAGE_M', get_option( 'image_medium_size_w' ) );
define ( 'IMAGE_L', get_option( 'image_large_size_w' ) );

/**
* tentacle class
*
* Taken part of the Dingo core load class for loading Tentacles admin Libs.
*
* @package Tentacle
* @author Adam Patterson
**/
class tentacle 
{
	// Valid User / Redirect
	// ---------------------------------------------------------------------------
	public static function valid_user()
	{	
		if(!user::valid()) 
		{
			//note::set("error","session",NOTE_SESSION);
			note::set('error','session',CURRENT_PAGE);
			url::redirect('admin'); 
		}
	}
	
	// File
	// ---------------------------------------------------------------------------
	public static function file($folder,$file)
	{
		// If file does not exist display error
		if(!file_exists("$folder/$file.php"))
		{
			dingo_error(E_USER_ERROR,"The requested $name ($folder/$file.php) could not be found.");
			return FALSE;
		}
		else
		{
			require_once("$folder/$file.php");
			return TRUE;
		}
	}

	// Library
	// ---------------------------------------------------------------------------
	public static function library($folder='/',$library)
	{
		return self::file(TENTACLE_LIB.$folder,$library,'library');
	}
	
	/**
	* render function
	*
	* Load themes for viewing.
	*
	* @return void
	* @author Adam Patterson
	**/   
	public static function render( $theme, $data = NULL )
    {
		
		if ( $theme == 'default' ):
			$theme = 'index';
		endif;
		
        // If theme does not exist display error
        if(!file_exists(THEMES_DIR.ACTIVE_THEME."/$theme.php"))
        {
            
			require(THEMES_DIR.ACTIVE_THEME."/404.php"); 
			           
			echo '<!--';
			dingo_error(E_USER_WARNING,'The requested theme ('.THEMES_DIR.ACTIVE_THEME."/$theme.php) could not be found.");
			echo '-->';
					
			return FALSE;
        } // if
        else
        {
            // If data is array, convert keys to variables
            if(is_array($data))
            {
                extract($data, EXTR_OVERWRITE);
            }

            require(THEMES_DIR.ACTIVE_THEME."/$theme.php");
            return FALSE;
        } // else
    } // END render	

	// Get the requested URL, parse it, then clean it up
	// ---------------------------------------------------------------------------
	public static function get_request_url()
	{	
		// Get the filename of the currently executing script relative to docroot
		$url = (empty($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '/';
		
		// Get the current script name (eg. /index.php)
		$script_name = (isset($_SERVER['SCRIPT_NAME'])) ? $_SERVER['SCRIPT_NAME'] : $url;
		
		// Parse URL, check for PATH_INFO and ORIG_PATH_INFO server params respectively
		$url = (0 !== stripos($url, $script_name)) ? $url : substr($url, strlen($script_name));
		$url = (empty($_SERVER['PATH_INFO'])) ? $url : $_SERVER['PATH_INFO'];
		$url = (empty($_SERVER['ORIG_PATH_INFO'])) ? $url : $_SERVER['ORIG_PATH_INFO'];
		
		// Check for GET __dingo_page
		$url = (input::get('__dingo_page')) ? input::get('__dingo_page') : $url;
		
		//Tidy up the URL by removing trailing slashes
		$url = (!empty($url)) ? rtrim($url, '/') : '/';
		
		return $url;
	}	
	
	 /**
	  * Checks what the latest Tentacle version is that is available at tentaclecms.com
	  */
	 public static function check_version()
	 {
		if ( !defined( 'TENTACLE_VERSION' ) || !TENTACLE_VERSION )
	         return;

		if ( !defined( 'CHECK_TIMEOUT') ) define( 'CHECK_TIMEOUT', 5 );
		$scc = stream_context_create( array( 'http' => array( 'timeout' => CHECK_TIMEOUT ) ) );

		$version = file_get_contents( 'http://api.tentaclecms.com/get/core/', 0, $scc );
	
		$v = json_decode( $version );
		
		if ($v->version > TENTACLE_VERSION)
		{
	        _e('<p class="well"><span class="label important">Important</span> There is a newer version of Tentacle, Visit <a href="'.$v->download.'">'.$v->download.'</a> to download <strong>Version '. $v->version.'</strong></p>');
				return true;
			}
	}

} // END class

	
	/**
	* For use with hierarchal data
	*
	* This is used to return a CSS class that can be used on generated tables and lists.
	*
	* @return string
	* @author Adam Patterson
	**/
	function offset( $i = 1, $output = 'class' ){
		
		if ( $output == 'list') {
			switch ( $i ) {
				case 0:
			        echo '';
			        break;
			    case 1:
			        echo '- ';
			        break;
			    case 2:
			        echo '-- ';
			        break;
			    case 3:
			        echo '--- ';
			        break;
				default:
					echo '---- ';
			}
		} elseif ( $output == 'class' ) {
			switch ( $i ) {
				case 0:
			        echo '';
			        break;
			    case 1:
			        echo 'sub-page';
			        break;
			    case 2:
			        echo 'sub-sub-page';
			        break;
			    case 3:
			        echo 'sub-sub-sub-page';
			        break;
				default:
					echo 'sub-sub-sub-sub-page';
			}
		}
	}
	
	/**
	* render function
	*
	* Load theme parts for inclusion.
	*
	* @return void
	* @author Adam Patterson
	**/   
	function load_part( $part, $data = '' )
	{
	    // If theme does not exist display error
	    if(!file_exists(THEMES_DIR.ACTIVE_THEME."/$part.php"))
	    {
	        dingo_error(E_USER_WARNING,'The requested theme part ('.THEMES_DIR.ACTIVE_THEME."/part-$part.php) could not be found.");
	        return FALSE;
	    } // if
	    else
	    {
	        // If data is array, convert keys to variables
	
	        if(is_array($data))
	        {
	            extract($data, EXTR_OVERWRITE);
	        }
	
	        require(THEMES_DIR.ACTIVE_THEME."/$part.php");
	        return FALSE;
	    } // else
	} // END render
	
	

// Display blog feed in the dashboard.
//----------------------------------------------------------------------------------------------

	function dashboard_feed( $feed, $count = 0, $only_titles = false ) {
		// Use cURL to fetch text
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $feed);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$rss = curl_exec($ch);
		curl_close($ch);

		// Manipulate string into object
		$rss = simplexml_load_string($rss);

		if ( $count == 0 ) {
			$cnt = count($rss->channel->item);
		} else {
			$cnt = $count;
		}

		echo '<ul>';
		for($i=0; $i<$cnt; $i++)
		{
			$url = $rss->channel->item[$i]->link;
			$title = $rss->channel->item[$i]->title;
			$desc = $rss->channel->item[$i]->description;
			
			if ( $only_titles == false ):
				echo '<li><h3><a href="'.$url.'">'.$title.'</a></h3><p>'.$desc.'</p></li>';
			else:
				echo '<li><h3><a href="'.$url.'">'.$title.'</a></h3></li>';
			endif;
		}
		echo '</ul>';
	}

	
// Server Overview
//----------------------------------------------------------------------------------------------
	
	
	function colorify_value($value, $expected) {
		if (strcasecmp($value, $expected) == 0) {
			return '<span class="label success">'.$value.'</span>';
		}
		else {
			return '<span class="label error">'.$value.'</span>';
		}
	}
	
	
	/**
	 * http://www.php.net/manual/en/function.phpinfo.php
	 * code at adspeed dot com
	 * 09-Dec-2005 11:31
	 * This function parses the phpinfo output to get details about a PHP module.
	 */
	function parse_php_info() {
		ob_start();
		phpinfo(INFO_MODULES);
		$s = ob_get_contents();
		ob_end_clean();
		$s = strip_tags($s,'<h2><th><td>');
		$s = preg_replace('/<th[^>]*>([^<]+)<\/th>/',"<info>\\1</info>",$s);
		$s = preg_replace('/<td[^>]*>([^<]+)<\/td>/',"<info>\\1</info>",$s);
		$vTmp = preg_split('/(<h2>[^<]+<\/h2>)/',$s,-1,PREG_SPLIT_DELIM_CAPTURE);
		$vModules = array();
		for ($i=1;$i<count($vTmp);$i++) {
			if (preg_match('/<h2>([^<]+)<\/h2>/',$vTmp[$i],$vMat)) {
				$vName = trim($vMat[1]);
				$vTmp2 = explode("\n",$vTmp[$i+1]);
				foreach ($vTmp2 AS $vOne) {
					$vPat = '<info>([^<]+)<\/info>';
					$vPat3 = "/$vPat\s*$vPat\s*$vPat/";
					$vPat2 = "/$vPat\s*$vPat/";
					if (preg_match($vPat3,$vOne,$vMat)) { // 3cols
						$vModules[$vName][trim($vMat[1])] = array(trim($vMat[2]),trim($vMat[3]));
					}
					elseif (preg_match($vPat2,$vOne,$vMat)) { // 2cols
						$vModules[$vName][trim($vMat[1])] = trim($vMat[2]);
					}
				}
			}
		}
		return $vModules;
	}


// Misc Utilities
//----------------------------------------------------------------------------------------------
	
	/**
	 * Appends a trailing slash.
	 *
	 * Will remove trailing slash if it exists already before adding a trailing
	 * slash. This prevents double slashing a string or path.
	 *
	 * The primary use of this is for paths and thus should be used for paths. It is
	 * not restricted to paths and offers no specific path support.
	 *
	 * @package WordPress
	 * @since 1.2.0
	 * @uses untrailingslashit() Unslashes string if it was slashed already.
	 *
	 * @param string $string What to add the trailing slash to.
	 * @return string String with trailing slash added.
	 */
	function trailingslashit($string) {
		return untrailingslashit($string) . '/';
	}
	
	
	/**
	 * Removes trailing slash if it exists.
	 *
	 * The primary use of this is for paths and thus should be used for paths. It is
	 * not restricted to paths and offers no specific path support.
	 *
	 * @package WordPress
	 * @since 2.2.0
	 *
	 * @param string $string What to remove the trailing slash from.
	 * @return string String without the trailing slash.
	 */
	function untrailingslashit($string) {
		return rtrim($string, '/');
	}

	
	/**
	 * Encodes HTML safely for UTF-8. Use instead of htmlentities.
	 */
	function html_encode($string) {
		return htmlentities($string, ENT_QUOTES, 'UTF-8') ;
	}
	
	
	function convert_size($num) {
	    if ($num >= 1073741824) $num = round($num / 1073741824 * 100) / 100 .' gb';
	    else if ($num >= 1048576) $num = round($num / 1048576 * 100) / 100 .' mb';
	    else if ($num >= 1024) $num = round($num / 1024 * 100) / 100 .' kb';
	    else $num .= ' b';
	    return $num;
	}
	
	
	// Information about time and memory
	function memory_usage() {
	    return convert_size(memory_get_usage());
	}
	


// Theme Content Rendering ( Output )
//----------------------------------------------------------------------------------------------

	
	function render_content ( $content='' ) {
		return stripslashes( $content );
	}	
	
	
	// Short Echo, Later used in translations.
	function _e( $data ) 
	{
		echo $data;
	}
	

	/**
	* Render pre tags around data for displaying arrays and objects.
	*
	* @return html
	* @author Adam Patterson
	**/
	function clean_out($data) {
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
	
	
// DEBUG
//----------------------------------------------------------------------------------------------

    function render_debug() {
		_e('<strong>GET</strong>');
	    	var_dump($_GET);
		_e('<strong>POST</strong>');
	    	var_dump($_POST);
		_e('<strong>COOKIE</strong>');
	    	var_dump($_COOKIE);
		_e('<strong>REQUEST</strong>');
	    	var_dump($_REQUEST);
    }



	// TEMP Array to Object
	//----------------------------------------------------------------------------------------------

	/**
	* Array to object - Takes an array as input and returns an object
	* @return object
	* @param  $array
	*/

		function array_to_object($array = array())
		{
		    $tmp = new stdClass;

		    foreach ($array as $key => $value) {
		        if (is_array($value)) {
		            $tmp->$key = array_to_object($value);
		        } else {
		            if (is_numeric($key)) {
		                exit('Cannot turn numeric arrays into objects!');
		            }

		            $tmp->$key = $value;
		        }
		    }

		    return $tmp;
		}


		function get_tracking_array(  )
		{
            $url = parse_url($_SERVER['REQUEST_URI']);

            $query_string = $url['query'];

			if ( $query_string != '' )
			{

		  	  $query_array = array();

				$raw_query = explode( '&', $query_string );

			    foreach( $raw_query as $key => $key_value )
				{

					$raw_value = explode( '=', $key_value );

					$query_array[$raw_value[0]] = $raw_value[1];
			    }
			    return $query_array;
			} else {
				return false;
			}

		}

?>