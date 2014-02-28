<?php
/**
* Tentacle CMS - Create & Manage Content your way!
*
* Version:
*     v0.8.5
*
* License:
*     Modified GPL (See COPYING)
*
* Tentacle CMS Copyright:
*     Copyright (c) 2012 Tentacle CMS - Adam Patterson
*/
if (version_compare(PHP_VERSION, "5.3.3", "<"))
    exit("Tentacle CMS requires PHP 5.3.3 or greater.");

error_reporting(E_STRICT|E_ALL);

// Application configuration
//----------------------------------------------------------------------------------------------

# Does Application Use Mod_Rewrite URLs?
define('MOD_REWRITE',TRUE);

# Turn Debugging On?
define('DEBUG', TRUE);
define('DEBUG_SQL', FALSE);

# Turn Error Logging On?
define('ERROR_LOGGING',TRUE);

# Application Location
define( 'APPLICATION'   ,'application' );

# Config Directory Location (in relation to application location)
define( 'CONFIG'        ,'config' );

# Allowed Characters in URL
define( 'ALLOWED_CHARS' ,'/^[ \!\,\~\&\.\:\+\@\-_a-zA-Z0-9]+$/');

define( 'APP_ROOT'      , __DIR__ );

define( 'DS'			, DIRECTORY_SEPARATOR );

# Tentacle
require_once(APPLICATION.'/'.CONFIG.'/define.php');

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