<?
/**
* File: Image
*/

/**
* Function: process_image
*	Takes an image and saves multiple versions of that image based on the admin options.
*
* Parameters:
*	$orifinal_file - String - Path to the image
*	$insert - Custom image size processed when the user clicks insert image.
*
* Returns:
*	NULL
*/
# @todo: 	for performance image resizing should probably work on a cascading principal where you take 
#			the original resize for the larger, large for the medium, medium for ...
function process_image( $orifinal_file = '', $insert = FALSE )
{
	$meta = explode('.', $orifinal_file );

	if( file_exists( IMAGE_DIR.$orifinal_file ))
	{
		$i = new image( IMAGE_DIR.$orifinal_file );
		$i->close();
		// Large
			$large = new image( IMAGE_DIR.$orifinal_file );

			if ($i->width > $i->height ) {
				$large->resize( IMAGE_L,0 );
			}else{
				$large->resize( 0, IMAGE_L );
			}
			
			$large_file = $meta[0].'_'.IMAGE_L.'.'.$meta[1];
			$large->save( IMAGE_DIR.$large_file );
			$large->close();


		// Medium
			$medium = new image( IMAGE_DIR.$large_file );

			if ($i->width > $i->height ) {
				$medium->resize( IMAGE_M, 0 );
			}else{
				$medium->resize( 0, IMAGE_M );
			}

			$medium_file = $meta[0].'_'.IMAGE_M.'.'.$meta[1];
			$medium->save( IMAGE_DIR.$medium_file );
			$medium->close();


		// Thumb
			$thumb = new image( IMAGE_DIR.$medium_file );

			if ($i->width > $i->height ){
				$thumb->resize( IMAGE_T, 0 );
			} else {
				$thumb->resize( 0, IMAGE_T );
			}

			$thumb_file = $meta[0].'_'.IMAGE_T.'.'.$meta[1];
			$thumb->save( IMAGE_DIR.$thumb_file );
			$thumb->close();


		// Square
			$square = new image( IMAGE_DIR.$thumb_file );

			$square->square( IMAGE_T );

			$square_file = $meta[0].'_sq.'.$meta[1];
			$square->save( IMAGE_DIR.$square_file );
			$square->close();
	} else {
		dingo_error(E_USER_ERROR, "Image file not found: The image file ($file_path) could not be found.");
	}
} // Process
?>