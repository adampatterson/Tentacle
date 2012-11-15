<?php
/**
 * File: Tentacle
 */

// Tentacle Globals
// ---------------------------------------------------------------------------

/**
 * Create a URI ( anything after the domain/folder/ )
 */
define ( 'URI'			, tentacle::get_request_url() );
define ( 'ACTIVE_THEME' , get::option( 'appearance' ) );
define ( 'PATH'			, THEMES_URL.'/'.ACTIVE_THEME );
define ( 'PATH_URI'  	, THEMES_DIR.ACTIVE_THEME );
define ( 'HISTORY' 		, BASE_URL.URI.'/' );
define ( 'IMAGE_T', get::option( 'image_thumb_size_w' ) );
define ( 'IMAGE_M', get::option( 'image_medium_size_w' ) );
define ( 'IMAGE_L', get::option( 'image_large_size_w' ) );

// tentacle core loaders
class tentacle 
{
	/**
	* Function: valid_user
	* Valid User / Redirect.
	*/
	public static function valid_user()
	{	
		if(!user::valid()) 
		{
			//note::set("error","session",NOTE_SESSION);
			note::set('error','session',CURRENT_PAGE);
			url::redirect('admin'); 
		}
	}

	
	/**
	* Function: render
	* Loads the active theme for viewing
	*
	* Parameters:
	*     $theme - string
	*     $data - object/array
	*
	* Returns:
	*     The loaded theme passing it $data
	*
	* See Also:
	*     <load_part>
	*/ 
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

	
	/**
	* Function: get_request_url
	* Get the requested URL, parse it, then clean it up
	*
	* Returns:
	*     $url
	*/
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
} // END class

	/**
	* Function: load_part
	* Load theme parts for inclusion.
	*
	* Parameters:
	*     $part - string
	*     $data - object/array
	*
	* Returns:
	*     $string
	*
	* See Also:
	*     <render>
	*/
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
	
	
	/**
	* Function: offset
	* For use with hierarchal data, used to return a CSS class that can be used on generated tables and lists.
	*
	* Returns:
	*     $string
	*/
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
     * Function: increment
     * Used for counting things like updates or notifications.
     *
     * Parameters:
     *     $key - string
     *
     * Returns:
     *     int
     */
    function increment( $key ) {
        $settings = load::model( 'settings' );

        $get = $settings->get($key);

        $incremented = $get+1;

        $update = $settings->update($key, $incremented);

        return $incremented;
    }


    /**
     * Function: deincrement
     * Used for counting things like updates or notifications.
     *
     * Parameters:
     *     $key - string
     *
     * Returns:
     *     int
     */
    function deincrement( $key ) {
        $settings = load::model( 'settings' );

        $get = $settings->get($key);

        $incremented = $get-1;

        $update = $settings->update($key, $incremented);

        return $incremented;
    }


    /**
     * Function: total_update
     * Total number of updates total or for themes/modules
     *
     * Parameters:
     *     $key - string ( )
     *
     * Returns:
     *     int
     */
	function total_update( $key='' ) {
		$settings = load::model( 'settings' );

        $themes = $settings->get('themes');
		$modules = $settings->get('modules');
		
		if ( $key == 'themes' ) {
			$total = $settings->get('themes');
		} elseif ( $key == 'modules' ) {
			$total = $settings->get('modules');
		} else {
			$total = $themes+$modules;
		}

        return $total;
	}


	/**
	* Function: parse_args
	*	Merge user defined arguments into defaults array.
	*
	*	From WordPress
	*
	* Parameters:
	*	$args - Array
	*	$defaults - Array
	*
	* Returns:
	*	$args - Array
	*/
	function parse_args( $args, $defaults ) {
		if ( is_object( $args ) )
			$r = get_object_vars( $args );
		elseif( is_array( $args ) )
			$r =& $args;
			
		if ( is_array( $defaults ) )
			return array_merge( $defaults, $args );
		return $args ;
	}


	/**
	* Function: dashboard_feed
	* Display blog feed in the dashboard.
	*
	* Arguments:
	*     $feed - string
	*     $count - int
	*	  $only_titles - true/false
	*
	* Returns:
	*     html
	*/
	function dashboard_feed( $args = array() ) {
		
		$defaults = array( 'feed' => null, 'count' => 4, 'only_titles' => false, 'cache' => true);
		$args = parse_args( $args, $defaults );
		
		$feed 			= $args['feed'];
		$count 			= $args['count'];
		$only_titles 	= $args['only_titles'];
		$feed_cache 	= $args['cache'];

		$cache = new cache();
		
		if ( $cache->look_up('dashboard') == false):
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $feed);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$rss = curl_exec($ch);
			curl_close($ch);

			$rss = new SimpleXmlElement($rss);
			$rss = $rss->asXML();
			
			$cache_data = $cache->set( 'dashboard', $rss, '+30 minutes' );
			
			$rss = simplexml_load_string($cache_data);
		else:
			$cache_data = $cache->get('dashboard');
			
			$rss = simplexml_load_string($cache_data);
		endif;

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


	/**
	* Function: status_tag
	* Used to return Labels on the admin side.
	*
	* Parameters:
	*     $value - string/int
	*
	* Returns:
	*     html
	*/
	function status_tag($value) {
		switch ($value) {
			case 'draft':
				return '<span class="label label-info">'.$value.'</span>';
				break;
			case 'published':
				return '<span class="label label-success">'.$value.'</span>';
				break;
			case 'trashed':
				return '<span class="label label-warning">'.$value.'</span>';
				break;
			default:
				return '<span class="label">'.$value.'</span>';
				break;
		}
	}
	
	
