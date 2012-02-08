<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Dingo Framework Basic Configuration File
 *
 * @Author          Evan Byrne
 * @Copyright       2008 - 2010
 * @Project Page    http://www.dingoframework.com
 */

// Does Application Use Mod_Rewrite URLs?
define('MOD_REWRITE',TRUE);

// Turn Debugging On?
define('DEBUG',TRUE);

// Turn Error Logging On?
define('ERROR_LOGGING',TRUE);

// Error Log File Location
define('ERROR_LOG_FILE','log.txt');


/**
 * Your Application's Default Timezone
 * Syntax for your local timezone can be found at
 * http://www.php.net/timezones
 */
date_default_timezone_set('UTC');

/* Auto Load Libraries */
config::set( 'autoload_library', array( 'db', 'session', 'user', 'url', 'pagination', 'benchmark', 'image', 'note', 'email' ) );

/* Auto Load Helpers */
config::set( 'autoload_helper', array('assets', 'theme', 'settings', 'scaffold', 'state', 'tentacle', 'navigation', 'gravatar', 'inflector', 'string', 'user' ) ); 

/* Sessions */
config::set('session',array(
	'connection'=>'default',
	'table'=>'sessions',
	'cookie'=>array('path'=>'/','expire'=>'+2 hours')
));

/* Notes */
config::set('notes',array('path'=>'/','expire'=>'+90 minutes'));

/*
 *  Tentacle
 */

/* Application Folder Locations */
config::set('folder_views','view');             // Views
config::set('folder_controllers','controller'); // Controllers
config::set('folder_models','model');           // Models
config::set('folder_helpers','helper');         // Helpers
config::set('folder_structures','structure');   // Structures
config::set('folder_plugins','plugin');         // Plugins
config::set('folder_cache','cache');            // Cache
config::set('folder_languages','language');     // Languages
config::set('folder_errors','error');           // Errors
config::set('folder_orm','orm');                // ORM


/*
 *  Component Versions
 */

/**
* The Tentacle version
*
* @global string $tentacle_version
*/
define('TENTACLE_VERSION', '1.0 beta');
 
/**
* The Dingo PHP Framework version
*
* @global string $dingo_version
*/
define('MVC_VERSION', DINGO_VERSION);
 
 
/**
* Holds the Tentacle DB revision, increments when changes are made to the Tentacle DB schema.
*
* @global int $tentacle_db_version
*/
define('TENTACLE_DB_VERSION', '1.0');
 

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