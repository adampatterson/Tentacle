<?php if(!defined('DINGO')){die('External Access to File Denied');}
/* Auto Load Libraries */
config::set('autoload_library',array('url'));

/* Auto Load Helpers */
config::set('autoload_helper',array('install'));

/* Notes */
config::set('notes',array('path'=>'/','expire'=>'+5 minutes'));

/* Application Folder Locations */
config::set('folder_views','view');             // Views
config::set('folder_controllers','controller'); // Controllers
config::set('folder_models','model');           // Models
config::set('folder_helpers','helper');         // Helpers
config::set('folder_errors','error');         // Helpers