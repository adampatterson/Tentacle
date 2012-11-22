<?php
class ajax_controller {
	
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
		$user = load::model( 'user' );
		$unique = $user->unique( $_POST['username'] );
	
		return $unique;
	}

	/**
	* Touch the DB and see if the credentials are correct.
	* ----------------------------------------------------------------------------------------------*/
	public function confirm_database()
	{
		$server = $_POST['server'];
		$username = $_POST['username'];
		$password = $_POST['password'];

		$host = $server;

		$link = @mysql_connect($host, $username, $password, TRUE);

		if (!$link)
		{
			$data['success'] = 'false';
			$data['message'] = 'Problem connecting to the database:' . mysql_error();
		}
		else
		{
			$data['success'] = 'true';
			$data['message'] = 'The database settings are tested and working fine.';
		}

		// Set some headers for our JSON
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');

		echo json_encode($data);
	}

	
	/**
	* Delete an image on the fly from the media manager/media insert
	* ----------------------------------------------------------------------------------------------*/
	public function delete_media()
	{
		# $title 		= 
		# $alt_text 	= 
		# $caption 		= 
		# $link_url		= 
	}
}