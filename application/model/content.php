<?
class content_model {

    /**
     * Function: add
     *	Adds content to the 'posts' table
     *
     * Parameters:
     *	$type - String/Bool - True for post
     *
     * Returns:
     *	INT
     */
    public function add ( $type = 'post' )
    {
        $uri_date = date('Y', time()).'/'.date('m', time());

        $title         = input::post( 'title' );
        $content       = input::post( 'content' );
        $status        = input::post( 'status' );
        $publish       = input::post( 'publish' );
        $slug          = string::sanitize($title);

        $post_author   = user::id();

        if ( $type == 'post' ): # Post
            $uri 		   = slash_it( get::option('blog_uri') ).$uri_date.'/'.$slug.'/';

            $post_template = input::post( 'post_type' );

            if ( $post_template == '' ):
                $post_template = 'type-post';
            endif;

        else: # Page
            $parent_page   = input::post( 'parent_page' );
            //$post_template = input::post( 'page_template' );

            $dirty_template = session::get( 'template' );

            if ( $dirty_template == '' ):
                $post_template = 'default';
            else:
                $post_template = $dirty_template;
            endif;

            $uri 			= $this->get_parent_uri( $parent_page ).$slug.'/';

        endif;


        if ( $type == 'page' ):
            $date = time();
        elseif ( $publish == 'published-on'):

            //$date = new date();

            $minute	= input::post( 'minute' );
            $hour	= input::post( 'hour' );
            $day 	= input::post( 'day' );
            $month 	= input::post( 'month' );
            $year	= input::post( 'year' );

            //2012-02-08 14:16:05
            $composed_time = $year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':00';
            //echo date('l dS \o\f F Y h:i:s A', strtotime( $composed_time ));

            $date = strtotime( $composed_time );
        else:

            $current_minute         = date('i', time());
            $current_hour           = date('H', time());
            $current_day            = date('d', time());
            $current_month          = date('m', time());
            $current_year           = date('Y', time());

            $current_composed_time = $current_year.'-'.$current_month.'-'.$current_day.' '.$current_hour.':'.$current_minute.':00';

            $date = strtotime( $current_composed_time );
        endif;

        $page          = db('posts');

        $row = $page->insert(array(
            'title'		=> $title,
            'slug'		=> $slug,
            'uri'		=> $uri,
            'content'	=> $content,
            'status'	=> $status,
            'author'	=> $post_author,
            'type'		=> $type,
            'template'	=> $post_template,
            'date'		=> $date,
            'modified'	=> time()
        ));

        if ( $this->add_scaffold( $row->id ) ):
            note::set('success','post_add','Post Added!');

            return $row->id;
        else:
            return false;
        endif;
    }

    /**
     * Function: add_scaffold
     *	Adds scaffolded data to the 'posts_meta' table
     *
     * Parameters:
     *	$id - INT
     *
     * Returns:
     *	True
     */
    public function add_scaffold ( $id = null ) {

        $scaffold_data = $_POST;

        $remove_keys = array( 'title', 'content', 'status', 'parent_page', 'page_template', 'page-or-post', 'history', 'tags', 'publish', 'year', 'month', 'day', 'hour', 'minute' );

        foreach ( $remove_keys as $remove_key ):
            unset( $scaffold_data[ $remove_key ] );
        endforeach;

        $meta_value = serialize( $scaffold_data );

        $page_meta      = db('posts_meta');

        $page_meta->insert(array(
            'posts_id'=>$id,
            'meta_key'=>'scaffold_data',
            'meta_value'=>$meta_value
        ));

        return true;
    }

    // Add Post's by import
    //----------------------------------------------------------------------------------------------
    public function add_by_import ( $import, $type = 'post' )
    {
        $uri_date = new DateTime( $import['post_date'] );

        $uri_date = $uri_date->format('Y').'/'.$uri_date->format('m');

        $title         = $import['post_title'];
        $slug          = string::sanitize($title);
        $uri 		   = slash_it( get::option('blog_uri') ).$uri_date.'/'.$slug.'/';
        $content       = $import['post_content'];
        $status        = $import['status'];

        $post_template = 'type-post';

        $date = new date();
        $date = strtotime( $import['post_date'] );

        $post_author   = user::id();

        $page          = db('posts');

        $row = $page->insert(array(
            'title'		=>$title,
            'slug'		=>$slug,
            'uri'		=>$uri,
            'content'	=>$content,
            'status'	=>$status,
            'author'	=>$post_author,
            'type'		=>$type,
            'template'	=>$post_template,
            'date'		=>$date,
            'modified'	=>time()
        ));

        $meta_value = serialize( '' );

        $page_meta      = db('posts_meta');

        $page_meta->insert(array(
            'posts_id'=>$row->id,
            'meta_key'=>'scaffold_data',
            'meta_value'=>$meta_value
        ));

        return $row->id;
    }


