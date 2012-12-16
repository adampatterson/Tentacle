<?php

class category_controller {

    public function index($category_name = ""){

        is::blog_installed();

        $uri 			= URI;

        load::helper('template');

        # Prepare the trigger class
        $trigger 		= Trigger::current();

        $scaffold 		= new scaffold ();

        if ( $uri == '' || $uri == 'category'):
            $uri 		= 'category/';
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

        if (URI == 'category') {
            $posts 		= $post->get( );
        } else {
            $category_id 	= $category->get( $category_name );

            $post_list = $category->get_page_ids( $category_id->id );
			
            foreach($post_list as $post_single) {
                $get_posts 		= $post->get( $post_single->page_id );

                if($get_posts) {
                    $posts[]  = $get_posts;
                }
            }
        }

        if($trigger->exists("preview"))
            $post->content = $trigger->filter($post->content,"preview");

        if($trigger->exists("shortcode"))
            $post->content = $trigger->filter($post->content,"shortcode");

        tentacle::render( 'template-blog', array ( 'posts' => $posts, 'author'=>$author, 'category'=>$category, 'tag'=>$tag ) );

    }// END index
} // END Class category

?>