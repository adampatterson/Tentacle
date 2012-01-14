<?php

error_reporting(E_STRICT|E_ALL);

// Application configuration
//----------------------------------------------------------------------------------------------

// Configuration
define('CONFIGURATION','setup');

// Dingo Location
define('SYSTEM','system');

// Application Location
define('APPLICATION','application');

// Config Directory Location (in relation to application location)
define('CONFIG','config');

// Allowed Characters in URL
define('ALLOWED_CHARS','/^[ \!\,\~\&\.\:\+\@\-_a-zA-Z0-9]+$/');
	
	
/*
* Added for Tentacle
*/
// Application's Base URL
if ($_SERVER["SERVER_PORT"] != '80' ) {
	$port = ':'.$_SERVER["SERVER_PORT"];
} else {
	$port = '';
}

// Application's Base URL
define('BASE_URI'      	, $_SERVER['REQUEST_URI'].$port.dirname($_SERVER['PHP_SELF']).'/');

// @todo BASE_URL may need some testing in other environments
define('BASE_URL'      	, 'http://'.$_SERVER["SERVER_NAME"].$port.dirname($_SERVER['PHP_SELF']).'/' );

// Application's Base Application URL
define('TENTACLE_APP'	, 'http://'.$_SERVER["SERVER_NAME"].$port.str_replace("setup/index.php", "", $_SERVER['PHP_SELF']));

define('TENTACLE_URL'  	, BASE_URL.'');

define('TENTACLE_ADMIN' , TENTACLE_APP.'tentacle/admin/');

define('TENTACLE_IMAGE' , TENTACLE_APP.'tentacle/admin/images/');
define('TENTACLE_CSS'  	, TENTACLE_APP.'tentacle/admin/css/');


// End of configuration
//----------------------------------------------------------------------------------------------
define('DINGO',1);
require_once(SYSTEM.'/core/bootstrap.php');
bootstrap::run();