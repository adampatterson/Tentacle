<?php

class attachment_controller {
        
    public function index()
	{
		//get the file array
		$file = get_tracking_array( );

        $file_path = IMAGE_DIR.$file['file'];

		$file_meta = explode('.', $file['file'] );
		
        if( file_exists( $file_path ) )
        {         
			$image = new image( IMAGE_DIR.$file['file'] );
			
			if ($image->width > $image->height ) {
				// Thumb
				$image = new image( IMAGE_DIR.$file['file'] );
				
				$image->resize( IMAGE_T,NULL );
				
				$size = '_'.IMAGE_T;

	            $image->save( IMAGE_DIR.$file_meta[0].$size.'.'.$file_meta[1] );
	            $image->close();
	
				// Medium
				$image = new image( IMAGE_DIR.$file['file'] );
				
				$image->resize( IMAGE_M, NULL );
				
				$size = '_'.IMAGE_M;

	            $image->save( IMAGE_DIR.$file_meta[0].$size.'.'.$file_meta[1] );
	            $image->close();
	
				// Medium
				$image = new image( IMAGE_DIR.$file['file'] );
				
				$image->resize( IMAGE_L,NULL );
				
				$size = '_'.IMAGE_L;

	            $image->save( IMAGE_DIR.$file_meta[0].$size.'.'.$file_meta[1] );
	            $image->close();
			} else {
				// Thumb
				$image = new image( IMAGE_DIR.$file['file'] );
				
				$image->resize( NULL,IMAGE_T );
				
				$size = '_'.IMAGE_T;

	            $image->save( IMAGE_DIR.$file_meta[0].$size.'.'.$file_meta[1] );
	            $image->close();
	
				// Medium
				$image = new image( IMAGE_DIR.$file['file'] );
				
				$image->resize(NULL,IMAGE_M);
				
				$size = '_'.IMAGE_M;

	            $image->save( IMAGE_DIR.$file_meta[0].$size.'.'.$file_meta[1] );
	            $image->close();
	
				// Medium
				$image = new image( IMAGE_DIR.$file['file'] );
				
				$image->resize(NULL,IMAGE_L);
				
				$size = '_'.IMAGE_L;

	            $image->save( IMAGE_DIR.$file_meta[0].$size.'.'.$file_meta[1] );
	            $image->close();
			}
				// Medium
				$image = new image( IMAGE_DIR.$file['file'] );
				
				$image->dynamic_resize(IMAGE_T,IMAGE_T);
				
				$size = '_sq';

	            $image->save( IMAGE_DIR.$file_meta[0].$size.'.'.$file_meta[1] );
	            $image->close();
        }

    }// END index

} // END Class file

?> 