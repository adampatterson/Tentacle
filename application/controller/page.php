<?php

class page_controller {
	
    public function index( $uri = "" ){
		
		tentacle::library('/', 'YAML');

		load::helper('module');
		
		# Initiate the extensions.
	    init_extensions();
	
		# Prepare the trigger class
		$trigger = Trigger::current();
		
		

		$scaffold = new Scaffold ();
		
		$uri = slash_it( $uri );
		
		if ( URI == '' || $uri == 'home'):
			$uri = 'home/';
		else:
			$uri = slash_it( URI );
		endif;
		
		require_once( PATH_URI.'/functions.php' );
		
		$page = load::model( 'page' );
		$post = $page->get_by_uri( $uri );
		
		$post_meta = $page->get_page_meta( $post->id );
		
		if ($post->type == 'post') {
			define("IS_POST", TRUE);
		} else {
			define("IS_POST", FALSE);
		}

		
		// Set GLOBALS
		//$GLOBALS['post'] 			= $post;
		//$GLOBALS['post_meta'] 	= $post_meta;
		
		load::helper('template');
		
		// If URI lookup fails redirect to the themes 404 page
		if ( $post ) {
			
			if($trigger->exists("preview"))
				echo $trigger->filter($text,"preview");
			
			$post->content = $trigger->filter($post->content,"preview");
				
			tentacle::render ( $post->template, array ( 'post' => $post, 'post_meta' => $post_meta ) );

			//if(user::valid()) load::helper ('adminbar');
			
		} else {
			// logging of 404's here.
			tentacle::render ( '404' );
		}
		
	}// END index
    
} // END Class page

?> 