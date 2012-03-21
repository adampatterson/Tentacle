<?php 
load::helper ('settings');


// Tentacle Globals
// ---------------------------------------------------------------------------

/**
 * Create a URI ( anything after the domain/folder/ )
 */
define ('URI'			, tentacle::get_request_url() );
define ('ACTIVE_THEME' , get_option( 'appearance' ) );
define ( 'PATH'			, THEMES_URL.'/'.ACTIVE_THEME );
define ( 'PATH_URI'  	, THEMES_DIR.ACTIVE_THEME );
define ( 'HISTORY' 		, BASE_URL.URI.'/' );

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
	     if (!defined('TENTACLE_VERSION') || !TENTACLE_VERSION)
	         return;

	     if (!defined('CHECK_TIMEOUT')) define('CHECK_TIMEOUT', 5);
	     $scc = stream_context_create(array('http' => array('timeout' => CHECK_TIMEOUT)));

	     $version = file_get_contents('http://version.tentaclecms.com/', 0, $scc);
	     if ($version > TENTACLE_VERSION)
	     {
	         _e('<p class="well"><span class="label important">Important</span> There is a newer version of Tentacle, Visit <a href="http://tentaclecms.com">http://tentaclecms.com</a> to upgrade to <strong>Version '. $version.'</strong></p>');
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
	    if(!file_exists(THEMES_DIR.ACTIVE_THEME."/part-$part.php"))
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
	
	        require(THEMES_DIR.ACTIVE_THEME."/part-$part.php");
	        return FALSE;
	    } // else
	} // END render
	
	

// Display blog feed in the dashboard.
//----------------------------------------------------------------------------------------------

	function dashboard_feed($feed) {
		// Use cURL to fetch text
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $feed);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$rss = curl_exec($ch);
		curl_close($ch);

		// Manipulate string into object
		$rss = simplexml_load_string($rss);

		$cnt = count($rss->channel->item);
		
		echo '<ul>';
		for($i=0; $i<$cnt; $i++)
		{
			$url = $rss->channel->item[$i]->link;
			$title = $rss->channel->item[$i]->title;
			$desc = $rss->channel->item[$i]->description;
			echo '<li><h3><a href="'.$url.'">'.$title.'</a></h3><p>'.$desc.'</p></li>';
		}
		echo '</ul>';
	}

	

// Render classes in the template
//----------------------------------------------------------------------------------------------
	
	/**
	 * Converts the URI into a list of classes
	 *
	 * @return string
	 * @author Adam Patterson
	 */
	function body_class () {
		// Separates classes with a single space, collates classes for body element
		echo 'class="'.join( ' ', explode("/", URI ) ).'"';
		//echo 'class="' . join( ' ', get_body_class( $class ) ) . '"';
	}
	
	/**
	 * Converts the URI for a post into a class
	 *
	 * @return string
	 * @author Adam Patterson
	 */
	function post_class() {
		return true;
	}
	

