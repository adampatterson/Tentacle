<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Session Library For Dingo Framework
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/session-library
 */

class session
{
	public static $config;
	public static $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
	public static $table = array();
	
	
	// Reset DB Rows
	// ---------------------------------------------------------------------------
	public static function cleanup()
	{
		$d = new DateTime();
		
		$t = db(self::$config['table'],NULL,self::$config['connection']);
		
		$t->delete('expire','<=',$d->format('U'));
	}
	
	
	// Get Session
	// ---------------------------------------------------------------------------
	public static function get($session)
	{
		// Check to see if in PHP table already
		if(isset(self::$table[$session]))
		{
			return self::$table[$session];
		}
		
		// If not then query database
		else
		{
			$t = db(self::$config['table'],NULL,self::$config['connection']);
			
			$res = $t->select('value')
						 ->where('name','=',$session)
						 ->clause('AND')
						 ->where('cookie','=',input::cookie($session))
						 ->execute();
			
			if(isset($res[0]->value))
			{
				return $res[0]->value;
			}
			else
			{
				return FALSE;
			}
		}
	}
	
	
	// Set Session
	// ---------------------------------------------------------------------------
	public static function set($name,$value,$cookie=FALSE)
	{
		if(!$cookie)
		{
			$cookie = self::$config['cookie'];
		}
		
		$d = new DateTime();
		$d->modify($cookie['expire']);
		
		$salt = self::salt();
		
		$cookie['name'] = $name;
		$cookie['value'] = $salt;
		
		if(empty($cookie['expire']))
		{
			$cookie['expire'] = '+1 hours';
		}
		
		cookie::set($cookie);
		
		$t = db(self::$config['table'],NULL,self::$config['connection']);
		
		$t->insert(array(
			'name'=>$name,
			'value'=>$value,
			'cookie'=>$salt,
			'expire'=>$d->format('U')
		));
		
		self::$table[$name] = $value;
	}
	
	
	// Reset Session
	// ---------------------------------------------------------------------------
	public static function reset($name,$cookie=FALSE)
	{
		if(!$cookie)
		{
			$cookie = self::$config['cookie'];
		}
		
		$value = self::get($name);
		self::delete($name,$cookie);
		self::set($name,$value,$cookie);
		
		self::$table[$name] = $value;
	}
	
	
	// Update Session
	// ---------------------------------------------------------------------------
	public static function update($name,$value)
	{
		$t = db(self::$config['table'],NULL,self::$config['connection']);
		
		$t->update(array('value'=>$value))
		      ->where('cookie','=',input::cookie($name))
		      ->execute();
		
		self::$table[$name] = $value;
	}
	
	
	
	// Delete Session
	// ---------------------------------------------------------------------------
	public static function delete($name,$cookie=FALSE)
	{
		if(!$cookie)
		{
			$cookie = self::$config['cookie'];
		}
		
		$t = db(self::$config['table'],NULL,self::$config['connection']);
		$t->delete('cookie','=',input::cookie($name));
		
		$cookie['name'] = $name;
		cookie::delete($cookie);
		
		unset(self::$table[$name]);
	}
	
	
	// Generate Unique Salt
	// ---------------------------------------------------------------------------
	public static function salt()
	{
		$len = rand(10,25);
		
		$salt = '';
		$i = 0;

		while($i < $len)
		{
			$char = substr(self::$chars, mt_rand(0, strlen(self::$chars) - 1), 1);
			$salt .= $char;
			$i++;
		}
		
		return $salt;
	}
}

session::$config = config::get('session');
session::cleanup();