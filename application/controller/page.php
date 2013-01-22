<?php
class page_controller {

    public function index(  ){
        load::library('benchmark');
        bench::mark('start');

        is::blog_installed();

        # Lets the navigation functions know that we are on the front end and not to show admin ( draft ) content.
        define ( 'FRONT'		, TRUE );

        $uri 			= URI;

        if ( $uri == '' || $uri == 'home'):
            $uri 		= 'home';
        elseif	( URI == '' || $uri == get::option('blog_uri') ):
            $uri 		= un_slash( get::option('blog_uri') );
        endif;

        $blog_uri = un_slash(get::option('blog_uri'));

        $routs = array(
            'home'                              => 'home.index',
            'tag'							    => 'tag.index',
            'tag/:words'			            => 'tag.slug',
            'tag/page/:int'					    => 'tag.paged',
            'category'						    => 'category.index',
            'category/:words'		            => 'category.slug',
            'category/page/:int'			    => 'category.paged',
            $blog_uri                           => 'blog.index',
            $blog_uri.'/:words' 			    => 'blog.slug',
            $blog_uri.'/page/:int'				=> 'blog.paged',
            $blog_uri.'/:int/:int'				=> 'blog.date',
            $blog_uri.'/:int/:int/:words'       => 'blog_date.slug',
            $blog_uri.'/:int/:int/page/:int'	=> 'blog_date.paged',
            ':words' 			                => 'page.index',
            ':words/page/:int'		            => 'page.paged',
            ':words/:words'                     => 'page.index',
            ':words/:plugin'                    => 'page.plugin',
            ':words/:words/:words'              => 'page.index'
        );

        url_map::add($routs);

        logger::set('URI', $uri );
        logger::set('Model Index', url_map::get( $uri ) );

        load::library('pagination');

        load::helper('template');

        // load the functions.php file from the active theme.
        if (file_exists(THEME_URI.'/functions.php'))
            require_once( THEME_URI.'/functions.php' );

        $post 		= load::model( 'post' );
        $page 		= load::model( 'page' );
        $category 	= load::model( 'category' );
        $tag 		= load::model( 'tags' );
        $author 	= load::model('user');

        switch (url_map::get( $uri )) {
            case 'home_index':
            case 'page_index':
            case 'page_plugin':

                define ( 'IS_POST'      , FALSE );

                $uri_parts = explode( '/', $uri );

                $uri_count = count( $uri_parts );

                if ($uri_count == 2)
                    $uri = $uri_parts[0];

                $post 		= $page->get_by_uri( $uri );

                tentacle::render( $post->template, array ( 'post' => $post ) );

                break;
            case 'blog_index':

                define ( 'IS_POST'      , FALSE );

                $posts 		= $post->get( );
                $post_total = count($posts);

                //$page = new pagination($post_total, $current_page,25);

                logger::set('Post total', $post_total);

                tentacle::render( 'template-blog', array ( 'posts' => $posts, 'author'=>$author, 'category'=>$category, 'tag'=>$tag ) );

                break;
            case 'blog_date':

                define ( 'IS_POST'      , FALSE );

                $posts 		= $post->get_by_date( $uri );
                $post_total = count($posts);

                //$page = new pagination($post_total, $current_page,25);

                logger::set('Post total', $post_total);

                tentacle::render( 'template-blog', array ( 'posts' => $posts, 'author'=>$author, 'category'=>$category, 'tag'=>$tag ) );

                break;
            case 'blog_date_slug':

                define ( 'IS_POST'      , TRUE );

                $post 		= $page->get_by_uri( $uri );

                $post_meta 	= $page->get_page_meta( $post->id );
                $post_total = count($post);

                logger::set('Post total', $post_total);

                tentacle::render( $post->template, array ( 'post' => $post, 'post_meta' => $post_meta ) );

                break;
            case 'category_slug':

                $category_slug = explode('/', $uri);

                define ( 'IS_POST'      , FALSE );

                if (URI == 'category')
                    $posts 		= $post->get( );
                else
                    $posts 	= $category->get_by_slug( $category_slug[1] );

                $post_total = count($posts);
                logger::set('Category total', $post_total);

                tentacle::render( 'template-blog', array ( 'posts' => $posts, 'author'=>$author, 'category'=>$category, 'tag'=>$tag ) );

                break;

            case 'tag_slug':

                $tag_slug = explode('/', $uri);

                define ( 'IS_POST'      , FALSE );

                if (URI == 'category')
                    $posts 		= $post->get( );
                else
                    $posts 	= $tag->get_by_slug( $tag_slug[1] );

                $post_total = count($posts);
                logger::set('Category total', $post_total);

                tentacle::render( 'template-blog', array ( 'posts' => $posts, 'author'=>$author, 'category'=>$category, 'tag'=>$tag ) );

                break;
            default:
                tentacle::render ( '404' );
                break;
        }

        bench::mark('end');
        $speed = bench::time('start','end');

        logger::set('Memory', memory_usage());
        logger::set('Execution Time', $speed);

        tentacle::admin_bar();
    }
    
}