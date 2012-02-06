<?php

class blog_controller {
        
    public function index( $uri = "" ){

		if(user::valid())
			load::helper ('adminbar');

		define ( 'FRONT'		,'true' );
		
		$uri = trailingslashit( $uri );
		
		if ( URI == '' || $uri == 'home'):
			$uri = 'blog/';
		else:
			$uri = trailingslashit( URI );
		endif;
		
		$post = load::model( 'post' );
		$posts = $post->get( );
		
		$category = load::model( 'category' );
		
		$user = load::model('user'); 
		
		tentacle::render ( 'blog', array ( 'data' => $posts, 'user'=>$user, 'category'=>$category ) );
                      
        }// END index

} // END Class blog

?> 