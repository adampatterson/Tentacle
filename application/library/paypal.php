<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * PayPal Library For Dingo Framework
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/paypal-helper
 */

class paypal
{
	public $error = false;
	public $url = 'https://www.paypal.com/cgi-bin/webscr';
	
	private $_valid = null;
	private $_data = '';
	private $_params = array();
	
	
	// Construct
	// ---------------------------------------------------------------------------
	public function __construct($sandbox = false)
	{
		if($sandbox) $this->url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		
		$this->param('rm',2);
		$this->param('cmd','_xclick');
	}
	
	
	// Param
	// ---------------------------------------------------------------------------
	public function param($name,$value)
	{
		$this->_params[$name] = $value;
		return $this;
	}
	
	
	// Data
	// ---------------------------------------------------------------------------
	public function data($name,$value)
	{
		$this->_data .= urlencode($name).'='.urlencode($value).'&';
		return $this;
	}
	
	
	// Generate
	// ---------------------------------------------------------------------------
	public function generate()
	{
		$t = '';
		
		foreach($this->_params as $key=>$val)
			$t .= "<input type=\"hidden\" name=\"$key\" value=\"$val\" />\n";
		
		return $t;
	}
	
	
	// Valid
	// ---------------------------------------------------------------------------
	public function valid()
	{
		// If already validated, just return last result
		if($this->_valid === true or $this->_valid === false) return $this->_valid;
		
		
		// Generate POST fields
		foreach($_POST as $key=>$val) $this->data($key,$val);
		
		
		// Connect to PayPal
		$sh = curl_init($this->url);
		curl_setopt($sh,CURLOPT_POST,true);
		curl_setopt($sh,CURLOPT_POSTFIELDS,$this->_data);
		curl_setopt($sh,CURLOPT_RETURNTRANSFER,1);
		
		
		// Bad Connection
		if(!$res = curl_exec($sh))
		{
			$this->error = 'Connection to PayPal failed.';
			$this->_valid = false;
			return false;
		}
		
		
		// Valid
		if(preg_match('/VERIFIED/is',$res))
		{
			$this->_valid = true;
			return true;
		}
		
		// Invalid
		else
		{
			$this->error = 'Invalid transaction.';
			$this->_valid = false;
			return false;
		}
	}
}