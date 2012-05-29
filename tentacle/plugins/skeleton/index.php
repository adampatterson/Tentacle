<?
Plugin::setInfos(array(
    'id'          => 'skeleton',
    'title'       => 'Skeleton',
    'description' => 'Provides a basic plugin implementation. (try enabling it!)',
    'version'     => '0.0.1',
    'license'     => 'GPL',
    'author'      => 'Adam Patterson',
    'website'     => 'http://www.adampatterson.ca/',
    'update_url'  => 'http://www.adampatterson.ca/plugin-versions.xml',
    'require_tentacle_version' => '0.0.1'
));

/*
class Module_Wordpress_import extends Module
{
	public $version = '1.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'WordPress Import'
			),
			'description' => array(
				'en' => 'Import a WordPress site into PyroCMS.'
			),
			'frontend' => false,
			'backend' => true
		);
	}

	public function install()
	{
		// Make sure the folder exists and is writable
		return is_dir($this->upload_path.'wp') or @mkdir($this->upload_path.'wp',0777,TRUE);
	}

	public function uninstall()
	{
		return rmdir($this->upload_path.'wp');
	}

	public function upgrade($old_version)
	{
		return true;
	}

	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
	}
}
*/
/* End of file details.php */
