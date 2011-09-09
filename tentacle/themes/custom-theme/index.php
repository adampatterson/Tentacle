<?
$settings = array(
    'id'          => 'custom_theme',
    'title'       => 'Custom Theme',
    'description' => 'This is the Custom theme for Tentacle.',
    'version'     => '1.0',
   	'license'     => 'GPL',
	'author'      => 'Adam Patterson',
    'website'     => 'http://www.adampatterson.ca/',
    'update_url'  => 'http://www.adampatterson.ca/theme-versions.xml',
    'require_tentacle_version' => '1.0'
);


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