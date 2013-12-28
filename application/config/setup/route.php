<?php if(!defined('DINGO')){die('External Access to File Denied');}

// admin route
route::set('install/([-_a-zA-Z0-9]+)',array(
    'controller'=>'install',
    'function'=>'$1',
    //'arguments'=>array('')
	));
	
route::set('ajax/([-_a-zA-Z0-9]+)',array(
    'controller'=>'ajax',
    'function'=>'$1'
	));

route::set('ajax/([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)',array(
    'controller'=>'ajax',
    'function'=>'$1'
	));

// Default Route
route::set('default_route','install/step1');

//route::set('main/([a-zA-Z]+)/([a-zA-Z]+)',array('controller'=>'$1','function'=>'awesome','arguments'=>array('$2')));
//route::set('one/([a-zA-Z]+)/([a-zA-Z]+)','query/$1/$2' );