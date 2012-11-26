<?
class media_model
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

		// Run content through HTMLawd and Samrty Text
		$media          = db('media');

		$row = $media->insert(array(
			'uri'			=> IMAGE_URI.$file,
			'slug'			=> $slug,
			'name'			=> $file_full,
			'title'			=> $file_name,
			'date'			=> time(),
			'alt'			=> $file_name,
			'count'			=> 1,
			'type'			=> 'image',
			'author'		=> $author
		));
    }

	public function update( $id )
	{
		// Run content through HTMLawd and Samrty Text
		$media          = db('media');

		$title          = input::post('title');
		$caption        = input::post('caption');
		$alt            = input::post('alt_text');

		$row = $media->update(array(
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
		$media = db ( 'media' );
		
		if ( $id == '' ) {
			$get_media = $media->select( '*' )
				->where ( 'type', '=', 'image' )
				->order_by ( 'id', 'DESC' )
				->execute();
					
			return $get_media;
			
		} else {
			$get_media = $media->select( '*' )
				->where ( 'id', '=', $id )
				->clause ('AND')
				->where ( 'type', '=', 'image' )
				->execute();
			
			return $get_media[0];
		}
	}
}