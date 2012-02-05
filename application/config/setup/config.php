<?php if(!defined('DINGO')){die('External Access to File Denied');}

// Does Application Use Mod_Rewrite URLs?
define('MOD_REWRITE'	,TRUE);

// Turn Debugging On?
define('DEBUG'			,FALSE);

// Turn Error Logging On?
define('ERROR_LOGGING'	,FALSE);

// Error Log File Location
define('ERROR_LOG_FILE'	,'log.txt');

/* Auto Load Libraries */
config::set('autoload_library',array('url'));

/* Auto Load Helpers */
config::set('autoload_helper',array());

/* Notes */
config::set('notes',array('path'=>'/','expire'=>'+5 minutes'));

/* Application Folder Locations */
config::set('folder_views','view');             // Views
config::set('folder_controllers','controller'); // Controllers
config::set('folder_models','model');           // Models
config::set('folder_helpers','helper');         // Helpers
config::set('folder_errors','error');         // Helpers