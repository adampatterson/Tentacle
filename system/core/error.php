<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Dingo Error Handling Functions
 *
 * @Author          Evan Byrne
 * @Copyright       2008 - 2010
 * @Project Page    http://www.dingoframework.com
 *
 * Many thanks to Kalle for providing code
 * http://www.talkphp.com/show-off/4070-dingo-framework-alpha-testing-open-3.html#post23025
 */


// Errors
// ---------------------------------------------------------------------------
function dingo_error($level,$message,$file='current file',$line='(unknown)')
{
	$fatal = false;
	$exception = false;
	
	switch($level)
	{
		case('exception'):
		{
			$prefix = 'Uncaught Exception';
			$exception = true;
		}
		break;
		case(E_RECOVERABLE_ERROR):
		{
			$prefix = 'Recoverable Error';
			$fatal	 = true;
		}
		break;
		case(E_USER_ERROR):
		{
			$prefix = 'Fatal Error';
			$fatal	 = true;
		}
		break;
		case(E_NOTICE):
		case(E_USER_NOTICE):
		{
			$prefix = 'Notice';
		}
		break;
		/* E_DEPRECATED & E_USER_DEPRECATED, available as of PHP 5.3 - Use their numbers here to prevent redefining them and two E_NOTICE's */
		case(8192):
		case(16384):
		{
			$prefix = 'Deprecated';
		}
		case(E_STRICT):
		{
			$prefix = 'Strict Standards';
		}
		break;
		default:
		{
			$prefix = 'Warning';
		}
	}
	
	$error = array(
		'level'=>$level,
		'prefix'=>$prefix,
		'message'=>$message,
		'file'=>$file,
		'line'=>$line
	);
	
	if($fatal)
	{
		ob_clean();
		
		if(file_exists(APPLICATION.'/'.config::get('folder_errors').'/fatal.php'))
		{
			require(APPLICATION.'/'.config::get('folder_errors').'/fatal.php');
		}
		else
		{
			echo 'Dingo could not locate error file at '.APPLICATION.'/'.config::get('folder_errors').'/fatal.php';
		}
		
		ob_end_flush();
		exit;
	}
	elseif($exception)
	{
		ob_clean();
		
		if(file_exists(APPLICATION.'/'.config::get('folder_errors').'/exception.php'))
		{
			require(APPLICATION.'/'.config::get('folder_errors').'/exception.php');
		}
		else
		{
			echo 'Dingo could not locate exception file at '.APPLICATION.'/'.config::get('folder_errors').'/exception.php';
		}
		
		ob_end_flush();
		exit;
	}
	elseif(DEBUG)
	{
		if(file_exists(APPLICATION.'/'.config::get('folder_errors').'/nonfatal.php'))
		{
			require(APPLICATION.'/'.config::get('folder_errors').'/nonfatal.php');
		}
		else
		{
			echo 'Dingo could not locate error file at '.APPLICATION.'/'.config::get('folder_errors').'/nonfatal.php';
		}
	}
	
	if(ERROR_LOGGING)
	{
		dingo_error_log($error);
	}
}


// Exceptions
// ---------------------------------------------------------------------------
function dingo_exception($ex)
{
	dingo_error('exception',$ex->getMessage(),$ex->getFile(),$ex->getLine());
	//echo "<p>Uncaught exception in {$exception->getFile()} on line {$exception->getLine()}: <strong>{$exception->getMessage()}</strong></p>";
}


// Error Logging
// ---------------------------------------------------------------------------
function dingo_error_log($error)
{
	$date = date('g:i A M d Y');
	
	$fh = fopen(ERROR_LOG_FILE,'a');
	flock($fh,LOCK_EX);
	fwrite($fh,"[$date] {$error['prefix']}: {$error['message']} IN {$error['file']} ON LINE {$error['line']}\n");
	flock($fh,LOCK_UN);
	fclose($fh);
}