<?
class post_model
{
	// Get Post
	//----------------------------------------------------------------------------------------------
	public function get ( $id='' )
	{
		$pages = db ( 'posts' );

		if ( $id == '' ) {
			$get_pages = $pages->select( '*' )
				->where ( 'type', '=', 'post' )
				->order_by ( 'id', 'DESC' )
				->execute();
					
			return $get_pages;
		} else {	
			$get_pages = $pages->select( '*' )
				->where ( 'id', '=', $id )
				->where ( 'type', '=', 'poast' )
				->order_by ( 'id', 'DESC' )
				->execute();	
			
			return $get_pages[0];
		}	
	}
	// Update Post
	//----------------------------------------------------------------------------------------------
	public function update ( $id='' )
	{
		return 'update';
	} 
	
	// Delete Post
	//----------------------------------------------------------------------------------------------
	public function soft_delete ( $id='' ) 
	{
		return 'delete';
	}
	
	// Delete Post
	//----------------------------------------------------------------------------------------------
	public function is_delete ( $id='' ) 
	{
		return 'delete';
	}
	
	// Add Post
	//----------------------------------------------------------------------------------------------
	public function add ( ) 
	{
		$title         = input::post ( 'title' );
		$slug          = sanitize($title);
		
		$content       = input::post ( 'content' );
		
		$post_template = input::post ( 'post_type' );
		
		$status        = input::post ( 'status' );
		//$visible       = input::post ( 'visible' );
		//$published     = input::post ( 'published' );
		
		$post_author   = user::id();
		
		$page          = db('posts');

		$page_id = $page->insert(array(
			'title'		=>$title,
			'slug'		=>$slug,
			'content'	=>$content,
			'status'	=>$status,
			'author'	=>$post_author,
			'type'		=>'post',
			'template'	=>$post_template,
			'date'		=>time(),
			'modified'	=>time()
		));

		return $page_id;
	}
	
	// Add Post Meta
	//----------------------------------------------------------------------------------------------
	public function add_meta ( $post_id ) 
	{
		$bread_crumb      = input::post ( 'bread_crumb' ); // Text
		
		$bread_crumb_slug = sanitize($bread_crumb);
		
		$meta_keywords    = input::post ( 'meta_keywords' ); // Comma seperated
		$meta_description = input::post ( 'meta_description' ); // Text
		$content_tags     = input::post ( 'content_tags' ); // Comma seperated
		
		$meta_robot       = input::post ( 'meta_robot' ); // Array
		$discussion       = input::post ( 'discussion' ); // Array

		$page = db('posts_meta');
/*
		$page->insert(array(
			'title'=>$title,
			'slug'=>$slug,
			'content'=>$content,
			'category'=>$page_category,
			'status'=>$status,
			'author'=>$post_author,
			'type'=>$post_type,
			'template'=>$post_template,
			'parent'=>$parent_page,
			'visible'=>$visible
		),FALSE);
*/
	}
}
