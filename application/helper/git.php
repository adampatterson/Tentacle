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
