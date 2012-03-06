<?php
class ajax_controller 
{
	
	# All ajax calls should pass throught this controller.
	
	public function index ()
	{	
		echo 'No direct access';
	}


	/**
	* Check for Unique user name
	* ----------------------------------------------------------------------------------------------*/
	public function unique_user ()
	{
		$user = load::model ( 'user' );
		$unique = $user->unique( $_POST['username'] );
	
		return $unique;
	}

}