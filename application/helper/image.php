<?
/**
* File: Image
*/


function process_image( $file = '', $insert = FALSE )
{
	//get the file array
	//$file = get_tracking_array( );

    $file_path = IMAGE_DIR.$file;

	$file_meta = explode('.', $file );	
	
    if( file_exists( $file_path ))
    {         
		$image = new image( $file_path );
		
		if ($image->width > $image->height ) {
			// Thumb
			$image = new image( $file_path );
			
			$image->resize( IMAGE_T,NULL );
			
			$size = '_'.IMAGE_T;

            $image->save( IMAGE_DIR.$file_meta[0].$size.'.'.$file_meta[1] );
            $image->close();

			// Medium
			$image = new image( $file_path );
			
			$image->resize( IMAGE_M, NULL );
			
			$size = '_'.IMAGE_M;

            $image->save( IMAGE_DIR.$file_meta[0].$size.'.'.$file_meta[1] );
            $image->close();

			// Medium
			$image = new image( $file_path );
			
			$image->resize( IMAGE_L,NULL );
			
			$size = '_'.IMAGE_L;

            $image->save( IMAGE_DIR.$file_meta[0].$size.'.'.$file_meta[1] );
            $image->close();
		} else {
			// Thumb
			$image = new image( $file_path );
			
			$image->resize( NULL,IMAGE_T );
			
			$size = '_'.IMAGE_T;

            $image->save( IMAGE_DIR.$file_meta[0].$size.'.'.$file_meta[1] );
            $image->close();

			// Medium
			$image = new image( $file_path );
			
			$image->resize(NULL,IMAGE_M);
			
			$size = '_'.IMAGE_M;

            $image->save( IMAGE_DIR.$file_meta[0].$size.'.'.$file_meta[1] );
            $image->close();

			// Medium
			$image = new image( $file_path );
			
			$image->resize(NULL,IMAGE_L);
			
			$size = '_'.IMAGE_L;

            $image->save( IMAGE_DIR.$file_meta[0].$size.'.'.$file_meta[1] );
            $image->close();
		}
			// Medium
			$image = new image( $file_path );
			
			$image->dynamic_resize(IMAGE_T,IMAGE_T);
			
			$size = '_sq';

            $image->save( IMAGE_DIR.$file_meta[0].$size.'.'.$file_meta[1] );
            $image->close();
    }
} // Process
?>