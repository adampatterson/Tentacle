<?php
/*
* Dingo system settings.
*/

// Configuration
define( 'CONFIGURATION' ,'deployment' );

// Dingo Location
define( 'SYSTEM'        ,'system' );

// Application Location
define( 'APPLICATION'   ,'application' );

// Config Directory Location (in relation to application location)
define( 'CONFIG'        ,'config' );

// Allowed Characters in URL
define( 'ALLOWED_CHARS' ,'/^[ \!\,\~\&\.\:\+\@\-_a-zA-Z0-9]+$/');

define( 'CORE_ROOT'     , __DIR__ );
define( 'APP_PATH'      , CORE_ROOT );
	
	
/*
* Added for Tentacle
*/
if ($_SERVER["SERVER_PORT"] != '80' ):
	$port = ':'.$_SERVER["SERVER_PORT"];
else:
	$port = '';
endif;
	
if ( dirname($_SERVER['PHP_SELF'])  == '/' ):
	$directory = '';
else:
	$directory = dirname($_SERVER['PHP_SELF']);
endif;
	
// Application's Base URL
define('BASE_URI'      , $_SERVER['REQUEST_URI'].$port );

// @todo BASE_URL may need some testing in other environments
define('BASE_URL'      ,'http://'.$_SERVER["SERVER_NAME"].$port.$directory.'/' );


// Application's Base URL
define('ROOT'      , BASE_URI );

//endif;

// Application's Base Application URL
define('TENTACLE_URL'  , BASE_URL.'tentacle/');
define('TENTACLE_URI'  , APP_PATH.'/tentacle');

// Admin's Base URL
define('ADMIN'         , BASE_URL.'admin/');
define('ADMIN_URL'     , TENTACLE_URL.'admin/');
define('ADMIN_URI'     , TENTACLE_URI.'/admin/');

define('TENTACLE_LIB'  , CORE_ROOT.'/tentacle/admin/lib/');
define('TENTACLE_JS'   , ADMIN_URL.'js/');
define('TENTACLE_CSS'  , ADMIN_URL.'css/');

// http://code.google.com/p/minify/
define('MINIFY'        , ADMIN_URL.'lib/min/');

// Image Size
define('GRAVATAR_SIZE' , "60" );

// Folders
define('STORAGE_DIR'   , TENTACLE_URI.'/storage');
define('THEMES_DIR'    , TENTACLE_URI.'/themes/');
define('THEMES_URL'    , TENTACLE_URL.'themes');
define('ADMIN_DIR'     , TENTACLE_URI.'/admin');
define('ADMIN_BUNDLE'  , ADMIN_URI.'bundles/');
define('IMAGE_DIR'     , STORAGE_DIR.'/images/');