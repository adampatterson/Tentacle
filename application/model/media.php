<?
class media_model
{
    public function add( $file )
    {
		$file_meta = explode('.', $file );
		
		$file_name = $file_meta[0];

		$slug			= sanitize($file_name);
		$author 		= user::id();

		// Run content through HTMLawd and Samrty Text
		$media          = db('media');

		$row = $media->insert(array(
			'uri'			=> IMAGE_URI.$file,
			'slug'			=> $slug,
			'title'			=> $file_name,
			'date'			=> time(),
			'alt'			=> $file_name,
			'count'			=> 1,
			'type'			=> 'image',
			'author'		=> $author
		));

		load::helper('image');
		process_image($file, TRUE);
    }

	public function update( $id )
	{
		// Run content through HTMLawd and Samrty Text
		$media          = db('media');

		$row = $media->update(array(
			'uri'			=> $uri,
			'slug'			=> $slug,
			'title'			=> $title,
			'caption'		=> $caption,
			'description'	=> $description,
			'date'			=> time(),
			'exif'			=> $exif,
			'alt'			=> $alt,
			'count'			=> $count,
			'type'			=> $type,
			'author'		=> $author
			))		
			->where( 'id', '=', $id )
			->execute();
	}
}