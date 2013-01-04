<?php
/**
* File: Git
*/


/**
* Function: pull
*   Executes a shell command 'git pull'
*
* Parameters:
*	Executes a shell command 'git pull'
*
* Returns:
*	Git message
*/
function pull( $branch = '' )
{
	return shell_exec('git pull');
}


/**
* Function: status
*	Executes a shell command 'git status'
*
* Returns:
*	Git message
*/
function status() 
{
	return shell_exec('git status');	
}
