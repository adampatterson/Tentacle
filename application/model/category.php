<?
load::helper( 'data_properties' );

class category_model extends properties {

	// Add Category
	//----------------------------------------------------------------------------------------------
	public function add( $import_category = '' )
	{
		if(is_array($import_category)) {
            $term_name = $import_category['category_name'];
            $term_slug = $import_category['category_slug'];
        } else {
            $term_name = input::post( 'name' );
            $term_slug = input::post( 'slug' );
        }

        $term_slug = string::sanitize( $term_slug );

        if ( !self::lookup( $term_slug ) )
        {
            $category_id = $this->term_table()
                    ->insert(array(
                    'name'=>$term_name,
                    'slug'=>$term_slug
                ));

            $this->term_taxonomy_table()
                    ->insert(array(
                    'taxonomy'=>'category',
                    'term_id'=>$category_id->id
                ),FALSE);

            note::set('success','category_add','Category Added!');

            return $category_id->id;
        } else {
            return self::lookup( $term_slug );
        }
	}


	// Update Category
	//----------------------------------------------------------------------------------------------
	public function update( $id='' )
	{
		$term_name = input::post( 'name' );
		$term_slug = input::post( 'slug' );
		
		$term_slug = string::camelize( $term_slug );
		$term_slug = string::underscore( $term_slug );

        $this->term_table()
                ->update( array(
				'name'=>$term_name,
				'slug'=>$term_slug,
			) )
			->where( 'id', '=', $id )
			->execute();
			
		note::set('success','category_update','Category Updated!');
	}


    // Lookup Category
    //----------------------------------------------------------------------------------------------
    public function lookup ( $slug='' )
    {
        $get_category = $this->term_table()
            ->select( '*' )
            ->where ( 'slug', '=', $slug )
            ->order_by ( 'id', 'DESC' )
            ->execute();

        if ($get_category)
            return $get_category[0]->id;

        return false;
    }


	// Get Category
	//----------------------------------------------------------------------------------------------
	public function get( $id='' )
	{
		if ( $id == '' ):
            return $this->term_table()
                ->select( '*' )
                ->order_by( 'id', 'DESC' )
                ->execute();

		elseif( is_string( $id ) && !is_numeric($id) ):
            $get_categories = $this->term_table()
                ->select( '*' )
                ->where( 'slug', '=', $id )
                ->order_by( 'id', 'DESC' )
                ->execute();

            if($get_categories == null ){
                return false;
            } else {
                return $get_categories[0];
            }
        else:
			$get_category = $this->term_table()
                ->select( '*' )
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
    return db::query("DELETE FROM term_relationships WHERE page_id=".$post_id );
	}


	// Delete Category
	//----------------------------------------------------------------------------------------------
	public function delete( $id ) 
	{
        $this->term_table()->delete( 'id','=',$id );
	}
	
	
	// Set the Category relations for a blog post.
	//----------------------------------------------------------------------------------------------	
	public function relations( $post_id = '', $term_id = '' )
	{
        return $this->term_relationship_table()->insert( array(
            'page_id'		=> $post_id,
            'term_id'		=> $term_id,
        ), FALSE );
	}

	
    public function get_by_slug( $slug = '' ) {

        return db::query("SELECT posts.*
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
                                        AND terms.slug = '".$slug."'
                                        AND posts.status = 'published'");
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
        return db::query("SELECT
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
	}
	
	
	public function get_all_categories( ) 
	{
        return db::query("SELECT term_taxonomy.taxonomy
                                         , term_taxonomy.description
                                         , term_taxonomy.parent
                                         , term_taxonomy.count
                                         , terms.*
                                         , terms.name
                                         , terms.slug
                                    FROM
                                      terms
                                    INNER JOIN term_taxonomy
                                    ON terms.id = term_taxonomy.term_id
                                    WHERE
                                      term_taxonomy.taxonomy = 'category'
                                    ORDER BY terms.name ASC" );
	}
}