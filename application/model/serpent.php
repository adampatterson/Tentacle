<?
class serpent_model {
	public function get_core()
	{
		$scc = stream_context_create( array( 'http' => array( 'timeout' => CHECK_TIMEOUT ) ) );

		$version = file_get_contents( 'http://api.tentaclecms.com/get/core/', 0, $scc );
	
		return json_decode( $version );
	}
	
	public function get_theme($single = '')
	{
		$scc = stream_context_create( array( 'http' => array( 'timeout' => CHECK_TIMEOUT ) ) );

		$themes = file_get_contents( 'http://api.tentaclecms.com/get/themes/'.$single, 0, $scc );
	
		return json_decode( $themes );
	}
	
	public function get_module($single = '')
	{
		$scc = stream_context_create( array( 'http' => array( 'timeout' => CHECK_TIMEOUT ) ) );
		
		$modules = file_get_contents( 'http://api.tentaclecms.com/get/plugins/'.$single, 0, $scc );

		return json_decode( $modules );
	}
}