<?
load::helper( 'data_properties' );

class content_model extends properties {

    public $type = 'post';

    /**
     * Function: type
     *	sets the content context, defaulting to post
     *
     * Parameters:
     *	$t - String/Bool - True for post
     *
     * Returns:
     *	string
     */
    public function type ( $t = 'post' )
    {
        $this->type = $t;

        return $this;
    }


    /**
     * Function: add
     *	Adds content to the 'posts' table
     */
    public function add ( )
    {
        $uri_date = date('Y', time()).'/'.date('m', time());

        $title         = input::post( 'title' );
        $content       = input::post( 'content' );
        $status        = input::post( 'status' );
        $publish       = input::post( 'publish' );
        $slug          = string::sanitize($title);

        $post_author   = user::id();

        if ( $this->type == 'post' ): # Post
            $uri 		   = slash_it( get::option('blog_uri') ).$uri_date.'/'.$slug.'/';

            $post_template = input::post( 'post_type' );

            if ( $post_template == '' ):
                $post_template = 'type-post';
            endif;

        else: # Page
            $parent_page   = input::post( 'parent_page' );

            $dirty_template = session::get( 'template' );

            if ( $dirty_template == '' ):
                $post_template = 'default';
            else:
                $post_template = $dirty_template;
            endif;

            $uri 			= $this->get_parent_uri( $parent_page ).$slug.'/';

        endif;


        if ( $this->type == 'page' ):
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

        $posts          = db('posts');

        $row = $posts->insert(array(
            'title'		=> $title,
            'slug'		=> $slug,
            'uri'		=> $uri,
            'content'	=> $content,
            'status'	=> $status,
            'author'	=> $post_author,
            'type'		=> $this->type,
            'template'	=> $post_template,
            'date'		=> $date,
            'modified'	=> time()
        ));

        if ( $this->add_scaffold( $row->id ) ):
            note::set('success','post_add', $this->type.' added!');

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

        $this->post_meta_table()->insert(array(
            'posts_id'=>$id,
            'meta_key'=>'scaffold_data',
            'meta_value'=>$meta_value
        ));

        return true;
    }


    // Add Post's by import
    //----------------------------------------------------------------------------------------------
    // @todo update impoirt process to use $this->type
    public function add_by_import ( $import )
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

        $row = $this->post_table()->insert(array(
            'title'		=>$title,
            'slug'		=>$slug,
            'uri'		=>$uri,
            'content'	=>$content,
            'status'	=>$status,
            'author'	=>$post_author,
            'type'		=> $this->type,
            'template'	=>$post_template,
            'date'		=>$date,
            'modified'	=>time()
        ));

        $meta_value = serialize( '' );

        $posts_meta      = db('posts_meta');

