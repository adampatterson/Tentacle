<?php
/**
* File: Dbug
*/

/**
* Function: logger
* 	Used to return an array containing the query run, what file and line number called it.
*
* Parameters:
*	$sql - String ( Query string )
* 	
* Returns:
* 	$dbug_query - Array
*/
function logger($sql)
{
	global $dbug_query;
	$uid = uniqid();
	
	$bt = debug_backtrace();
    $caller = array_shift($bt);
	
	$dbug_query[$uid]['query'] = $sql;
	$dbug_query[$uid]['file'] = $caller['file'].' from line #'.$caller['line'];
}

/**
* Function: render_debug
* 	Render pre tags around data for displaying arrays and objects.
*
* Parameters:
*	$_GET
*	$_POST
*	$_REQUEST
*	$_COOKIE
*	$GLOBALS
* 	
* Returns:
*	HTML from dBug class
*/
   function render_debug() {
	tentacle::library('dbug','dbug');

   	new dBug($_GET, null, true);
   	new dBug($_POST, null, true);
   	//new dBug($_FILES, null, true);
   	new dBug($_REQUEST, null, true);
   	new dBug($_COOKIE, null, true);
   	//new dBug($_SERVER, null, true);
	//new dBug($_ENV, null, true);
	new dBug($GLOBALS['dbug_query'], null, true);
   }

?>