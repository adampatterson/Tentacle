<?
/*
 * File: Get / Set / Is / The
 */

	/**
	* Function: get_option
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
	function get_option( $key, $default = false )
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
     * Function: set_option
     *	Set a new option ( Key Value ) if the option exists it will be updated.
     *
     * Parameters:
     *	$key - String
     *	$value - String
     *
     * Returns:
     *	$value - String
     */
    function set_option( $key = '', $value = '' )
    {
        $settings = load::model( 'settings' );

        $add = $settings->update( $key, $value );

        return $value;
    }


    function get_enabled_module() {
        return enabled_module();
    }

	/**
	* Function: get_current_db_version
	*	Function call for the DB version saved in the database.
	*
	* Returns:
	*	String
	*/
	function get_current_db_version ()
	{
		return get_option( 'db_version' );
	}
	
	
	/**
	* Function: get_db_version
	*	Function call to the constant TENTACLE_DB_VERSION
	*
	* Returns:
	*	String
	*/
	function get_db_version ()
	{
		return TENTACLE_DB_VERSION;
	}

		
	/**
	* Function: get_url
	* Create a really nice url like http://www.example.com/controller/action/params#anchor
	*
	* you can put as many params as you want,
	* if a params start with # it is considered to be an Anchor
	*
	* - get_url('controller/action/param1/param2') // I always use this method
	* - get_url('controller', 'action', 'param1', 'param2');
	*
	* Returns:
	*	string
	*/
	function get_url() 
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
	* Function: get_request_method
	*	Returns the request method.
	*
	* Returns:
	*	GET, POST or AJAX
	*/
	function get_request_method() 
	{
	    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') return 'AJAX';
	    else if ( ! empty($_POST)) return 'POST';
	    else return 'GET';
	}
	
	
	/**
	* Function: get_gravatar
	*	Get either a Gravatar URL or complete image tag for a specified email address.
	*
	*	- <?php echo get_gravatar($gravatar); ?>
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
	function get_gravatar( $email, $s = GRAVATAR_SIZE, $d = 'mm', $r = 'g', $img = true, $atts = array() )
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
	* Function: get_snippet
	*	Function call passing the $slug to retrieve the snippet.
	*
	* Parameters:
	*	$slug - String
	*
	* Returns:
	*	String
	*/
	function get_snippet( $slug ) {
		$snippet = load::model( 'snippet' );
		$snippet_single = $snippet->get_slug( $slug );

		return $snippet_single->content;
	}
		
		
	/**
	* Function: get_json
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
	function get_json( $key, $json ) 
	{
		foreach ($json as $json_key => $value ) {
			if ($key == $json_key) {
				return $value;
			}
		}	
	}
	
				
	function get_next_post () {}
	function get_previous_post () {}
	function get_post_status () {}
		
	
	/**
	* Function: is_blog_installed
	*	Simply checks to see if the blog is installed.
	*
	* Returns:
	*	Bool
	*/
	function is_blog_installed() {
		$touch = load::model( 'sql' );

		$touch_db = $touch->touch_db();

		if ( $touch_db === false ) {
			url::redirect('install/step5');
		} else {
			return true;
		}		
	}


	/**
	* Function: is_agree
	*	Has the owner agreed to the terms and services.
	*
	* Returns:
	*	Bool
	*/
	function is_agree() {
		if ( get_option( 'is_agree' ) ) {
			return true;
		} else {
			return false;
		}
	}


	/**
	* Function: is_availible_updates
	*	Are there any updates?
	*
	* Returns:
	*	Bool
	*/
	function is_availible_updates() {
		if ( get_option( 'is_updates' ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	* Function: is_update
	*	Is the new version newer than the current version.
	*
	* Returns:
	*	Bool
	*/
	function is_update( $current, $new ) {
		if ($current < $new) {
			return true;
		} else {
			return false;
		}
	}


	/**
	* Function: is_mobile
	*	Is the page being viewed with a mobile device?
	*
	* Returns:
	*	Bool
	*/
	function is_mobile() 
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


	function is_rtl () {}
	function is_front_page () {}
	function is_home () {}
	function is_date () {}
	function is_search () {}
	function is_paged () {}
	function is_page () {}
	function is_preview () {}
	function is_page_template () {}
	function is_404 () {}
	function is_error () {}
	function is_single () {}
	function is_sticky () {}
	function is_admin () {}
	function is_archive () {}
	function is_post_type_archive () {}
	function is_author () {}
	function is_user_logged_in () {}
	function is_category () {}
	function is_tag () {}
	function is_tax () {}
	function is_trackback () {}
	function is_serialized () {}
	function is_admin_bar_showing () {}