<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Theme Library For Dingo Framework
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/theme-library
 */

class theme
{
	private $dingo;
	private $current = 'default';
	
	
	// Construct
	// ---------------------------------------------------------------------------
	public function __construct($dingo)
	{
		$this->dingo = $dingo;
		
		if($current = config::get('current_theme'))
		{
			$this->current = $current;
		}
	}
	
	
	// Set
	// ---------------------------------------------------------------------------
	public function set($theme)
	{
		$this->current = $theme;
	}
	
	
	// Theme
	// ---------------------------------------------------------------------------
	public function view($view,$data=NULL)
	{
		// Try to load view from theme
		if(file_exists(config::get('application')."/views/{$this->current}/$view.php"))
		{
			$this->dingo->load->view("{$this->current}/$view",$data);
		}
		
		// If view not found in theme try to load from default theme
		elseif($this->current != 'default' AND file_exists(config::get('application')."/views/default/$view.php"))
		{
			$this->dingo->load->view("default/$view",$data);
		}
		
		// Otherwise throw an error
		else
		{
			dingo_error(E_USER_WARNING,'The requested theme view ('.config::get('application')."/views/{$this->current}/$view.php) could not be found.");
		}
	}
}

register::library('theme',new theme($dingo));