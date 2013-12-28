<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Dingo Framework DB Configuration File
 *
 * @Author          Evan Byrne
 * @Copyright       2008 - 2010
 * @Project Page    http://www.dingoframework.com
 */

// @todo INSTALL EDIT
config::set('db',array(
  
  /* Default Connection */
  'default'=>array(
    'driver'=>'mysql',        // Driver
    'host'=>'localhost',      // Host
    'username'=>'root',       // Username
    'password'=>'',           // Password
    'database'=>'tentacle' // Database
  )
));