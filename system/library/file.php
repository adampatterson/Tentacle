<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * File Library For Dingo Framework
 *
 * @Author          Evan Byrne
 * @Copyright       2008 - 2010
 * @Project Page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/file-helper
 */

class file
{
	public $fh = FALSE;
	public $location = FALSE;
	public $method = FALSE;
	public $lock = FALSE;
	
	
	// Construct
	// ---------------------------------------------------------------------------
	public function __construct($location=FALSE,$method='r',$lock=LOCK_EX)
	{
		if($location)
		{
			$this->location = $location;
			$this->method = $method;
			$this->lock = $lock;
			
			$this->fh = fopen($this->location,$this->method);
			flock($this->fh,$this->lock);
		}
		else
		{
			$this->fh = tmpfile();
		}
		
		return $this;
	}
	
	
	// Read
	// ---------------------------------------------------------------------------
	public function read($chars=FALSE)
	{
		if(!$chars)
		{
			$chars = filesize($this->location);
		}
		
		return fread($this->fh,$chars);
	}
	
	
	// Write
	// ---------------------------------------------------------------------------
	public function write($data=FALSE)
	{
		fwrite($this->fh,$data);
	}
	
	
	// Read Line
	// ---------------------------------------------------------------------------
	public function read_lines($data=FALSE)
	{
		return fgets($this->fh,$data);
	}
	
	
	// Seek
	// ---------------------------------------------------------------------------
	public function seek($offset=0,$whence=FALSE)
	{
		fseek($this->fh,$offset,$whence=FALSE);
	}
	
	
	// Scan File
	// ---------------------------------------------------------------------------
	public function scan($format)
	{
		return fscanf($this->fh,$format);
	}
	
	
	// Close
	// ---------------------------------------------------------------------------
	public function close()
	{
		if($this->fh)
		{
			if($this->lock)
			{
				flock($this->fh,LOCK_UN);
			}
			
			fclose($this->fh);
			$this->fh = FALSE;
		}
	}
	
	
	// Destruct
	// ---------------------------------------------------------------------------
	public function __destruct()
	{
		$this->close();
	}
	
	
	// MIME Type
	// ---------------------------------------------------------------------------
	static function mime($file)
	{
		if(function_exists('finfo_file'))
		{
			$fh = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($fh,$file);
			finfo_close($fh);
			return $mime;
		}
		else
		{
			return mime_content_type($file);
		}
	}
	
	
	// Download
	// ---------------------------------------------------------------------------
	static function download($file,$name)
	{
		header("Content-disposition:attachment;filename=$name");
		header('Content-type:'+file::mime($file));
		readfile($file);
	}
}
