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
	public function render_admin ( $location, $template = '', $id = null )
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
		
		if ( $id == null ) {
			url::redirect( 'admin/content_'.$location.'/' );
		} else {
			url::redirect( 'admin/content_'.$location.'/'.$id );
		}
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
		$page_single = $page->update( );
		
		//	user the same serialize process as in the add page
		//	uopdate the modified time.
		
		session::delete ( 'template' );

		$history = input::post ( 'history' );	
		url::redirect($history);
	}
	
	
	public function soft_delete_page ()
 	{
	
	}
	
	
	public function delete_page ()
 	{
	
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
		// @todo: deal with an array for categorie values.
	
		tentacle::valid_user();
			
		$post = load::model( 'post' );
		$post_single = $post->add( );
		
		$page_categories = input::post( 'post_category' );
		$category = load::model( 'category' );
		$category_relations = $category->relations( $post_single->id, $page_categories );
		// we need the page ID before we can add any meta to the DB.
		//$post_meta = $post->add_meta( $post_single );
		
		note::set('success','post_add','Post Added!');
		url::redirect( input::post ( 'history' ) );
	}	
	
	
	public function update_post ()
 	{
	
	}
	
	
	public function soft_delete_post ()
 	{
	
	}
	
	
	public function delete_post ()
 	{
	
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

		url::redirect($history); 

	}
	
	public function update_user ( )
	{
		tentacle::valid_user();

		$user 				= load::model('user');
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
			
		$snippet = load::model('snippet');
		$snippet_single = $snippet->add( );

		//$history = input::post ( 'history' );
		url::redirect('admin/snippets_manage/'); 
	}
	
	public function update_snippet ( $id )
	{
		tentacle::valid_user();
		
		$snippet = load::model('snippet');
		$snippet_single = $snippet->update( $id  );
		
		

		url::redirect('admin/snippets_manage/');
	}
	
	public function delete_snippet ( $id = '' )
	{
		tentacle::valid_user();
		
		$snippet = load::model('snippet');
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
}