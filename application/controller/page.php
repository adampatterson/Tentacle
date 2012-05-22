<?php

class page_controller {
	
    public function index( $uri = "" ){
		
		//load::library ('file');

		$scaffold = new Scaffold ();
		
		$uri = trailingslashit( $uri );
		
		if ( URI == '' || $uri == 'home'):
			$uri = 'home/';
		else:
			$uri = trailingslashit( URI );
		endif;
		
		require_once( PATH_URI.'/functions.php' );
		
		$page = load::model( 'page' );
		$post = $page->get_by_uri( $uri );
		
		$post_meta = $page->get_page_meta( $post->id );
		
		// Set GLOBALS
		//$GLOBALS['post'] 			= $post;
		//$GLOBALS['post_meta'] 	= $post_meta;
		
		require_once(APP_PATH.'/application/helper/template.php');
		
		// If URI lookup fails redirect to the themes 404 page
		if ( $post ) {
			tentacle::render ( $post->template, array ( 'post' => $post, 'post_meta' => $post_meta ) );

			//if(user::valid()) load::helper ('adminbar');
			
		} else {
			// logging of 404's here.
			tentacle::render ( '404' );
		}
		
	}// END index
    
} // END Class page

?> 