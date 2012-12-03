<?php
/**
 * image
 *
 * Easy image handling using PHP 5  and the GDlib
 *
 * @copyright     Copyright 20010-2011, ushi <ushi@porkbox.net>
 * @link          https://github.com/ushis/PHP-Image-Class
 * @license       DBAD License (http://philsturgeon.co.uk/code/dbad-license)
 *
 * Modified by Adam Patterson with code from:
 * @Project Page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/image-helper
 */
class image {

	/**
	 * Image resource
	 *
	 * @var resource
	 * @acces private
	 */
	private $image;

	/**
	 * Type of image
	 *
	 * @var string
	 * @acces private
	 */
	private $type = 'png';

	/**
	 * Width of the image in pixel
	 *
	 * @var integer
	 * @acces private
	 */
	public $width;

	/**
	 * Height of the image in pixel
	 *
	 * @var integer
	 * @acces private
	 */
	public $height;
	
	private $quality = 100;
	private $compression = 4;


	// Construct
	// ---------------------------------------------------------------------------
	public function __construct($file=FALSE)
	{
		if($file) {
            $this->open($file);
        }
	}

	/**
	 * Return infos about the image
	 *
	 * @return array image infos
	 * @acces public
	 */
	public function get_info() {
		return array(
			'width' => $this->width,
			'height' => $this->height,
			'type' => $this->type,
			'resource' => $this->image,
		);
	}

	/**
	 * Get color in rgb
	 *
	 * @param string $hex Color in hexadecimal code
	 * @return array Color in rgb
	 * @acces public
	 */
	public function hex2rgb($hex) {
		$hex = str_replace('#', '', $hex);
		$hex = (preg_match('/^([a-fA-F0-9]{3})|([a-fA-F0-9]{6})$/', $hex)) ? $hex : '000';

		switch(strlen($hex)) {
	 		case 3:
				$rgb['r'] = hexdec(substr($hex, 0, 1).substr($hex, 0, 1));
				$rgb['g'] = hexdec(substr($hex, 1, 1).substr($hex, 1, 1));
				$rgb['b'] = hexdec(substr($hex, 2, 1).substr($hex, 2, 1));
				break;

			case 6:
				$rgb['r'] = hexdec(substr($hex, 0, 2));
				$rgb['g'] = hexdec(substr($hex, 2, 2));
				$rgb['b'] = hexdec(substr($hex, 4, 2));
				break;
		}

		return $rgb;
	}

	/**
	 * Creates image resource from file
	 *
	 * @param string $path Path to an image
	 * @return boolean true if resource was created
	 * @acces public
	 */
	public function open($path) {
		
		// Check to see if image exists
		if(!file_exists($path))
		{
			dingo_error(E_USER_ERROR, "Image file not found: The image file ($path) could not be found.");
		}
		
		$file = @fopen($path, 'r');

		if(!$file)
			return false;

        $this->orient_image($path);

		fclose($file);
		$info = getimagesize($path);

		switch($info[2]) {
			case 1:
				$this->image = imagecreatefromgif($path);
				$this->type = 'gif';
				break;

			case 2:
				$this->image = imagecreatefromjpeg($path);
				$this->type = 'jpg';
				break;

			case 3:
				$this->image = imagecreatefrompng($path);
				$this->type = 'png';
				imagealphablending($this->image, false);
				imagesavealpha($this->image,true);
				break;

			default:
				return false;
		}

		$this->width = $info[0];
		$this->height = $info[1];
		
		return $this;
	}

	/**
	 * Creates image resource with background
	 *
	 * @param integer $width Width of the image
	 * @param integer $height Height of the image
	 * @param string $background Background color in hexadecimal code
	 * @return boolean true if resource was created
	 * @acces public
	 */
	public function create($width, $height, $background = null) {
		if($width > 0 && $height > 0) {
			$this->image = imagecreatetruecolor($width, $height);
			$this->width = $width;
			$this->height = $height;

			if(preg_match('/^([a-fA-F0-9]{3})|([a-fA-F0-9]{6})$/', $background)) {
				$rgb = $this->hex2rgb($background);
				$background = imagecolorallocate($this->image, $rgb['r'], $rgb['g'], $rgb['b']);
				imagefill($this->image, 0, 0, $background);
			} else {
				imagealphablending($this->image, false);
				$black = imagecolorallocate($this->image, 0, 0, 0);
				imagefilledrectangle($this->image, 0, 0, $this->width, $this->height, $black);
				imagecolortransparent($this->image, $black);
				imagealphablending($this->image, true);
			}

			return true;
		}
		
		return false;
	}