// Get and is functions
//----------------------------------------------------------------------------------------------
	
	/**
	 * Retrieve the classes for the body element as an array.
	 *
	 * @since 2.8.0
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function get_body_class( $class = '' ) {
		/*
		global $wp_query, $wpdb;
	
		$classes = array();
	
		if ( is_rtl() )
			$classes[] = 'rtl';
	
		if ( is_front_page() )
			$classes[] = 'home';
		if ( is_home() )
			$classes[] = 'blog';
		if ( is_archive() )
			$classes[] = 'archive';
		if ( is_date() )
			$classes[] = 'date';
		if ( is_search() )
			$classes[] = 'search';
		if ( is_paged() )
			$classes[] = 'paged';
		if ( is_attachment() )
			$classes[] = 'attachment';
		if ( is_404() )
			$classes[] = 'error404';
	
		if ( is_single() ) {
			$post_id = $wp_query->get_queried_object_id();
			$post = $wp_query->get_queried_object();
	
			$classes[] = 'single';
			$classes[] = 'single-' . sanitize_html_class($post->post_type, $post_id);
			$classes[] = 'postid-' . $post_id;
	
			// Post Format
			$post_format = get_post_format( $post->ID );
	
			if ( $post_format && !is_wp_error($post_format) )
				$classes[] = 'single-format-' . sanitize_html_class( $post_format );
			else
				$classes[] = 'single-format-standard';
	
			if ( is_attachment() ) {
				$mime_type = get_post_mime_type($post_id);
				$mime_prefix = array( 'application/', 'image/', 'text/', 'audio/', 'video/', 'music/' );
				$classes[] = 'attachmentid-' . $post_id;
				$classes[] = 'attachment-' . str_replace( $mime_prefix, '', $mime_type );
			}
		} elseif ( is_archive() ) {
			if ( is_post_type_archive() ) {
				$classes[] = 'post-type-archive';
				$classes[] = 'post-type-archive-' . sanitize_html_class( get_query_var( 'post_type' ) );
			} else if ( is_author() ) {
				$author = $wp_query->get_queried_object();
				$classes[] = 'author';
				$classes[] = 'author-' . sanitize_html_class( $author->user_nicename , $author->ID );
				$classes[] = 'author-' . $author->ID;
			} elseif ( is_category() ) {
				$cat = $wp_query->get_queried_object();
				$classes[] = 'category';
				$classes[] = 'category-' . sanitize_html_class( $cat->slug, $cat->term_id );
				$classes[] = 'category-' . $cat->term_id;
			} elseif ( is_tag() ) {
				$tags = $wp_query->get_queried_object();
				$classes[] = 'tag';
				$classes[] = 'tag-' . sanitize_html_class( $tags->slug, $tags->term_id );
				$classes[] = 'tag-' . $tags->term_id;
			} elseif ( is_tax() ) {
				$term = $wp_query->get_queried_object();
				$classes[] = 'tax-' . sanitize_html_class( $term->taxonomy );
				$classes[] = 'term-' . sanitize_html_class( $term->slug, $term->term_id );
				$classes[] = 'term-' . $term->term_id;
			}
		} elseif ( is_page() ) {
			$classes[] = 'page';
	
			$page_id = $wp_query->get_queried_object_id();
	
			$post = get_page($page_id);
	
			$classes[] = 'page-id-' . $page_id;
	
			if ( $wpdb->get_var( $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_parent = %d AND post_type = 'page' AND post_status = 'publish' LIMIT 1", $page_id) ) )
				$classes[] = 'page-parent';
	
			if ( $post->post_parent ) {
				$classes[] = 'page-child';
				$classes[] = 'parent-pageid-' . $post->post_parent;
			}
			if ( is_page_template() ) {
				$classes[] = 'page-template';
				$classes[] = 'page-template-' . sanitize_html_class( str_replace( '.', '-', get_post_meta( $page_id, '_wp_page_template', true ) ), '' );
			} else {
				$classes[] = 'page-template-default';
			}
		} elseif ( is_search() ) {
			if ( !empty( $wp_query->posts ) )
				$classes[] = 'search-results';
			else
				$classes[] = 'search-no-results';
		}
	
		if ( is_user_logged_in() )
			$classes[] = 'logged-in';
	
		if ( is_admin_bar_showing() )
			$classes[] = 'admin-bar';
	
		$page = $wp_query->get( 'page' );
	
		if ( !$page || $page < 2)
			$page = $wp_query->get( 'paged' );
	
		if ( $page && $page > 1 ) {
			$classes[] = 'paged-' . $page;
	
			if ( is_single() )
				$classes[] = 'single-paged-' . $page;
			elseif ( is_page() )
				$classes[] = 'page-paged-' . $page;
			elseif ( is_category() )
				$classes[] = 'category-paged-' . $page;
			elseif ( is_tag() )
				$classes[] = 'tag-paged-' . $page;
			elseif ( is_date() )
				$classes[] = 'date-paged-' . $page;
			elseif ( is_author() )
				$classes[] = 'author-paged-' . $page;
			elseif ( is_search() )
				$classes[] = 'search-paged-' . $page;
			elseif ( is_post_type_archive() )
				$classes[] = 'post-type-paged-' . $page;
		}
	
		if ( ! empty( $class ) ) {
			if ( !is_array( $class ) )
				$class = preg_split( '#\s+#', $class );
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}
	
		$classes = array_map( 'esc_attr', $classes );
	
		return apply_filters( 'body_class', $classes, $class );
		*/
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
?>