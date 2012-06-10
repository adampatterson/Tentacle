<?php

class page_controller {
	
    public function index(  ){
		$uri = URI;

		tentacle::library('YAML', 'YAML');

		load::helper('module');
		
		# Initiate the extensions.
	    init_extensions();
	
		# Prepare the trigger class
		$trigger = Trigger::current();
		
		$scaffold = new Scaffold ();
		
		if ( $uri == '' || $uri == 'home'):
			$uri = 'home/';
		elseif	( URI == '' || $uri == 'blog'):
			$uri = 'blog/';
		else:
			$uri = slash_it( $uri );
		endif;
		
		// load the functions.php file from the active theme.
		if (file_exists(PATH_URI.'/functions.php')) {
			require_once( PATH_URI.'/functions.php' );
		}
			
		if (URI == 'blog') {

			define("IS_POST", FALSE);

			$post = load::model( 'post' );
			$posts = $post->get( );

			$category 	= load::model( 'category' );
			$tag 		= load::model( 'tags' );
			$author 	= load::model('user'); 

			require_once(APP_PATH.'/application/helper/template.php');

			tentacle::render ( 'template-blog', array ( 'posts' => $posts, 'author'=>$author, 'category'=>$category, 'tag'=>$tag ) );
			
		} else {
			$page 		= load::model( 'page' );
			$post 		= $page->get_by_uri( $uri );
			
			$post_meta 	= $page->get_page_meta( $post->id );

			define("IS_POST", TRUE);

			load::helper('template');

			// If URI lookup fails redirect to the themes 404 page
			if ( $post ) {

				if($trigger->exists("preview"))
					echo $trigger->filter($text,"preview");

				// at this tage we are simply allowing the contnet attribute to be modified by the modules.
				$post->content = $trigger->filter($post->content,"preview");

				tentacle::render ( $post->template, array ( 'post' => $post, 'post_meta' => $post_meta ) );
				//if(user::valid()) load::helper ('adminbar');

			} else {
				// logging of 404's here.
				tentacle::render ( '404' );
			}

			echo __CLASS__.'<br />';
			render_debug();
		}	
		
		
		
	}// END index
    
} // END Class page

?> 