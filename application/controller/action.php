<?php
class action_controller {
	
	/**
	* Cut it Out
	* ----------------------------------------------------------------------------------------------*/
	public function index ()
	{	
		echo 'No direct access';
	}
	
	
	/**
	* Agree to terms
	* ----------------------------------------------------------------------------------------------*/
	public function agree ()
	{
	
		$setting = load::model( 'settings' );
		
		$update_agree = $setting->update( 'is_agree', 'true' );

		url::redirect('admin/dashboard');
	}
	
	/**
	 * 
	 * 
	 * 
	 * ========================= Log-in/Out
	 * 
	 * 
	 * 
	 * 
	 */
	
	
	/**
	* Login
	* ----------------------------------------------------------------------------------------------*/
	public function login ()
	{
		$username = input::post( 'username' );
	    $password = input::post( 'password' );
	
		$history = input::post( 'history' );

	    user::login($username, $password);

	    if(user::valid()) 
		{

			if ($history != '') 
			{
				url::redirect($history);
			} 
			else 
			{
				url::redirect('admin/dashboard');
			}
			
	    } 
		else 
		{
	       note::set("error","login",NOTE_PASSWORD);
	       url::redirect('admin/index'); 
	    }
	}
	

	/**
	* Lost Password
	* ----------------------------------------------------------------------------------------------*/
	public function lost()
	{
 		$username = input::post('username');

		$users_table = db('users');  

		if ( strstr( $username, '@', true) ) {
			$user = $users_table->select('*')
		                    ->where('email','=',$username)
		                    ->execute();
		} else {
			$user = $users_table->select('*')
		                    ->where('username','=',$username)
		                    ->execute();
		}
		           
	    if ( isset($user[0]->email)) 
		{
	        // Generate a Hash from the users IP
       

			$user_name    = $user[0]->username;
			$email        = $user[0]->email;

			$first_name   = $user[0]->first_name;
			$last_name    = $user[0]->last_name;

			$encrypted_password = sha1( $password );

			$registered = time();
			$hashed_ip = sha1($_SERVER['REMOTE_ADDR'].$registered);
			
			user::update($username)
			           ->data('activation_key',$hashed_ip)
			           ->save();

			$send_email = load::model( 'email' );

			load::helper('email');

			$hashed_ip = sha1($_SERVER['REMOTE_ADDR'].time());
			$hash_address = BASE_URL.'admin/activate/'.$hashed_ip;

			$message = '<p>A password reset has been issued for <strong>Username</strong>: '.$user_name.' </p>
						<p><strong>Click the link to create a new password.</strong><br />'.BASE_URL.'admin/set_password/'.$hashed_ip.'</p>';

			$user_email = $send_email->send( 'Recover your password', $message, $email );

			note::set("success","sent_message",'An email has been sent with instructions.');
			url::redirect('admin');
			
	    } else {
	        // @todo set lost password error message for not match
	        echo 'No match, Set an error message';
	    }
	

	} // END Function Action Login


	/**
	* Activate account
	* ----------------------------------------------------------------------------------------------*/
	public function activate( $hash='' ){

		$user = load::model( 'user' );
		$user_details = $user->get_hash( $hash );
		
		user::update($user_details->email)
		           ->data('activation_key','')
				   ->data('status','')
		           ->save();

		note::set('success','sent_message','Your email has been confirmed.');
	
		url::redirect( 'admin' );
	}


	/**
	* Set password from hash
	* ----------------------------------------------------------------------------------------------*/
	public function set_password( )
	{	
		$user = load::model( 'user' );
		$user_details = $user->set_password( );

		user::update($user_details->email)
		           ->data('activation_key','')
				   ->data('status','')
		           ->save();

		note::set('success','sent_message','Your password has been reset.');
		
		url::redirect( 'admin' );
	}
	

	/**
	* Check for Unique user name
	* ----------------------------------------------------------------------------------------------*/
	public function unique_user ()
	{
		$user = load::model( 'user' );
		$unique = $user->unique( $_POST['username'] );
	
		return $unique;
	}


