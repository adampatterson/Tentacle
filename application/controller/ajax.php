<?php
load::helper( 'data_properties' );

class ajax_controller extends properties {
	
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
		return $this->user_model()->unique( $_POST['username'] );
	}


    /**
     * Check for Unique user name
     * ----------------------------------------------------------------------------------------------*/
    public function unique_uri ( $type = null )
    {
        $clean_slug = array();

        $uri_date = date('Y', time()).'/'.date('m', time());
        $slug          = string::sanitize( $_POST['slug'] );
        $uri          = $_POST['uri'];

        if ( $type == 'post' ) # Post
            $uri 		   = slash_it( get::option('blog_uri') ).$uri_date.'/'.$slug.'/';

        else # Page
            $slug 	    	= $slug.'/';

        if ( $this->content_model()->unique_uri( $uri.$slug ) )
        {
            $clean_slug['uri'] = $uri;
            $clean_slug['slug'] = $slug;
            $clean_slug['suggested'] = $slug;
            $clean_slug['unique'] = false;
        } else {
            $clean_slug['uri'] = slash_it( un_slash( $slug ).'2' );
            $clean_slug['slug'] = $slug;
            $clean_slug['suggested'] = un_slash( $slug ).'2';
            $clean_slug['unique'] = true;
        }

        $clean_slug['type'] = $type;
        $clean_slug['lookup'] = $uri.$slug;

        echo json_encode( $clean_slug );
    }


    /**
     * Reorder page structure
     * ----------------------------------------------------------------------------------------------*/
    public function sortable ()
    {
        if (!empty($_REQUEST["data"]))
            $page = $this->content_model()->update_page_order( $_POST['data'] );
    }


    /**
     * Reorder page structure
     * ----------------------------------------------------------------------------------------------*/
    public function update_media ()
    {
        if (!empty($_POST))
            $update = $this->media_model()->update( $_POST['file_id'] );
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