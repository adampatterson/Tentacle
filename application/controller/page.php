<?php

class page_controller {
        
    public function index( $page_name = "" ){

		load::library ('file');
		$scaffold = new Scaffold ();
		
		if ( URI == ''):
			$uri = 'index';
		else:
			$uri = URI;
		endif;
		
		tentacle::render ($uri, array ('scaffold' => $scaffold));
                      
        }// END index
    
} // END Class page

?> 