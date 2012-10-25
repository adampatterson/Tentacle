<?php
class admin_controller {
	
	/**
	* Manage Updates
	* ----------------------------------------------------------------------------------------------*/
	public function updates()
	{
		tentacle::valid_user();
		
		load::view ('admin/updates');	
	}
	
	
	public function updated ()
	{	
		tentacle::valid_user();

		load::view ('admin/upgraded');
	}
	
	
	/**
	* License Agree
	* ----------------------------------------------------------------------------------------------*/
	public function agree ()
	{
		tentacle::valid_user();
		
		load::view ( 'admin/agree' );
	}
	
	/**
	* Dashboard
	* ----------------------------------------------------------------------------------------------*/
	public function index ()
	{
		is_blog_installed(); 
		
		if(user::valid()) { 
			url::redirect('admin/dashboard'); 
		} else{
			load::view ('admin/login');
		}
	}
	
	public function dashboard ()
	{
		tentacle::valid_user();

		//if ( is_agree() == false )
		// 			url::redirect('admin/agree');
		
		if ( get_db_version() != get_current_db_version() )
			url::redirect('admin/updates');
		
		$id = user::id( );

		$user = load::model( 'user' );
		$user_single = $user->get( $id );
		$user_meta = $user->get_meta( $id );		
		
		load::view ( 'admin/dashboard', array( 'user'=>$user_single, 'user_meta'=>$user_meta ) );
	}
	
	/**
	* Logout
	* ----------------------------------------------------------------------------------------------*/
	public function logout ()
	{
		user::logout();
		url::redirect('admin/index');
	}


	/**
	* Activate account
	* ----------------------------------------------------------------------------------------------*/
	public function activate( $hash='' ){
		
		$user = load::model( 'user' );
		$hash_user = $user->get_hash( $hash );
		
		die;
		
		note::set('success','sent_message','Your password has been reset.');
		
		url::redirect( 'admin/login' );
	}
	
	
	/**
	* Lost Password
	* ----------------------------------------------------------------------------------------------*/
	public function lost(){
		load::view( 'admin/lost' );
	}
	
	
	/**
	* Set Password
	* ----------------------------------------------------------------------------------------------*/
	public function set_password( $hash=''){
		
		if ( $hash == '' ) {
			url::redirect( '/' );
		} else {
			load::view( 'admin/set_password', array( 'hash'=> $hash ) );
		}
		
	}
	
	
	/**
	* resources
	* ----------------------------------------------------------------------------------------------*/
	public function resources ()
	{
		tentacle::valid_user();

		load::view ( 'admin/resource' );
	}

	/**
	 * 
	 * 
	 * 
	 * ========================= Content
	 * 
	 * 
	 * 
	 * 
	 */

	/**
	* Add Page
	* ----------------------------------------------------------------------------------------------*/
	public function content_add_page ( $parent_page_id='' )
	{
		tentacle::valid_user();
		
		$page = load::model( 'page' );
		$pages = $page->get( );
		
		$page_hiarchy = $page->get_page_children( 0, $pages );

		load::view ( 'admin/content/content_add_page', array( 'pages' => $page_hiarchy, 'parent_page_id'=>$parent_page_id ) );		
	}
	
	/**
	* Update Page
	* ----------------------------------------------------------------------------------------------*/
	public function content_update_page ( $page_id )
	{
		tentacle::valid_user();
	
		$page = load::model( 'page' );
		$get_page = $page->get( $page_id );
		
		$pages = $page->get( );
		
		$page_hiarchy = $page->get_page_children( 0, $pages );
		
		$tag = load::model( 'tags' );
		$tags = $tag->get_all_tags();
		$tag_dirty_relations = $tag->get_relations( $page_id);
				
		foreach ( $tag_dirty_relations as $tag_single ) {
			$tag_relations[] = $tag_single->name;
		}
		
		if ( isset( $tag_relations ) != '') {
			$tag_relations = join(",", $tag_relations);
		} else {
			$tag_relations = null;
		}

		$get_page_meta = $page->get_page_meta( $page_id );

		load::view ('admin/content/content_edit_page', array(  'get_page'=>$get_page, 'get_page_meta'=>$get_page_meta, 'pages'=>$page_hiarchy, 'page_id'=>$page_id, 'tags'=>$tags, 'tag_relations'=>$tag_relations) );		
	}

	/**
	* Manage Page
	* ----------------------------------------------------------------------------------------------*/
	public function content_manage_pages ( $status = '' )
	{
		tentacle::valid_user();
		
		$page = load::model( 'page' );
		
		if ( $status ):
			$page_hiarchy = $page->get_by_status( $status );
		else:
			$pages = $page->get( );
			
			$page_hiarchy = $page->get_page_children( 0, $pages );
		endif;
		
		$user = load::model('user'); 
		$options = load::model( 'settings' );

		load::view ('admin/content/content_manage_pages', array( 'pages'=>$page_hiarchy, 'user'=>$user ) );
	}

