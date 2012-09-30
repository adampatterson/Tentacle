<?
class settings_model  
{
	// Add Setting
	//----------------------------------------------------------------------------------------------
	public function add ( $key, $value, $autoload )	
	{
		$setting = db('options');
		
		$result = $this->look_up( $key );
				
		if ( $result == false ):
		
			$setting->insert( array(
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
			$setting = db('options');

			$setting->update( array(
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
		$setting = db ( 'options' );
		
		$get_settings = $setting->select( '*' )
			->where( 'key', '=', $key )
			->execute();

		$count = $setting->count()
			->where( 'key', '=', $key )
			->execute();

		if ( $count == 0 ):
			return false;
		else:
			return $get_settings[0]->value;		
		endif;			
	}


	// Lookup Setting
	//----------------------------------------------------------------------------------------------	
	public function look_up( $key = '')	
	{
		$setting = db ( 'options' );
		
		$get_settings = $setting->select( '*' )
			->where( 'key', '=', $key )
			->order_by ( 'id', 'DESC' )
			->execute();

		$count = $setting->count()
			->where( 'key', '=', $key )
			->execute();

		if ( $count == 0 ):
			return false;
		else:
			return true;	
		endif;
	}
	
	
	// Delete Setting
	//----------------------------------------------------------------------------------------------
	public function delete ( $key = '' )	
	{
		$setting = db('options');

		$setting->delete( 'key','=',$key );
	}	
} // END setting_model