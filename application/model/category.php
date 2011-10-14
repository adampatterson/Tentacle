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
				'slug'=>$term_slug
			))
			->where( 'id', '=', $id )
			->execute();
			
		note::set('success','snippet_update','Snippet Updated!');
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

		$category->insert(array(
			'name'=>$term_name,
			'slug'=>$term_slug
		),FALSE);

		note::set('success','category_add','Category Added!');		
	}
}