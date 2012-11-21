<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * User Authentication Library For Dingo Framework
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/user-library
 */

load::library('hash','passwordhash');

class user
{
	public static $table;
	public static $types = array();
	
	public static $_id;
	public static $_email;
	public static $_username;
	public static $_password;
	public static $_type;
	public static $_data;
	
	public static $_valid = FALSE;
	
	
	public static function passwordhash(){
		return new PasswordHash(8, FALSE);
	}
	
	// Valid
	// ---------------------------------------------------------------------------
	public static function valid()
	{
		return self::$_valid;
	}
	
	
	// Is Type
	// ---------------------------------------------------------------------------
	public static function is_type($t)
	{
		if(self::$_valid OR $t == 'banned')
		{
			// If type of user is equal to or greater than specified return TRUE
			return(self::$types[self::$_type] >= self::$types[$t]);
		}
		else
		{
			// If not a valid user return FALSE
			return FALSE;
		}
	}
	
	
	// Banned
	// ---------------------------------------------------------------------------
	public static function banned()
	{
		// Return TRUE is banned, FALSE otherwise
		return(self::$types[self::$_type] === self::$types['banned']);
	}
	
	
	// Check
	// ---------------------------------------------------------------------------
	public static function check($i,$password)
	{
		$valid = FALSE;
		
		// Get information about current user
		if($i AND $password)
		{
			// Find by ID
			if(preg_match('/^([0-9]+)$/',$i))
			{
				$user = self::$table->select('*')
									->where('id','=',$i)
									->limit(1)
									->execute();
			}
			
			// Find by Username
			elseif(preg_match('/^([\-_ a-z0-9]+)$/is',$i))
			{
				$user = self::$table->select('*')
									->where('username','=',$i)
									->limit(1)
									->execute();
			}
			
			// Find by E-mail
			else
			{
				$user = self::$table->select('*')
									->where('email','=',$i)
									->limit(1)
									->execute();
			}
			
			$user = $user[0];
			if (self::passwordhash()->CheckPassword($password, $user->password) ) {
				// If valid login credentials
				if(!empty($user))
				{
					// If not banned, mark as valid
					if($user->type != 'banned')
					{
						$valid = TRUE;
					}
				}
			}
		}
		
		return $valid;
	}
	
	
	// Get
	// ---------------------------------------------------------------------------
	public static function get($i)
	{
		// Find by ID
		if(preg_match('/^([0-9]+)$/',$i))
		{
			$user = self::$table->select('*')
								->where('id','=',$i)
								->limit(1)
								->execute();
		}
		
		// Find by Username
		elseif(preg_match('/^([\-_ a-z0-9]+)$/is',$i))
		{
			$user = self::$table->select('*')
								->where('username','=',$i)
								->limit(1)
								->execute();
		}
		
		// Find by E-mail
		else
		{
			$user = self::$table->select('*')
								->where('email','=',$i)
								->limit(1)
								->execute();
		}
		
		// If user is found
		if(!empty($user[0]))
		{
			$user[0]->data = json_decode($user[0]->data,true);
			return $user[0];
		}
		
		// Otherwise return FALSE
		else
		{
			return FALSE;
		}
	}
	
	
	// Log In
	// ---------------------------------------------------------------------------
	public static function login($i,$password)
	{
		self::$_valid = FALSE;
		
		// Try to log in
		if($i AND $password)
		{
			// Find by ID
			if(preg_match('/^([0-9]+)$/',$i))
			{
				$user = self::$table->select('*')
									->where('id','=',$i)
									->limit(1)
									->execute();
			}
		
			// Find by Username
			elseif(preg_match('/^([\-_ a-z0-9]+)$/is',$i))
			{
				$user = self::$table->select('*')
									->where('username','=',$i)
									->limit(1)
									->execute();
			}
		
			// Find by E-mail
			else
			{
				$user = self::$table->select('*')
									->where('email','=',$i)
									->limit(1)
									->execute();
			}
		
			$user = $user[0];
	
			if (self::passwordhash()->CheckPassword($password, $user->password) ) {
				// If valid login credentials
				if(!empty($user))
				{
				
					self::$_id = $user->id;
					self::$_email = $user->email;
					self::$_username = $user->username;
					self::$_password = $user->password;
					self::$_type = $user->type;
					self::$_data = $user->data;

					// If not banned, mark as valid
					if(self::$_type != 'banned')
					{
						self::$_valid = TRUE;
						session::set('user_email',self::$_email);
						session::set('user_password',self::$_password);
					}
				}
			}

			return self::$_valid;
		}
	}
	
	
	// Log Out
	// ---------------------------------------------------------------------------
	public static function logout()
	{
		session::delete('user_email');
		session::delete('user_password');
		
		self::$_valid = FALSE;
	}
	
	
	// Create
	// ---------------------------------------------------------------------------
	public static function create($user)
	{
		// Make sure data key is set to prevent JSON errors
		if(!isset($user['data']))
		{
			$user['data'] = array();
		}
		
		$user['data'] = json_encode($user['data']);
		$user['password'] = self::hash($user['password']);
		
		return self::$table->insert($user);
	}
	
	
	// Update
	// ---------------------------------------------------------------------------
	public static function update($i=FALSE)
	{
		// Defaults to current user ID
		if(!$i)
		{
			$i = self::$_id;
		}
		
		return new user_update($i,self::$table);
	}
	
	
	// Delete
	// ---------------------------------------------------------------------------
	public static function delete($i)
	{
		// Find by ID
		if(preg_match('/^([0-9]+)$/',$i))
		{
			self::$table->delete('id','=',$i);
		}
		
		// Find by Username
		elseif(preg_match('/^([\-_ a-z0-9]+)$/is',$i))
		{
			self::$table->delete('username','=',$i);
		}
		
		// Find by E-mail
		else
		{
			self::$table->delete('email','=',$i);
		}
	}
	
	
	// Ban
	// ---------------------------------------------------------------------------
	public static function ban($i)
	{
		// Find by ID
		if(preg_match('/^([0-9]+)$/',$i))
		{
			self::$table->update(array('type'=>'banned'))
			            ->where('id','=',$i)
			            ->execute();
		}
		
		// Find by Username
		elseif(preg_match('/^([\-_ a-z0-9]+)$/is',$i))
		{
			self::$table->update(array('type'=>'banned'))
			            ->where('username','=',$i)
			            ->execute();
		}
		
		// Find by E-mail
		else
		{
			self::$table->update(array('type'=>'banned'))
			            ->where('email','=',$i)
			            ->execute();
		}
	}
	
	
	// Unique
	// ---------------------------------------------------------------------------
	public static function unique($i)
	{
		// Find by ID
		if(preg_match('/^([0-9]+)$/',$i))
		{
			$user = self::$table->select('*')
			                    ->where('id','=',$i)
			                    ->limit(1)
			                    ->execute();
		}
		
		// Find by Username
		elseif(preg_match('/^([\-_ a-z0-9]+)$/i',$i))
		{
			$user = self::$table->select('*')
			                    ->where('username','=',$i)
			                    ->limit(1)
			                    ->execute();
		}
		
		// Find by E-mail
		else
		{
			$user = self::$table->select('*')
			                    ->where('email','=',$i)
			                    ->limit(1)
			                    ->execute();
		}
		
		return (!isset($user[0]));
	}
	
	
	// ID
	// ---------------------------------------------------------------------------
	public static function id()
	{
		return self::$_id;
	}
	
	
	// E-mail
	// ---------------------------------------------------------------------------
	public static function email()
	{
		return self::$_email;
	}
	
	
	// Username
	// ---------------------------------------------------------------------------
	public static function username()
	{
		return self::$_username;
	}
	
	
	// Type
	// ---------------------------------------------------------------------------
	public static function type()
	{
		return self::$_type;
	}
	
	
	// Password
	// ---------------------------------------------------------------------------
	public static function password()
	{
		return self::$_password;
	}
	
	
	// Data
	// ---------------------------------------------------------------------------
	public static function data($key)
	{
		return (isset(self::$_data[$key])) ? self::$_data[$key] : NULL;
	}
	
	
	// Hash
	// ---------------------------------------------------------------------------
	public static function hash($i)
	{	
		return self::passwordhash()->HashPassword($i);
	}
}


