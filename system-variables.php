<?php
/*
* Dingo system settings.
*/


// Does Application Use Mod_Rewrite URLs?
define('MOD_REWRITE',TRUE);

// Turn Debugging On?
define('DEBUG', TRUE);

// Turn Error Logging On?
define('ERROR_LOGGING',TRUE);

// Error Log File Location
define('ERROR_LOG_FILE','log.txt');

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
	
define( 'DS'				, DIRECTORY_SEPARATOR );
	
// Application's Base URL
define('BASE_URI'      , $_SERVER['REQUEST_URI'].$port );

// @todo BASE_URL may need some testing in other environments
define('BASE_URL'      ,'http://'.$_SERVER["SERVER_NAME"].$port.$directory.'/' );

// Application's Base URL
define('ROOT'		   , BASE_URI );

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
define('IMAGE_URL'	   , TENTACLE_URL.'/storage/images/');



/*
 *  Component Versions
 */

/**
* The Tentacle version
*
* @global string $tentacle_version
*/
define('TENTACLE_VERSION', '0.5');
 
 
/**
* Holds the Tentacle DB revision, increments when changes are made to the Tentacle sql model.
*
* @global int $tentacle_db_version
*/
define('TENTACLE_DB_VERSION', '104');
 

/**
* Holds the required PHP version
*
* @global string $required_php_version
*/
define('REQUIRED_PHP_VERSION', '5.2');
 
 
/**
* Holds the required MySQL version
*
* @global string $required_mysql_version
*/
define('REQUIRED_MYSQL_VERSION', '4.1.2');
