<?php
class action_controller 
{
	
	# All actions should return True of False and be treated accordingly.
	public function index ()
	{	
		echo 'No direct access';
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
	public function login ()
	{
		$username = input::post ( 'username' );
	    $password = input::post ( 'password' );
	
		$history = input::post ( 'history' );

	    user::login($username, $password);

	    if(user::valid()) {

			if ($history != '') {
				url::redirect($history);
			} else {
				url::redirect('admin/dashboard');
			}
			
	    } else {
	       note::set("error","login",NOTE_PASSWORD);
	       url::redirect('admin/index'); 
	    }
	}
	

	public function lost(){
 
    	$username = input::post('username');

	    $users_table = db('users');               
	    $user = $users_table->select('*')
	                    ->where('email','=',$username)
	                    ->execute();
            
	    if ( isset($user[0]->email)) {
	        // Generate a Hash from the users IP
       
	        $ip = $_SERVER['REMOTE_ADDR'];

	        $hashed_ip = sha1($ip.time());
       
	        $users_table->update(array(
	            'forgot_password'=>$hashed_ip
	            ))
	            ->where('email','=',$username)
	            ->execute();
       
	        // Attach that Hash to the users email address.
	        $mail = new email();
	        $mail->to($username);
	        $hash_address = BASE_URL.'user/reset/'.$hashed_ip;
	        // @todo get install admings email address
	        $mail->from('Tentacle');
	        $mail->subject('Missing Password');
	        $mail->content('<strong>Click the link to reset your password.</strong><br />'.$hash_address);
	        $mail->send();

	        note::set("error","forgot",NOTE_LOST);
       
	        url::redirect('/'); 
       
	    } else {
	        // @todo set lost password error message for not match
	        echo 'No match, Set an error message';
	    }

	} // END Function Action Login


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
 	public function add_page ()
 	{
		tentacle::valid_user();

		$page = load::model( 'page' );
		$page_single = $page->add( );
			
		// Delete the selected tempalte from the session once the Page has been posted.
		session::delete ( 'template' );

		url::redirect( 'admin/content_update_page/'.$page_single );
	}
	
	
	public function update_page ( $page_id )
 	{
		tentacle::valid_user();

		$page = load::model( 'page' );
		$page_single = $page->update( $page_id );
		
		session::delete ( 'template' );

		url::redirect( input::post ( 'history' ) );
	}

	
	public function delete_page ()
 	{
	
	}
	
	
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
 	public function add_post ()
 	{
		tentacle::valid_user();
			
		$post = load::model( 'post' );
		$post_single = $post->add( );
		
		$post_categories = input::post( 'post_category' );
		$category = load::model( 'category' );
		$category_relations = $category->relations( $post_single, $post_categories );
		
		url::redirect( 'admin/content_update_post/'.$post_single );
	}	
	
	
	public function update_post ( $post_id )
 	{
		tentacle::valid_user();

		$post = load::model( 'post' );
		$post_single = $post->update( $post_id );
		
		$post_categories = input::post( 'post_category' );
		$category = load::model( 'category' );
		$category_relations = $category->relations( $post_single, $post_categories, true );
		
		url::redirect( input::post ( 'history' ) );
	}
	
	
	public function delete_post ()
 	{
	
	}
	
	
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
	public function add_user ()
	{
		tentacle::valid_user();
				
		$user = load::model( 'user' );
		$user_single = $user->add();

		$history = input::post ( 'history' );

		// Check for return True.
		// Log error

		//url::redirect($history); 
		url::redirect('admin/users_manage/');

	}
	
	public function update_user ( )
	{
		tentacle::valid_user();

		$user 				= load::model( 'user' );
		$user_single 		= $user->update();
		
		$history = input::post ( 'history' );

		url::redirect($history); 
	}
	

	public function delete_user ( $id = '' )
	{
		tentacle::valid_user();
		
		$user = load::model( 'user' );
		$user_delete = $user->delete( $id );
		
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
	public function add_snippet ()
	{	
		tentacle::valid_user();
			
		$snippet = load::model( 'snippet' );
		$snippet_single = $snippet->add( );

		//$history = input::post ( 'history' );
		url::redirect('admin/snippets_manage/'); 
	}
	
	public function update_snippet ( $id )
	{
		tentacle::valid_user();
		
		$snippet = load::model( 'snippet' );
		$snippet_single = $snippet->update( $id  );
		
		

		url::redirect('admin/snippets_manage/');
	}
	
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
 	public function add_category ()
 	{	
		tentacle::valid_user()
		;	
 		$category = load::model( 'category' );
 		$category_single = $category->add( );
 
 		//$history = input::post ( 'history' );
 		url::redirect('admin/content_manage_categories/'); 
 	}
 	
 	public function update_category ( $id ) 
 	{
		tentacle::valid_user();
	
		$category = load::model( 'category' );
		$category_single = $category->update( $id  );

		url::redirect('admin/content_manage_categories/'); 
 	}
 	
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
 	public function update_settings ( $key, $value, $autoload = 'yes' )
	{
		$setting = load::model ( 'settings' );
		
		$update_appearance = $setting->update( $key, $value, $autoload );

		url::redirect('admin/settings_appearance');	
	}
	
	public function udpate_settings_post ( )
	{	
		$setting = load::model ( 'settings' );
		
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

		$history = input::post ( 'history' );
		url::redirect($history);
		//unset($_POST);
	}
	
	/**
	 * 
	 * 
	 * 
	 * ========================= Install
	 * 
	 * 
	 * 
	 * 
	 */	
	public function agree()
	{
		url::redirect('install/step1');
	}
	
	
	public function database()
	{
				
		$this->driver 		= 'mysql';
		$this->host 		= input::post ( 'db_host' );
		$this->username 	= input::post ( 'db_user' );
		$this->password 	= input::post ( 'db_password' );
		$this->database 	= input::post ( 'db_name' );
		
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
	
	public function admin()
	{
		load::config('db');
		
		$config = config::get('db');

		$user_name    = input::post ( 'user_name' );
		$raw_password     = input::post ( 'password' );
		$email        = input::post ( 'email' );

		$first_name   = input::post ( 'first_name' );
		$last_name    = input::post ( 'last_name' );
		$display_name = input::post ( 'display_name' );

		$encrypted_password = sha1( $raw_password );

		$registered = time();

		$pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);

		$build = $pdo->exec( "INSERT INTO `users` (`email`, `username`, `password`, `type`, `data`, `registered`, `status`)
								VALUES
									('$email', '$user_name', '$encrypted_password', 'administrator', '{\"first_name\":\"$first_name\",\"last_name\":\"$last_name\",\"activity_key\":\"\",\"url\":\"\",\"display_name\":\"$display_name\",\"editor\":\"wysiwyg\"}', '$registered', 1)" );
			
		url::redirect('install/done');
	}
	
	
}