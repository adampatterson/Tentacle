<?
class page_model  
{	
	// Get Page
	//----------------------------------------------------------------------------------------------
	public function get ( $id='' )
	{
		$pages = db ( 'posts' );
		
		if ( $id == '' ) {
			$get_pages = $pages->select( '*' )
				->where ( 'type', '=', 'page' )
				->order_by ( 'menu_order', 'ASC' )
				->execute();
					
			return $get_pages;
		} else {	
			$get_pages = $pages->select( '*' )
				->where ( 'id', '=', $id )
				->order_by ( 'id', 'DESC' )
				->execute();	

			return $get_pages[0];
		}	
	}
	
	
	// Get Page by Status
	//----------------------------------------------------------------------------------------------
	public function get_by_status ( $id='', $status='' )
	{
		$pages = db ( 'posts' );
		
		if ( $id == '' ) {
			$get_pages = $pages->select( '*' )
				->where ( 'type', '=', 'page' )
			 	->clause('AND')
				->where ( 'status', '=', 'published' )
				->order_by ( 'menu_order', 'ASC' )
				->execute();
					
			return $get_pages;
		} else {	
			$get_pages = $pages->select( '*' )
				->where ( 'id', '=', $id )
				->clause( 'AND' )
				->where ( 'type', '=', 'page' )
				->order_by ( 'id', 'DESC' )
				->execute();	

			return $get_pages[0];
		}	
	}
	

