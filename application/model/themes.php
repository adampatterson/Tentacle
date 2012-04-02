<?
class themes_model 
{
	public function __construct ()
	{
		//tentacle::valid_user();
	}
	
	public function get_themes () 
	{
		return (object)get_themes();
	}
	
	public function theme_settings ( $theme = '' )
	{
		return get_settings('/$theme');
	}
	
	public function theme_resources ( $theme = 'default' )
	{
		return get_resources(THEMES_DIR.'/$theme');
	}
	
	public function get_templates ( $theme = 'default' )
	{
		return get_templates(THEMES_DIR.'/$theme');
	}
}