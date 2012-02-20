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


/**
* render pre tags around data
*
* @return html
* @author Adam Patterson
**/
function clean_out($data) {
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}


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
 * Create a really nice url like http://www.example.com/controller/action/params#anchor
 *
 * you can put as many params as you want,
 * if a params start with # it is considered to be an Anchor
 *
 * get_url('controller/action/param1/param2') // I always use this method
 * get_url('controller', 'action', 'param1', 'param2');
 *
 * @param string conrtoller, action, param and/or #anchor
 * @return string
 */
function get_url() {
    $params = func_get_args();
    if (count($params) === 1) return BASE_URL . $params[0];
    
    $url = '';
    foreach ($params as $param) {
        if (strlen($param)) {
            $url .= $param{0} == '#' ? $param: '/'. $param;
        }
    }
    return BASE_URL . preg_replace('/^\/(.*)$/', '$1', $url);
}


/**
 * Get the request method used to send this page
 *
 * @return string possible value: GET, POST or AJAX
 */
function get_request_method() {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') return 'AJAX';
    else if ( ! empty($_POST)) return 'POST';
    else return 'GET';
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


function is_blog_installed() {
	if ( get_option( 'is_blog_installed' ) ) {
		return true;
	} else {
		return false;
	}
}


function get_db_version ()
{
	return get_option( 'db_version' );
}
?>