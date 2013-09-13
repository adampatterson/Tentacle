<?
class delete_model {

    public $post_table;
    public $post_meta_table;

    public function post_table ( )
    {
        return $this->post_table = db ( 'posts' );
    }

    public function post_meta_table ( )
    {
        return $this->post_meta_table = db ( 'posts_meta' );
    }


    /**
	 * Mark a record as deleted
	 *
	 * @author Adam Patterson
	 */
	public function soft_delete ( $id='' ) 
	{
        $this->post_table()
            ->update(array(
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
		$deleted_page = $this->post_table()
            ->count( )
			->where ( 'id', '=', $id )
			->clause('AND')
			->where ( 'status', '=', 'trash' )
			->execute();
		
		$deleted_page = $this->post_table()->total( );
		
		if ( $deleted_page >= 1 )
			return true;
	}
}