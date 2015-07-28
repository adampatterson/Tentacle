<?php
load::helper( 'data_properties' );

class admin_controller extends properties {

	/**
	* Manage Updates
	* ----------------------------------------------------------------------------------------------*/
	public function updates()
	{
		tentacle::valid_user();
		
		load::view ('admin/updates');	
	}

	
	public function updated ( )
	{	
		tentacle::valid_user();

        if ( get::option('old_version') )
            load::model('statistics')->mixpanel_server( false, get::option('old_version') );

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
		is::blog_installed();
		
		if(user::valid()) { 
			url::redirect('admin/dashboard'); 
		} else{
			load::view ('admin/login');
		}
	}
	
	public function dashboard ()
	{
		tentacle::valid_user();

//		if ( is::agree() == false )
//		    url::redirect('admin/agree');
		
		if ( get::db_version() != get::current_db_version() )
			url::redirect('admin/updates');
		
		$id = user::id( );

		$user_single    = $this->user_model()->get( $id );
		$user_meta      = $this->user_model()->get_meta( $id );
		
		load::view ( 'admin/dashboard', array( 'user' => $user_single, 'user_meta' => $user_meta ) );
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
	public function activate( $hash='' )
    {
		$hash_user = $this->user_model()->get_hash( $hash );

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
		
		$pages = $this->content_model()->type( 'page' )->get( );
		
		$page_hierarchy = $this->content_model()->get_page_children( 0, $pages );

		load::view ( 'admin/content/add_page', array( 'pages' => $page_hierarchy, 'parent_page_id'=>$parent_page_id ) );
	}
	
	/**
	* Update Page
	* ----------------------------------------------------------------------------------------------*/
	public function content_update_page ( $page_id )
	{
		tentacle::valid_user();

		$get_page = $this->content_model()
            ->type( 'page' )
            ->get( $page_id );

		$pages = $this->content_model()
            ->type( 'page' )
            ->get( );

		$page_hierarchy = $this->content_model()->get_page_children( 0, $pages );
		
		$tags = $this->tag_model()->get_all_tags();
		$tag_dirty_relations = $this->tag_model()->get_relations( $page_id);
				
		foreach ( $tag_dirty_relations as $tag_single )
			$tag_relations[] = $tag_single->name;

		if ( isset( $tag_relations ) != '')
			$tag_relations = join(",", $tag_relations);
		else
			$tag_relations = null;

		$get_page_meta = $this->content_model()->get_meta( $page_id );

		load::view ('admin/content/edit_page', array(  'get_page'=>$get_page, 'get_page_meta'=>$get_page_meta, 'pages'=>$page_hierarchy, 'page_id'=>$page_id, 'tags'=>$tags, 'tag_relations'=>$tag_relations) );
	}

    /**
     * Update Page
     * ----------------------------------------------------------------------------------------------*/
    public function content_order_page (  )
    {
        tentacle::valid_user();

        define ( 'FRONT'		,'true' );

        $pages = $this->content_model()
            ->type('page')->
            get_by_parent_id( 0 );

        load::view ('admin/content/order_page', array(  'pages'=>$pages ) );
    }

	/**
	* Manage Page
	* ----------------------------------------------------------------------------------------------*/
	public function content_manage_pages ( $status = '' )
	{
		tentacle::valid_user();

		if ( $status ):
			$page_hierarchy = $this->content_model()
                ->type('page')
                ->get_by_status( $status );
		else:
			$pages = $this->content_model()
                ->type('page')
                ->get( );

			$page_hierarchy = $this->content_model()
                ->type('page')
                ->get_page_children( 0, $pages );
		endif;

		load::view ('admin/content/manage_pages', array( 'pages'=>$page_hierarchy, 'user'=>$this->user_model() ) );
	}

	/**
	* Add Post
	* ----------------------------------------------------------------------------------------------*/
	public function content_add_post ()
	{
		tentacle::valid_user();

		$categories = $this->category_model()->get_all_categories( );

		$tags = $this->tag_model()->get_all_tags();

		load::view ('admin/content/add_post', array( 'categories'=>$categories, 'tags'=>$tags ) );
	}

	/**
	* Update Post
	* ----------------------------------------------------------------------------------------------*/
	public function content_update_post ( $post_id )
	{
		tentacle::valid_user();

		$get_post = $this->content_model()
            ->type( 'post' )
            ->get( $post_id );

		$categories = $this->category_model()->get_all_categories( );
		$category_relations = $this->category_model()->get_relations( $post_id );

		$tags = $this->tag_model()->get_all_tags();
		$tag_dirty_relations = $this->tag_model()->get_relations( $post_id );

		foreach ( $tag_dirty_relations as $tag_single )
			$tag_relations[] = $tag_single->name;

		if ( isset( $tag_relations ) != '')
			$tag_relations = join(",", $tag_relations);
		else
			$tag_relations = null;

		$get_post_meta = $this->content_model()->get_meta( $post_id );

		load::view ('admin/content/edit_post', array(  'get_post'=>$get_post, 'get_post_meta'=>$get_post_meta, 'post_id' => $post_id, 'categories'=>$categories, 'category_relations'=>$category_relations, 'tags'=>$tags, 'tag_relations'=>$tag_relations) );
	}

	/**
	* manage Posts
	* ----------------------------------------------------------------------------------------------*/
	public function content_manage_posts ( $status = '' )
	{
		tentacle::valid_user();

		if ( $status )
			$posts = $this->content_model()
                ->type( 'post' )
                ->get_by_status( $status );
		else
			$posts = $this->content_model()
                ->type( 'post' )
                ->get( );

		load::view ('admin/content/manage_posts', array( 'posts'=>$posts, 'user'=>$this->user_model(), 'category'=>$this->category_model() ) );
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

		load::view ('admin/content/manage_comments');
	}

	/**
	* manage Categories
	* ----------------------------------------------------------------------------------------------*/
	public function content_manage_categories ()
	{
		tentacle::valid_user();

		$categories = $this->category_model()->get_all_categories();

		load::view ('admin/content/manage_categories', array( 'categories'=>$categories ) );
	}

	/**
	* Edit category
	* ----------------------------------------------------------------------------------------------*/
	public function content_edit_category ( $id = '' )
	{
		tentacle::valid_user();

		$category_single = $this->category_model()->get( $id );

		load::view ('admin/content/edit_category', array( 'category'=>$category_single, 'id'=>$id ) );
	}
	
	/**
	* Delete category
	* ----------------------------------------------------------------------------------------------*/
	public function content_delete_category ( $id = '' )
	{
		tentacle::valid_user();

		$category_single = $this->category_model()->get( $id );
		
		load::view ('admin/content/delete_category', array( 'category'=>$category_single, 'id'=>$id ) );	
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
		
		load::view ('admin/menu/manage');
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
		
		$get_media = $this->media_model()->get();

		load::view ( 'admin/media/insert', array( 'media'=> $get_media ) );
	}

	/**
	* Manage Media
	* ----------------------------------------------------------------------------------------------*/
	public function media_manage ()
	{
		tentacle::valid_user();
		
		$get_media = $this->media_model()->get();
		
		load::view ('admin/media/manage', array( 'media'=> $get_media ) );
	}

	public function media_update($id)
	{
		tentacle::valid_user();

		$get_image = $this->media_model()->get($id);

		load::view ('admin/media/update', array( 'image'=> $get_image ) );
	}

	/**
	* Download Media
	* ----------------------------------------------------------------------------------------------*/
	public function media_downloads ()
	{
		tentacle::valid_user();
		
		load::view ('admin/media/downloads');
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
		
		load::view ('admin/snippets/add');
	}

	/**
	* Manage Snippet
	* ----------------------------------------------------------------------------------------------*/
	public function snippets_manage ()
	{
		tentacle::valid_user();
		
		$snippets = $this->snippet_model()->get( );

		load::view ('admin/snippets/manage', array( 'snippets'=>$snippets ) );
	}
	
	/**
	* Edit Snippet
	* ----------------------------------------------------------------------------------------------*/
	public function snippets_edit ( $id = '' )
	{
		tentacle::valid_user();
		
		$snippet_single = $this->snippet_model()->get( $id );
		
		load::view ('admin/snippets/edit', array( 'snippet'=>$snippet_single ) );
	}
	
	/**
	* Delete Snippet
	* ----------------------------------------------------------------------------------------------*/
	public function snippets_delete ( $id )
	{
		tentacle::valid_user();
		
		$snippet_single = $this->snippet_model()->get( $id );

		load::view ('admin/snippets/delete', array( 'snippet'=>$snippet_single, 'id'=>$id ) );
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

		load::view ('admin/settings/appearance', array('theme'=>$theme ));
	}

	public function settings_appearance_options() {
		tentacle::valid_user();

		load::view ('admin/settings/appearance_options');
	}
	
	/**
	* Plugin Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_plugins ( $plugin_view = false )
	{
        tentacle::valid_user();

		// These will come from the Serpent API
        $serpent_plugins = $this->serpent_model()->get_plugin( );
		
		$plugin_raw = $this->plugin_model()->navigation('plugin_navigation');
		$get_plugin = $this->plugin_model()->get();

        if ( $plugin_view == true ) {
            
			load::view('admin/partials/header', array('title' => 'Dashboard', 'assets' => array('application')));

            foreach ($plugin_raw as $plugin_subnav)
                foreach ($plugin_subnav as $plugin) {

                    if ($plugin['route'] == $plugin_view) {
                        load::plugin_view($plugin['uri'].'/'.$plugin['route'], array('data'=> 'test'));
                    }
                }

            load::view('admin/partials/footer', array( 'assets' => array( '' ) ) );
        } else {
            load::view ('admin/settings/plugins', array( 'serpent_plugins'=>$serpent_plugins, 'plugins'=>$get_plugin ) );
        }
	}


	/**
	* Comment Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_comments ()
	{
		tentacle::valid_user();

		load::view ('admin/settings/comments');
	}

	/**
	* Export Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_export ()
	{
		tentacle::valid_user();

		load::view ('admin/settings/export');
	}

	/**
	* Template Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_templates ()
	{
		tentacle::valid_user();

		load::view ('admin/settings/templates');
	}

	/**
	* General Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_general ()
	{
		tentacle::valid_user();
		
		  $categories = $this->category_model()->get_all_categories( );

      $pages = $this->content_model()
          ->type( 'page' )
          ->get();

      $page_array = $this->content_model()
          ->type( 'page' )
          ->get_page_children( 0, $pages, 0 );

      $page_object = (object)$page_array;

      $get_page_by_level = $this->content_model()
          ->type( 'page' )
          ->get_page_by_level( $page_object, 0 );

		load::view ('admin/settings/general', array( 'categories'=>$categories, 'pages'=>$get_page_by_level ) );
	}

	/**
	* SEO Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_seo ()
	{
		tentacle::valid_user();

		load::view ('admin/settings/seo');
	}

	/**
	* SEO 404 Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_seo_404 ()
	{
		tentacle::valid_user();

		load::view ('admin/settings/seo_404');
	}

	/**
	* Import Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_import ()
	{
		tentacle::valid_user();

		load::view ('admin/settings/import');
	}

	/**
	* Media Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_media ()
	{
		tentacle::valid_user();

		load::view ('admin/settings/media');
	}

	/**
	* Privacy Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_privacy ()
	{		
		tentacle::valid_user();

		load::view ('admin/settings/privacy');
	}

	/**
	* Reading Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_reading ()
	{
		tentacle::valid_user();

		load::view ('admin/settings/reading');
	}

	/**
	* Writing Settings
	* ----------------------------------------------------------------------------------------------*/
	public function settings_writing ()
	{
		tentacle::valid_user();
	
		$categories = $this->category_model()->get( );
	
		load::view ('admin/settings/writing', array( 'categories'=>$categories ) );
	}

    /**
     * Import WordPress
     * ----------------------------------------------------------------------------------------------*/
    public function import_wordpress()
    {
        tentacle::valid_user();

        load::view ('admin/import/wordpress' );
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

		load::view ('admin/users/add');
	}
	
	/**
	* Edit User
	* ----------------------------------------------------------------------------------------------*/
	public function users_edit ( $id='' )
	{
		tentacle::valid_user();
		
		$user_single    = $this->user_model()->get( $id );
		$user_meta      = $this->user_model()->get_meta( $id );

		load::view ( 'admin/users/edit', array( 'user'=>$user_single, 'user_meta'=>$user_meta ) );
	}
	
	/**
	* Manage Users
	* ----------------------------------------------------------------------------------------------*/
	public function users_manage ( )
	{
		tentacle::valid_user( );

		$users          = $this->user_model()->get( );
		
		load::view ( 'admin/users/manage', array( 'users'=>$users ) );
	}

	/**
	* User Profile
	* ----------------------------------------------------------------------------------------------*/
	public function users_profile ( )
	{
		tentacle::valid_user( );

		$id = user::id( );

		$user_single    = $this->user_model()->get( $id );
		$user_meta      = $this->user_model()->get_meta( $id );

		load::view ( 'admin/users/profile', array( 'user'=>$user_single, 'user_meta'=>$user_meta ) );
	}

	/**
	* Delete user
	* ----------------------------------------------------------------------------------------------*/	
	public function users_delete ( $id )
	{
		tentacle::valid_user();
		
		$user_meta      = $this->user_model()->get_meta( $id );

		load::view ('admin/users/delete', array( 'user_meta'=>$user_meta, 'id'=>$id ) );
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