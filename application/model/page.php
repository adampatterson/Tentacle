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
		$title         = $_POST['title'];
		
		$slug          = sanitize($title);
		
		$content       = $_POST['content'];
		
		$status        = $_POST['status'];
		/*
		$visible       = $_POST['visible'];
		$published     = $_POST['published'];
		*/
		
		$parent_page   = $_POST['parent_page'];
		$post_template = $_POST['page_template'];
		
		//Capture the post array and remove required inoputs.
		
		$post_type     = 'page';
		
		$post_author   = user::id();
		
		$page          = db('posts');
		
/* 		Save required information to the posts table
		$page->insert(array(
			'title'=>$title,
			'slug'=>$slug,
			'content'=>$content,
			'status'=>$status,
			'author'=>$post_author,
			'type'=>$post_type,
			'template'=>$post_template,
			'parent'=>$parent_page
		));
		*/
		
		clean_out($_POST);
		
		$page_meta      = db('posts_meta');
		
// 		Strip out the postts required information.

// 		Clean out any post options that are key values.
/*		$page->insert(array(
			'post_id'=>$page->id,
			'meta_key'=>$meta_key,
			'meta_value'=>$meta_value
		));
		*/
		
		/*        
        mySerialize( $obj ) {
           return base64_encode(gzcompress(serialize($obj)));
        }
        
        myUnserialize( $txt ) {
           return unserialize(gzuncompress(base64_decode($txt)));
        } 
		*/

		note::set('success','page_add','Page Added!');
	}

} // END setting_model
?>
