<?
class terms_model 
{
	// Add Tag
	//----------------------------------------------------------------------------------------------
	public function add () 
	{
		return 'add';
	}


	// Update Tag
	//----------------------------------------------------------------------------------------------
	public function update ( $id='' )
	{
		return 'update';
	} 
	
	
	// Get Tag
	//----------------------------------------------------------------------------------------------
	public function get ( $id='' )
	{
		return 'get';
	}
	
	
	// Delete Tag
	//----------------------------------------------------------------------------------------------
	public function delete ( $id='' ) 
	{
		return 'delete';
	}
	
	
	// Tag Relations
	//----------------------------------------------------------------------------------------------
	public function relations () 
	{
		$page_category = serialize(input::post( 'post_category' ));
		
		$terms         = db('posts');

		$page->insert(array(
			'title'		=>$title,
			'slug'		=>$slug,
			'content'	=>$content
		),FALSE);
		
	}
}