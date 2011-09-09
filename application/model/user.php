<?
class user_model
{
	// Get User
	//----------------------------------------------------------------------------------------------
	public function get ( $id='' )
	{
		$users_table = db ( 'users' );
					
		if ($id=='') {
			// Get Comments Database
			$users = $users_table->select( '*' )
				->order_by ( 'id', 'DESC' )
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
	
	// Get Meta User
	//----------------------------------------------------------------------------------------------
	public function get_meta ( $id )
	{
		$user_meta = db ( 'users' );
				
		$user_meta = $user_meta->select( 'data' )
			->where ( 'id', '=', $id )
			->execute();
			
		$user_meta = json_decode($user_meta[0]->data);
			
		return $user_meta;
	}
	
	// Update User
	//----------------------------------------------------------------------------------------------
	public function update ( )
	{
		$user_name = input::post ( 'user_name' );
		$password = input::post ( 'password' );
		$old_email = input::post ( 'old_email' );
		$new_email = input::post ( 'email' );
		$type = input::post ( 'type' );
		
		$first_name = input::post ( 'first_name' );
		$last_name = input::post ( 'last_name' );
		$display_name = input::post ( 'display_name' );
		$url = input::post ( 'url' );
		
		$profile = input::post ( 'profile' );
		
		// need to set the users old email address before you update it.

		
		user::update($old_email)
			->email($new_email)
			->username($user_name)
			->type($type)
			->data('first_name',$first_name)
			->data('last_name',$last_name)
			->data('url',$url)
			->data('display_name',$display_name)
			->save();
		
		if ($password != '') 
		{
			user::update($email)
				->password($password)
				->save();
		}
	
		note::set('success','user_updated','User Updated!');
	
		return TRUE;
	} 
	
	// Delete User
	//----------------------------------------------------------------------------------------------
	public function delete ( $id  ) 
	{
		#@todo dont allow the user to delete all accounts! One must be left.
		
		user::delete( $id );
		note::set('success','user_delete','User Deleted!');
		
		return TRUE;
	}
	
	// Add User
	//----------------------------------------------------------------------------------------------
	public function add () 
	{
		
		/*
		if(user::unique('ETbyrne'))
		{
			echo 'Username not taken!';
		}
		else
		{
			echo 'Username taken!';
		}
		*/
		
		$user_name = input::post ( 'user_name' );
	    $password = input::post ( 'password' );
		$email = input::post ( 'email' );
		$type = input::post ( 'type' );

		$first_name = input::post ( 'first_name' );
		$last_name = input::post ( 'last_name' );
		$display_name = input::post ( 'display_name' );
		$url = input::post ( 'url' );
		
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
			->data('display_name',$display_name)
			->save();
			
		note::set('success','user_add','User Added!');
	}
}