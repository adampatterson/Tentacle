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
		
		$page = load::model ( 'page' );
		
		$content = $page->get_by_uri( $uri );

		tentacle::render ( $content->template, array ( 'data' => $content ) );
                      
        }// END index
    
} // END Class page

?> 