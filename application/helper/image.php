<?
/**
* File: Image
*/

/**
* Function: process_image
*	Takes an image and saves multiple versions of that image based on the admin options.
*
* Parameters:
*	$file - String - Path to the image
*	$insert - Custom image size processed when the user clicks insert image.
*
* Returns:
*	NULL
*/
function process_image( $file = '', $insert = FALSE )
{
    $file_path = IMAGE_DIR.$file;

	$meta = explode('.', $file );

    if( file_exists( $file_path ))
    {
		$i = new image( $file_path );

		// Thumb
			$thumb = new image( $file_path );

			if ($i->width > $i->height ){
				$thumb->resize( IMAGE_T, 0 );
			} else {
				$thumb->resize( 0, IMAGE_T );
			}

			$thumb->save( IMAGE_DIR.$meta[0].'_'.IMAGE_T'.'.$meta[1] );
			$thumb->close();


		// Medium
			$medium = new image( $file_path );

			if ($i->width > $i->height ) {
				$medium->resize( IMAGE_M, 0 );
			}else{
				$medium->resize( 0, IMAGE_M );
			}

			$medium->save( IMAGE_DIR.$meta[0].'_'.IMAGE_M.'.'.$meta[1] );
			$medium->close();


		// Large
			$large = new image( $file_path );

			if ($i->width > $i->height ) {
				$large->resize( IMAGE_L,0 );
			}else{
				$large->resize( 0, IMAGE_L );
			}

			$large->save( IMAGE_DIR.$meta[0].'_'.IMAGE_L.'.'.$meta[1] );
			$large->close();

		// Square
			$square = new image( $file_path );

			$square->square( IMAGE_T );

			$square->save( IMAGE_DIR.$meta[0].'_sq.'.$meta[1] );
			$square->close();
    } else {
		dingo_error(E_USER_ERROR, "Image file not found: The image file ($file_path) could not be found.");
	}
} // Process
?>