	// Get Page Meta
	//----------------------------------------------------------------------------------------------
	public function get_page_meta ( $id='' )
	{		
		$page_meta = db ( 'posts_meta' );
	
		$dirty_page_meta = $page_meta->select( 'meta_value' )
			->where ( 'posts_id', '=', $id )
			->execute();	
		
		$clean_page_meta = unserialize( $dirty_page_meta[0]->meta_value );

		return array_to_object( $clean_page_meta );
	}
	
	
	public function get_parent_uri( $parent_id )
	{
		$pages = db ( 'posts' );
	
		$get_parent_uri = $pages->select( 'uri' )
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
	
	
	public function get_by_uri( $uri )
	{
		$pages = db ( 'posts' );
	
		$get_parent_uri = $pages->select( '*' )
			->where ( 'uri', '=', $uri )
			->execute();
		
		if ( $uri ):
			return $get_parent_uri[0]->uri;
		else:
			return false;
		endif;
	}
	

	public function get_home( )
	{
		$pages = db ( 'posts' );
				
		$home = $pages->select( '*' )
			->where ( 'menu_order', '=', '1' )
			->execute();
			
			return $home;
	}
	
	public function get_breadcrumbs( )
	{
		
	}

	public function get_descendant_ids( $id, $id_array = array() )
	{
		$id_array[] = $id;

		$pages = db ( 'posts' );
		
		$children = $pages->select( 'id', 'title' )
			->where ( 'parent', '=', $id )
			->clause ( 'AND' )
			->where ( 'type', '=', 'page' )
			->execute();

		$has_children = !empty($children);

		if ($has_children)
		{
			// Loop through all of the children and run this function again
			foreach ($children as $child)
			{
				$id_array = $this->get_descendant_ids($child->id, $id_array);
			}
		}

		return $id_array;
	}
	

	public function get_page_tree ( $page_dirty )
	{	
		$pages = array();		
		
		foreach ($page_dirty as $page) {
			$pages[$page->id] = (array) $page;
		}	
			
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
	public function has_children( $parent_id )
	{
		// Query the DB looking for parent_id
	}
	
	
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


	public function get_page_level ( $pages, $depth = 0 )
	{
		$page_list = array();
     
   		foreach ( (array) $pages as $page ):
            if ( $page['level'] == $depth ):
                $page_list[] = (array)$page;
            endif;
        endforeach;

        return $page_list;
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
	

	// Update Page
	//----------------------------------------------------------------------------------------------	
	public function update ( $id ) 
	{
		// create a new version of the content.

		$title         = $_POST['title'];
		$slug          = sanitize($title);
		$content       = $_POST['content'];
		$status        = $_POST['status'];
		$parent_page   = $_POST['parent_page'];
		//$post_template = $_POST['page_template'];
		
		$dirty_template = session::get( 'template' );
		
		if ( $dirty_template == '' ):
			$post_template = 'default';
		else:
			$post_template = $dirty_template;
		endif;
		
		
		$post_type     = $_POST['page-or-post'];
		
		$post_author   = user::id();
		
		$uri 			= $this->get_parent_uri( $parent_page ).$slug.'/';
		
		// Run content through HTMLawd and Samrty Text
		$page          = db('posts');
		
		$row = $page->update(array(
			'title'	=>$title,
			'slug'		=>$slug,
			'content'	=>$content,
			'status'	=>$status,
			'author'	=>$post_author,
			'type'		=>$post_type,
			'template'	=>$post_template,
			'parent'	=>$parent_page,
			'uri'		=>$uri,
			'modified'	=> time()
		))		
			->where( 'id', '=', $id )
			->execute();

	
		$scaffold_data = $_POST;

		$remove_keys = array( 'title', 'content', 'status', 'parent_page', 'page_template', 'page-or-post', 'history'  );
		
		foreach ( $remove_keys as $remove_key ):
			unset( $scaffold_data[ $remove_key ] );
		endforeach;
	
		$meta_value = serialize( $scaffold_data );

		$page_meta      = db('posts_meta');

		$page->update(array(
			'meta_key'=>'scaffold_data',
			'meta_value'=>$meta_value
		))
			->where( 'posts_id', '=', $id )
			->execute();
			
		note::set('success','page_update','Page Updated!');		
	}
	
	
	public function soft_delete ( $id='' ) 
	{
		$page_meta      = db('posts_meta');

		$page->update(array(
			'status'=>'trash'
		))
			->where( 'id', '=', $id )
			->execute();
			
		note::set('success','page_soft_delete','Moved to the trash.');	
	}
	
	
	public function is_delete ( $id='' ) 
	{
		$page	      = db('posts_meta');

		$deleted_page = $page->count( )
			->where ( 'id', '=', $id )
			->clause('AND')
			->where ( 'status', '=', 'trash' )
			->execute();
		
		$deleted_page = $page->total( );
		
		if ( $deleted_page >= 1 )
			return true;
	}
	

	// Add Page
	//----------------------------------------------------------------------------------------------	
	public function add ( ) 
	{
		$title         = $_POST['title'];
		$slug          = sanitize($title);
		$content       = $_POST['content'];
		$status        = $_POST['status'];
		$parent_page   = $_POST['parent_page'];
		//$post_template = $_POST['page_template'];
		
		$dirty_template = session::get( 'template' );
		
		if ( $dirty_template == '' ):
			$post_template = 'default';
		else:
			$post_template = $dirty_template;
		endif;
		
		
		$post_type     = $_POST['page-or-post'];
		
		$post_author   = user::id();
		
		$uri 			= $this->get_parent_uri( $parent_page ).$slug.'/';
		
		// Run content through HTMLawd and Samrty Text
		$page          = db('posts');
		
		$row = $page->insert(array(
			'title'	=>$title,
			'slug'		=>$slug,
			'content'	=>$content,
			'status'	=>$status,
			'author'	=>$post_author,
			'type'		=>$post_type,
			'template'	=>$post_template,
			'parent'	=>$parent_page,
			'uri'		=>$uri,
			'date'		=>time(),
			'modified'	=> time()
		));

	
		$scaffold_data = $_POST;

		$remove_keys = array( 'title', 'content', 'status', 'parent_page', 'page_template', 'page-or-post', 'history'  );
		
		foreach ( $remove_keys as $remove_key ):
			unset( $scaffold_data[ $remove_key ] );
		endforeach;
	
		$meta_value = serialize( $scaffold_data );

		$page_meta      = db('posts_meta');

		$page_meta->insert(array(
			'posts_id'=>$row->id,
			'meta_key'=>'scaffold_data',
			'meta_value'=>$meta_value
		));

		note::set('success','page_add','Page Added!');
		return $row->id;
	}
	
} // END setting_model
?>
