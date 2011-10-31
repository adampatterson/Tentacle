<?
class page_model  
{
	/*
    const TABLE_NAME = 'posts';
    
    const STATUS_DRAFT = 'publish';
    const STATUS_REVIEWED = 50;
    const STATUS_PUBLISHED = 100;
    const STATUS_HIDDEN = 101;

    const LOGIN_NOT_REQUIRED = 0;
    const LOGIN_REQUIRED = 1;
    const LOGIN_INHERIT = 2;
    
    public $title;
    public $slug;
    public $breadcrumb;
    public $keywords;
    public $description;
    public $content;
    public $parent_id;
    public $layout_id;
    public $behavior_id;
    public $status_id;
    public $comment_status;
    
    public $created_on;
    public $published_on;
    public $updated_on;
    public $created_by_id;
    public $updated_by_id;
    public $position;
    public $is_protected;
    public $needs_login;
    */

	
	// Get Page
	//----------------------------------------------------------------------------------------------
	public function get ( $id='' )
	{
		$pages = db ( 'posts' );
		
		if ( $id == '' ) {
			$get_pages = $pages->select( '*' )
				->where ( 'type', '=', 'page' )
				->order_by ( 'id', 'DESC' )
				->execute();
					
			return $get_pages;
		} else {	
			$get_pages = $pages->select( '*' )
				->where ( 'id', '=', $id )
				->clause( 'AND' )
				->where ( 'type', '=', 'page' )
				->order_by ( 'id', 'DESC' )
				->execute();	

			return $get_pages[0];
		}	
	}
	
	
	// Get Page Meta
	//----------------------------------------------------------------------------------------------
	public function get_page_meta ( $id='' )
	{		
		$page_meta = db ( 'posts_meta' );
	
		$dirty_page_meta = $page_meta->select( 'meta_value' )
			->where ( 'posts_id', '=', $id )
			->execute();	
		
		$clean_page_meta = unserialize( $dirty_page_meta[0]->meta_value );

		return arrayToObject( $clean_page_meta );
	}


	// Update Page
	//----------------------------------------------------------------------------------------------	
	public function update ( ) 
	{
		note::set('success','page_update','Page Updated!');
	}
	
/*
	public function soft_delete ( $id='' ) 
	{
		return 'delete';
	}
	
	public function is_delete ( $id='' ) 
	{
		return 'delete';
	}
	*/

	// Add Page
	//----------------------------------------------------------------------------------------------	
	public function add ( ) 
	{
		$title         = $_POST['title'];
		$slug          = sanitize($title);
		$content       = $_POST['content'];
		$status        = $_POST['status'];
		$parent_page   = $_POST['parent_page'];
		//$post_template = $_POST['page_template'];
		
		$dirty_template = session::get( 'template' );
		
		if ( $dirty_template == '' ) 
		{
			$post_template = 'default';
		} else {
			$post_template = $dirty_template;
		}
		
		
		$post_type     = $_POST['page-or-post'];
		
		$post_author   = user::id();
		
		$page          = db('posts');
		
		$row = $page->insert(array(
			'title'=>$title,
			'slug'=>$slug,
			'content'=>$content,
			'status'=>$status,
			'author'=>$post_author,
			'type'=>$post_type,
			'template'=>$post_template,
			'parent'=>$parent_page
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

		note::set('success','page_add','Page Added!');
	}
} // END setting_model
?>
