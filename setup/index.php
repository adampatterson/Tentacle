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
define('BASE_URI'      , $_SERVER['REQUEST_URI']);

// @todo BASE_URL may need some testing in other environments
//if ($_SERVER["SERVER_NAME"] == 'localhost') {
//define('BASE_URL'      ,'http://'.$_SERVER["SERVER_NAME"].'/http/dev.tcms.me/' );
//} else {
define('BASE_URL'      ,'http://'.$_SERVER["SERVER_NAME"].'/' );
//}

// Application's Base URL

define('ROOT'      ,'http://'.$_SERVER["SERVER_NAME"].'/' );


// Application's Base Application URL
define('TENTACLE_URL'  , BASE_URL.'tentacle/');

define('TENTACLE_ADMIN'  , TENTACLE_URL.'admin/');

define('TENTACLE_JS'   , TENTACLE_URL.'admin/js/');
define('TENTACLE_CSS'  , TENTACLE_URL.'admin/css/');


// End of configuration
//----------------------------------------------------------------------------------------------
define('DINGO',1);
require_once(SYSTEM.'/core/bootstrap.php');
bootstrap::run();