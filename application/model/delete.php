<?
class delete_model {
	
	/**
	 * Mark a record as deleted
	 *
	 * @author Adam Patterson
	 */
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
	
	
	/**
	 * Is the record marked as deleted?
	 *
	 * @author Adam Patterson
	 */
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
	
}