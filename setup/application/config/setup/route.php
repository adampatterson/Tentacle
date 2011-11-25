<?php if(!defined('DINGO')){die('External Access to File Denied');}


// Default Route
route::set('default_route','main');

// admin route
route::set('step/install/([-_a-zA-Z0-9]+)',array(
    'controller'=>'install',
    'function'=>'step.$1',
    //'arguments'=>array('')
	));

//route::set('main/([a-zA-Z]+)/([a-zA-Z]+)',array('controller'=>'$1','function'=>'awesome','arguments'=>array('$2')));
//route::set('one/([a-zA-Z]+)/([a-zA-Z]+)','query/$1/$2' );