<?
class post_model
{
	// Get Post
	//----------------------------------------------------------------------------------------------
	public function get ( $id='' )
	{
		$posts = db ( 'posts' );

		if( defined( 'FRONT' ) ) {
			$get_posts = $posts->select( '*' )
				->where ( 'type', '=', 'post' )
				->order_by ( 'menu_order', 'ASC' )
				->clause ('AND')
				->where ( 'status', '=', 'published' )
				->execute();
					
			return $get_posts;
		} elseif ( $id == '' ) {
			$get_posts = $posts->select( '*' )
				->where ( 'type', '=', 'post' )
				->order_by ( 'id', 'DESC' )
				->clause ('AND')
				->where ( 'status', '!=', 'trash' )
				->execute();
					
			return $get_posts;
		} else {
			$get_posts = $posts->select( '*' )
				->where ( 'id', '=', $id )
				->clause ('AND')
				->where ( 'type', '=', 'post' )
				->execute();
			
			return $get_posts[0];
		}
	}
	
	
	// Get Page Meta
	//----------------------------------------------------------------------------------------------
	/**
	 * Get the meta date for a page, this would be any scaffold data or page options.
	 *
	 * @author Adam Patterson
	 */
	public function get_post_meta ( $id='' )
	{		
		$post_meta = db ( 'posts_meta' );
	
		$dirty_post_meta = $post_meta->select( 'meta_value' )
			->where ( 'posts_id', '=', $id )
			->execute();	
		
		$clean_post_meta = unserialize( $dirty_post_meta[0]->meta_value );

		return (object)$clean_post_meta;
	}
	
	
	// Update Post
	//----------------------------------------------------------------------------------------------
	public function update ( $id ) 
	{
		// create a new version of the content.

		$title         = $_POST['title'];
		$slug          = sanitize($title);
		$content       = $_POST['content'];
		$status        = $_POST['status'];
		$parent_page   = $_POST['parent_page'];
		//$post_template = $_POST['page_template'];
		
		$dirty_template = session::get( 'template' );
		
		if ( $dirty_template == '' ):
			$post_template = 'default';
		else:
			$post_template = $dirty_template;
		endif;
		
		
		$post_type     = $_POST['page-or-post'];
		
		$post_author   = user::id();
		
		$uri 			= $this->get_parent_uri( $parent_page ).$slug.'/';
		
		// Run content through HTMLawd and Samrty Text
		$page          = db('posts');
		
		$row = $page->update(array(
			'title'	=>$title,
			'slug'		=>$slug,
			'content'	=>$content,
			'status'	=>$status,
			'author'	=>$post_author,
			'type'		=>$post_type,
			'template'	=>$post_template,
			'parent'	=>$parent_page,
			'uri'		=>$uri,
			'modified'	=> time()
		))		
			->where( 'id', '=', $id )
			->execute();

	
		$scaffold_data = $_POST;

		$remove_keys = array( 'title', 'content', 'status', 'parent_page', 'page_template', 'page-or-post', 'history'  );
		
		foreach ( $remove_keys as $remove_key ):
			unset( $scaffold_data[ $remove_key ] );
		endforeach;
	
		$meta_value = serialize( $scaffold_data );

		$page_meta      = db('posts_meta');

		$page->update(array(
			'meta_key'=>'scaffold_data',
			'meta_value'=>$meta_value
		))
			->where( 'posts_id', '=', $id )
			->execute();
			
		note::set('success','page_update','Page Updated!');		
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

		$row = $page->insert(array(
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

		
		$scaffold_data = $_POST;

		$remove_keys = array( 'title', 'content', 'status', 'parent_page', 'page_template', 'page-or-post', 'history'  );

		foreach ( $remove_keys as $remove_key ):
			unset( $scaffold_data[ $remove_key ] );
		endforeach;

		$meta_value = serialize( $scaffold_data );

		$page_meta      = db('posts_meta');

		$page_meta->insert(array(
			'posts_id'=>$row->id,
			'meta_key'=>'scaffold_data',
			'meta_value'=>$meta_value
		));

		note::set('success','post_add','Post Added!');
		return $row->id;
		
		echo $row->id;
	}
}
