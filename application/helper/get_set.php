<?
/*
 * File: Get / Set / Is / The
 */
class get {
	/**
	* Function: get::option
	*	Takes the $option key and queries the DB Option table for a result.
	*	If nothing is found then the $default value is returned.
	*
	* Parameters:
	*	$options - String
	*	$default - String
	*
	* Returns:
	*	String
	*/
	public static function option( $key, $default = false )
	{
        $settings = load::model( 'settings' );
        $get = $settings->get( $key );

		if ( $get != false ) {
			return $get;
		} else {
			return $default;
		}
	}


    /**
     * Function: get::current_db_version
     *	Function call for the DB version saved in the database.
     *
     * Returns:
     *	String
     */
    public static function current_db_version ()
    {
        return get::option( 'db_version' );
    }


    /**
     * Function: get::db_version
     *	Function call to the constant TENTACLE_DB_VERSION
     *
     * Returns:
     *	String
     */
    public static function db_version ()
    {
        return TENTACLE_DB_VERSION;
    }

    function enabled_module() {
        return enabled_module();
    }


    /**
     * Function: get::url
     * Create a really nice url like http://www.example.com/controller/action/params#anchor
     *
     * you can put as many params as you want,
     * if a params start with # it is considered to be an Anchor
     *
     * - get::url('controller/action/param1/param2') // I always use this method
     * - get::url('controller', 'action', 'param1', 'param2');
     *
     * Returns:
     *	string
     */
    public static function url()
    {
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
     * Function: get::request_method
     *	Returns the request method.
     *
     * Returns:
     *	GET, POST or AJAX
     */
    public static function request_method()
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') return 'AJAX';
        else if ( ! empty($_POST)) return 'POST';
        else return 'GET';
    }

    /**
     * Function: get::gravatar
     *	Get either a Gravatar URL or complete image tag for a specified email address.
     *
     *	- <?php echo get::gravatar($gravatar); ?>
     *
     * Parameters:
     * $email - String - The email address
     * $s - String - Size in pixels, defaults to 80px [ 1 - 512 ]
     * $d - String - Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * $r - String - Maximum rating (inclusive) [ g | pg | r | x ]
     * $img - True to return a complete IMG tag False for just the URL
     * $atts - Array - Optional, additional key/value attributes to include in the IMG tag
     *
     * Returns:
     *	String - Containing either just a URL or a complete image tag
     */
    public static function gravatar( $email, $s = GRAVATAR_SIZE, $d = 'mm', $r = 'g', $img = true, $atts = array() )
    {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }

    /**
     * Function: get::json
     *	Simple function that woks with JSON and returns the $value of the $key
     *
     * Parameters:
     *	$key - string
     * 	$json - JSON
     *
     * Returns:
     *	$value - string
     *
     */
    public static function json( $key, $json )
    {
        foreach ($json as $json_key => $value ) {
            if ($key == $json_key) {
                return $value;
            }
        }
    }


    public static function next_post () {}
    public static function previous_post () {}
    public static function post_status () {}


    /**
     * Function: get::url_contents
     * Wrapper function for CURL, alternative to the some times disabled function file_get_contents() on some hosting environments.
     *
     * Parameters:
     *	$url - string
     *
     * Returns:
     *	$output - curl contents
     */
    public static function url_contents ( $url ) {
        if (!function_exists('curl_init'))
            die('CURL is not installed!');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }


    /**
     * Function: get::snippet
     *	Function call passing the $slug to retrieve the snippet.
     *
     * Parameters:
     *	$slug - String
     *
     * Returns:
     *	String
     */
    public static function snippet( $slug ) {
        $snippet = load::model( 'snippet' );
        $snippet_single = $snippet->get_slug( $slug );

        return $snippet_single->content;
    }


    /**
     * Function: tracking_array
     * Get an array from the query string, this can be used for tracking downloads or other statistics.
     *
     * Parameters:
     *	  $url - String
     *
     * Returns:
     *     $query_array - Array
     */
    function tracking_array(  )
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
}


class set {
    /**
     * Function: option
     *	Set a new option ( Key Value ) if the option exists it will be updated.
     *
     * Parameters:
     *	$key - String
     *	$value - String
     *
     * Returns:
     *	$value - String
     */
    public static function option( $key = '', $value = '' )
    {
        $settings = load::model( 'settings' );

        $add = $settings->update( $key, $value );

        return $value;
    }
}

