<?php

class page_controller {
	
    public function index( $uri = "" ){

		load::library ('file');
		$scaffold = new Scaffold ();
		
		$uri = trailingslashit( $uri );
		
		if ( URI == '' || $uri == 'home'):
			$uri = 'home/';
		else:
			$uri = trailingslashit( URI );
		endif;
		
		require_once( PATH_URI.'/functions.php' );
		
		$page = load::model ( 'page' );
		$content = $page->get_by_uri( $uri );
		
		$get_page_meta = $page->get_page_meta( $content->id );
		
		// If URI lookup fails redirect to the themes 404 page
		if ( $content ) {
			tentacle::render ( $content->template, array ( 'data' => $content, 'get_page_meta' => $get_page_meta ) );

			if(user::valid()) load::helper ('adminbar');
		} else {
			// logging of 404's here.
			tentacle::render ( '404' );
		}
		
        }// END index
    
} // END Class page

?> 