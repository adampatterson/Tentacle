<?
if(!defined('SCAFFOLD')):
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
<h1>Index</h1>

<? endif;?>