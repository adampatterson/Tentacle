<?php if(!defined('DINGO')){die('External Access to File Denied');}

route::set('(.*)',array(
    'controller'=>'page',
    'function'=>'index',
	));

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
route::set('file',array(
    'controller'=>'file',
    'function'=>'index'
	));
	
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
	
route::set('admin/([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)',array(
    'controller'=>'admin',
    'function'=>'$1',
    'arguments'=>array('$2')
	));

route::set('admin',array(
    'controller'=>'admin',
    'function'=>'index'
	));


route::set('ajax/([-_a-zA-Z0-9]+)',array(
    'controller'=>'action',
    'function'=>'$1'
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
	
// dev index
route::set('dev',array(
    'controller'=>'dev',
    'function'=>'index'
	));
	
// install rout
route::set('install',array(
    'controller'=>'install',
    'function'=>'agree',
	));

route::set('install/([-_a-zA-Z0-9]+)',array(
    'controller'=>'install',
    'function'=>'$1',
    'arguments'=>array('$1')
	));
	
		
route::set('default_route','page/index');



/*
 * From Dingo
 * route::set('main/([a-zA-Z]+)/([a-zA-Z]+)',array('controller'=>'$1','function'=>'awesome','arguments'=>array('$2')));
 * route::set('one/([a-zA-Z]+)/([a-zA-Z]+)','query/$1/$2' );
 * route::set('sweet',array('controller'=>'test/sweet'));
 * 
 * From FROG CMS
 * Visiting /about/ would call PageController::about(),
 * visiting /blog/5 would call BlogController::post(5)
 * visiting /blog/5/comment/42/delete would call BlogController::deleteComment(5,42)
 */