// Server Overview
//----------------------------------------------------------------------------------------------

	/**
	* Function: colorify_value
	* Used to compare two strings, if they are equal then a bootstrap label of success is returned, error if other wise.
	*
	* Parameters:
	*     $value - string/int
	*     $expected - string/int
	*
	* Returns:
	*     html
	*/
	function colorify_value($value, $expected) {
		if (strcasecmp($value, $expected) == 0) {
			return '<span class="label label-success">'.$value.'</span>';
		}
		else {
			return '<span class="label label-error">'.$value.'</span>';
		}
	}
	
	
	/**
	* Function: parse_php_info
	* This function parses the phpinfo output to get details about a PHP module.
	* http://www.php.net/manual/en/function.phpinfo.php
    *
	* Returns:
	*     html
	*/
	function parse_php_info()
	{
		ob_start();
		phpinfo(INFO_MODULES);
		$phpinfo_html = ob_get_contents();
		ob_end_clean();

		$phpinfo_html = strip_tags($phpinfo_html, "<h2><th><td>");
		$phpinfo_html = preg_replace("#<th[^>]*>([^<]+)<\/th>#", "<info>$1</info>", $phpinfo_html);
		$phpinfo_html = preg_replace("#<td[^>]*>([^<]+)<\/td>#", "<info>$1</info>", $phpinfo_html);
		$phpinfo_html = preg_split("#(<h2[^>]*>[^<]+<\/h2>)#", $phpinfo_html, -1, PREG_SPLIT_DELIM_CAPTURE);
		$modules = array();

		for($i=1; $i < count($phpinfo_html); $i++)
		{
			if(preg_match("#<h2[^>]*>([^<]+)<\/h2>#", $phpinfo_html[$i], $match))
			{
				$name = trim($match[1]);
				$tmp2 = explode("\n", $phpinfo_html[$i+1]);
				foreach($tmp2 as $one)
				{
					$pat = '<info>([^<]+)<\/info>';
					$pat3 = "/$pat\s*$pat\s*$pat/";
					$pat2 = "/$pat\s*$pat/";

					// 3 columns
					if(preg_match($pat3, $one, $match))
					{
						$modules[$name][trim($match[1])] = array(trim($match[2]), trim($match[3]));
					}
					// 2 columns
					else if(preg_match($pat2, $one, $match))
					{
						$modules[$name][trim($match[1])] = trim($match[2]);
					}
				}
			}
		}
		return $modules;
	}


