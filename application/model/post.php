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
		$title         = $_POST['title'];
		
		$slug          = sanitize($title);
		
		$content       = $_POST['content'];
		
		$status        = $_POST['status'];
		$visible       = $_POST['visible'];
		$published     = $_POST['published'];
		
		$parent_page   = $_POST['parent_page'];
		$post_type 		= $_POST['post_type'];
		$page_category = input::post ( 'page_category');
		
		$post_type     = 'post';
		
		$post_author   = user::id();
		
		$page          = db('posts');

		$page->insert(array(
			'title'=>$title,
			'slug'=>$slug,
			'content'=>$content,
			'category'=>$page_category,
			'status'=>$status,
			'author'=>$post_author,
			'type'=>$post_type,
			'template'=>$post_type,
			'parent'=>$parent_page,
			'visible'=>$visible
		),FALSE);

		note::set('success','post_add','Post Added!');
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