    // Update Post
    //----------------------------------------------------------------------------------------------
    public function update ( $id )
    {
        // create a new version of the content.
        $title         = input::post( 'title' );
        $slug          = string::sanitize($title);
        $content       = input::post( 'content' );
        $status        = input::post( 'status' );
        $publish       = input::post( 'publish' );

        $post_template = input::post( 'post_type' );

        if ( $post_template == '' )
            $post_template = 'type-post';


        $minute	= input::post( 'minute' );
        $hour	= input::post( 'hour' );
        $day 	= input::post( 'day' );
        $month 	= input::post( 'month' );
        $year	= input::post( 'year' );

        $composed_time = $year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':00';
//      var_dump($composed_time);
        $date_published = strtotime( $composed_time );


        $history_date = input::post( 'date_history' );

        $history_minute	    = date('i', $history_date);
        $history_hour	    = date('H', $history_date);
        $history_day 	    = date('d', $history_date);
        $history_month 	    = date('m', $history_date);
        $history_year	    = date('Y', $history_date);

        $history_composed_time = $history_year.'-'.$history_month.'-'.$history_day.' '.$history_hour.':'.$history_minute.':00';
//      var_dump($history_composed_time);
        $date_history = strtotime( $history_composed_time );


        $current_minute         = date('i', time());
        $current_hour           = date('H', time());
        $current_day            = date('d', time());
        $current_month          = date('m', time());
        $current_year           = date('Y', time());

        $current_composed_time = $current_year.'-'.$current_month.'-'.$current_day.' '.$current_hour.':'.$current_minute.':00';
//      var_dump($current_composed_time);
        $date_current = strtotime( $current_composed_time );

//        _s('Published Date');
//        var_dump($date_published);
//        _s('Date from Histroy');
//        var_dump($date_history);
//        _s('The current Date');
//        var_dump($date_current);

        if ($date_history < $date_published){
//            _p("The date is in the future");
        }

        if ( $status == 'published' &&  $date_published < $date_history ):
//            _p("If the page is published, and the published date is less than the history date use date published.");
            $date = $date_published;

        elseif ( $status == 'published' &&  $date_current < $date_published ):
//            _p("If the page is published, and the published date is greater than the current date then use the date published.");
            $date = $date_published;

        elseif ( $status == 'published' ):
//            _p("The date is not greater, but the page is published so we use the history date.");
            $date = $date_history;

        elseif ($date_history > $date_published ):
//            _p("The published date is not greater than the history, the published date may have been changed earlier.");
            $date = $date_published;

        elseif ( $status == 'draft' &&  $date_current < $date_published ):
//            _p("If the page is in draft but the published date is in the future then leave it alone.");
            $date = $date_published;

        elseif ( $status == 'draft' ):
//            _p("If the page is in draft, but the published date is not in the future then use the current date.");
            $date = $date_current;

        endif;

        $post_type     = $_POST['page-or-post'];

        $post_author   = user::id();


        $uri_date_raw	    = date('Y', $history_date).'-'.date('m', $history_date);

        $uri_date = new DateTime( $uri_date_raw );

        $uri_date = $uri_date->format('Y').'/'.$uri_date->format('m');
        $uri = slash_it( get::option('blog_uri') ).$uri_date.'/'.$slug.'/';

        // Run content through HTMLawd and Samrty Text
        $page          = db('posts');

        $row = $page->update(array(
            'title'		=>$title,
            'slug'		=>$slug,
            'content'	=>$content,
            'status'	=>$status,
            'author'	=>$post_author,
            'type'		=>$post_type,
            'template'	=>$post_template,
            'uri'		=>$uri,
            'date'		=>$date,
            'modified'	=> time()
        ))
            ->where( 'id', '=', $id )
            ->execute();


        $scaffold_data = $_POST;

        $remove_keys = array( 'title', 'content', 'status', 'parent_page', 'page_template', 'page-or-post', 'history', 'publish', 'minute', 'hour', 'day', 'month', 'year', 'save', 'tags'  );

        foreach ( $remove_keys as $remove_key ):
            unset( $scaffold_data[ $remove_key ] );
        endforeach;

        $meta_value = serialize( $scaffold_data );


        $page_meta      = db('posts_meta');

        $meta = $page_meta->update(array(
            'meta_value'=>$meta_value
        ))
            ->where( 'posts_id', '=', $id )
            ->execute();

        note::set('success','page_update','Page Updated!');

        return $id;
    }