	/**
	 * Resizes the image
	 *
	 * @param integer $width New width
	 * @param integer $height New height
	 * @return boolean true if image was resized
	 * @acces public
	 */
	public function resize($width, $height) {
		if($width <= 0 && $height <= 0)
			return false;
		elseif($width > 0 && $height <= 0)
			$height = $this->height*$width/$this->width;
		elseif($width <= 0 && $height > 0)
			$width = $this->width*$height/$this->height;

		$image = imagecreatetruecolor($width, $height);
		imagealphablending($image, false);
		imagesavealpha($image, true);
		imagecopyresampled($image, $this->image, 0, 0, 0, 0, $width, $height, $this->width,$this->height);
		$this->image = $image;
		$this->width = $width;
		$this->height = $height;
		return true;
	}

	/**
	 * Crops a part of the image
	 *
	 * @param integer $x X-coordinate
	 * @param integer $y Y-coordinate
	 * @param integer $width Width of cutout
	 * @param integer $height Height of cutout
	 * @acces public
	 */
	public function crop($x, $y, $width, $height) {
		$image = imagecreatetruecolor($width, $height);
		imagealphablending($image, false);
		imagesavealpha($image, true);
		imagecopyresampled($image, $this->image, 0, 0, $x, $y, $width, $height, $width, $height);
		
		$this->image = $image;
		$this->width = $width;
		
		$this->height = $height;
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
		
		$this;
	}
	
	
	// Square
	// ---------------------------------------------------------------------------
	public function square($size)
	{
		$this->dynamic_resize($size,$size);
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

	/**
	 * Rotates image
	 *
	 * @param integer $angle in degree
	 * @acces public
	 */
	public function rotate($angle) {
		$this->image = imagerotate($this->image, $angle, 0);
	}


	public function orient_image($path) {

        if (exif_imagetype($path) == IMAGETYPE_JPEG) {
            $exif = @exif_read_data($path);
            if ($exif === false) {
                return false;
            }

            if ( array_key_exists('Orientation', $exif ) ) {

                $orientation = intval(@$exif['Orientation']);
                if (!in_array($orientation, array(3, 6, 8))) {
                    return false;
                }

                $image = @imagecreatefromjpeg($path);
                switch ($orientation) {
                      case 3:
                        $image = @imagerotate($image, 180, 0);
                        break;
                      case 6:
                        $image = @imagerotate($image, 270, 0);
                        break;
                      case 8:
                        $image = @imagerotate($image, 90, 0);
                        break;
                    default:
                        return false;
                }
                $this->image = imagejpeg($image, $path);
            }
        }
    }


	/**
	 * Creates rectangle
	 *
	 * @param integer $x1 X1-coordinate
	 * @param integer $y1 Y1-coordinate
	 * @param integer $x2 X2-coordinate
	 * @param integer $y2 Y2-coordinate
	 * @param string $color Color in hexadecimal code
	 * @acces public
	 */
	public function rectangle($x1, $y1, $x2, $y2, $color) {
		$rgb = $this->hex2rgb($color);
		$color = imagecolorallocate($this->image, $rgb['r'], $rgb['g'], $rgb['b']);
		imagefilledrectangle($this->image, $x1, $y1, $x2, $y2, $color);
	}

	/**
	 * Creates ellipse
	 *
	 * @param integer $x X-coordinate
	 * @param integer $y Y-coordinate
	 * @param integer $width Width of ellipse
	 * @param integer $height Height of ellipse
	 * @param string $color Color in hexadecimal code
	 * @acces public
	 */
	public function ellipse($x, $y, $width, $height, $color) {
		$rgb = $this->hex2rgb($color);
		$color = imagecolorallocate($this->image, $rgb['r'], $rgb['g'], $rgb['b']);
		imagefilledellipse($this->image, $x, $y, $width, $height, $color);
	}

	/**
	 * Creates polygon
	 *
	 * @param array $points Coordinates of the vertices
	 * @param string $color Color in hexadecimal code
	 * @acces public
	 */
	public function polygon($points, $color) {
		$rgb = $this->hex2rgb($color);
		$color = imagecolorallocate($this->image, $rgb['r'], $rgb['g'], $rgb['b']);
		$num = count($points)/2;
		imagefilledpolygon($this->image, $points, $num, $color);
	}

	/**
	 * Draws a line
	 *
	 * @param array $points Coordinates of the vertices
	 * @param string $color Color in hexadecimal code
	 * @acces public
	 */
	public function line($points, $color) {
		$rgb = $this->hex2rgb($color);
		$color = imagecolorallocate($this->image, $rgb['r'], $rgb['g'], $rgb['b']);
		imageline($this->image, $points[0], $points[1], $points[2], $points[3], $color);
	}

	/**
	 * Writes on image
	 *
	 * @param integer $x X-coordinate
	 * @param integer $y Y-coordinate
	 * @param string $font Path to ttf
	 * @param integer $size Font size
	 * @param integer $angle in degree
	 * @param string $color Color in hexadecimal code
	 * @param string $text Text
	 * @acces public
	 */
	public function write($x, $y, $font, $size, $angle, $color, $text) {
		$rgb = $this->hex2rgb($color);
		$color = imagecolorallocate($this->image, $rgb['r'], $rgb['g'], $rgb['b']);
		imagettftext($this->image, $size, $angle, $x, $y, $color, $font, $text);
	}

	/**
	 * Merges image with another
	 *
	 * @param Image $img object
	 * @param mixed $x X-coordinate
	 * @param mixed $y Y-coordinate
	 * @acces public
	 */
	public function merge($img, $x, $y) {
		$infos = $img->get_info();

		switch($x) {
			case 'left':
				$x = 0;
				break;

			case 'right':
				$x = $this->width-$infos['width'];
				break;

			default:
				$x = $x;
		}

		switch($y) {
			case 'top':
				$y = 0;
				break;

			case 'bottom':
				$y = $this->height-$infos['height'];
				break;

			default:
				$y = $y;
		}

		imagealphablending($this->image, true);
		imagecopy($this->image, $infos['resource'], $x, $y, 0, 0, $infos['width'], $infos['height']);
	}
	
	
	// Show Image
	// ---------------------------------------------------------------------------
	public function show()
	{
		// JPG
		if($this->type == 'jpg')
		{
			header('Content-type:image/jpeg');
			imagejpeg($this->image,NULL,$this->quality);
		}
		
		// GIF
		elseif($this->type == 'gif')
		{
			header('Content-type:image/gif');
			imagegif($this->image,NULL,$this->quality);
		}
		
		// PNG
		elseif($this->type == 'png')
		{
			header('Content-type:image/png');
			imagepng($this->image,NULL,$this->compression);
		}
		
		return $this;
	}

	/**
	 * Saves image
	 *
	 * @param string $path Path to location
	 * @param string $type Filetype
	 * @return boolean true if image was saved
	 * @acces public
	 */
	public function save($path) {
		$dir = dirname($path);
		$type = pathinfo($path, PATHINFO_EXTENSION);

		if(!file_exists($dir) || !is_dir($dir))
			return false;

		if(!is_writable($dir))
			return false;

		if($type != 'gif' && $type != 'jpeg' && $type != 'jpg' && $type != 'png') {
			$type = $this->type;
			$path .= '.'.$type;
		}

		switch($type) {
			case 'gif':
				imagegif($this->image, $path, $quality);
				break;

			case 'jpeg': case 'jpg':
				imagejpeg($this->image, $path, $this->quality);
				break;

			default:
				imagepng($this->image, $path, $this->compression);
		}
		
		return true;
	}
	
	public function close()
	{
		imagedestroy($this->image);
		
		return $this;
	}
}