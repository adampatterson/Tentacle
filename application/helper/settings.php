<?

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
	$setting = load::model ( 'settings' );

	if ( isset( $option ) ):
		return $setting->get( $option );
	else:
		return false;
	endif;
}