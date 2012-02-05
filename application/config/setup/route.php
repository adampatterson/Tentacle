<?php if(!defined('DINGO')){die('External Access to File Denied');}

// admin route
route::set('install/([-_a-zA-Z0-9]+)',array(
    'controller'=>'install',
    'function'=>'$1',
    //'arguments'=>array('')
	));

// Default Route
route::set('default_route','install/agree');

//route::set('main/([a-zA-Z]+)/([a-zA-Z]+)',array('controller'=>'$1','function'=>'awesome','arguments'=>array('$2')));
//route::set('one/([a-zA-Z]+)/([a-zA-Z]+)','query/$1/$2' );