	/**
	* Add Post
	* ----------------------------------------------------------------------------------------------*/
	public function content_add_post ()
	{
		tentacle::valid_user();
		
		load::helper ('date');
		
		$category = load::model( 'category' );
		$categories = $category->get_all_categories( );
		$tag = load::model( 'tags' );

		$tags = $tag->get_all_tags();
		
		load::view ('admin/content/content_add_post', array( 'categories'=>$categories, 'tags'=>$tags ) );
	}

	/**
	* Update Post
	* ----------------------------------------------------------------------------------------------*/
	public function content_update_post ( $post_id )
	{
		tentacle::valid_user();
	
		load::helper ('date');
	
		$post = load::model( 'post' );
		$get_post = $post->get( $post_id );
		
		$category = load::model( 'category' );
		$categories = $category->get_all_categories( );
		$category_relations = $category->get_relations( $post_id );
		
		$tag = load::model( 'tags' );
		$tags = $tag->get_all_tags();
		$tag_dirty_relations = $tag->get_relations( $post_id );
		
		foreach ( $tag_dirty_relations as $tag_single ) {
			$tag_relations[] = $tag_single->name;
		}  
		
		if ( isset( $tag_relations ) != '') {
			$tag_relations = join(",", $tag_relations);
		} else {
			$tag_relations = null;
		}

		$get_post_meta = $post->get_post_meta( $post_id );
		
		load::view ('admin/content/content_edit_post', array(  'get_post'=>$get_post, 'get_post_meta'=>$get_post_meta, 'post_id' => $post_id, 'categories'=>$categories, 'category_relations'=>$category_relations, 'tags'=>$tags, 'tag_relations'=>$tag_relations) );		
	}

	/**
	* manage Posts
	* ----------------------------------------------------------------------------------------------*/
	public function content_manage_posts ( $status = '' )
	{
		tentacle::valid_user();
				
		$post = load::model( 'post' );
		
		if ( $status ):
			$posts = $post->get_by_status( $status );
		else:
			$posts = $post->get( );
		endif;
		
		$category = load::model( 'category' );
		
		$user = load::model('user'); 
		
		load::view ('admin/content/content_manage_posts', array( 'posts'=>$posts, 'user'=>$user, 'category'=>$category ) );
	}

	/**
	 * 
	 * 
	 * 
	 * ========================= Content
	 * 
	 * 
	 * 
	 * 
	 */

	/**
	* Manage Comments
	* ----------------------------------------------------------------------------------------------*/
	public function content_manage_comments ()
	{
		tentacle::valid_user();
		
		load::view ('admin/content/content_manage_comments');
	}

	/**
	* manage Categories
	* ----------------------------------------------------------------------------------------------*/
	public function content_manage_categories ()
	{
		tentacle::valid_user();
		
		$category = load::model( 'category' );
		$categories = $category->get();
		
		load::view ('admin/content/content_manage_categories', array( 'categories'=>$categories ) );	
	}

	/**
	* Edit category
	* ----------------------------------------------------------------------------------------------*/
	public function content_edit_category ( $id = '' )
	{
		tentacle::valid_user();
		
		$category = load::model( 'category' );
		$category_single = $category->get( $id );
		
		load::view ('admin/content/content_edit_category', array( 'category'=>$category_single, 'id'=>$id ) );	
	}
	
	/**
	* Delete category
	* ----------------------------------------------------------------------------------------------*/
	public function content_delete_category ( $id = '' )
	{
		tentacle::valid_user();
		
		$category = load::model( 'category' );
		$category_single = $category->get( $id );
		
		load::view ('admin/content/content_delete_category', array( 'category'=>$category_single, 'id'=>$id ) );	
	}
	
	/**
	 * 
	 * 
	 * 
	 * ========================= Menu
	 * 
	 * 
	 * 
	 * 
	 */
	
	/**
	* Add Menu
	* ----------------------------------------------------------------------------------------------*/
	public function menu_add ()
	{
		tentacle::valid_user();
		
		load::view ('admin/menu/menu_add');
	}

	/**
	* Manage Menu
	* ----------------------------------------------------------------------------------------------*/
	public function menu_manage ()
	{
		tentacle::valid_user();
		
		load::view ('admin/menu/menu_manage');
	}

	/**
	 * 
	 * 
	 * 
	 * ========================= Media
	 * 
	 * 
	 * 
	 * 
	 */

