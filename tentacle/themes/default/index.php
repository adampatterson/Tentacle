<?
/*
Theme Name: Default Tentacle Theme
Theme URI: http://tcms.me/
Description: This is the Tentacle default thgeme.
Author: Tentacle
Version: 1.0
Require: 1.0
License: GNU General Public License
License URI: license.txt
*/
/*
$settings = array(
    'id'          => 'default_theme',
    'title'       => 'Default Theme',
    'description' => 'This is the Default theme for Tentacle.',
    'version'     => '1.0',
	'license'     => 'GPL',
	'author'      => 'Adam Patterson',
    'website'     => 'http://www.adampatterson.ca/',
    'update_url'  => 'http://www.adampatterson.ca/theme-versions.xml',
    'require_tentacle_version' => '1.0'
);
*/


if (CONFIGURATION == 'deployment'){
	$resource_assets = array(
	    'css' => 'deploy_style.css',
	    'js' => 'deploy_javascript.js',
    	'print' => 'deploy_print.css:print'
	);
} else {
	$resource_assets = array(
	    'css' => 'dev_style.css',
	    'js' => 'dev_javascript.js',
    	'print' => 'dev_print.css:print'
	);
}// END if
?>