<?
class settings_model  
{
	
	// Get Setting
	//----------------------------------------------------------------------------------------------	
	public function get ( $key = '' )	
	{

		$setting = db ( 'options' );
		
		$get_settings = '';

		if ( $key != '' ):
	
			$get_settings = $setting->select( '*' )
				->where( 'key', '=', $key )
				->order_by ( 'id', 'DESC' )
				->execute();

			if ( !isset($get_settings) ) {
				return false;
			}

			return $get_settings;
			
		else:
		
			return false;
		
		endif;
	}
	
	// Delete Setting
	//----------------------------------------------------------------------------------------------
	public function delete ( $key = '' )	
	{
		$setting = db('options');

		$setting->delete( 'key','=',$key );
	}

	// Add Setting
	//----------------------------------------------------------------------------------------------
	public function add ( $key, $value, $autoload )	
	{
		$setting = db('options');
		
		$setting->insert( array(
				'key' => $key,
				'value' => $value,
				'autoload' => $autoload
			), FALSE );
	}
	
	// Update Setting
	//----------------------------------------------------------------------------------------------
	public function update ( $key = '', $value = '' )	
	{
		$autoload = 'yes';
			
		if ( $this->get( $key ) == false ):
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
	
} // END setting_model