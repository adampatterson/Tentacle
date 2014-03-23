<?php if(!defined('DINGO')){die('External Access to File Denied');}

date_default_timezone_set('UTC');

/* Auto Load Libraries */
config::set( 'autoload_library', array( 'logger', 'dispatcher', 'db', 'assets', 'session', 'user', 'cache', 'url', 'collections', 'pagination', 'image', 'note', 'email' ) );

/* Auto Load Helpers */
if ( strpos( BASE_URI,'install' ) == true )
	config::set( 'autoload_helper', array(  ) ); 	
else
	config::set( 'autoload_helper', array( 'theme', 'get_set', 'tentacle', 'upgrade', 'common', 'navigation', 'shortcode') );

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
config::set('folder_languages','language');     // Languages
config::set('folder_errors','error');           // Errors
config::set('folder_orm','orm');                // ORM