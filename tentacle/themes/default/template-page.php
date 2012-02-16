<?
 /*
Name: Page
*/

$data = array(
	'display' => 'admin'
);

if(!defined('SCAFFOLD')):
$resource_assets = array(
    'css' => 'dev_style.css',
    'js' => 'dev_javascript.js',
	'print' => 'dev_print.css:print'
);

load::theme_part('header',array('title'=>'Page Template','assets'=>'default'));?>

<?	load::theme_part('footer'); 
endif; ?>