/**
 * User Authentication Library User Update Class For Dingo Framework
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 */
class user_update
{
	private $table;
	private $exists = TRUE;
	
	public $id;
	public $email;
	public $username;
	public $password;
	public $type;
	public $data;
	
	
	// Construct
	// ---------------------------------------------------------------------------
	public function __construct($i,$table)
	{
		$this->table = $table;
		
		// Find by ID
		if(preg_match('/^([0-9]+)$/',$i))
		{
			$user = $this->table->select('*')
			                    ->where('id','=',$i)
			                    ->limit(1)
			                    ->execute();
		}
		
		// Find by Username
		elseif(preg_match('/^([\-_ a-z0-9]+)$/i',$i))
		{
			$user = $this->table->select('*')
			                    ->where('username','=',$i)
			                    ->limit(1)
			                    ->execute();
		}
		
		// Find by E-mail
		else
		{
			$user = $this->table->select('*')
			                    ->where('email','=',$i)
			                    ->limit(1)
			                    ->execute();
		}
		
		if(isset($user[0]))
		{
			$this->id = $user[0]->id;
			$this->email = $user[0]->email;
			$this->username = $user[0]->username;
			$this->password = $user[0]->password;
			$this->type = $user[0]->type;
			$this->data = json_decode($user[0]->data,true);
		}
		else
		{
			$this->exists = FALSE;
		}
	}
	
