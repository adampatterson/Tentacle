<?php if(!defined('DINGO')){die('External Access to File Denied');}

// User Database Connection
config::set('user_connection','default');

// User Database Table
config::set('user_table','users');

// User Types
config::set('user_types',array(
	'banned'=>0,
	'guest'=>1,
	'user'=>2,
	'mod'=>3,
	'admin'=>4,
	'owner'=>5
));