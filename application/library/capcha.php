<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Capcha Library For Dingo Framework
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/capcha-library
 */

class capcha
{
	private static $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
	
	private static $_font_file;
	private static $_font_size = FALSE;
	private static $_font_color = array(20,40,100);
	private static $_background_color = array(255,255,255);
	private static $_noise_color = array(100,120,180);
	
	
	// Font File
	// ---------------------------------------------------------------------------
	public static function font_file($font_file)
	{
		self::$_font_file = $font_file;
	}
	
	
	// Font Size
	// ---------------------------------------------------------------------------
	public static function font_size($font_size)
	{
		self::$_font_size = $font_size;
	}
	
	
	// Font Color
	// ---------------------------------------------------------------------------
	public static function font_color($f1,$f2,$f3)
	{
		self::$_font_color = array($f1,$f2,$f3);
	}
	
	
	// Background Color
	// ---------------------------------------------------------------------------
	public static function background_color($b1,$b2,$b3)
	{
		self::$_background_color = array($b1,$b2,$b3);
	}
	
	
	// Noise Color
	// ---------------------------------------------------------------------------
	public static function noise_color($n1,$n2,$n3)
	{
		self::$_noise_color = array($n1,$n2,$n3);
	}
	
	
	// Generate
	// ---------------------------------------------------------------------------
	public static function generate($id,$width=100,$height=40)
	{
		$code = session::get("capcha_$id");
		
		// If not set then font size will be 75% size of height or width
		if(!self::$_font_size)
		{
			if($width > $height)
			{
				self::$_font_size = $height * 0.75;
			}
			else
			{
				self::$_font_size = $width * 0.75;
			}
		}
		
		// Create image
		$image = imagecreate($width,$height) or die('Cannot initialize new GD image stream');
		
		// set the colors
		$background_color = imagecolorallocate($image,self::$_background_color[0],self::$_background_color[1],self::$_background_color[2]);
		$text_color = imagecolorallocate($image,self::$_font_color[0],self::$_font_color[1],self::$_font_color[2]);
		$noise_color = imagecolorallocate($image,self::$_noise_color[0],self::$_noise_color[1],self::$_noise_color[2]);
		
		// Generate random dots in background
		for($i=0;$i<($width*$height)/3;$i++)
		{
			imagefilledellipse($image,mt_rand(0,$width),mt_rand(0,$height),1,1,$noise_color);
		}
		
		// Generate random lines in background
		for($i=0;$i<($width*$height)/150;$i++)
		{
			imageline($image,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),$noise_color);
		}
		
		// create textbox and add text
		$textbox = imagettfbbox(self::$_font_size,0,self::$_font_file,$code) or die('Error in imagettfbbox function');
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image,self::$_font_size,0,$x,$y,$text_color,self::$_font_file,$code) or die('Error in imagettftext function');
		
		// Output captcha image to browser
		header('Content-Type:image/jpeg');
		imagejpeg($image);
		imagedestroy($image);
	}
	
	
	// Set
	// ---------------------------------------------------------------------------
	public static function set($id,$len=4)
	{
		session::delete("capcha_$id");
		session::set("capcha_$id",self::code($len));
	}
	
	
	// Delete
	// ---------------------------------------------------------------------------
	public static function delete($id)
	{
		session::delete("capcha_$id");
	}
	
	
	// Check
	// ---------------------------------------------------------------------------
	public static function check($id,$value)
	{
		return (session::get("capcha_$id") == strtoupper($value));
	}
	
	
	// Generate Unique Code
	// ---------------------------------------------------------------------------
	public static function code($len)
	{
		$code = '';
		$i = 0;

		while($i < $len)
		{
			$char = substr(self::$chars,mt_rand(0,strlen(self::$chars)-1),1);
			$code .= $char;
			$i++;
		}
		
		return $code;
	}
}