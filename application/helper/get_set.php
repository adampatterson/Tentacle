<?
/*
 * File: Get / Set / Is / The
 */
class get {

    private static $options = array();

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
	public static function option( $key, $default = null )
	{
        if( isset( static::$options[ $key ] ) ):
            #logger::set( 'Option from Object', $key );
            return static::$options[ $key ];
        else:
            #logger::set( 'Option from DB', $key );

            $settings = load::model( 'settings' );
            $get = $settings->get( $key );

            static::$options[ $key ] = $get;

            if ( $get == false ) {
                return $default;
            } else {
                return $get;
            }
        endif;
	}


    public static function theme_options() {
        $options = self::option('theme_options');

        // work with collection array

        if ( is_serialized($options))
            return unserialize($options);
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

    function enabled_plugin() {
        return enabled_plugin();
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
                $url .= $param[0] == '#' ? $param: '/'. $param;
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
        $url = 'http://www.gravatar.com/avatar/'.md5( strtolower( trim( $email ) ) )."?s=$s&d=$d&r=$r";
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



    static function yaml( $file ){

        $tokens = token_get_all(file_get_contents($file));
        $scaffold = '';

        foreach($tokens as $token) {
            if($token[0] == T_DOC_COMMENT ) {
                $scaffold = $token[1];
                break;
            }
        }

        if ($scaffold != null ){
            $replace = array("/**", "*/");

            $scaffold_data = str_replace($replace, "", $scaffold);

            $data = Spyc::YAMLLoad( $scaffold_data );

            return $data;
        } else {
            return null;
        }

    }

//    public static function next_post () {}
//    public static function previous_post () {}
//    public static function post_status () {}


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
        if ( function_exists( 'curl_init' ) ) {
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)" );
            curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
            $output = curl_exec( $ch );
            curl_close( $ch );

            return $output;
        } elseif ( file_get_contents( __FILE__ ) )
        {

            $opts = array(
                'http'=>array(
                    'method'=>"GET"
                )
            );

            $context = stream_context_create( $opts );

            return file_get_contents( $url, false, $context );

        } else {
            return false;
        }
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

function is ( $look ) {

    switch ( $look ) {
        case 'home':
            if ( defined('IS_HOME') && IS_HOME )
                return true;
            else
                return false;

            break;
        case 'blog':
            if ( defined('IS_BLOG') && IS_BLOG )
                return true;
            else
                return false;
            break;
        case 'post':
            if ( defined('IS_POST') && IS_POST )
                return true;
            else
                return false;
            break;
        case 'page':
            if ( defined('IS_PAGE') && IS_PAGE )
                return true;
            else
                return false;
            break;
        case 'sub_page':
            if ( defined('IS_SUB_PAGE') && IS_SUB_PAGE )
                return true;
            else
                return false;
            break;
        case 'error':
            if ( defined('IS_ERROR') && IS_ERROR )
                return true;
            else
                return false;
            break;
        default:
            return false;
            break;
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
    public static function iphone()
    {
        return (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone');
    }


    /**
     * Check to see if the Http User Agent is an iPod.
     *
     * @access  public
     * @return  bool
     */
    public static function ipod()
    {
        return (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'iPod');
    }


    /**
     * Check to see if the Http User Agent is an iPad.
     *
     * @access  public
     * @return  bool
     */
    public static function ipad()
    {
        return (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'iPad');
    }


    /**
     * Check to see if the Http User Agent is an Android.
     *
     * @access  public
     * @return  bool
     */
    public static function android()
    {
        return (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'Android');
    }

    /**
     * Check to see if the Http User Agent is an Palm Pre.
     *
     * @access  public
     * @return  bool
     */
    public static function palmpre()
    {
        return (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'webOS');
    }


    /**
     * Check to see if the Http User Agent is an BlackBerry.
     *
     * @access  public
     * @return  bool
     */
    public static function blackberry()
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
    public static function ssl()
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

//	public static function rtl () {}
//	public static function front_page () {}
//	public static function home () {}
	//public static function date () {}
//	public static function search () {}
//	public static function paged () {}
//	public static function page () {}
//	public static function preview () {}
//	public static function page_template () {}
	//public static function 404 () {}
//	public static function error () {}
//	public static function single () {}
//	public static function sticky () {}
//	public static function admin () {}
//	public static function archive () {}
//	public static function post_type_archive () {}
//	public static function author () {}
//	public static function user_logged_in () {}
//	public static function category () {}
//	public static function tag () {}
//	public static function tax () {}
//	public static function trackback () {}
//	public static function serialized () {}
//	public static function admin_bar_showing () {}

    /**
     * Function: blog_installed
     *	Simply checks to see if the blog is installed.
     *
     * Returns:
     *	Bool
     */
    public static function blog_installed() {

        if ( ! get::option('is_blog_installed')) {

            $touch = load::model('migration');

            $touch_db = $touch->touch_db();

            if ($touch_db === false)
                url::redirect('install/step5');
        }

        return true;
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
