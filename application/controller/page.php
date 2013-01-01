<?php
class page_controller {
	
    public function index(  ){

		is::blog_installed();
		
		$uri 			= URI;

		load::helper('template');
	
		# Prepare the trigger class
		$trigger 		= Trigger::current();
		
		$scaffold 		= new scaffold ();
		
		if ( $uri == '' || $uri == 'home'):
			$uri 		= 'home/';
		elseif	( URI == '' || $uri == get::option('blog_uri') ):
			$uri 		= slash_it( get::option('blog_uri') );
        else:
            $uri 		= slash_it( $uri );
		endif;

		// load the functions.php file from the active theme.
		if (file_exists(PATH_URI.'/functions.php')) {
			require_once( PATH_URI.'/functions.php' );
		}
	
		// Todo: get option blog path.
		if (URI == get::option('blog_uri') ) {
            define ( 'FRONT'		,'true' );
			define("IS_POST", FALSE);

			$post 		= load::model( 'post' );
			$posts 		= $post->get( );

			$category 	= load::model( 'category' );
			$tag 		= load::model( 'tags' );
			$author 	= load::model('user'); 

			if($trigger->exists("preview"))
				$post->content = $trigger->filter($post->content,"preview");
			
			if($trigger->exists("shortcode"))
				$post->content = $trigger->filter($post->content,"shortcode");

			tentacle::render( 'template-blog', array ( 'posts' => $posts, 'author'=>$author, 'category'=>$category, 'tag'=>$tag ) );
			
		} elseif (URI == 'category') {

            echo 'category';

        } else {
            $page 		= load::model( 'page' );
            $post 		= $page->get_by_uri( $uri );

            if ( !$post) {
                $post 		= $page->get_by_slug( $uri );
            }

            $post_meta 	= $page->get_page_meta( $post->id );

            define("IS_POST", TRUE);

            // If URI lookup fails redirect to the themes 404 page
            if ( $post ) {

                // at this tage we are simply allowing the contnet attribute to be modified by the plugins.
                if($trigger->exists("preview"))
                    $post->content = $trigger->filter($post->content,"preview");

                if($trigger->exists("shortcode"))
                    $post->content = $trigger->filter($post->content,"shortcode");

                tentacle::render( $post->template, array ( 'post' => $post, 'post_meta' => $post_meta, 'trigger', $trigger ) );

            } else {
                // logging of 404's here.
                tentacle::render ( '404' );
            }
        }
		
		//if(user::valid()) load::view( 'admin/partials/template-navigation' );
		//if(user::valid()) render_debug();

	}// END index
    
} // END Class page

?> 