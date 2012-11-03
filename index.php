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

require_once('system-variables.php');


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