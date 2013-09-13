<?
class settings_model  
{
    public $options_table;

    public function options_table( )
    {
        return $this->options_table = db ( 'options' );
    }


	// Add Setting
	//----------------------------------------------------------------------------------------------
	public function add ( $key, $value, $autoload )	
	{
		$result = $this->look_up( $key );
				
		if ( $result == false ):

            $this->options_table()->insert( array(
					'key' => $key,
					'value' => $value,
					'autoload' => $autoload
				), FALSE );
		endif;	
	}
	
	
	// Update Setting
	//----------------------------------------------------------------------------------------------
	public function update ( $key = '', $value = '' )	
	{	
		$autoload = 'yes';
			
		$result = $this->look_up( $key );
				
		if ( $result == false ):
			$this->add( $key, $value, $autoload );
		else:

            $this->options_table()
                ->update( array(
					'key' => $key,
					'value' => $value,
					'autoload' => $autoload
				) )
				->where( 'key', '=', $key )
				->execute();			
		endif;		
	}
	
		
	// Get Setting
	//----------------------------------------------------------------------------------------------	
	public function get ( $key = '' )	
	{
		$get_settings = $this->options_table()
            ->select( '*' )
			->where( 'key', '=', $key )
			->execute();

        if( empty( $get_settings)  )
            return false;
		else
			return $get_settings[0]->value;
	}


	// Lookup Setting
	//----------------------------------------------------------------------------------------------	
	public function look_up( $key = '')	
	{
		$get_settings = $this->options_table()
            ->select( '*' )
			->where( 'key', '=', $key )
			->order_by ( 'id', 'DESC' )
			->execute();

        if( empty( $get_settings)  )
			return false;
		else
			return true;
	}
	
	
	// Delete Setting
	//----------------------------------------------------------------------------------------------
	public function delete ( $key = '' )	
	{
		$this->options_table()->delete( 'key','=',$key );
	}	
}