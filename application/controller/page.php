<?php
load::helper( 'data_properties' );

class page_controller extends properties {

    public function index( )
    {

        if( DEBUG ):
            load::library('benchmark');
            bench::mark('start');
        endif;

        is::blog_installed();

        # Lets the navigation functions know that we are on the front end and not to show admin ( draft ) content.
        define ( 'FRONT'		, TRUE );

        $uri 			= URI;

        $blog_uri       = get::option( 'blog_uri' );

        if ( $uri == '' || $uri == 'home'):
            $uri 		= 'home';
            define( 'IS_HOME'    , TRUE );
        elseif	( URI == '' || $uri == $blog_uri ):
            $uri 		= un_slash( $blog_uri );
            define( 'IS_HOME'    , FALSE );
        endif;

        $id = $this->content_model()->get_by_uri(URI);

        if ( $id )
            define( 'ID'            , $id->id);
        else
            define( 'ID'            , '' );

        $blog_uri = un_slash( $blog_uri );

        $routs = array(
            'p/:int'					        => 'short.url',
            'home'                              => 'home.index',
            'tag'							    => 'tag.index',
            'tag/:words'			            => 'tag.slug',
            'tag/page/:int'					    => 'tag.paged',
            'category'						    => 'category.index',
            'category/:words'		            => 'category.slug',
            'category/page/:int'			    => 'category.paged',
            'feed'                              => 'feed.index',
            $blog_uri                           => 'blog.index',
            $blog_uri.'/:words' 			    => 'blog.slug',
            $blog_uri.'/page/:int'				=> 'blog.paged',
            $blog_uri.'/:int/:int'				=> 'blog.date',
            $blog_uri.'/:int/:int/:words'       => 'blog_date.slug',
            $blog_uri.'/:int/:int/page/:int'	=> 'blog_date.paged',
            ':words' 			                => 'page.index',
            ':words/page/:int'		            => 'page.paged',
            ':words/:plugin'                    => 'page.plugin',
            ':words/:words'                     => 'page.subpage',
            ':words/:words/:words'              => 'page.subpage'
        );

        url_map::add( $routs );

        logger::set( 'URI', $uri );
        logger::set( 'Model Index', url_map::get( $uri ) );

        load::library( 'pagination' );

        load::helper( 'template' );

        // load the functions.php file from the active theme.
        if (file_exists(THEME_URI.'/functions.php'))
            require_once( THEME_URI.'/functions.php' );

        $uri_parts = explode('/', URI);
        $current_page = end( $uri_parts );

        if( !is_numeric( $current_page ) )
            $current_page = 1;

        $post_limit = get::option( 'page_limit', 5 );

        $redirect_uri = $this->content_model()->type( )->get_by_partial_uri( URI );

        // True the page exists
        // False the page is a 404
        // Data then we found something and redirect

//        if ( $redirect_uri === false )
            //url::redirect($redirect_uri->uri);

        switch (url_map::get( $uri )) {
            case 'feed_index':
                define('FEED'           , TRUE);
                define('IS_BLOG'      , FALSE );
                header('Content-Type: application/rss+xml; charset=ISO-8859-1');

                echo file_get_contents('rss.xml');

                break;
            case 'home_index':
            case 'page_index':
            case 'page_plugin':
                define ( 'IS_POST'      , FALSE );
                define ( 'IS_PAGE'      , TRUE );
                define ( 'IS_BLOG'      , FALSE );
                define('FEED'            , FALSE);

                $uri_parts = explode( '/', $uri );

                $uri_count = count( $uri_parts );

                if ($uri_count == 2)
                    $uri = $uri_parts[0];

                $post = $this->content_model()->get_by_uri( $uri );

                if($post != false)
                    $post_meta  = $this->content_model()->get_meta( $post->id );

                if ( !$post ):
                    tentacle::render ( '404' );
                    define ( 'IS_404'      , TRUE );
                else:
                    logger::set('Page Template', $post->template);
                    tentacle::render( $post->template, array ( 'post' => $post, 'page' => $this->content_model(), 'post_meta' => $post_meta ) );
                endif;

            break;
            case 'short_url':

                $post = $this->content_model()->get_uri( $uri_parts[1] );

                url::redirect($post);

            break;
            case 'page_subpage':
                define ( 'IS_PAGE'      , TRUE );
                define ( 'IS_SUB_PAGE'  , TRUE );
                define ( 'IS_POST'      , FALSE );
                define ( 'IS_BLOG'      , FALSE );
                define('FEED'            , FALSE);

                $post       = $this->content_model()->get_by_uri( $uri );

                if ( !$post ):
                  tentacle::render ( '404' );
                else:
                  $post_meta  = $this->content_model()->get_meta( $post->id );
                  logger::set('Page Template', $post->template);
                  tentacle::render( $post->template, array ( 'post' => $post, 'post_meta' => $post_meta ) );
                endif;
            break;
            case 'blog_index':

                define ( 'IS_POST'      , FALSE );
                define ( 'IS_BLOG'      , TRUE );
                define('FEED'            , FALSE);

                $post_total 		= $this->content_model()->get( );

                $posts = new pagination($post_total, $current_page, $post_limit);

                logger::set('Post total', count($post_total));

                if ( count($post_total) > $post_limit ) {
                    $paginate = new paginate($post_total, $current_page);

                    paginate::padding(false);
                    paginate::selectable_pages('7');
                }

                logger::set('Page Template', 'template-blog');
                tentacle::render( 'template-blog', array ( 'posts' => $posts->results(), 'author' => $this->user_model(), 'category' => $this->category_model(), 'tag' => $this->tag_model() ) );

            break;
            case 'blog_date':
            case 'blog_slug':

                define ('IS_POST'      , FALSE);
                define ('IS_BLOG'      , TRUE);
                define('FEED'            , FALSE);

                $posts 		= $this->content_model()->get_by_date( $uri );

                logger::set('Post total', count($posts));

                if ( !$posts )
                    tentacle::render ( '404' );
                else
                    tentacle::render( 'template-blog', array ( 'posts' => $posts, 'author' => $this->user_model(), 'category' => $this->category_model(), 'tag' => $this->tag_model() ) );

            break;
            case 'blog_date_slug':

                define ( 'IS_POST'      , TRUE );
                define ( 'IS_BLOG'      , TRUE );
                define('FEED'            , FALSE);

                $post 		    = $this->content_model()->get_by_uri( $uri );

                if ( !$post ):
                    tentacle::render ( '404' );
                else:
                    $post_meta 	= $this->content_model()->get_meta( $post->id );

                    logger::set('Post total', count($post));
                    logger::set('Post Template', $post->template);

                    dispatcher::set('posts', $post);
                    dispatcher::set('post_meta', $post_meta);
                    dispatcher::set('author', $this->user_model());
                    dispatcher::set('category', $this->category_model());
                    dispatcher::set('tag', $this->tag_model());

                    tentacle::render( $post->template, array ( 'post' => $post, 'post_meta' => $post_meta, 'author' => $this->user_model(), 'category' => $this->category_model(), 'tag' => $this->tag_model() ) );
                endif;

            break;
            case 'blog_paged':

                define ( 'IS_POST'      , FALSE );
                define ( 'IS_BLOG'      , TRUE );
                define ( 'IS_PAGED'      , TRUE );
                define('FEED'            , FALSE);

                $post_total     = $this->content_model()->get( );

                $posts = new pagination($post_total, $current_page, $post_limit);

                logger::set('Post total', count($post_total));

                if ( count($post_total) > $post_limit ) {
                    $paginate = new paginate($post_total, $current_page);

                    paginate::padding(false);
                    paginate::selectable_pages('7');
                }

                tentacle::render( 'template-blog', array ( 'posts' => $posts->results(), 'author' => $this->user_model(), 'category'=>$this->category_model(), 'tag' => $this->tag_model() ) );
            break;
            case 'category_slug':

                $category_slug = explode('/', $uri);

                define ( 'IS_POST'      , FALSE );
                define('FEED'            , FALSE);

                if (URI == 'category')
                    $posts 		= $this->content_model()->type( 'post' )->get( );
                else
                    $posts 	    = $this->category_model()->get_by_slug( $category_slug[1] );

                $post_total = count($posts);
                logger::set('Category total', $post_total);

                tentacle::render( 'template-blog', array ( 'posts' => $posts, 'author' => $this->user_model(), 'category'=>$this->category_model(), 'tag' => $this->tag_model() ) );

            break;
            case 'tag_slug':

                $tag_slug = explode('/', $uri);

                define ( 'IS_POST'      , FALSE );
                define('FEED'            , FALSE);

                if (URI == 'category')
                    $posts = $this->content_model()
                        ->type( 'post' )
                        ->get( );
                else
                    $posts 	    = $this->tag_model()->get_by_slug( $tag_slug[1] );

                $post_total = count($posts);
                logger::set('Category total', $post_total);

                tentacle::render( 'template-blog', array ( 'posts' => $posts, 'author' => $this->user_model(), 'category'=>$this->category_model(), 'tag' => $this->tag_model() ) );
            break;
            default:
                define('FEED'            , FALSE);
                define ( 'IS_POST'      , FALSE );
                tentacle::render ( '404' );
            break;
        }

        if( DEBUG and !FEED):
            bench::mark('end');
            $speed = bench::time('start','end');

            logger::set('Memory', memory_usage());
            logger::set('Execution Time', $speed);

            // Site stats are triggered in the admin bar if you are not logged in.
            tentacle::admin_bar();
        endif;

    }
}