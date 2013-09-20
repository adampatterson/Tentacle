<?php
load::helper( 'data_properties' );
/*
 * @todo Check if the app is installed ( select the DV version )
 */

class install_controller extends properties
{
	public function step1 ( )
	{	
		if ( !file_exists( '.htaccess' ) ):
			//write_htaccess();
		endif;
		
		if ( !file_exists( 'application/config/deployment/db.php' ) ):
			load::view ('install/step1');
		elseif(file_exists( 'application/config/deployment/db.php' ) && $this->migration_model()->touch_db() == false ):
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
		
		$sql = $this->migration_model();
		
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

		// Set the current Install version
		$sql->set_db('116');
								
		load::view ('install/step5');
	}
	
	public function done ( )
	{
        load::model('statistics')->mixpanel_server( true );
			
		load::view ( 'install/done' );	
	}
}