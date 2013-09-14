<?
load::helper( 'data_properties' );

/*
    const TABLE_NAME = 'snippet';
    
    public $name;
    public $filter_id;
    public $content;
    public $content_html;
    
    public $created_on;
    public $updated_on;
    public $created_by_id;
    public $updated_by_id;
 */

class snippet_model extends properties
{
    // Add Snippet
	//----------------------------------------------------------------------------------------------
	public function add () 
	{
		$name            = input::post( 'name' );
		$created_by      = user::id();
		$snippet_content = input::post( 'content' );
		$filter          = input::post( 'filter' );
		
		$slug            = string::camelize($name);
		$slug            = string::underscore($slug);

        $this->snippet_table()
            ->insert(array(
                'name'=>$name,
                'slug'=>$slug,
                'created_by'=>$created_by,
                'content'=>$snippet_content,
                'filter'=>$filter
            ),FALSE);

		note::set('success','snippet_add','Snippet Added!');
	}
	

	// Update Snippet
	//----------------------------------------------------------------------------------------------
	public function update ( $id )
	{
		$name            = input::post( 'name' );
		$updated_by      = user::id();
		$snippet_content = input::post( 'content' );
		$filter          = input::post( 'filter' );
		
		$slug            = string::camelize( $name );
		$slug            = string::underscore( $slug );
		
        $this->snippet_table()
            ->update(array(
				'name'=>$name,
				'slug'=>$slug,
				'updated_by'=>$updated_by,
				'content'=>$snippet_content,
				'filter'=>$filter
			))
			->where( 'id', '=', $id )
			->execute();
			
		note::set('success','snippet_update','Snippet Updated!');
	} 
	
	
	// Get Snippet
	//----------------------------------------------------------------------------------------------
	public function get ( $id='' )
	{

		if ( $id == '' ) {
			$get_snippets = $this->snippet_table()
                ->select( '*' )
				->order_by ( 'name', 'DESC' )
				->execute();
					
			return $get_snippets;
		} else {	
			$get_snippets = $this->snippet_table()
                ->select( '*' )
				->where ( 'id', '=', $id )
				->execute();	
			
			return $get_snippets[0];
		}		
	}
	
	
	// Get by Slug
	//----------------------------------------------------------------------------------------------
	public function get_slug ( $slug='' )
	{
		$get_snippet = $this->snippet_table()
            ->select( '*' )
			->where ( 'slug', '=', $slug )
			->execute();

		return $get_snippet[0];
	}


	// Delete Snippet
	//----------------------------------------------------------------------------------------------	
	public function delete ( $id='' ) 
	{
        $this->snippet_table()->delete( 'id','=',$id );
	}
}