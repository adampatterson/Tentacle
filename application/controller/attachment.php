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
			$size = 250;            

			$image = new image( IMAGE_DIR.$file['file'] );
            $image->resize($size,NULL);
			
			$size = '_'.$size;
			
            $image->save( IMAGE_DIR.$file_meta[0].$size.'.'.$file_meta[1] );
            $image->close();
        }

    }// END index

} // END Class file

?> 