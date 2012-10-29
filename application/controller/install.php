<?php

/*
 * @todo Check if the app is installed ( select the DV version )
 */

class install_controller
{
	public function step1 ( )
	{	
		if ( !file_exists( '.htaccess' ) ):
			//write_htaccess();
		endif;
		
		if ( !file_exists( 'application/config/deployment/db.php' ) ):
			load::view ('install/step1');
		elseif(file_exists( 'application/config/deployment/db.php' ) && load::model( 'sql' )->touch_db() == false ):
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
		
		$sql = load::model( 'sql' );
		
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
		
		// Set the current Install version
		$sql->set_db('113');
								
		load::view ('install/step5');
	}
	
	public function done ( )
	{
		load::view ( 'install/done' );	
	}
}