// Misc Utilities
//----------------------------------------------------------------------------------------------
	
	/**
	* Function: slash_it
	* Appends a trailing slash.
	*
	* Will remove trailing slash if it exists already before adding a trailing
	* slash. This prevents double slashing a string or path.
	*
	* The primary use of this is for paths and thus should be used for paths. It is
	* not restricted to paths and offers no specific path support.
	*
	* From WordPress
	*
	* Parameters:
	*     $string - string $string What to add the trailing slash to.
	*
	* Returns:
	*     $string - String with trailing slash added.
	*
	* See Also:
	*     <un_slash>
	*/
	function slash_it($string) {
		return un_slash($string) . '/';
	}


	/**
	* Function: un_slash
	* Removes trailing slash if it exists.
	*
	* The primary use of this is for paths and thus should be used for paths. It is
	* not restricted to paths and offers no specific path support.
	*
	*
	* From WordPress
	*
	* Parameters:
	*     $string - string $string What to remove the trailing slash from.
	*
	* Returns:
	*     $string - String without the trailing slash.
	*
	* See Also:
	*     <slash_it>
	*/
	function un_slash($string) {
		return rtrim($string, '/');
	}

	/**
	* Function: html_encode
	* Encodes HTML safely for UTF-8. Use instead of htmlentities.
	*
	* Parameters:
	*     $string - String containing content
	*
	* Returns:
	*     $string - String cleaned with invalid characters converted to UTF-8
	*/
	function html_encode($string) {
		return htmlentities($string, ENT_QUOTES, 'UTF-8') ;
	}
	
	/**
	* Function: convert_size
	* Converts a number to a readable file size.
	*
	* Parameters:
	*     $num - Int
	*
	* Returns:
	*     $num - Bytes converted to KB, MB, or GB
	*
	* See Also:
	*     <memory_usage>
	*/
	function convert_size($num) {
	    if ($num >= 1073741824) $num = round($num / 1073741824 * 100) / 100 .' gb';
	    else if ($num >= 1048576) $num = round($num / 1048576 * 100) / 100 .' mb';
	    else if ($num >= 1024) $num = round($num / 1024 * 100) / 100 .' kb';
	    else $num .= ' b';
	    return $num;
	}
	

	/**
	* Function: memory_usage
	* Information about time and memory
	*
	* Returns:
	*     Int
	*
	* See Also:
	*     <convert_size>
	*/
	function memory_usage() {
	    return convert_size(memory_get_usage());
	}
	


// Theme Content Rendering ( Output )
//----------------------------------------------------------------------------------------------

	/**
	* Function: render_content
	* Information about time and memory
	*
	* Parameters:
	*	  $content - String
	* 	
	* Returns:
	*     $content - Slashes removed.
	*/
	function render_content ( $content='' ) {
		return stripslashes( $content );
	}	


	/**
	* Function: _e
	* Short Echo, Later used in translations.
	*
	* Parameters:
	*	  $data - String
	* 	
	* Returns:
	*     $data - String
	*/
	function _e( $data ) 
	{
		echo $data;
	}
	
	
	/**
	* Function: uri_contains
	*
	* Parameters:
	*	  $string - String
	* 	
	* Returns:
	*     Bool
	*/
	function uri_contains( $string )
	{
		if(strpos(BASE_URI, $string) !== false){
			return TRUE;
		} else {
			return FALSE;
		}
	}


	/**
	* Function: clean_out
	* Render pre tags around data for displaying arrays and objects.
	*
	* Parameters:
	*	  $data - String
	* 	
	* Returns:
	*     HTML
	*/
	function clean_out($data) {
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}


	// TEMP Array to Object
	//----------------------------------------------------------------------------------------------

		/**
		* Function: array_to_object
		* Array to object - Takes an array as input and returns an object
		*
		* Parameters:
		*	  $array - Array
		* 	
		* Returns:
		*     $tmp - Object
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
?>