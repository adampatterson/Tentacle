<?
/*
 * File: Get
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
	function get_option( $option, $default = false ) 
	{
		$setting = db ( 'options' );
		
		$get_settings = $setting->select( '*' )
			->where( 'key', '=', $option )
			->execute();
		
		if ( isset($get_settings[0]->value)) {
			return $get_settings[0]->value;
		} else {
			return $default;
		}
	}

     function get_modules() {
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
		
		
	function get_next_post () {}
	function get_previous_post () {}
	function get_post_status () {}