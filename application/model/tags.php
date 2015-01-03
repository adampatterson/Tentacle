<?
load::helper( 'data_properties' );

class tags_model extends properties
{
    // Add tag
	//----------------------------------------------------------------------------------------------
	public function add ( $post_tags )
	{
        if(is_array($post_tags))
            $term_name = $post_tags['tag_name'];
        else
            $term_name = $post_tags;

        $term_slug = string::sanitize( $term_name );

        if ( !self::lookup( $term_slug ) and $post_tags != '' ):
            $tag_id = $this->term_table()
                ->insert(array(
                'name'=>$term_name,
                'slug'=>$term_slug
            ));

            $this->term_taxonomy_table()->insert(array(
                'taxonomy'=>'tag',
                'term_id'=>$tag_id->id
            ),FALSE);

			return $tag_id->id;
		else:
            return self::lookup( $term_slug );
		endif;	
	}
	
	
	// Update tag
	//----------------------------------------------------------------------------------------------
	public function update ( $id='' )
	{
		$term_name = input::post( 'name' );
		$term_slug = input::post( 'slug' );
		
		$term_slug = string::camelize( $term_slug );
		$term_slug = string::underscore( $term_slug );

        $this->term_table()
            ->update(array(
				'name'=>$term_name,
				'slug'=>$term_slug,
			))
			->where( 'id', '=', $id )
			->execute();
			
		note::set('success','tag_update','tag Updated!');
	}	
	

	// Lookup tag
	//----------------------------------------------------------------------------------------------
	public function lookup ( $slug='' )
	{
		$get_tag = $this->term_table()
            ->select( '*' )
			->where ( 'slug', '=', $slug )
			->order_by ( 'id', 'DESC' )
			->execute();	
		
		if ($get_tag) 
		{
			return $get_tag[0]->id;
			
		} else {
			return false;
		}
	}
	
	// Get tag
	//----------------------------------------------------------------------------------------------
	public function get ( $id='' )
	{
		if ( $id == '' ):
			$get_tags = $this->term_table()
                ->select( '*' )
				->order_by ( 'id', 'DESC' )
				->execute();
			return $get_tags;
    elseif( is_string( $id ) && !is_numeric($id) ):
        $get_tags = $this->term_table()
            ->select( '*' )
            ->where( 'slug', '=', $id )
            ->order_by( 'id', 'DESC' )
            ->execute();

        if($get_tags == null ){
            return false;
        } else {
            return $get_tags[0];
        }
    else:
    $get_tag = $this->term_table()
              ->select( '*' )
      ->where ( 'id', '=', $id )
      ->order_by ( 'id', 'DESC' )
      ->execute();
			
			return $get_tag[0];
		endif;
	}


    // Get tag List
    // @todo: return a comma seporated list ( with links )
    //----------------------------------------------------------------------------------------------
    public function get_list ( $list = array() )
    {
      foreach( $list as $item )
      $get_tag[] = $this->term_table()->get( $item )->name;

		  return $get_tag[0];
    }


	// Delete tag
	//----------------------------------------------------------------------------------------------
	public function delete_relations ( $post_id='' )
	{
		return db::query("DELETE FROM term_relationships WHERE page_id=".$post_id );
	}


	// Delete tag
	//----------------------------------------------------------------------------------------------
	public function delete ( $id ) 
	{
		$this->term_table()->delete( 'id','=',$id );
	}
	
	
	// Set the tag relations for a blog post.
	//----------------------------------------------------------------------------------------------	
	public function relations ( $post_id = '', $term_id = '')
	{
		return $this->term_relationship_table()
            ->insert(array(
                'page_id'		=> $post_id,
                'term_id'		=> $term_id,
            ),FALSE);
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
                                        term_taxonomy.taxonomy = 'tag'
                                        AND terms.slug = '".$slug."'
                                        AND posts.status = 'published'");
    }


    public function get_page_ids( $term_id = '' )
    {
        return db::query("SELECT
                page_id
            FROM
                term_relationships
            WHERE
                term_id = ".$term_id );
    }


	// Get the tag relations of a blog post.
	//----------------------------------------------------------------------------------------------	
	public function get_relations ( $post_id = '' ) 
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
										term_taxonomy.taxonomy = 'tag' AND
										term_relationships.page_id = ".$post_id );
	}
	
	
	public function get_all_tags ( ) 
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
                                      term_taxonomy.taxonomy = 'tag'
                                    ORDER BY terms.name ASC" );
	}
}