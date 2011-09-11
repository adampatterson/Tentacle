<?
 /*
Name: Page template
URI: http://tcms.me/
Description: This is the Tentacle default theme.
Author: Tentacle
Version: 1.0
License: GNU General Public License
License URI: license.txt
*/

/**
* @todo Make a template header and footer to include, then use the assets() pointing to the themes dundle folder. 
* assets( @array, minify, css)
*/

$resource_assets = array(
    'css' => 'dev_style.css',
    'js' => 'dev_javascript.js',
	'print' => 'dev_print.css:print'
);

load::theme_part('header',array('title'=>'Add a new snippet','assets'=>'application'));
?>

<?	load::theme_part('footer'); ?>