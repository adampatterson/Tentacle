<?php if(!defined('DINGO')){die('External Access to File Denied');}

//load::library('db');

route::set('(.*)',array(
    'controller'=>'page',
    'function'=>'index'
	));

// attachmentr route
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

/*
// blog route
route::set('blog',array(
    'controller'=>'blog',
    'function'=>'index'
	));

route::set('blog/([-_a-zA-Z0-9]+)',array(
    'controller'=>'blog',
    'function'=>'index',
    'arguments'=>array('$1')
	));
*/

// category route
route::set('category',array(
    'controller'=>'category',
    'function'=>'index'
	));

route::set('category/([-_a-zA-Z0-9]+)',array(
    'controller'=>'category',
    'function'=>'index',
    'arguments'=>array('$1')
	));


// comment route
route::set('comment/([-_a-zA-Z0-9]+)',array(
    'controller'=>'comment',
    'function'=>'index',
    'arguments'=>array('$1')
	));


// tag route
route::set('tag',array(
    'controller'=>'tag',
    'function'=>'index'
	));
	
route::set('tag/([-_a-zA-Z0-9]+)',array(
    'controller'=>'tag',
    'function'=>'index',
    'arguments'=>array('$1')
	));


// file route
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
	
// dev route
route::set('dev/([-_a-zA-Z0-9]+)',array(
    'controller'=>'dev',
    'function'=>'$1'
	));
	
// dev route
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

// dev index
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
	
route::set('ajax/([-_a-zA-Z0-9]+)',array(
    'controller'=>'ajax',
    'function'=>'$1'
	));
	
route::set('ajax/([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)',array(
    'controller'=>'ajax',
    'function'=>'$1'
	));
			
route::set('default_route','page/index');