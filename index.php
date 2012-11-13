<?php
/**
* Tentacle CMS - Create & Manage Content your way!
*
* Version:
*     v0.5.8
*
* License:
*     Modified CPL (See COPYING)
*
* Tentacle CMS Copyright:
*     Copyright (c) 2012 Tentacle CMS - Adam Patterson
*/
if (version_compare(PHP_VERSION, "5.2.0", "<"))
    exit("Tentacle CMS requires PHP 5.2.0 or greater.");

error_reporting(E_STRICT|E_ALL);

// Application configuration
//----------------------------------------------------------------------------------------------

# Does Application Use Mod_Rewrite URLs?
define('MOD_REWRITE',TRUE);

# Turn Debugging On?
define('DEBUG', TRUE);

# Turn Error Logging On?
define('ERROR_LOGGING',TRUE);

# Error Log File Location
define('ERROR_LOG_FILE','log.txt');

# Application Location
define( 'APPLICATION'   ,'application' );

# Config Directory Location (in relation to application location)
define( 'CONFIG'        ,'config' );

# Allowed Characters in URL
define( 'ALLOWED_CHARS' ,'/^[ \!\,\~\&\.\:\+\@\-_a-zA-Z0-9]+$/');

define( 'APP_ROOT'      , __DIR__ );

define( 'DS'			, DIRECTORY_SEPARATOR );

# Application's Base URL
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

define('BASE_URI'      , $_SERVER['REQUEST_URI'].$port );

# @todo BASE_URL may need some testing in other environments
//define('BASE_URL'      ,'http://'.$_SERVER["SERVER_NAME"].$port.$directory.'/' );
define('BASE_URL'      ,'http://'.$_SERVER["SERVER_NAME"].$directory.'/' );

# Application's Base Application URL
define('TENTACLE_URL'     , BASE_URL.'tentacle/');
define('TENTACLE_URI'     , APP_ROOT.'/tentacle');

# Admin's Base URL
define('ADMIN'            , BASE_URL.'admin/');
define('ADMIN_URL'        , BASE_URL.'tentacle/');
define('ADMIN_URI'        , APP_ROOT.'tentacle/');
define('ADMIN_JS'   	  , BASE_URL.'tentacle/js/');
define('ADMIN_CSS'     	  , BASE_URL.'tentacle/css/');
define('ADMIN_IMG'     	  , BASE_URL.'tentacle/images/');

define('TENTACLE_LIB'     , APP_ROOT.'/application/library/');

# Image Size
define('GRAVATAR_SIZE' 	  , "60" );

# Folders
define('STORAGE_DIR'   	  , APP_ROOT.'/storage');
define('STORAGE_URL'   	  , BASE_URL.'storage');
                       	  
define('TEMP'		   	  , STORAGE_DIR.'/temp/');
                       	  
define('THEMES_DIR'    	  , APP_ROOT.'/themes/');
define('THEMES_URL'    	  , BASE_URL.'themes');

define('TENTACLE_PLUGIN'  , APP_ROOT.'/modules');

define('IMAGE_DIR'     	  , APP_ROOT.'/storage/images/');
define('IMAGE_URL'	   	  , BASE_URL.'storage/images/');
define('IMAGE_URI'	   	  , 'tentacle/storage/images/');
# See application/helper/tentacle.php for other constants set using functionality not loaded yet.

/*
 *  Serpent Timeout
 */
define( 'CHECK_TIMEOUT', 5 );

/**
 * The Tentacle version
 */
define('TENTACLE_VERSION', 'v0.8.3');

/**
 * Holds the Tentacle DB revision, increments when changes are made to the Tentacle sql model.
 */
define('TENTACLE_DB_VERSION', '113');

/**
 * Holds the required PHP versionw
 */
define('REQUIRED_PHP_VERSION', '5.2');

/**
 * Holds the required MySQL version
 */
define('REQUIRED_MYSQL_VERSION', '4.1.2');


// @todo If the DB file exists but there are no tables, redirect as well.
if ( !file_exists( 'application/config/deployment/db.php' ) ):
	define('SETUP', 1);
endif;

// Configuration
if ( !defined( 'SETUP' ) && strpos( BASE_URI,'install' ) !== true ) {
	define( 'CONFIGURATION' ,'deployment' );	
} else {
	define( 'CONFIGURATION' ,'setup' );	
}

// End of configuration
//----------------------------------------------------------------------------------------------
define('DINGO',1);
require_once('application/bootstrap.php');

bootstrap::run();