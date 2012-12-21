<?
class category_model {

	// Add Category
	//----------------------------------------------------------------------------------------------
	public function add() 
	{
		$term_name = input::post( 'name' );         
		$term_slug = input::post( 'slug' );
		
		$term_slug = string::camelize( $term_slug );
		$term_slug = string::underscore( $term_slug );;
		
		$category  = db( 'terms' );

		$category_id = $category->insert(array(
			'name'=>$term_name,
			'slug'=>$term_slug
		));

		$term_taxonomy  = db( 'term_taxonomy' );

		$term_taxonomy->insert(array(
			'taxonomy'=>'category',
			'term_id'=>$category_id->id
		),FALSE);

		note::set('success','category_add','Category Added!');
		
		return $category_id;		
	}


	// Update Category
	//----------------------------------------------------------------------------------------------
	public function update( $id='' )
	{
		$term_name = input::post( 'name' );
		$term_slug = input::post( 'slug' );
		
		$term_slug = string::camelize( $term_slug );
		$term_slug = string::underscore( $term_slug );
		
		$category  = db( 'terms' );
		
		$category->update( array(
				'name'=>$term_name,
				'slug'=>$term_slug,
			) )
			->where( 'id', '=', $id )
			->execute();
			
		note::set('success','category_update','Category Updated!');
	} 


	// Get Category
	//----------------------------------------------------------------------------------------------
	public function get( $id='' )
	{
		$categories = db( 'terms' );
		
		if ( $id == '' ):
            $get_categories = $categories->select( '*' )
                ->order_by( 'id', 'DESC' )
                ->execute();

            return $get_categories;
		elseif( is_string( $id ) ):
            $get_categories = $categories->select( '*' )
                ->where( 'slug', '=', $id )
                ->order_by( 'id', 'DESC' )
                ->execute();

            return $get_categories[0];
        else:
			$get_category = $categories->select( '*' )
				->where( 'id', '=', $id )
				->order_by( 'id', 'DESC' )
				->execute();	
			
			return $get_category[0];
		endif;
	}
	

	// Delete Category
	//----------------------------------------------------------------------------------------------
	public function delete_relations( $post_id='' )
	{
		$term_relations = db::query("DELETE FROM term_relationships WHERE page_id=".$post_id );

        return null;
	}


	// Delete Category
	//----------------------------------------------------------------------------------------------
	public function delete( $id ) 
	{
		$category = db( 'terms' );

		$category->delete( 'id','=',$id );
	}
	
	
	// Set the Category relations for a blog post.
	//----------------------------------------------------------------------------------------------	
	public function relations( $post_id = '', $categories = '', $update = false ) 
	{	
		$term         = db('term_relationships');

		if ( $update == true)
			$term_relations = $this->delete_relations( $post_id );

		foreach ( $categories as $term_id ):
			$term->insert( array(
				'page_id'		=> $post_id,
				'term_id'		=> $term_id,
			), FALSE );
		endforeach;
	}

	
    public function get_by_slug( $slug = '' ) {

        $posts_by_slug = db::query("SELECT posts.*
                                    FROM
                                        term_relationships
                                    INNER JOIN posts
                                    ON term_relationships.page_id = posts.id
                                    INNER JOIN terms
                                    ON term_relationships.term_id = terms.id
                                    INNER JOIN term_taxonomy
                                    ON terms.id = term_taxonomy.term_id
                                    WHERE
                                        term_taxonomy.taxonomy = 'category'
                                        AND terms.slug = '".$slug."'" );

        return $posts_by_slug;
    }

    public function get_page_ids( $term_id = '' )
    {
        $post_id = db::query("SELECT
                page_id
            FROM
                term_relationships
            WHERE
                term_id = ".$term_id );

        foreach($post_id as $id) {
            $post_array[] = $id->page_id;
        }

        return $post_array;
    }


	// Get all other categories associated with this page.
	//----------------------------------------------------------------------------------------------	
	public function get_relations( $post_id = '' )
	{	
        $term_relations = db::query("SELECT
                                    terms.id,
                                    terms.name,
                                    terms.slug,
                                    term_taxonomy.taxonomy,
                                    term_taxonomy.description,
                                    term_taxonomy.parent,
                                    term_taxonomy.`count`,
                                    term_relationships.page_id,
                                    term_relationships.term_order
                                FROM
                                    terms terms,
                                    term_taxonomy term_taxonomy,
                                    term_relationships term_relationships
                                WHERE
                                    terms.id = term_taxonomy.term_id AND
                                    terms.id = term_relationships.term_id AND
                                    term_taxonomy.taxonomy = 'category' AND
                                    term_relationships.page_id = ".$post_id );

		return $term_relations;
	}
	
	
	public function get_all_categories( ) 
	{	
		$term_relations = db::query("SELECT t.*, tt.* FROM terms AS t INNER JOIN term_taxonomy AS tt ON t.id = tt.term_id WHERE tt.taxonomy IN ('category') ORDER BY t.name ASC" );
			
		return $term_relations;
	}
}