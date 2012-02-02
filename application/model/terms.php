<?
class terms_model 
{
	
	// Get Tag
	//----------------------------------------------------------------------------------------------
	public function get ( $id='' )
	{
		return 'get';
	}
	
	// Update Tag
	//----------------------------------------------------------------------------------------------
	public function update ( $id='' )
	{
		return 'update';
	} 
	
	// Delete Tag
	//----------------------------------------------------------------------------------------------
	public function delete ( $id='' ) 
	{
		return 'delete';
	}
	
	// Add Tag
	//----------------------------------------------------------------------------------------------
	public function add () 
	{
		return 'add';
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