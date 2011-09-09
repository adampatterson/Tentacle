<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Image Library Dingo Framework
 *
 * @Author          Evan Byrne
 * @Copyright       2008 - 2010
 * @Project Page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/image-helper
 */

class image
{
	private $_image;
	private $_type;
	private $_quality = 100;
	private $_compression = 4;
	public $width;
	public $height;
	
	
	// Construct
	// ---------------------------------------------------------------------------
	public function __construct($file=FALSE)
	{
		if($file)
		{
			$this->open($file);
		}
	}
	
	
	// Open Image
	// ---------------------------------------------------------------------------
	public function open($file)
	{
		// Check to see if image exists
		if(!file_exists($file))
		{
			dingo_error("Image file not found: The image file ($file) could not be found.",E_USER_ERROR);
		}
		
		// Attempt to open image
		else
		{
			$fs = getimagesize($file);
			
			switch($fs['mime'])
			{
				case 'image/pjpeg':
					$this->_image = imagecreatefromjpeg($file);
					$this->_type = 'jpg';
				break;
				case 'image/jpeg':
					$this->_image = imagecreatefromjpeg($file);
					$this->_type = 'jpg';
				break;
				case 'image/gif':
					$this->_image = imagecreatefromgif($file);
					$this->_type = 'gif';
				break;
				case 'image/x-png':
					$this->_image = imagecreatefrompng($file);
					imagealphablending($this->_image,true);
					imagesavealpha($this->_image,true);
					$this->_type = 'png';
				break;
				case 'image/png':
					$this->_image = imagecreatefrompng($file);
					imagealphablending($this->_image,true);
					imagesavealpha($this->_image,true);
					$this->_type = 'png';
				break;
				default:
					throw new Exception('Invalid image: The given image could not be opened.');
				break;
			}
			
			$this->width = imagesx($this->_image);
			$this->height = imagesy($this->_image);
		}
		
		return $this;
	}
	
	
	// Set Image Type
	// ---------------------------------------------------------------------------
	public function type($type)
	{
		// Check to see if supported image type
		if(($type != 'jpg') AND ($type != 'gif') AND ($type != 'png'))
		{
			dingo_error(E_USER_ERROR,"Invalid image type: The given image type ($type) was not valid.");
		}
		else
		{
			$this->_type = strtolower($type);
		}
		
		return $this;
	}
	
	
	// Image Quality
	// ---------------------------------------------------------------------------
	public function quality($q=100)
	{
		$this->_quality = $q;
		return $this;
	}
	
	
	// Image Compression
	// ---------------------------------------------------------------------------
	public function compression($c=4)
	{
		$this->_compression = $c;
		return $this;
	}
	
	
	// Resize
	// ---------------------------------------------------------------------------
	public function resize($x=NULL,$y=NULL)
	{
		// Width not given
		if(!$x)
		{
			$x = $this->width*($y/$this->height);
		}
		
		// Height not given
		elseif(!$y)
		{
			$y = $this->height*($x/$this->width);
		}
		
		$tmp = imagecreatetruecolor($x,$y);
		imagecopyresampled($tmp,$this->_image,0,0,0,0,$x,$y,$this->width,$this->height);
		$this->_image = $tmp;
		
		$this->width = $x;
		$this->height = $y;
		
		return $this;
	}
	
	
	// Crop
	// ---------------------------------------------------------------------------
	public function crop($x=0,$y=0,$width=1,$height=1)
	{
		
		$tmp = imagecreatetruecolor($width,$height);
		imagecopyresampled($tmp,$this->_image,0,0,$x,$y,$width,$height,$width,$height);
		$this->_image = $tmp;
		
		$this->width = $width;
		$this->height = $height;
		
		return $this;
	}
	
	
	// Dynamic Resize
	// ---------------------------------------------------------------------------
	public function dynamic_resize($new_width,$new_height)
	{
		// Taller image
		if($new_height > $new_width OR ($new_height == $new_width AND $this->height < $this->width))
		{
			$this->resize(NULL,$new_height);
			
			$w = ($new_width-$this->width)/-2;
			$this->crop($w,0,$new_width,$new_height);
		}
		
		// Wider image
		else
		{
			$this->resize($new_width,NULL);
			
			$y = ($new_height-$this->height)/-2;
			$this->crop(0,$y,$new_width,$new_height);
		}
		
		$this->width = $new_width;
		$this->height = $new_height;
		
		return $this;
	}
	
	
	// Square
	// ---------------------------------------------------------------------------
	public function square($size)
	{
		return $this->dynamic_resize($size,$size);
	}
	
	
	// Zone Crop
	// ---------------------------------------------------------------------------
	public function zone_crop($width,$height,$zone='center')
	{
		// Center
		if($zone == 'center')
		{
			$x = ($width-$this->width)/-2;
			$y = ($height-$this->height)/-2;
		}
		
		// Top Left
		elseif($zone == 'top-left')
		{
			$x = 0;
			$y = 0;
		}
		
		// Top
		elseif($zone == 'top')
		{
			$x = ($this->width-$width)/2;
			$y = 0;
		}
		
		// Top Right
		elseif($zone == 'top-right')
		{
			$x = $this->width-$width;
			$y = 0;
		}
		
		// Right
		elseif($zone == 'right')
		{
			$x = $this->width-$width;
			$y = ($this->height-$height)/2;
		}
		
		// Bottom Right
		elseif($zone == 'bottom-right')
		{
			$x = $this->width-$width;
			$y = $this->height-$height;
		}
		
		// Bottom
		elseif($zone == 'bottom')
		{
			$x = ($this->width-$width)/2;
			$y = $this->height-$height;
		}
		
		// Bottom Left
		elseif($zone == 'bottom-left')
		{
			$x = 0;
			$y = $this->height-$height;
		}
		
		// Left
		elseif($zone == 'left')
		{
			$x = 0;
			$y = ($this->height-$height)/2;
		}
		
		// Invalid Zone
		else
		{
			dingo_error(E_USER_ERROR,"Invalid image crop zone '$zone' given for image helper zone_crop().");
		}
		
		return $this->crop($x,$y,$width,$height);
	}
	
	
	// Rotate
	// ---------------------------------------------------------------------------
	public function rotate($deg=0,$bg=0)
	{
		$this->_image = imagerotate($this->_image,$deg,$bg);
		
		return $this;
	}
	
	
	// Save Image
	// ---------------------------------------------------------------------------
	public function save($file)
	{
		// JPG
		if($this->_type == 'jpg')
		{
			imagejpeg($this->_image,$file,$this->_quality);
		}
		
		// GIF
		elseif($this->_type == 'gif')
		{
			imagegif($this->_image,$file,$this->_quality);
		}
		
		// PNG
		elseif($this->_type == 'png')
		{
			imagepng($this->_image,$file,$this->_compression);
		}
		
		return $this;
	}
	
	
	// Show Image
	// ---------------------------------------------------------------------------
	public function show()
	{
		// JPG
		if($this->_type == 'jpg')
		{
			header('Content-type:image/jpeg');
			imagejpeg($this->_image,NULL,$this->_quality);
		}
		
		// GIF
		elseif($this->_type == 'gif')
		{
			header('Content-type:image/gif');
			imagegif($this->_image,NULL,$this->_quality);
		}
		
		// PNG
		elseif($this->_type == 'png')
		{
			header('Content-type:image/png');
			imagepng($this->_image,NULL,$this->_compression);
		}
		
		return $this;
	}
	
	
	// Close
	// ---------------------------------------------------------------------------
	public function close()
	{
		imagedestroy($this->_image);
		
		return $this;
	}
}