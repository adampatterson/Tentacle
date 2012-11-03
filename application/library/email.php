<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Email Library For Dingo Framework
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/email-helper
 */

class email
{
	private $to = array();
	private $from;
	private $content;
	private $subject;
	private $attachments;
	
	
	// Construct
	// ---------------------------------------------------------------------------
	public function __construct($to=FALSE,$from=FALSE,$content=FALSE,$subject=FALSE)
	{
		$this->to($to);
		$this->from($from);
		$this->content($content);
		$this->subject($subject);
		$this->attachments = array();
	}
	
	
	// To
	// ---------------------------------------------------------------------------
	public function to()
	{
		$email = func_get_args();
		
		// If email is a list of addresses
		if(is_array($email))
		{
			// Add each address to array
			foreach($email as $address)
			{
				if($address)
				{
					$this->to[] = $address;
				}
			}
		}
		
		return $this;
	}
	
	
	// From
	// ---------------------------------------------------------------------------
	public function from($from=FALSE)
	{
		$this->from = trim($from);
		return $this;
	}
	
	
	// Subject
	// ---------------------------------------------------------------------------
	public function subject($title=FALSE)
	{
		$this->subject = $title;
		return $this;
	}
	
	
	// Content
	// ---------------------------------------------------------------------------
	public function content($message=FALSE)
	{
		$this->content = wordwrap($message,70);
		$this->content = str_replace("\n.","\n..",$this->content);
		return $this;
	}
	
	// Add an attachment
	// ---------------------------------------------------------------------------
	public function attachment($filename,$content_type='application/octet-stream',$name='')
	{
		$attachment = new email_attachment();
		$attachment_name = (strlen(trim($name)) > 0) ? basename($name) : basename($filename);
		
		if($attachment->load($filename,$content_type,array('name'=>$attachment_name)))
		{
			$attachment->header("Content-Disposition","attachment;\r\n\tfilename=\"{$attachment_name}\"");
			
			// If attachment is successfully loaded then keep it.
			$this->attachments[md5($filename)] = $attachment;
		}
		return $this;
	}
	
	
	// Send
	// ---------------------------------------------------------------------------
	public function send()
	{
		$headers = array(
			"From: {$this->from}",
			"MIME-Version: 1.0"
		);
		
		// Default line endings to CRLF.
		$eol = "\r\n";
		
		// If we have an attachment, we need a multipart/mixed construct
		if(count($this->attachments) > 0)
		{
			// We have attachments, so send email as multipart/mixed content type
			$random_hash = md5(date('r',time()));
			$mime_boundary = "Dingo-{$random_hash}";
			$mime_alt_boundary = "Dingo-Alt-{$random_hash}";
			$headers[] = "Content-Type: multipart/mixed; boundary=\"{$mime_boundary}\"";
			$content = "This is a multi-part message in MIME format.{$eol}";
			
			$alt_content = array();
			
			// HTML multipart alternative
			$alt_content_attachment = new email_attachment();
			$alt_content_attachment->content($this->content,'text/html',array('charset'=>'iso-8859-1'));
			$alt_content[] = (String) $alt_content_attachment;
			
			// Plain text multipart alternative
			$alt_content_attachment = new email_attachment();
			$alt_content_attachment->content(strip_tags($this->content),'text/plain',array('charset'=>'iso-8859-1'));
			$alt_content[] = (String) $alt_content_attachment;
			
			$alt_content = implode("{$eol}--{$mime_alt_boundary}{$eol}",$alt_content);
			$alt_content = "{$eol}--{$mime_alt_boundary}{$eol}{$alt_content}{$eol}--{$mime_alt_boundary}--{$eol}";
			
			// Attach multipart alternative content
			$alt_attachment = new email_attachment();
			$alt_attachment->content($alt_content,'multipart/alternative',array('boundary'=>$mime_alt_boundary));
			array_unshift($this->attachments, $alt_attachment);
			
			// Build multipart items and content
			foreach($this->attachments as $attachment)
			{
				$content .= "{$eol}--{$mime_boundary}{$eol}";
				$content .= (String) $attachment;
			}
			$content .= "{$eol}--{$mime_boundary}--{$eol}";
		}
		else
		{
			$headers[] = "Content-Type: text/html;\r\n\tcharset=\"iso-8859-1\"";
			$content = $this->content;
		}
		
		foreach($this->to as $to)
		{
			mail($to,$this->subject,$content,implode("\r\n",$headers));
		}
	}
}

// Email Attachment class
class email_attachment
{
	private $data;
	private $headers;
	private $encoder;
	
	public function __construct()
	{
		$this->data = '';
		$this->headers = array();
		$this->encoder = 'base64';
	}
	
	// String output of attachment, with headers, etc.
	public function __toString()
	{
		$output = "\r\n";
		$headers = array();
		
		// Encode the attachment as necessary
		switch($this->encoder)
		{
			case '7bit':
			case '8bit':
				$this->header("Content-Transfer-Encoding",'7bit');
				$output .= wordwrap($this->data);
				break;
			case 'base64':
				$this->header("Content-Transfer-Encoding",'base64');
				$output .= chunk_split(base64_encode($this->data));
				break;
			default:
				$output .= wordwrap($this->data);
				break;
		}
		
		// Prepare MIME headers
		foreach($this->headers as $header=>$value)
		{
			$headers[] = "{$header}: {$value}\r\n";
		}
		
		$headers = implode('',$headers);
		return $headers . $output;
	}
	
	// Add an attachment header
	public function header($name,$value='')
	{
		$this->headers[$name] = $value;
	}
	
	// Set the Content-Type header and attributes
	public function content_type($content_type='application/octet-stream',$attributes=null)
	{
		// Prepare Content-Type additional attributes, like name, charset, etc.
		$content_attributes = (is_array($attributes)) ? $attributes : array();
		foreach($content_attributes as $attribute=>$value)
		{
			$content_attributes[$attribute] = "{$attribute}=\"{$value}\"";
		}
		$content_attributes = (count($content_attributes) > 0) ? "; \r\n\t" . implode('; ',$content_attributes) : '';
		
		// Set the Content-Type header
		$this->header("Content-Type",$content_type.$content_attributes);
	}
	
	// Loads a file attachment
	public function load($filename,$content_type='application/octet-stream',$attributes=null)
	{
		if(file_exists($filename))
		{
			$data = @file_get_contents($filename);
			if ($data !== false)
			{
				$this->content($data,$content_type,$attributes);
				return true;
			}
		}
		return false;
	}
	
	// Prepares an attachment based on a string of data, aka "Load from String"
	public function content($data,$content_type='application/octet-stream',$attributes=null)
	{
		// Determine content transfer encoding based on MIME type
		switch($content_type)
		{
			case 'text/plain':
			case 'text/html':
				$this->encoder = '7bit';
				break;
			case 'multipart/alternative':
				$this->encoder = '';
				break;
			default:
				$this->encoder = 'base64';
		}
		$this->content_type($content_type,$attributes);
		$this->data = $data;
		return true;
	}
}