class is {
    /**
     * PUF
     * - Detect
     * PHP Utility Framework.
     *
     * @package		PUF
     * @version		1.0
     * @author		Gilbert Pellegrom
     * @license		GPL v2
     * @link		http://puf.dev7studios.com
     */

    /**
    * Function: mobile
    *	Is the page being viewed with a mobile device?
    *
    * Returns:
    *	Bool
    */
    public static function mobile()
    {
        $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
        $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

        if ($iphone || $android || $palmpre || $ipod || $berry == true)
        {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Check to see if the Http User Agent is an iPhone.
     *
     * @access  public
     * @return  bool
     */
    public function iphone()
    {
        return (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone');
    }


    /**
     * Check to see if the Http User Agent is an iPod.
     *
     * @access  public
     * @return  bool
     */
    public function ipod()
    {
        return (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'iPod');
    }


    /**
     * Check to see if the Http User Agent is an iPad.
     *
     * @access  public
     * @return  bool
     */
    public function ipad()
    {
        return (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'iPad');
    }


    /**
     * Check to see if the Http User Agent is an Android.
     *
     * @access  public
     * @return  bool
     */
    public function android()
    {
        return (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'Android');
    }

    /**
     * Check to see if the Http User Agent is an Palm Pre.
     *
     * @access  public
     * @return  bool
     */
    public function palmpre()
    {
        return (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'webOS');
    }


    /**
     * Check to see if the Http User Agent is an BlackBerry.
     *
     * @access  public
     * @return  bool
     */
    public function blackberry()
    {
        return (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry');
    }


    /**
     * Check to see if SSL is used.
     *
     * Credit: http://core.svn.wordpress.org/trunk/wp-includes/functions.php
     *
     * @access  public
     * @return  bool
     */
    public function ssl()
    {
        if ( isset($_SERVER['HTTPS']) ) {
            if ( 'on' == strtolower($_SERVER['HTTPS']) )
                return true;
            if ( '1' == $_SERVER['HTTPS'] )
                return true;
        } elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
            return true;
        }
        return false;
    }


    /**
     * Check to see if this is this a referral.
     *
     * Credit: http://codeigniter.com/user_guide/libraries/user_agent.html
     * License: http://codeigniter.com/user_guide/license.html
     *
     * @access	public
     * @return	bool
     */
    public function referral()
    {
        return (!isset($_SERVER['HTTP_REFERER']) OR $_SERVER['HTTP_REFERER'] == '') ? false : true;
    }

	public static function rtl () {}
	public static function front_page () {}
	public static function home () {}
	//public static function date () {}
	public static function search () {}
	public static function paged () {}
	public static function page () {}
	public static function preview () {}
	public static function page_template () {}
	//public static function 404 () {}
	public static function error () {}
	public static function single () {}
	public static function sticky () {}
	public static function admin () {}
	public static function archive () {}
	public static function post_type_archive () {}
	public static function author () {}
	public static function user_logged_in () {}
	public static function category () {}
	public static function tag () {}
	public static function tax () {}
	public static function trackback () {}
	public static function serialized () {}
	public static function admin_bar_showing () {}

    /**
     * Function: blog_installed
     *	Simply checks to see if the blog is installed.
     *
     * Returns:
     *	Bool
     */
    public static function blog_installed() {
        $touch = load::model( 'sql' );

        $touch_db = $touch->touch_db();

        if ( $touch_db === false ) {
            url::redirect('install/step5');
        } else {
            return true;
        }
    }


    /**
     * Function: agree
     *	Has the owner agreed to the terms and services.
     *
     * Returns:
     *	Bool
     */
    public static function agree() {
        if ( get::option( 'is_agree' ) ) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Function: availible_updates
     *	Are there any updates?
     *
     * Returns:
     *	Bool
     */
    public static function is_availible_updates() {
        if ( get::option( 'is::updates' ) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Function: update
     *	Is the new version newer than the current version.
     *
     * Returns:
     *	Bool
     */
    public static function update( $current, $new ) {
        if ($current < $new) {
            return true;
        } else {
            return false;
        }
    }
}