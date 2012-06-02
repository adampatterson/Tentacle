<?php

class blog_controller {
        
    public function index( $uri = "" ){
		
		define("IS_POST", FALSE);
		
		$uri = slash_it( $uri );
		
		if ( URI == '' || $uri == 'home'):
			$uri = 'blog/';
		else:
			$uri = slash_it( URI );
		endif;
		
		require_once( PATH_URI.'/functions.php' );
								
		$post = load::model( 'post' );
		$posts = $post->get( );
		
		$category = load::model( 'category' );
		
		$tag = load::model( 'tags' );
		
		$author = load::model('user'); 
		
		require_once(APP_PATH.'/application/helper/template.php');

		tentacle::render ( 'template-blog', array ( 'posts' => $posts, 'author'=>$author, 'category'=>$category, 'tag'=>$tag ) );
        
		//if(user::valid()) load::helper ('adminbar');         

	}// END index

} // END Class blog