	/**
	* Add Media
	* ----------------------------------------------------------------------------------------------*/
	public function media_insert ()
	{
		tentacle::valid_user();
		
		$media = load::model( 'media' );
		$get_media = $media->get();

		load::view ( 'admin/media/media_insert', array( 'media'=> $get_media ) );
	}

	/**
	* Add Media
	* ----------------------------------------------------------------------------------------------*/
	public function media_add ()
	{
		tentacle::valid_user();
		
		load::view ('admin/media/media_add');
	}
	
	/**
	* Manage Media
	* ----------------------------------------------------------------------------------------------*/
	public function media_manage ()
	{
		tentacle::valid_user();
		
		$media = load::model( 'media' );
		$get_media = $media->get();
		
		load::view ('admin/media/media_manage', array( 'media'=> $get_media ) );
	}

	/**
	* Download Media
	* ----------------------------------------------------------------------------------------------*/
	public function media_downloads ()
	{
		tentacle::valid_user();
		
		load::view ('admin/media/media_downloads');
	}

	/**
	 * 
	 * 
	 * 
	 * ========================= Snippets
	 * 
	 * 
	 * 
	 * 
	 */
	
	/**
	* Add Snippet
	* ----------------------------------------------------------------------------------------------*/
	public function snippets_add ()
	{
		tentacle::valid_user();
		
		load::view ('admin/snippets/snippets_add');
	}

	/**
	* Manage Snippet
	* ----------------------------------------------------------------------------------------------*/
	public function snippets_manage ()
	{
		tentacle::valid_user();
		
		$snippet = load::model( 'snippet' );
		$snippets = $snippet->get( );
		
		load::view ('admin/snippets/snippets_manage', array( 'snippets'=>$snippets ) );	
	}
	
	/**
	* Edit Snippet
	* ----------------------------------------------------------------------------------------------*/
	public function snippets_edit ( $id = '' )
	{
		tentacle::valid_user();
		
		$snippet = load::model( 'snippet' );
		$snippet_single = $snippet->get( $id );
		
		load::view ('admin/snippets/snippets_edit', array( 'snippet'=>$snippet_single ) );
	}
	
	/**
	* Delete Snippet
	* ----------------------------------------------------------------------------------------------*/
	public function snippets_delete ( $id )
	{
		tentacle::valid_user();
		
		$snippet = load::model( 'snippet' );
		$snippet_single = $snippet->get( $id );

		load::view ('admin/snippets/snippets_delete', array( 'snippet'=>$snippet_single, 'id'=>$id ) );
	}

	/**
	 * 
	 * 
	 * 
	 * ========================= Add On's
	 * 
	 * 
	 * 
	 * 
	 */
	
	/**
	* Add On's
	* ----------------------------------------------------------------------------------------------*/
	public function addons_install ()
	{
		tentacle::valid_user();
		
		load::view ('admin/addons_install');
	}

	/**
	 * 
	 * 
	 * 
	 * ========================= Settings
	 * 
	 * 
	 * 
	 * 
	 */

	/**
	* Appearance Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_appearance ()
	{
		tentacle::valid_user();

		$theme = load::helper ('theme');
		
		$options = load::model( 'settings' );
		$get = $options->get( 'appearance' );
		
		$serpent = load::model( 'serpent' );
		$themes = $serpent->get_theme( );
		
		load::view ('admin/settings/settings_appearance', array('theme'=>$theme ));
	}
	
	
	/**
	* Module Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_modules ()
	{
		tentacle::valid_user();
	
		$serpent = load::model( 'serpent' );
		$serpent_modules = $serpent->get_module( );
		
		$modules = load::model( 'module' );
		$get_module = $modules->get();

		load::view ('admin/settings/settings_modules', array( 'serpent_modules'=>$serpent_modules, 'modules'=>$get_module ) );
	}

	/**
	* Comment Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_comments ()
	{
		tentacle::valid_user();

		load::view ('admin/settings/settings_comments');
	}

	/**
	* Export Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_export ()
	{
		tentacle::valid_user();

		load::view ('admin/settings/settings_export');
	}

	/**
	* Template Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_templates ()
	{
		tentacle::valid_user();

		load::view ('admin/settings/settings_templates');
	}

	/**
	* General Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_general ()
	{
		tentacle::valid_user();
		
		$category = load::model( 'category' );
		$categories = $category->get( );

		load::view ('admin/settings/settings_general', array( 'categories'=>$categories ) );
	}

	/**
	* SEO Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_seo ()
	{
		tentacle::valid_user();

		load::view ('admin/settings/settings_seo');
	}

	/**
	* SEO 404 Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_seo_404 ()
	{
		tentacle::valid_user();

		load::view ('admin/settings/settings_seo_404');
	}

	/**
	* Import Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_import ()
	{
		tentacle::valid_user();

		load::view ('admin/settings/settings_import');
	}

	/**
	* Media Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_media ()
	{
		tentacle::valid_user();

		load::view ('admin/settings/settings_media');
	}

	/**
	* Privacy Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_privacy ()
	{		
		tentacle::valid_user();

		load::view ('admin/settings/settings_privacy');
	}

	/**
	* Reading Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_reading ()
	{
		tentacle::valid_user();

		load::view ('admin/settings/settings_reading');
	}

	/**
	* Writing Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_writing ()
	{
		tentacle::valid_user();
	
		$category = load::model( 'category' );
		$categories = $category->get( );
	
		load::view ('admin/settings/settings_writing', array( 'categories'=>$categories ) );
	}


	/**
	 * 
	 * 
	 * 
	 * ========================= Users
	 * 
	 * 
	 * 
	 * 
	 */

