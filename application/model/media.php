<?php

class media_model extends properties
{
    # @todo: if the file name is the same do not add it to the databsdse.
	public function add( $file )
    {
		$file_meta = string_to_parts($file);
		
		$file_full      = $file_meta['name'];
		$file_name      = $file_meta['file_name'];
		$file_extension = $file_meta['extension'];

		$slug			= string::sanitize($file_name);
		$author 		= user::id();

        $image = IMAGE_DIR.$file_meta['name'];

        if (exif_imagetype($image) == IMAGETYPE_JPEG) {
            $exif = @exif_read_data($image);
            if ($exif === false) {
                $exif = '';
            } else {
                $exif = serialize($exif);
            }
        } else {
            $exif = '';
        }

		// Run content through HTMLawd and Samrty Text
		$row = $this->media_table()
            ->insert(array(
			'uri'			=> IMAGE_URI.$file,
			'slug'			=> $slug,
			'name'			=> $file_full,
			'title'			=> $file_name,
			'date'			=> time(),
            'exif'          => $exif,
			'alt'			=> $file_name,
			'count'			=> 1,
			'type'			=> 'image',
			'author'		=> $author
		));
    }


	public function update( $id )
	{
		// Run content through HTMLawd and Samrty Text
		$title          = input::post('title');
		$caption        = input::post('caption');
		$alt            = input::post('alt_text');

		$row = $this->media_table()
            ->update(array(
			//'uri'			=> $uri,
			//'slug'			=> $slug,
			'title'			=> $title,
			'caption'		=> $caption,
			//'description'	=> $description,
			'alt'			=> $alt
			))
			->where( 'id', '=', $id )
			->execute();
	}


	public function get( $id = '' )
	{
		if ( $id == '' ) {
            $get_media =  $this->media_table()
                ->select( '*' )
				->where ( 'type', '=', 'image' )
				->order_by ( 'id', 'DESC' )
				->execute();

            return $get_media;
		} else {
			$get_media = $this->media_table()
                ->select( '*' )
				->where ( 'id', '=', $id )
				->clause ('AND')
				->where ( 'type', '=', 'image' )
				->execute();
			
			return $get_media[0];
		}
	}
}