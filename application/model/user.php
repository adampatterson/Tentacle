<?
class user_model
{
	/**
	* Add User
	* ----------------------------------------------------------------------------------------------*/
	public function add () 
	{		
		$user_name    = input::post ( 'user_name' );
		$password     = input::post ( 'password' );
		$email        = input::post ( 'email' );
		$type         = input::post ( 'type' );
		
		$first_name   = input::post ( 'first_name' );
		$last_name    = input::post ( 'last_name' );
		$display_name = input::post ( 'display_name' );
		$url          = input::post ( 'url' );
		
		$editor       = input::post ( 'editor' );
	
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
			
		$users  = db( 'users' );
		
		$users->update(array(
				'registered'=> time()
			))
			->where( 'email', '=', $email )
			->execute();
			
		note::set('success','user_add','User Added!');
	}
	
	
	/**
	* Update User
	* ----------------------------------------------------------------------------------------------*/
	public function update ( )
	{
		$user_name    = input::post ( 'user_name' );
		$password     = input::post ( 'password' );
		$old_email    = input::post ( 'old_email' );
		$new_email    = input::post ( 'email' );
		$type         = input::post ( 'type' );
		
		$first_name   = input::post ( 'first_name' );
		$last_name    = input::post ( 'last_name' );
		$display_name = input::post ( 'display_name' );
		$url          = input::post ( 'url' );
		
		$editor       = input::post ( 'editor' );
		
		$profile      = input::post ( 'profile' );
		
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
	
		note::set('success','user_updated','User Updated!');
	
		return TRUE;
	}
	
	
	/**
	* Get User
	* ----------------------------------------------------------------------------------------------*/
	public function get ( $id='' )
	{
		$users_table = db ( 'users' );
					
		if ($id=='') {
			// Get Comments Database
			$users = $users_table->select( '*' )
				->order_by ( 'username', 'DESC' )
				->execute ();
				
			return $users;
				
		} else {
			// Get Comments Database
			$users = $users_table->select( '*' )
				->where ( 'id', '=', $id)
				->execute();				
				
			return $users[0];	
		}
	}
	
	
	/**
	* Get user Meta
	* ----------------------------------------------------------------------------------------------*/
	public function get_meta ( $id )
	{
		$user_meta = db ( 'users' );
				
		$user_meta = $user_meta->select( 'data' )
			->where ( 'id', '=', $id )
			->execute();
			
		$user_meta = json_decode($user_meta[0]->data);
			
		return $user_meta;
	}
	
	
	/**
	* Delete User
	* ----------------------------------------------------------------------------------------------*/
	public function delete ( $id  ) 
	{
		#@todo dont allow the user to delete all accounts! One must be left.
		
		user::delete( $id );
		note::set('success','user_delete','User Deleted!');
		
		return TRUE;
	}
	
	
	/**
	* Unique User
	* ----------------------------------------------------------------------------------------------*/
	public function unique ( $username )
	{
		if( user::unique( $username ) ):
			echo '0';
		else:
			echo '1';
		endif;
	}
}