<?
/**
* File: Cache
*/
class cache
{
	
	public function __construct()
	{
		# code...
	}


	/**
	* Function: set
	*	Set cache
	*
	* Parameters:
	*	$key - string
	*	$data - Array or Object
	*	$expires - http://php.net/manual/en/function.strtotime.php
	*
	* Returns:
	*	Object
	*/


	public function set( $key, $data, $expire='+720 minutes' )
	{
		$cache['expire'] = strtotime($expire);
		$cache['data'] = $data;
		
		$cache_data = serialize( $cache );
		
		$settings = load::model( 'settings' );
		
		$set = $settings->add('_transient_'.$key, $cache_data, null );
		
		return $this->get($key);
    }
	
	
	/**
	* Function: get
	*	Get cache
	*
	* Parameters:
	*	$key - string
	*
	* Returns:
	*	Object / False
	*/	
	public function get( $key )
	{
		$settings = load::model( 'settings' );
		$get = $settings->get('_transient_'.$key);
		
		$cache_data = unserialize($get);
		
		if ($cache_data['expire'] < time() ) {
			// if the cache has expired then reload the cache.
			$this->delete( $key );
			return false;
		} else {
			return $cache_data['data'];
		}
	}
	
	
	/**
	* Function: delete
	*	Delete cache
	*
	* Parameters:
	*	$key - string
	*
	* Returns:
	*	True
	*/
	public function delete( $key ) 
	{
		$settings = load::model( 'settings' );
		
		$delete_cache = $settings->delete( '_transient_'.$key );
		
		return true;
	}


	public function clear() 
	{
		
	}
	
	
	public function flush() 
	{
		
	}

	/**
	* Function: look_up
	*	Find a cache object by key
	*
	* Parameters:
	*	$key - String
	*
	* Returns:
	*	Boolean
	*/
	public function look_up( $key)	
	{
		$settings = load::model('settings');

		$get = $settings->get('_transient_'.$key);
		
		$cache_data = unserialize($get);
		
		if ($cache_data['expire'] < time() ) {
			// if the cache has expired then reload the cache.
			$this->delete( $key );
			return false;
		} else {
			return true;
		}
	}
	
	
	/**
	*	Create an array containing paths to javascript files. They for now should be loaded in order of their requirements.
	*/
	static public function script( $scriptFiles = '' )
	{
		load::library('jsmin');
		
		/* Add your CSS files to this array (THESE ARE ONLY EXAMPLES) */
		$scriptFiles = array(
			"application.js",
			"bootstrap.js"
		);

		/**
		 * Ideally, you wouldn't need to change any code beyond this point.
		 */
		$buffer = "";
		foreach ($scriptFiles as $scriptFile) {
		  $buffer .= file_get_contents(ADMIN_JS.$scriptFile);
		}

		// Enable GZip encoding.
		ob_start("ob_gzhandler");

		// Enable caching
		header('Cache-Control: public');

		// Expire in one day
		header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');

		// Set the correct MIME type, because Apache won't set it for us
		header("Content-type: text/css");

		// Write everything out
		echo JSMin::minify( $buffer );
	}
		
	
	static public function css( $cssFiles = '' )
	{
		/* Add your CSS files to this array (THESE ARE ONLY EXAMPLES) */
		$cssFiles = array(
		  "bootstrap.css"
		);

		/**
		 * Ideally, you wouldn't need to change any code beyond this point.
		 */
		$buffer = "";
		foreach ($cssFiles as $cssFile) {
		  $buffer .= file_get_contents(ADMIN_CSS.$cssFile);
		}

		// Remove comments
		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);

		// Remove space after colons
		$buffer = str_replace(': ', ':', $buffer);

		// Remove whitespace
		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);

		// Enable GZip encoding.
		ob_start("ob_gzhandler");

		// Enable caching
		header('Cache-Control: public');

		// Expire in one day
		header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');

		// Set the correct MIME type, because Apache won't set it for us
		header("Content-type: text/css");

		// Write everything out
		echo($buffer);
	}
}

