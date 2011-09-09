<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Dingo Framework Basic Configuration File
 *
 * @Author          Evan Byrne
 * @Copyright       2008 - 2010
 * @Project Page    http://www.dingoframework.com
 */

// Application's Base URL
// @todo BASE_URL may need some testing in other environments
define('BASE_URL','http://'.$_SERVER["SERVER_NAME"].'/');

define('BASE_IMAGE',BASE_URL.'assets/images/');

// Image Path and Thumbnail settings
// Content images will be stored here, they will consist of a large view and a optional medium view.
define('IMG_CONTENNT', "storage/profiles/");
// Thumbnails images will be kept in this folder.
define('IMG_THUMB', "storage/thumbs/");
// Original images will be kept in this folder, only the file names will be changed.
define('IMG_ORIGINAL', "storage/original/");

// Peramiters for image functions
define('TN_WIDTH', "60");
define('TN_HEIGHT', "60");
define('IMG_WIDTH', "200");
define('IMG_HEIGHT', "200");
define('IMG_QUALITY', "100");

define('MAX_FILESIZE',"2400");

// Does Application Use Mod_Rewrite URLs?
define('MOD_REWRITE',TRUE);

// Turn Debugging On?
define('DEBUG',FALSE);

if (DEBUG == TRUE) {
	require_once('assets/lib/FirePHPCore/fb.php');
	ob_start();
}

// Turn Error Logging On?
define('ERROR_LOGGING',TRUE);

// Error Log File Location
define('ERROR_LOG_FILE','log.txt');


/**
 * Your Application's Default Timezone
 * Syntax for your local timezone can be found at
 * http://www.php.net/timezones
 */
// @todo INSTALL EDIT
date_default_timezone_set('America/New_York');

/* Auto Load Libraries */
config::set('autoload_library',array('db','session','user','url','pagination','benchmark','image','note','email'));

/* Auto Load Helpers */
config::set('autoload_helper',array()); 

/* Sessions */
config::set('session',array(
  'connection'=>'default',
  'table'=>'sessions',
  'cookie'=>array('path'=>'/','expire'=>'+1 hours')
));

/* Notes */
config::set('notes',array('path'=>'/','expire'=>'+5 minutes'));

define('NOTE_SESSION','<strong>Sorry</strong>: Your session has times out. Please log back in for security reasons.');
define('NOTE_PASSWORD','<strong>Sorry</strong>: The login information was incorrect.');
define('NOTE_LOST','Please check your email address for further instructions.');

/* Application Folder Locations */
config::set('folder_views','view');             // Views
config::set('folder_controllers','controller'); // Controllers
config::set('folder_models','model');           // Models
config::set('folder_helpers','helper');         // Helpers
config::set('folder_structures','structure');   // Structures
config::set('folder_plugins','plugin');         // Plugins
config::set('folder_cache','cache');             // Cache
config::set('folder_languages','language');     // Languages
config::set('folder_errors','error');           // Errors
config::set('folder_orm','orm');                // ORM

