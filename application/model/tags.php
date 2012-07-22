<?
class tags_model
{
	
	// Add tag
	//----------------------------------------------------------------------------------------------
	public function add ( $post_tags ) 
	{
		$term_name = $post_tags;
		
		$term_slug = camelize( $term_name );
		$term_slug = underscore( $term_slug );;
	
		$tag  = db( 'terms' );
		$term_taxonomy = db( 'term_taxonomy' );

		if ( !self::lookup( $term_slug ) ) 
		{
			$tag_id = $tag->insert(array(
						'name'=>$term_name,
						'slug'=>$term_slug
					));
			
					$term_taxonomy->insert(array(
						'taxonomy'=>'tag',
						'term_id'=>$tag_id->id
					),FALSE);
			
			return $tag_id->id;
		} else {
			return self::lookup( $term_slug );
		}		
	}
	
	
	// Update tag
	//----------------------------------------------------------------------------------------------
	public function update ( $id='' )
	{
		$term_name = input::post( 'name' );
		$term_slug = input::post( 'slug' );
		
		$term_slug = camelize( $term_slug );
		$term_slug = underscore( $term_slug );
		
		$tag  = db( 'terms' );
		
		$tag->update(array(
				'name'=>$term_name,
				'slug'=>$term_slug,
			))
			->where( 'id', '=', $id )
			->execute();
			
		note::set('success','tag_update','tag Updated!');
	}	
	

	// Lookuo tag
	//----------------------------------------------------------------------------------------------
	public function lookup ( $slug='' )
	{
		$tags = db ( 'terms' );
		
		$get_tag = $tags->select( '*' )
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
		$tags = db ( 'terms' );
		
		if ( $id == '' ) {
			$get_tags = $tags->select( '*' )
				->order_by ( 'id', 'DESC' )
				->execute();
			return $get_tags;
		} else {	
			$get_tag = $tags->select( '*' )
				->where ( 'id', '=', $id )
				->order_by ( 'id', 'DESC' )
				->execute();	
			
			return $get_tag[0];
		}
	}


    // Get tag List
    // @todo: return a comma seporated list ( with links )
    //----------------------------------------------------------------------------------------------
    public function get_list ( $list = array() )
    {
        $tags = db ( 'terms' );

        foreach( $list as $item ){
            
				$this->get( $item )->name; 
				
        }
		  
		  return $get_tag[0];
    }


	// Delete tag
	//----------------------------------------------------------------------------------------------
	public function delete_relations ( $post_id='' )
	{
		$term_relations = db::query("DELETE FROM term_relationships WHERE page_id=".$post_id );
	}


	// Delete tag
	//----------------------------------------------------------------------------------------------
	public function delete ( $id ) 
	{
		$tag = db( 'terms' );

		$tag->delete( 'id','=',$id );
	}
	
	
	// Set the tag relations for a blog post.
	//----------------------------------------------------------------------------------------------	
	public function relations ( $post_id = '', $term_id = '', $update = false ) 
	{	
		$term         = db('term_relationships');

		if ( $update == true)
			$term_relations = db::query("DELETE FROM term_relationships WHERE page_id=".$post_id );

		$term->insert(array(
			'page_id'		=> $post_id,
			'term_id'		=> $term_id,
		),FALSE);
	}

	
	// Get the tag relations of a blog post.
	//----------------------------------------------------------------------------------------------	
	public function get_relations ( $post_id = '' ) 
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
										term_taxonomy.taxonomy = 'tag' AND
										term_relationships.page_id = ".$post_id );
			
		return $term_relations;
	}
	
	
	public function get_all_tags ( ) 
	{	
		
		$term_relations = db::query("SELECT t.*, tt.* FROM terms AS t INNER JOIN term_taxonomy AS tt ON t.id = tt.term_id WHERE tt.taxonomy IN ('tag') ORDER BY t.name ASC" );
			
		return $term_relations;
	}
}