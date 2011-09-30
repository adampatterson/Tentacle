<?
class settings_model  
{
	/*
		site_title
		tagline
		base_url
		admin_email
		
		membership
		default_role
		timezone
		date_format
		time_format
		week_starts_on
		
		google_analytics
		google_webmaster_tools
		yahoo_explorer
		bing_webmaster
		
		robot_spider
		robot_noindex
		
		meta_description
		
		default_category
		update_services
		
		front_page
		posts_page
		posts_per_page
		feed_items
		feed_text
		encoding
		
		default_article_setting
		comment_rules
		comment_settings
		comment_appear
		comment_blacklist
		
		email_notification
		
		avatar_show
		avatar_rating
		avatar_default
		
		image_thumb_size
		image_medium_size
		image_large_size
		
		upload_folder
		upload_url
		upload_organize
		
		site_visibility
		maintenance_mode
		
		import
		
		export
		
	*/
	
	// Get Setting
	//----------------------------------------------------------------------------------------------	
	public function get ( $key = '' )	
	{
		/*
		$setting = db ( 'options' );

		if ( $key == '' ) {
			$get_settings = $setting->select( '*' )
				->order_by ( 'id', 'DESC' )
				->execute();
					
			return $get_settings;
		
		
		if ( get == no ):
			return $value;
		else:
			return false;
		endif;
		*/
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
	public function add ( $key = '' )	
	{
		
	}
	
	// Update Setting
	//----------------------------------------------------------------------------------------------
	public function update ( $key = '', $value = '' )	
	{
		if ( $this->get( $key ) == false ):
			$this->add( $key, $value );
		else:
			$setting = db('options');

			$setting->update(array(
					'key'=>$key,
					'value'=>$value
				))
				->where( 'key', '=', $key )
				->execute();
		endif;		
	}
	
} // END setting_model