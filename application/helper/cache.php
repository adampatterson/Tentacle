<?
/**
* //File: Cache
*/
class cache
{
	
	public function __construct()
	{
		# code...
	}
	
	
	public function add( $key, $data, $group, $expire )
	{
		
	}
	
	
	public function set( $key, $data, $group, $expire )
	{
		
	}
	
	
	public function get( $key, $group )
	{
		
	}
	
	
	public function delete( $id, $group ) 
	{
		
	}
	
	
	public function replace( $key, $data, $group, $expire )
	{
		
	}
	
	
	public function flush() 
	{
		
	}
	
	static public function script( $scriptFiles = '' )
	{
		tentacle::library('jsmin','jsmin');
		
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
		  $buffer .= file_get_contents(TENTACLE_JS.$scriptFile);
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
		  $buffer .= file_get_contents(TENTACLE_CSS.$cssFile);
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