    // Get Post
    //----------------------------------------------------------------------------------------------
    public function get ( $id='' )
    {
        $posts = db ( 'posts' );

        if( defined( 'FRONT' ) ) {
            $get_posts = $posts->select( '*' )
                ->where ( 'type', '=', 'post' )
                ->order_by ( 'date', 'DESC' )
                ->clause ('AND')
                ->where ( 'status', '=', 'published' )
                ->clause ('AND')
                ->where ( 'date', '<=', time() )
                ->execute();

            return $get_posts;
        } elseif ( $id == '' ) {
            $get_posts = $posts->select( '*' )
                ->where ( 'type', '=', 'post' )
                ->order_by ( 'id', 'DESC' )
                ->clause ('AND')
                ->where ( 'status', '!=', 'trash' )
                ->execute();

            return $get_posts;
        } else {
            $get_posts = $posts->select( '*' )
                ->where ( 'id', '=', $id )
                ->clause ('AND')
                ->where ( 'type', '=', 'post' )
                ->execute();

            if( isset($get_posts[0])){
                return $get_posts[0];
            } else {
                return false;
            }

        }
    }


    // Get posts by quantity
    //----------------------------------------------------------------------------------------------
    public function get_quantity( $quantity=10 ){
        $posts = db ( 'posts' );

        $get_posts = $posts->select( '*' )
            ->limit( $quantity )
            ->where ( 'type', '=', 'post' )
            ->order_by ( 'date', 'DESC' )
            ->clause ('AND')
            ->where ( 'status', '=', 'published' )
            ->clause ('AND')
            ->where ( 'date', '<=', time() )
            ->execute();

        return $get_posts;
    }


    // Get Page by Status
    //----------------------------------------------------------------------------------------------
    public function get_by_status ( $status = '', $type = null )
    {
        $pages = db ( 'posts' );

        if ( $status != '' ) {
            $get_pages = $pages->select( '*' )
                ->where ( 'type', '=', 'post' )
                ->clause('AND')
                ->where ( 'status', '=', $status )
                ->order_by ( 'id', 'DESC' )
                ->execute();

            return $get_pages;
        } else {
            return false;
        }
    }


    // Get Posts by post-type
    //----------------------------------------------------------------------------------------------
    public function get_by_type ( $type = false )
    {
        $pages = db ( 'posts' );

        if ( $type ) {
            $get_pages = $pages->select( '*' )
                ->where ( 'type', '=', 'post' )
                ->clause('AND')
                ->where ( 'template', '=', 'type-'.$type )
                ->clause('AND')
                ->where ( 'status', '=', 'published' )
                ->order_by ( 'id', 'DESC' )
                ->execute();

            return $get_pages;
        } else {
            return false;
        }
    }


    /**
     * Get an object based on its date ( year/month )
     *
     * @param string $date
     * @return void
     * @author Adam Patterson
     *
     */
    public function get_by_date( $date )
    {
        # @todo wild card on URI with
        # @todo Import of content needs to be adjusted.
        # @todo update of content needs to be udpated
        return db::query("SELECT * FROM posts WHERE uri LIKE '%".$date."%'");
    }


    // Get Page Meta
    //----------------------------------------------------------------------------------------------
    /**
     * Get the meta date for a page, this would be any scaffold data or page options.
     *
     * @author Adam Patterson
     */
    # change to get_meta
    public function get_post_meta ( $id='' )
    {
        $post_meta = db ( 'posts_meta' );

        $dirty_post_meta = $post_meta->select( 'meta_value' )
            ->where ( 'posts_id', '=', $id )
            ->execute();

        if( ! empty($dirty_post_meta))
        {
            $clean_post_meta = unserialize( $dirty_post_meta[0]->meta_value );
            return (object)$clean_post_meta;
        }
        else
        {
            return null;
        }
    }
}
