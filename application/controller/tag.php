<?php

class tag_controller {

    public function index($tag_name = "default"){

        is::blog_installed();

        $uri 			= URI;

        load::helper('template');

        # Prepare the trigger class
        $trigger 		= Trigger::current();

        $scaffold 		= new scaffold ();

        if ( $uri == '' || $uri == 'tag'):
            $uri 		= 'tag/';
        else:
            $uri 		= slash_it( $uri );
        endif;

        // load the functions.php file from the active theme.
        if (file_exists(PATH_URI.'/functions.php')) {
            require_once( PATH_URI.'/functions.php' );
        }

        $post 		= load::model( 'post' );
        $category 	= load::model( 'category' );
        $tag 		= load::model( 'tags' );
        $author 	= load::model('user');

        define("IS_POST", FALSE);

        if (URI == 'tag') {
            $posts 		= $post->get( );
        } else {
            $posts 	= $tag->get_by_slug( $tag_name );
        }

        if($trigger->exists("preview"))
            $post->content = $trigger->filter($post->content,"preview");

        if($trigger->exists("shortcode"))
            $post->content = $trigger->filter($post->content,"shortcode");

        tentacle::render( 'template-blog', array ( 'posts' => $posts, 'author'=>$author, 'category'=>$category, 'tag'=>$tag ) );

    }// END index
} // END Class category

?>