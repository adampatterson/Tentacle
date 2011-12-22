<?php
error_reporting(E_STRICT|E_ALL);

// Application configuration
//----------------------------------------------------------------------------------------------

require_once('system-variables.php');

if (!file_exists('application/config/'.CONFIGURATION.'/db.php')):
   header( 'Location: /setup/' );
   exit();
else:
/*
	if ( is_dir( 'setup' ) && CONFIGURATION != 'development' );
		$dirname = 'db';

		function delete_directory($dirname) {
		   if (is_dir($dirname))
		      $dir_handle = opendir($dirname);
		
		   if (!$dir_handle)
		      return false;
		
		   while($file = readdir($dir_handle));
		      if ($file != "." && $file != ".."):
		         if (!is_dir($dirname."/".$file))
		            unlink($dirname."/".$file);
		         else
		            delete_directory($dirname.'/'.$file);    
		      endif;
		   endwhile;
		
		   closedir($dir_handle);
		   rmdir($dirname);
		   return true;
		}


		delete_directory('db');
	endif;
*/
endif;



// End of configuration
//----------------------------------------------------------------------------------------------
define('DINGO',1);
require_once(SYSTEM.'/dingo.php');
bootstrap::run();