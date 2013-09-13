<?
class user_model
{
    /**
	* Add User
	* ----------------------------------------------------------------------------------------------*/
	public function add () 
	{		
		$user_name    = input::post( 'user_name' );
		$password     = input::post( 'password' );
		$email        = input::post( 'email' );
		$type         = input::post( 'type' );
		
		$first_name   = input::post( 'first_name' );
		$last_name    = input::post( 'last_name' );
		$display_name = input::post( 'display_name' );
		$url          = input::post( 'url' );
		
		$editor       = input::post( 'editor' );
	
		user::create(array(
			'username'=>$user_name,
			'email'=>$email,
			'password'=>$password,
			'type'=>$type
		));

		user::update($email)
			->data('first_name',$first_name)
	      	->data('last_name',$last_name)
			->data('activity_key','activation_key')
			->data('url',$url)
			->data('editor',$editor)
			->data('display_name',$display_name)
			->save();

		$this->user_table()
            ->update(array(
				'registered'=> time()
			))
			->where( 'email', '=', $email )
			->execute();

# @todo: send email is done on the action controller
//        if (input::post( 'send_password' ) == 'yes') {
//            $send_email = load::model( 'email' );
//
//            load::helper('email');
//
//            $hashed_ip = sha1($_SERVER['REMOTE_ADDR'].time());
//            $hash_address = BASE_URL.'admin/activate/'.$hashed_ip;
//
//            $message = '<p>Hello '.$first_name.' '.$last_name.',<br />Here are your account details.</p>
//						<p><strong>Username</strong>: '.$user_name.'<br />
//						<strong>Password</strong>: '.$password.'</p>
//						<a href="'.BASE_URL.'admin/">'.BASE_URL.'admin/</a>';
//
//            $user_email = $send_email->send( 'Welcome to Tentacle CMS', $message, $email );
//        }

		note::set('success','user_add','User Added!');
	}
	
	
	/**
	* Update User
	* ----------------------------------------------------------------------------------------------*/
	public function update ( )
	{
		$user_name    = input::post( 'user_name' );
		$password     = input::post( 'password' );
		$old_email    = input::post( 'old_email' );
		$new_email    = input::post( 'email' );
		$type         = input::post( 'type' );
		
		$first_name   = input::post( 'first_name' );
		$last_name    = input::post( 'last_name' );
		$display_name = input::post( 'display_name' );
		$url          = input::post( 'url' );
		
		$editor       = input::post( 'editor' );
		
		$profile      = input::post( 'profile' );
		
		// need to set the users old email address before you update it.

		user::update($old_email)
			->email($new_email)
			->username($user_name)
			->type($type)
			->data('first_name',$first_name)
			->data('last_name',$last_name)
			->data('url',$url)
			->data('editor',$editor)
			->data('display_name',$display_name)
			->save();
		
		if ($password != '') 
		{
			user::update($new_email)
				->password($password)
				->save();
		}

        if (input::post( 'send_password' ) == 'yes') {
            $email = load::model( 'email' );

            $user_data = user::get($new_email);

            $welcome = $email->welcome($user_data, 'Welcome to Tentacle CMS' );
        }

		note::set('success','user_updated','User Updated!');
	
		return TRUE;
	}
	
	
	/**
	* Get User
	* ----------------------------------------------------------------------------------------------*/
	public function get ( $id='' )
	{
		if ($id=='') {
			// Get Comments Database
			$users = $this->user_table()
                ->select( '*' )
				->order_by ( 'username', 'DESC' )
				->execute ();
				
			return $users;
				
		} else {
			// Get Comments Database
			$users = $this->user_table()
                ->select( '*' )
				->where ( 'id', '=', $id)
				->execute();				
				
			return $users[0];	
		}
	}
	
	public function set_password(  )
	{
		$user = self::get_hash( input::post('hash') );
		
		user::update($user->email)
			->password( input::post('password') )
			->data( 'activation_key', '' )
			->save();
			
		return $user;
	}
	
	/**
	* Get from Hash
	* ----------------------------------------------------------------------------------------------*/
	public function get_hash( $hash )
	{
		$user_hash = db::query("SELECT * FROM users WHERE
			data LIKE '%".$hash."%'
			ORDER BY id ASC");
			
		$total = count($user_hash);
		
		if ($total != 1) {
			return false;
		} else {
			return $user_hash[0];
		}
	}
	
	
	/**
	* Get user Meta
	* ----------------------------------------------------------------------------------------------*/
	public function get_meta ( $id )
	{
	    $user_meta = $this->user_table()
            ->select( 'data' )
			->where ( 'id', '=', $id )
			->execute();

        if(isset($user_meta[0])){
            return json_decode($user_meta[0]->data);
        } else {
            $user_meta = array('first_name'=> '<strong>N/A</strong>', 'last_name' => '');

            return (object)$user_meta;
        }
	}
	
	
	/**
	* Delete User
	* ----------------------------------------------------------------------------------------------*/
	public function delete ( $id  ) 
	{
		#@todo don't allow the user to delete all accounts! One must be left.
		
		user::delete( $id );
		note::set('success','user_delete','User Deleted!');
		
		return TRUE;
	}
	
	
	/**
	* Unique User
	* ----------------------------------------------------------------------------------------------*/
	public function unique ( $username )
	{
		if( user::unique( $username ) )
			echo '0';
		else
			echo '1';
	}
}