<?
class category_model
{

	// Get Category
	//----------------------------------------------------------------------------------------------
	public function get ( $id='' )
	{
		$categories = db ( 'terms' );
		
		if ( $id == '' ) {
			$get_categories = $categories->select( '*' )
				->order_by ( 'id', 'DESC' )
				->execute();
			return $get_categories;
		} else {	
			$get_category = $categories->select( '*' )
				->where ( 'id', '=', $id )
				->order_by ( 'id', 'DESC' )
				->execute();	
			
			return $get_category[0];
		}
	}


    // Get Category List
    // @todo: return a comma seporated list ( with links )
    //----------------------------------------------------------------------------------------------
    public function get_list ( $list = array() )
    {
        $categories = db ( 'terms' );

        foreach( $list as $item ){
            
				$this->get( $item )->name; 
				
        }
		  
		  return $get_category[0];
    }
	
	
	// Update Category
	//----------------------------------------------------------------------------------------------
	public function update ( $id='' )
	{
		$term_name = input::post ( 'name' );
		$term_slug = input::post ( 'slug' );
		
		$inflector = new inflector( );
		$term_slug = $inflector->camelize( $term_slug );
		$term_slug = $inflector->underscore( $term_slug );
		
		$category  = db( 'terms' );
		
		$category->update(array(
				'name'=>$term_name,
				'slug'=>$term_slug,
			))
			->where( 'id', '=', $id )
			->execute();
			
		note::set('success','category_update','Category Updated!');
	} 


	// Delete Category
	//----------------------------------------------------------------------------------------------
	public function delete_relations ( $post_id='' )
	{
		$term_relations = db::query("DELETE FROM term_relationships WHERE page_id=".$post_id );
	}


	// Delete Category
	//----------------------------------------------------------------------------------------------
	public function delete ( $id ) 
	{
		$category = db( 'terms' );

		$category->delete( 'id','=',$id );
	}
	
	
	// Add Category
	//----------------------------------------------------------------------------------------------
	public function add ( ) 
	{
		$term_name = input::post ( 'name' );
		$term_slug = input::post ( 'slug' );
		
		$inflector = new inflector( );
		$term_slug = $inflector->camelize( $term_slug );
		$term_slug = $inflector->underscore( $term_slug );;
		
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
	
	
	// Set the Category relations for a blog post.
	//----------------------------------------------------------------------------------------------	
	public function relations ( $post_id = '', $categories = '', $update = false ) 
	{	
		$term         = db('term_relationships');

		if ( $update == true)
			$term_relations = db::query("DELETE FROM term_relationships WHERE page_id=".$post_id );

		foreach ( $categories as $term_id ):
			$term->insert(array(
				'page_id'		=> $post_id,
				'term_id'		=> $term_id,
			),FALSE);
		endforeach;
	}

	
	// Get the Category relations of a blog post.
	//----------------------------------------------------------------------------------------------	
	/*
	[id] => 1
	            [name] => Default
	            [slug] => default
	            [taxonomy] => category
	            [description] => 
	            [parent] => 0
	            [count] => 0
	            [page_id] => 79
	            [term_order] =>
	*/
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
										term_taxonomy.taxonomy = 'category' AND
										term_relationships.page_id = ".$post_id );
			
		return $term_relations;
	}
}