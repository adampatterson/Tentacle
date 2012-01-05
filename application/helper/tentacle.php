<?php 

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
        // If theme does not exist display error
        if(!file_exists(THEMES_DIR.ACTIVE_THEME."/$theme.php"))
        {
            dingo_error(E_USER_WARNING,'The requested theme ('.THEMES_DIR.$theme_folder."/$theme.php) could not be found.");
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
} // END class


/**
* For use with hierarchal data
*
* This is used to return a CSS class that can be used on generated tables and lists.
*
* @return string
* @author Adam Patterson
**/
function offset( $i = 1 ){
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
?>