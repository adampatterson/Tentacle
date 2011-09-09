<?php if(!defined('DINGO')){die('External Access to File Denied');}

// page route
route::set('([-_a-zA-Z0-9]+)',array(
    'controller'=>'page',
    'function'=>'article',
    'arguments'=>array('$1')
	));

// page/page route
route::set('([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)',array(
    'controller'=>'page',
    'function'=>'article',
    'arguments'=>array('$1','$2')
	));

// page/page/page route
route::set('([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)',array(
    'controller'=>'page',
    'function'=>'article',
    'arguments'=>array('$1','$2','$3')
	));

// blog route
route::set('blog/([-_a-zA-Z0-9]+)',array(
    'controller'=>'blog',
    'function'=>'index',
    'arguments'=>array('$1')
	));

// category route
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
route::set('tag/([-_a-zA-Z0-9]+)',array(
    'controller'=>'tag',
    'function'=>'index',
    'arguments'=>array('$1')
	));

// file route
route::set('file/([-_a-zA-Z0-9]+)',array(
    'controller'=>'file',
    'function'=>'index',
    'arguments'=>array('$1')
	));

// admin route
route::set('admin/([-_a-zA-Z0-9]+)',array(
    'controller'=>'admin',
    'function'=>'$1'
	));
	
// admin route
route::set('admin/([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)',array(
    'controller'=>'admin',
    'function'=>'$1',
    'arguments'=>array('$2')
	));

// admin index
route::set('admin',array(
    'controller'=>'admin',
    'function'=>'index'
	));

// default route
route::set('default_route','page/index');

?>