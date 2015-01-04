<?php

/*
 * @todo Check if the app is installed ( select the DV version )
 */

class install_controller
{

    public function step1 ( )
	{
		// Create a .htaccess file that is a bit more advanced with thins like Mod Defalte and proper routing for plugnis.
        //if ( !file_exists( '.htaccess' ) )
			//create_htaccess();

		if ( !file_exists( 'application/config/deployment/db.php' ) ):
			load::view ('install/step1');
		elseif(file_exists( 'application/config/deployment/db.php' ) && load::model('migration')->touch_db() == false ):
			url::redirect('install/step5');
		else:
			load::view ('install/nothing');
		endif;
	}

	public function step2 ( )
	{
		load::view ('install/step2');
	}

	public function step3 ( )
	{
		load::view ('install/step3');
	}

	public function step4 ( )
	{
		load::view ('install/step4');
	}

	public function step5 ( )
	{
		// CREATE DATABASE database_name
		load::library('db');

		$sql = load::model('migration');

		$sql->get_100();

		// Seed data
		$sql->get_101();

		// Set an option key for the blog being installed
		$sql->get_102();

		$sql->get_103();

		$sql->get_104();

        $sql->get_105();

        $sql->get_106();

        $sql->get_107();

        $sql->get_108();

        $sql->get_109();

        $sql->get_110();

        $sql->get_111();

        $sql->get_112();

        $sql->get_113();

        $sql->get_114();

        $sql->get_115();

        $sql->get_116();

        $sql->get_117();

		// Set the current Install version
		$sql->set_db('117');

		load::view ('install/step5');
	}

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
        // @todo we cant log a dingo error since the config is not valid at this point.
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


  public function done ( )
	{
    load::model('statistics')->mixpanel_server( true );

		load::view ( 'install/done' );
	}
}