	/**
	 * 
	 * 
	 * 
	 * ========================= Load Scaffold
	 * 
	 * 
	 * 
	 * 
	 */
	
	/**
	* Render Admin
	* ----------------------------------------------------------------------------------------------*/
	public function render_admin ( $location, $template = ''/*, $id = null */ )
	{
		
		if ( $template == 'default' ):
			$delete = session::delete ( 'template' );
		else:
			if ( session::get( 'template' ) ):
				session::update( 'template', $template );
			else:
				session::set( 'template', $template);
			endif;
		endif;
		
		url::redirect( 'admin/content_'.$location.'/' );
		/*
		if ( $id == null ) {
			url::redirect( 'admin/content_'.$location.'/' );
		} else {
			url::redirect( 'admin/content_'.$location.'/'.$id );
		}
		*/
	}


	/**
	 * 
	 * 
	 * 
	 * ========================= Pages
	 * 
	 * 
	 * 
	 * 
	 */

	/**
	* Add Page
	* ----------------------------------------------------------------------------------------------*/
 	public function add_page ()
 	{
		tentacle::valid_user();

		$page = load::model( 'page' );
		$page_single = $page->add( );
			
		// Delete the selected tempalte from the session once the Page has been posted.
		session::delete ( 'template' );

		/*
		$post_tags = input::post( 'tags' );
		$tag = load::model( 'tags' );
		$tag_relations = $tag->relations( $post_single, $post_tags );
		*/

		url::redirect( 'admin/content_update_page/'.$page_single );
	}
	

	/**
	* Update Page
	* ----------------------------------------------------------------------------------------------*/	
	public function update_page ( $page_id )
 	{
		tentacle::valid_user();

		$page = load::model( 'page' );
		$page_single = $page->update( $page_id );
		
		/*
		$post_tags = input::post( 'tags' );
		$tag = load::model( 'tags' );
		$tag_relations = $tag->relations( $post_single, $post_tags, true );
		*/
		
		session::delete ( 'template' );

		url::redirect( input::post( 'history' ) );
	}


	/**
	* Delete User
	* ----------------------------------------------------------------------------------------------*/	
	public function delete_page ()
 	{
	
	}
	

	/**
	* Trash User
	* ----------------------------------------------------------------------------------------------*/	
	public function trash_page ( $id )
 	{
		$page = db('posts');

		$page->update(array(
			'status'=>'trash'
		))
			->where( 'id', '=', $id )
			->execute();
			
		note::set('success','page_soft_delete','Moved to the trash.');
		
		url::redirect( 'admin/content_manage_pages' );
	}
	
	/**
	 * 
	 * 
	 * 
	 * ========================= Posts
	 * 
	 * 
	 * 
	 * 
	 */
	
	/**
	* Add Post
	* ----------------------------------------------------------------------------------------------*/
 	public function add_post ()
 	{
		tentacle::valid_user();
			
		$post = load::model( 'post' );
		$post_single = $post->add( );
		
		$post_categories = input::post( 'post_category' );
		$category = load::model( 'category' );
		$category_relations = $category->relations( $post_single, $post_categories );
		
		$post_tags = input::post( 'tags' );
		$post_tags = explode(',', $post_tags );
		$tags = load::model( 'tags' );
		
		foreach ( $post_tags as $tag ) {
			$tag_single = $tags->add( $tag );
			
			$tag_relations = $tags->relations( $post_single, $tag_single );
		}	
		
		url::redirect( 'admin/content_update_post/'.$post_single );
	}	
	
	
	/**
	* Update User
	* ----------------------------------------------------------------------------------------------*/
	public function update_post ( $post_id )
 	{
		tentacle::valid_user();

		$post = load::model( 'post' );
		$post_single = $post->update( $post_id );
		
		$post_categories = input::post( 'post_category' );
		$category = load::model( 'category' );
		$category_relations = $category->relations( $post_single, $post_categories, true );
		
		$post_tags = input::post( 'tags' );
		$post_tags = explode(',', $post_tags );
		$tags = load::model( 'tags' );
		
		foreach ( $post_tags as $tag ) {

			$tag_single = $tags->add( $tag );
			
			$tag_relations = $tags->relations( $post_single, $tag_single );
		}
		
		url::redirect( input::post( 'history' ) );
	}
	

