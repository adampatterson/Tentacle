<?php
error_reporting(E_STRICT|E_ALL);

// Application configuration
//----------------------------------------------------------------------------------------------

require_once('system-variables.php');


// @todo If the DB file exists but there are no tables, redirect as well.
if ( !file_exists( 'application/config/deployment/db.php' ) ):
	define('SETUP', 1);
endif;

// Configuration
if ( !defined( 'SETUP' ) && strpos( BASE_URI,'install' ) != true ) {
	define( 'CONFIGURATION' ,'deployment' );	
} else {
	define( 'CONFIGURATION' ,'setup' );	
}

// End of configuration
//----------------------------------------------------------------------------------------------
define('DINGO',1);
require_once(SYSTEM.'/dingo.php');
bootstrap::run();