        $posts_meta->insert(array(
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

        $post_author   = user::id();


        $uri_date_raw	    = date('Y', $history_date).'-'.date('m', $history_date);

        $uri_date = new DateTime( $uri_date_raw );

        $uri_date = $uri_date->format('Y').'/'.$uri_date->format('m');
        $uri = slash_it( get::option('blog_uri') ).$uri_date.'/'.$slug.'/';


        if ( $this->type == 'post' ): # Post
            $uri 		   = slash_it( get::option('blog_uri') ).$uri_date.'/'.$slug.'/';

            $post_template = input::post( 'post_type' );

            if ( $post_template == '' ):
                $post_template = 'type-post';
            endif;

        else: # Page
            $parent_page   = input::post( 'parent_page' );

            $dirty_template = session::get( 'template' );

            if ( $dirty_template == '' ):
                $post_template = 'default';
            else:
                $post_template = $dirty_template;
            endif;

            $uri 			= $this->get_parent_uri( $parent_page ).$slug.'/';

        endif;

        $row = $this->post_table()->update(array(
            'title'		=>$title,
            'slug'		=>$slug,
            'content'	=>$content,
            'status'	=>$status,
            'author'	=>$post_author,
            'template'	=>$post_template,
            'uri'		=>$uri,
            'date'		=>$date,
            'modified'	=> time()
        ))
            ->where( 'id', '=', $id )
            ->execute();

        if ( $this->add_scaffold( $row->id ) ):
            note::set('success','post_add', $this->type.' Added!');

            return $row->id;
        else:
            return false;
        endif;
    }


    public function update_uri( $id )
    {
        $parent_uri = $this->get_parent_ids( $id );

        $uri = '';
        foreach( array_reverse($parent_uri) as $id ){
            $uri .= $this->get_parent_slug( $id ).'/';
        }

        return substr($uri, 1);
    }


    public function update_page_order( $new_order )
    {
        // Run the function above
        $clean_order = parse_multidimensional_array( $new_order );

        // Loop through the "readable" array and save changes to DB
        foreach ($clean_order as $key => $value):

            // $value should always be an array, but we do a check
            if (is_array($value)):

                $new_uri = $this->update_uri( $value['id'] );

                $this->post_table()->update(array(
                    'parent'=>$value['parentID'],
                    'menu_order'=>$key,
                    'uri'=>$new_uri
                ))
                    ->where( 'id', '=', $value['id'] )
                    ->execute();
            endif;
        endforeach;
    }


    // Get Post
    //----------------------------------------------------------------------------------------------
    public function get ( $id='' )
    {
        if( defined( 'FRONT' ) ) {
            $get_posts = $this->post_table()
                ->select( '*' )
                ->where ( 'type', '=', $this->type )
                ->order_by ( 'date', 'DESC' )
                ->clause ('AND')
                ->where ( 'status', '=', 'published' )
                ->clause ('AND')
                ->where ( 'date', '<=', time() )
                ->execute();

            return $get_posts;
        } elseif ( $id == '' ) {
            $get_posts = $this->post_table()
                ->select( '*' )
                ->where ( 'type', '=', $this->type )
                ->order_by ( 'id', 'DESC' )
                ->clause ('AND')
                ->where ( 'status', '!=', 'trash' )
                ->execute();

            return $get_posts;
        } else {
            $get_posts = $this->post_table()
                ->select( '*' )
                ->where ( 'id', '=', $id )
                ->execute();

            if( isset($get_posts[0]))
                return $get_posts[0];
            else
                return false;
        }
    }


    // Get URI
    //----------------------------------------------------------------------------------------------
    /**
     * Return a page by ID
     *
     * @author Adam Patterson
     */
    public function get_uri( $id='' )
    {
        if ( $id != '' ) {
            $get_posts = $this->post_table()
                ->select( 'uri' )
                ->where ( 'id', '=', $id )
                ->order_by ( 'id', 'DESC' )
                ->execute();

            return $get_posts[0]->uri;
        }
    }


    /**
     * Get an object based on its URI
     *
     * @param string $uri
     * @return void
     * @author Adam Patterson
     *
     * @todo If the URI query returns nothing we should post a 404
     *
     */
    public function get_by_uri( $uri )
    {
        $uri = slash_it($uri);

        $get_parent_uri = $this->post_table()
            ->select( '*' )
            ->where ( 'uri', '=', $uri )
            ->execute();

        if ( $uri ):
            if ( isset($get_parent_uri[0] ) and !empty($get_parent_uri) ):
                return $get_parent_uri[0];
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }


    public function get_breadcrumbs( )
    {

    }


    /**
     * Return the home Hobject
     *
     * @author Adam Patterson
     */
    public function get_home( )
    {
        $home = $this->post_table()
            ->select( '*' )
            ->where ( 'menu_order', '=', '1' )
            ->execute();

        return $home;
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
        return db::query("SELECT * FROM posts WHERE uri LIKE '%".$date."%'");
    }


    /**
     * Return all pages or one page by ID
     *
     * @author Adam Patterson
     */
    public function get_by_parent_id ( $id='' )
    {
        $get_posts = $this->post_table()
            ->select( '*' )
            ->where ( 'type', '=', $this->type )
            ->order_by ( 'menu_order', 'ASC' )
            ->clause ('AND')
            ->where ( 'status', '!=', 'trash' )
            ->clause ('AND')
            ->where ( 'parent', '=', $id )
            ->order_by ( 'id', 'DESC' )
            ->execute();

        return $get_posts;
    }

    // Get Page by Status
    //----------------------------------------------------------------------------------------------
    public function get_by_status ( $status = '' )
    {
        if ( $status != '' ) {
            $get_posts = $this->post_table()
                ->select( '*' )
                ->where ( 'type', '=', $this->type )
                ->clause('AND')
                ->where ( 'status', '=', $status )
                ->order_by ( 'id', 'DESC' )
                ->execute();

            return $get_posts;
        } else {
            return false;
        }
    }



    /**
     * Get an object based on its SLUG
     *
     * @param string $uri
     * @return void
     * @author Adam Patterson
     *
     * @todo Finds the last page available in a URI
     *
     */
    public function get_by_slug( $uri )
    {
        $slug_parts = explode('/', $uri);

        foreach ($slug_parts as $part ) {
            $get_slug = $this->post_table()
                ->select( '*' )
                ->where ( 'slug', '=', $part )
                ->execute();

            if ($get_slug) {
                return $get_slug[0];
            }
        }
    }


    // Get Page Meta
    //----------------------------------------------------------------------------------------------
    /**
     * Get the meta date for a page, this would be any scaffold data or page options.
     *
     * @author Adam Patterson
     */
    public function get_meta ( $id='' )
    {
        $dirty_post_meta = $this->post_meta_table()
            ->select( 'meta_value' )
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


    /**
     * Get the URI of a parent page
     *
     * @param string $parent_id
     * @return void
     * @author Adam Patterson
     */
    public function get_parent_uri( $parent_id )
    {
        $get_parent_uri = $this->post_table()
            ->select( 'uri' )
            ->where ( 'id', '=', $parent_id )
            ->clause ( 'AND' )
            ->where ( 'type', '=', 'page' )
            ->execute();

        if ( $parent_id ):
            return $get_parent_uri[0]->uri;
        else:
            return false;
        endif;
    }


    /**
     * Get the SLUG of a parent page
     */
    public function get_parent_slug( $parent_id )
    {
        $get_parent_uri = $this->post_table()
            ->select( 'slug' )
            ->where ( 'id', '=', $parent_id )
            ->clause ( 'AND' )
            ->where ( 'type', '=', 'page' )
            ->execute();

        if ( $parent_id ):
            return $get_parent_uri[0]->slug;
        else:
            return false;
        endif;
    }


    /**
     * Get a parent page
     *
     * @param string $parent_id
     * @return void
     * @author Adam Patterson
     */
    public function get_parent( $parent_id )
    {
        $get_parent_uri = $this->post_table()
            ->select( '*' )
            ->where ( 'id', '=', $parent_id )
            ->clause ( 'AND' )
            ->where ( 'type', '=', 'page' )
            ->execute();

        if ( $parent_id ):
            return $get_parent_uri[0];
        else:
            return false;
        endif;
    }


    public function get_parent_ids( $id, $id_array = array() )
    {
        $id_array[] = $id;

        $parents = $this->post_table()
            ->select( 'parent', 'uri' )
            ->where ( 'id', '=', $id )
            ->clause ( 'AND' )
            ->where ( 'type', '=', 'page' )
            ->execute();

        $has_parent = !empty($parents);

        if ($has_parent)
            // Loop through all of the children and run this function again
            foreach ($parents as $parent)
                $id_array = $this->get_parent_ids($parent->parent, $id_array);

        return $id_array;
    }


    /**
     * Return the children under a parent ID
     *
     * @author Adam Patterson
     *
     * @param int $page_id
     *
     * @return Object
     */
    public function &get_page_children( $page_id, $pages, $level = 0 )
    {
        $page_list = array();
        foreach ( (array) $pages as $key => $page ):
            if ( $page->parent == $page_id ):
                $page_list[$key] = (array)$page;
                $page_list[$key]['level'] = $level;

                //	$page_list = array_merge($page_list, $page_list_two);

                if ( $children = $this->get_page_children($page->id, $pages, $level+1 ) )
                    $page_list = array_merge( $page_list, $children );
            endif;
        endforeach;

        return $page_list;
    }


    /**
     * Return all ID's under a parent id.
     *
     * @author Adam Patterson
     */
    public function get_page_descendant_ids( $id = null, $id_array = array() )
    {
        $id_array[] = $id;

        $children = $this->post_table()
            ->select( 'id', 'title' )
            ->where ( 'parent', '=', $id )
            ->clause ( 'AND' )
            ->where ( 'type', '=', 'page' )
            ->execute();

        $has_children = !empty($children);

        if ($has_children)

            // Loop through all of the children and run this function again
            foreach ($children as $child)
                $id_array = $this->get_page_descendant_ids($child->id, $id_array);

        return $id_array;
    }


    /**
     * Returns an array of pages ( one level deep )
     *
     * @author Adam Patterson
     */
    public function get_page_descendants( $id = null )
    {
        $id_array[] = $id;

        $children = $this->post_table()
            ->select( '*' )
            ->where ( 'parent', '=', $id )
            ->clause ( 'AND' )
            ->where ( 'type', '=', 'page' )
            ->execute();

        return $children;
    }


    /**
     * Return a hierarchical page tree
     *
     * @author Adam Patterson
     */
    public function get_page_tree ( $page_dirty )
    {
        $pages = array();

        foreach ($page_dirty as $page)
            $pages[$page->id] = (array) $page;

        // build a multidimensional array of parent > children
        foreach ($pages as $row):
            if (array_key_exists($row['parent'], $pages))
                // add this page to the children array of the parent page
                $pages[$row['parent']]['children'][] =& $pages[$row['id']];

            // this is a root page
            if ($row['parent'] == 0)
                $page_array['children'][] =& $pages[$row['id']];

        endforeach;

        return $page_array;
    }


    // Children
    //----------------------------------------------------------------------------------------------
    /**
     * Does the page have children?
     *
     * @access public
     * @param int $parent_id The ID of the parent page
     * @return mixed
     */
    public function page_has_children( $parent_id )
    {
        // Query the DB looking for parent_id
    }


    public function get_page_by_level ( $pages, $depth = 0 )
    {
        $page_list = array();

        foreach ( (array) $pages as $page ):
            if ( $page['level'] == $depth ):
                $page_list[] = (array)$page;
            endif;
        endforeach;

        return $page_list;
    }


    public function get_page_level ( $pages, $uri )
    {
        $page_list = array();

        foreach ( (array) $pages as $page ):
            if ( $page['uri'] == $uri ):
                $page_level[] = (array)$page['level'];
            endif;
        endforeach;

        return $page_level[0][0];
    }


    public function &get_flat_page_hierarchy( &$pages, $page_id = 0 )
    {
        if ( empty( $pages ) ) {
            $result = array();
            return $result;
        }

        $children = array();

        foreach ( (array) $pages as $p ) {
            $parent_id = intval( $p->parent );
            $children[ $parent_id ][] = $p;
        }

        $result = array();
        $this->_page_traverse_name( $page_id, $children, $result );

        return $result;
    }


    public function _page_traverse_name( $page_id, &$children, &$result )
    {
        if ( isset( $children[ $page_id ] ) ){
            foreach( (array)$children[ $page_id ] as $child ) {
                $result[ $child->id ] = $child->slug;
                $this->_page_traverse_name( $child->id, $children, $result );
            }
        }
    }
}