	/**
	* Add User
	* ----------------------------------------------------------------------------------------------*/
	public function users_add ()
	{
		tentacle::valid_user();

		load::view ('admin/users/users_add');
	}
	
	/**
	* Edit User
	* ----------------------------------------------------------------------------------------------*/
	public function users_edit ( $id='' )
	{
		tentacle::valid_user();
		
		$user = load::model('user');
		$user_single = $user->get($id);
		$user_meta = $user->get_meta($id);

		load::view ( 'admin/users/users_edit', array( 'user'=>$user_single, 'user_meta'=>$user_meta ) );
	}
	
	/**
	* Manage Users
	* ----------------------------------------------------------------------------------------------*/
	public function users_manage ( )
	{
		tentacle::valid_user( );
		
		$user = load::model( 'user' );
		$users = $user->get( );
		
		load::view ( 'admin/users/users_manage', array( 'users'=>$users ) );
	}

	/**
	* User Profile
	* ----------------------------------------------------------------------------------------------*/
	public function users_profile ( )
	{
		tentacle::valid_user( );

		$id = user::id( );

		$user = load::model( 'user' );
		$user_single = $user->get( $id );
		$user_meta = $user->get_meta( $id );

		load::view ( 'admin/users/users_profile', array( 'user'=>$user_single, 'user_meta'=>$user_meta ) );
	}

	/**
	* Delete user
	* ----------------------------------------------------------------------------------------------*/	
	public function users_delete ( $id )
	{
		tentacle::valid_user();
		
		$user = load::model( 'user' );
		$user_meta = $user->get_meta( $id );

		load::view ('admin/users/users_delete', array( 'user_meta'=>$user_meta, 'id'=>$id ) );
	}

	/**
	 * 
	 * 
	 * 
	 * ========================= SEO
	 * 
	 * 
	 * 
	 * 
	 */

	/**
	* Webmaster Tools
	* ----------------------------------------------------------------------------------------------*/
	public function seo_webmaster_tools()
	{
		tentacle::valid_user();

		load::view ('admin/seo/seo_webmaster');
	}

	/**
	* Analytics
	* ----------------------------------------------------------------------------------------------*/	
	public function seo_analytics()
	{
		tentacle::valid_user();
		
		load::view ('admin/seo/seo_analytics');
	}

	/**
	* 404
	* ----------------------------------------------------------------------------------------------*/	
	public function seo_404 ()
	{
		tentacle::valid_user();
		
		load::view ('admin/seo/seo_404');
	}

	/**
	* Cononical
	* ----------------------------------------------------------------------------------------------*/
	public function seo_canonical ()
	{
		tentacle::valid_user();
		
		load::view ('admin/seo/seo_canonical');
	}

	/**
	* Meta Description
	* ----------------------------------------------------------------------------------------------*/
	public function seo_meta_description ()
	{
		tentacle::valid_user();
		
		load::view ('admin/seo/seo_meta_description');
	}

	/**
	* Meta Keywords
	* ----------------------------------------------------------------------------------------------*/
	public function seo_meta_keywords ()
	{
		tentacle::valid_user();
		
		load::view ('admin/seo/seo_meta_keywords');
	}

	/**
	* Robots
	* ----------------------------------------------------------------------------------------------*/
	public function seo_robot ()
	{
		tentacle::valid_user();
		
		load::view ('admin/seo/seo_robot');
	}

	/**
	 * 
	 * 
	 * 
	 * ========================= About
	 * 
	 * 
	 * 
	 * 
	 */

	/**
	* System Details
	* ----------------------------------------------------------------------------------------------*/
	public function about_system_details ()
	{
		tentacle::valid_user();
		
		load::view ('admin/about_system_details');
	}
} // END Class main_controller