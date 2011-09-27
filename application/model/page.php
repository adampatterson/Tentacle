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
				->where ( 'type', '=', 'page' )
				->order_by ( 'id', 'DESC' )
				->execute();	
			
			return $get_pages[0];
		}	
	}
/*
	public function update ( $id = '' )
	{
		return 'update';
	} 
	
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
		$title = input::post ( 'title' );
		
		$slug = sanitize($title);
		
		$content = input::post ( 'content' );
		
		$status = input::post ( 'status' );
		$visible = input::post ( 'visible' );
		$published = input::post ( 'published' );
		
		$parent_page = input::post ( 'parent_page' );
		$post_template = input::post ( 'page_template' );
		
		$post_type = 'page';
		
		$post_author = user::id();

		$page = db('posts');

		$page->insert(array(
			'title'=>$title,
			'slug'=>$slug,
			'content'=>$content,
			'status'=>$status,
			'author'=>$post_author,
			'type'=>$post_type,
			'template'=>$post_template,
			'parent'=>$parent_page,
			'visible'=>$visible
		),FALSE);

		note::set('success','page_add','Page Added!');
	}

} // END setting_model
?>
