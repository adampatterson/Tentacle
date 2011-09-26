<?php
error_reporting(E_STRICT|E_ALL);

// Application configuration
//----------------------------------------------------------------------------------------------

require_once('application/config/system-variables.php');

// Tentacle Version
require_once('application/config/'.CONFIGURATION.'/version.php');

 if (!file_exists('application/config/'.CONFIGURATION.'/db.php')){
   header( 'Location: /setup/' ) ;
   exit();
 } 

// End of configuration
//----------------------------------------------------------------------------------------------
define('DINGO',1);
require_once(SYSTEM.'/dingo.php');
bootstrap::run();