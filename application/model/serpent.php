<?
class serpent_model {
	public function get_core()
	{
		load::helper('file');
		
		$scc = stream_context_create( array( 'http' => array( 'timeout' => CHECK_TIMEOUT ) ) );

		$version = get::url_contents('http://api.tentaclecms.com/get/core/');
	
		return json_decode( $version );
	}
	
	public function get_theme($single = '')
	{
		load::helper('file');
		
		$scc = stream_context_create( array( 'http' => array( 'timeout' => CHECK_TIMEOUT ) ) );

		$themes = get::url_contents( 'http://api.tentaclecms.com/get/themes/'.$single );
	
		return json_decode( $themes );
	}
	
	public function get_plugin($single = '')
	{
		load::helper('file');
		
		$scc = stream_context_create( array( 'http' => array( 'timeout' => CHECK_TIMEOUT ) ) );
		
		$plugins = get::url_contents( 'http://api.tentaclecms.com/get/plugins/'.$single );

		return json_decode( $plugins );
	}
}