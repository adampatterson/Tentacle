<?php

/*
 * @todo Check if the app is installed ( select the DV version )
 */

class install_controller
{
	public function agree ()
	{
		if ( !file_exists( 'application/config/deployment/db.php' ) ):
			load::view ('install/index');
		else:
			load::view ('install/nothing');
		endif;
	}
	
	public function step1 ( $step )
	{	
		load::view ('install/step1');
	}
	
	public function step2 ( $step )
	{
		load::view ('install/step2');
	}
	
	public function step3 ( $step )
	{
		load::view ('install/step3');
	}
	
	public function step4 ( $step )
	{
		load::view ('install/step4');
	}
	
	public function step5 ( $step )
	{
		// CREATE DATABASE database_name
		load::library('db');
		
		$sql = load::model ( 'sql' );
		
		$sql->get_100();
		
		// Seed data
		$sql->get_101();
				
		// Set an option key for the blog being installed
		$sql->get_102();
		
		$sql->get_103();
		
		$sql->set_db('103');
								
		load::view ('install/step5');
	}
	
	public function done ( $step )
	{
		load::view ( 'install/done' );	
	}
}