	public static function passwordhash(){
		return new PasswordHash(8, FALSE);
	}
	
	// ID
	// ---------------------------------------------------------------------------
	public function id($id)
	{
		$this->id = $id;
		return $this;
	}
	
	
	// E-mail
	// ---------------------------------------------------------------------------
	public function email($email)
	{
		$this->email = $email;
		return $this;
	}
	
	
	// Username
	// ---------------------------------------------------------------------------
	public function username($username)
	{
		$this->username = $username;
		return $this;
	}
	
	
	// Password
	// ---------------------------------------------------------------------------
	public function password($password)
	{
		$this->password = $this->hash($password);
		return $this;
	}
	
	
	// Type
	// ---------------------------------------------------------------------------
	public function type($type)
	{
		$this->type = $type;
		return $this;
	}
	
	
	// Data
	// ---------------------------------------------------------------------------
	public function data($key,$value)
	{
		$this->data[$key] = $value;
		return $this;
	}
	
	
	// Save
	// ---------------------------------------------------------------------------
	public function save()
	{
		$this->table->update(array(
						'id'=>$this->id,
						'email'=>$this->email,
						'username'=>$this->username,
						'password'=>$this->password,
						'type'=>$this->type,
						'data'=>json_encode($this->data)
					))
		            ->where('id','=',$this->id)
		            ->execute();
		
		return $this;
	}
	
	
	// Hash
	// ---------------------------------------------------------------------------
	public function hash($i)
	{
		return self::passwordhash()->HashPassword($i);
	}
}



// Load config file
load::config('user');
user::$types = config::get('user_types');

// Set database table
user::$table = db(config::get('user_table'),NULL,config::get('user_connection'));

// Get session data
user::$_email = session::get('user_email');
user::$_password = session::get('user_password');

// Get information about current user
if(user::$_email AND user::$_password)
{
	$user = user::$table->select('*')
						->where('email','=',user::$_email)
						->clause('AND')
						->where('password','=',user::$_password)
						->limit(1)
						->execute();
	
	// If valid login credentials
	if(!empty($user[0]))
	{
		$user = $user[0];
		user::$_id = $user->id;
		user::$_email = $user->email;
		user::$_username = $user->username;
		user::$_password = $user->password;
		user::$_type = $user->type;
		user::$_data = json_decode($user->data,true);
		
		// If not banned, mark as valid
		if(user::$_type != 'banned')
		{
			user::$_valid = TRUE;
		}
	}
}