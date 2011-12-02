<?php

class action_controller
{
	
	public function agree()
	{
		url::redirect('setup/install/step1');
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

		$setup_handle = fopen('./application/config/setup/db.php', 'w');

		$setup_source = str_replace ( $search, $replace, $source );
		foreach ( $setup_source as $str )
			fwrite($setup_handle, $str);

		// Setup the Deployment db.php file
		$handle = fopen('../application/config/deployment/db.php', 'w');

		$source = str_replace ( $search, $replace, $source );
		foreach ( $source as $str )
			fwrite($handle, $str);
		
		url::redirect('setup/install/step4');
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
			
		url::redirect('setup/install/done');
	}
}