	/**
	* Delete Post
	* ----------------------------------------------------------------------------------------------*/	
	public function delete_post ()
 	{
	
	}
	

	/**
	* Trash Post
	* ----------------------------------------------------------------------------------------------*/	
	public function trash_post ( $id )
 	{
		$page = db('posts');

		$page->update(array(
			'status'=>'trash'
		))
			->where( 'id', '=', $id )
			->execute();
			
		note::set('success','post_soft_delete','Moved to the trash.');
		
		url::redirect( 'admin/content_manage_posts' );
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
	public function add_user ()
	{
		tentacle::valid_user();
				
		$user = load::model( 'user' );
		$user_single = $user->add();

		if (input::post( 'send_password' ) == 'yes') {
			$send_email = load::model( 'email' );

			$user_name    = input::post( 'user_name' );
			$password     = input::post( 'password' );
			$email        = input::post( 'email' );
		
			$first_name   = input::post( 'first_name' );
			$last_name    = input::post( 'last_name' );
	
			load::helper('email');

			$hashed_ip = sha1( $_SERVER['REMOTE_ADDR'].time() );
			
			user::update($user_name)
			           ->data('activation_key',$hashed_ip)
					   ->data('status','inactive')
			           ->save();
		
			if ($password == '') {
				$message = '<p>Hello '.$first_name.' '.$last_name.',<br />Here are your account details.</p>
							<p><strong>Username</strong>: '.$user_name.'<br />
							<p><strong>Click the link to create a password.</strong><br /> '.BASE_URL.'admin/set_password/'.$hashed_ip.'</p>
							<strong>From:</strong> <a href="'.BASE_URL.'admin/">'.BASE_URL.'admin/</a>';
			} else {
				$message = '<p>Hello '.$first_name.' '.$last_name.',<br />Here are your account details.</p>
							<p><strong>Username</strong>: '.$user_name.'<br />
							<strong>Password</strong>: '.$password.'</p>
							<p><strong>Click the link to activate your account.</strong><br /> '.BASE_URL.'action/activate/'.$hashed_ip.'</p>
							<strong>From:</strong> <a href="'.BASE_URL.'admin/">'.BASE_URL.'admin/</a>';
			}

			$user_email = $send_email->send( 'Welcome to Tentacle CMS', $message, $email );	
		}
		
		$history = input::post( 'history' );
		
		url::redirect('admin/users_manage/');
	}


	/**
	* Update User
	* ----------------------------------------------------------------------------------------------*/	
	public function update_user ( )
	{
		tentacle::valid_user();

		$user 				= load::model( 'user' );
		$user_single 		= $user->update();
		
		$history = input::post( 'history' );

		url::redirect($history); 
	}
	

	/**
	* Delete User
	* ----------------------------------------------------------------------------------------------*/
	public function delete_user ( $id = '' )
	{
		tentacle::valid_user();
		
		$confirm = input::post('delete_user');
		
		if ( $confirm == 'delete' ) {
			$user = load::model( 'user' );
			$user_delete = $user->delete( $id );
		}
		
		url::redirect('admin/users_manage/');
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
	public function add_snippet ()
	{	
		tentacle::valid_user();
			
		$snippet = load::model( 'snippet' );
		$snippet_single = $snippet->add( );

		//$history = input::post( 'history' );
		url::redirect('admin/snippets_manage/'); 
	}


	/**
	* Update Snippet
	* ----------------------------------------------------------------------------------------------*/	
	public function update_snippet ( $id )
	{
		tentacle::valid_user();
		
		$snippet = load::model( 'snippet' );
		$snippet_single = $snippet->update( $id  );
		
		

		url::redirect('admin/snippets_manage/');
	}
	

	/**
	* Delete Snippet
	* ----------------------------------------------------------------------------------------------*/
	public function delete_snippet ( $id = '' )
	{
		tentacle::valid_user();
		
		$snippet = load::model( 'snippet' );
		$snippet_delete = $snippet->delete( $id );
		
		url::redirect('admin/snippets_manage/');
	}
	
	
	/**
	 * 
	 * 
	 * 
	 * ========================= Categories
	 * 
	 * 
	 * 
	 * 
	 */
	
	
	/**
	* Add Category
	* ----------------------------------------------------------------------------------------------*/
 	public function add_category ()
 	{	
		tentacle::valid_user();	
 		$category = load::model( 'category' );
 		$category_single = $category->add( );
 
 		//$history = input::post( 'history' );
 		url::redirect('admin/content_manage_categories/'); 
 	}


	/**
	* Update Category
	* ----------------------------------------------------------------------------------------------*/ 	
 	public function update_category ( $id ) 
 	{
		tentacle::valid_user();
	
		$category = load::model( 'category' );
		$category_single = $category->update( $id  );

		url::redirect('admin/content_manage_categories/'); 
 	}
 

	/**
	* Delete Category
	* ----------------------------------------------------------------------------------------------*/	
 	public function delete_category ( $id ) 
 	{
		tentacle::valid_user()
		;
 		$category = load::model( 'category' );
 		$category_delete = $category->delete( $id );
 		
 		url::redirect('admin/content_manage_categories/'); 
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
	* Update Settings
	* ----------------------------------------------------------------------------------------------*/
 	public function update_settings ( $key, $value, $autoload = 'yes' )
	{
		$setting = load::model( 'settings' );
		
		$update_appearance = $setting->update( $key, $value, $autoload );

		url::redirect('admin/settings_appearance');	
	}
	
	
	/**
	* Update Settings Post
	* ----------------------------------------------------------------------------------------------*/
	public function udpate_settings_post ( )
	{	
		$setting = load::model( 'settings' );
		
		$autoload = 'yes';
		$keys = array_keys( $_POST );
		$values = array_values( $_POST );
		
		for (
		     reset($keys), 
		     reset($values);
		     list(, $key ) = each( $keys ) ,
		     list(, $value ) = each( $values )
		     ;
		) {
			if ( $key != 'submit' && $key != 'history') 
			{
				$update_settings = $setting->update( $key, $value, $autoload );
			}
		}

		$history = input::post( 'history' );
		url::redirect($history);
		//unset($_POST);
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
     * Upload
     * ----------------------------------------------------------------------------------------------*/
	/*
	 * jQuery File Upload Plugin PHP Example 5.7
	 * https://github.com/blueimp/jQuery-File-Upload
	 *
	 * Copyright 2010, Sebastian Tschan
	 * https://blueimp.net
	 *
	 * Licensed under the MIT license:
	 * http://www.opensource.org/licenses/MIT
	 */
    public function upload_media ()
    {
		$target_folder = STORAGE_DIR.'images/'; // Relative to the root
		
		error_reporting(E_ALL | E_STRICT);

		tentacle::library('','upload.class');

		$upload_handler = new UploadHandler();

		header('Pragma: no-cache');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Content-Disposition: inline; filename="files.json"');
		header('X-Content-Type-Options: nosniff');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
		header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');

		switch ($_SERVER['REQUEST_METHOD']) {
		    case 'OPTIONS':
		        break;
		    case 'HEAD':
		    case 'GET':
		        $upload_handler->get();
		        break;
		    case 'POST':
		        if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
		            $upload_handler->delete();
		        } else {
		            $upload_handler->post();
		        }
		        break;
		    case 'DELETE':
		        $upload_handler->delete();
		        break;
		    default:
		        header('HTTP/1.1 405 Method Not Allowed');
		}
    }


	public function update_media( $id )
	{
		$media = load::model( 'media' );

		//$update = $media->update( $id );
		
		$history = input::post( 'history' );

		url::redirect($history); 
	}

	
	public function delete_media()
	{
		
	}
	
	
	public function trash_media()
	{
		
	}
	
	
	/**
	 * 
	 * 
	 * 
	 * ========================= Install Process
	 * 
	 * 
	 * 
	 * 
	 */	
	
	
	/**
	* Database
	* ----------------------------------------------------------------------------------------------*/
	public function database()
	{
				
		$this->driver 		= 'mysql';
		$this->host 		= input::post( 'db_host' );
		$this->username 	= input::post( 'db_user' );
		$this->password 	= input::post( 'db_password' );
		$this->database 	= input::post( 'db_name' );
		
		try {
			$this->con = new pdo("{$this->driver}:dbname={$this->database};host={$this->host}",$this->username,$this->password);
		} catch(PDOException $e) {
			dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
		}


		// Setup the Temp db.php file
		$search = array ( 'fill_databasename', 'fill_username', 'fill_password', 'fill_host');
		$replace = array ( $this->database, $this->username, $this->password, $this->host );

		$setup_handle = array (
		"<? if(!defined('DINGO')){die('External Access to File Denied');} \n ",
		"config::set('db',array(",
		"		'default'=>array(",
		"		'driver'=>'mysql',\n",
		"		'host'=>'fill_host',\n",
		"		'username'=>'fill_username', \n",
		"		'password'=>'fill_password',  \n",
		"		'database'=>'fill_databasename' \n",
		"		)
	));
?>" );

		$source = array (
		"<? if(!defined('DINGO')){die('External Access to File Denied');} \n ",
		"config::set('db',array(",
		"		'default'=>array(",
		"		'driver'=>'mysql',\n",
		"		'host'=>'fill_host',\n",
		"		'username'=>'fill_username', \n",
		"		'password'=>'fill_password',  \n",
		"		'database'=>'fill_databasename' \n",
		"		)
	));
?>" );

		$setup_handle = fopen('application/config/setup/db.php', 'w');

		$setup_source = str_replace ( $search, $replace, $source );
		foreach ( $setup_source as $str )
			fwrite($setup_handle, $str);

		// Setup the Deployment db.php file
		$handle = fopen('application/config/deployment/db.php', 'w');

		$source = str_replace ( $search, $replace, $source );
		foreach ( $source as $str )
			fwrite($handle, $str);
		
		url::redirect('install/step4');
	}
	
	
	/**
	* Admin
	* ----------------------------------------------------------------------------------------------*/
	public function admin()
	{
		load::config('db');
		
		$config = config::get('db');

		$user_name    = input::post( 'user_name' );
		$password     = input::post( 'password' );
		$email        = input::post( 'email' );

		$first_name   = input::post( 'first_name' );
		$last_name    = input::post( 'last_name' );
		$display_name = input::post( 'display_name' );

		$encrypted_password = sha1( $password );
		
		$registered = time();
		$hashed_ip = sha1($_SERVER['REMOTE_ADDR'].$registered);
		$hash_address = BASE_URL.'admin/activate/'.$hashed_ip;
		

		$pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);

		$build = $pdo->exec( "INSERT INTO `users` (`email`, `username`, `password`, `type`, `data`, `registered`, `status`)
								VALUES
									('$email', '$user_name', '$encrypted_password', 'administrator', '{\"first_name\":\"$first_name\",\"last_name\":\"$last_name\",\"activity_key\":\"$hashed_ip\",\"url\":\"\",\"display_name\":\"$display_name\",\"editor\":\"wysiwyg\"}', '$registered', 1)" );
		
		
		if (input::post( 'send_password' ) == 'yes') {
			$send_email = load::model( 'email' );

			load::helper('email');

			$hashed_ip = sha1($_SERVER['REMOTE_ADDR'].time());
			$hash_address = BASE_URL.'admin/activate/'.$hashed_ip;

			$message = '<p>Hello '.$first_name.' '.$last_name.',<br />Here are your account details.</p>
						<p><strong>Username</strong>: '.$user_name.'<br />
						<strong>Password</strong>: '.$password.'</p>
						<a href="'.BASE_URL.'admin/">'.BASE_URL.'admin/</a>';

			$user_email = $send_email->send( 'Welcome to Tentacle CMS', $message, $email );
		}
		
		
		url::redirect('install/done');
	}
}