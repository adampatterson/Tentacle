<?php

/**
 * Git Helper
 *
 * @author Adam Patterson
 */

function pull ($branch = '')
{
	return shell_exec('git pull');
}

function status () 
{
	return shell_exec('git status');	
}
