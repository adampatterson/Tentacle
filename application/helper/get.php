<?
/*
 * These Get functions are meant to the used more so on the admin side.
 */

	/**
	 * Get Options
	 *
	 * @param string $option 
	 * @param string $default 
	 * @return void
	 * @author Adam Patterson
	 */
	function get_option( $option, $default = false ) 
	{
		$setting = db ( 'options' );
		
		$get_settings = $setting->select( '*' )
			->where( 'key', '=', $option )
			->execute();

		return $get_settings[0]->value;
	}

	function get_current_db_version ()
	{
		return get_option( 'db_version' );
	}
	
	function get_db_version ()
	{
		return TENTACLE_DB_VERSION;
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
	 * Get the request method used to send this page
	 *
	 * @return string possible value: GET, POST or AJAX
	 */
	function get_request_method() 
	{
	    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') return 'AJAX';
	    else if ( ! empty($_POST)) return 'POST';
	    else return 'GET';
	}
	