<?php if(!defined('DINGO')){die('External Access to File Denied');}

/*
'int'           '([0-9]+)'
'numeric'       '([0-9\.]+)'
'alpha'         '([a-zA-Z]+)'
'alpha-int'     '([a-zA-Z0-9]+)'
'alpha-numeric' '([a-zA-Z0-9\.]+)'
'words'         '([_a-zA-Z0-9\- ]+)'
'any'           '(.*?)'
'extension'     '([a-zA-Z]+)\.([a-zA-Z]+)'
*/

route::set('(.*)',array(
  'controller'=>'page',
  'function'=>'index'
));

// attachment route
/* (jpg|png|gif|bmp)
route::set('attachment/([0-9]+)x([0-9]+)/([^\s]+)\.',array(
    'controller'=>'attachment',
    'function'=>'file',
    'arguments'=>array('$1','$2','$3')
	));
*/

route::set('attachment',array(
  'controller'=>'attachment',
  'function'=>'file'
));

// comment
route::set('comment/([-_a-zA-Z0-9]+)',array(
  'controller'=>'comment',
  'function'=>'index',
  'arguments'=>array('$1')
));

// file
route::set('attachment',array(
  'controller'=>'attachment',
  'function'=>'index'
));

// admin route
route::set('admin/([-_a-zA-Z0-9]+)',array(
  'controller'=>'admin',
  'function'=>'$1'
));

route::set('admin/([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)',array(
  'controller'=>'admin',
  'function'=>'$1',
  'arguments'=>array('$2')
));

route::set('admin',array(
  'controller'=>'admin',
  'function'=>'index'
));

// Actoin
route::set('action',array(
  'controller'=>'action',
  'function'=>'index'
));

route::set('action/([-_a-zA-Z0-9]+)',array(
  'controller'=>'action',
  'function'=>'$1'
));

route::set('action/([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)',array(
  'controller'=>'action',
  'function'=>'$1',
'arguments'=>array('$2')
));

route::set('action/([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)',array(
  'controller'=>'action',
  'function'=>'$1',
'arguments'=>array('$2','$3')
));


// API
route::set('api',array(
  'controller'=>'api',
  'function'=>'index'
));

route::set('api/([-_a-zA-Z0-9]+)',array(
  'controller'=>'api',
  'function'=>'$1'
));

route::set('api/([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)',array(
  'controller'=>'api',
  'function'=>'$1',
  'arguments'=>array('$2')
));

route::set('api/([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)',array(
  'controller'=>'api',
  'function'=>'$1',
  'arguments'=>array('$2','$3')
));


// dev route
route::set('dev/([-_a-zA-Z0-9]+)',array(
  'controller'=>'dev',
  'function'=>'$1'
));

route::set('dev/([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)',array(
  'controller'=>'dev',
  'function'=>'$1',
  'arguments'=>array('$2')
));

route::set('dev/([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)',array(
  'controller'=>'dev',
  'function'=>'$1',
  'arguments'=>array('$2','$3')
));

route::set('dev',array(
  'controller'=>'dev',
  'function'=>'index'
));


// install rout
route::set('install',array(
  'controller'=>'install',
  'function'=>'step1',
));

route::set('install/([-_a-zA-Z0-9]+)',array(
  'controller'=>'install',
  'function'=>'$1',
  'arguments'=>array('$1')
));

// Install
route::set('ajax/([-_a-zA-Z0-9]+)',array(
  'controller'=>'ajax',
  'function'=>'$1'
));

route::set('ajax/([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)',array(
  'controller'=>'ajax',
  'function'=>'$1',
  'arguments'=>array('$2')
));

route::set('default_route','page/index');
