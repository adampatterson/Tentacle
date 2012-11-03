<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Note Library For Dingo Framework
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/note-library
 */

class note
{
	// Set
	// ---------------------------------------------------------------------------
	public static function set($type,$id,$message)
	{
		$c = config::get('notes');
		$c['name'] = "note-$type-$id";
		$c['value'] = $message;
		cookie::set($c);
	}
	
	
	// Regular
	// ---------------------------------------------------------------------------
	public static function regular($id,$message)
	{
		self::set('regular',$id,$message);
	}
	
	
	// Error
	// ---------------------------------------------------------------------------
	public static function error($id,$message)
	{
		self::set('error',$id,$message);
	}
	
	
	// Warning
	// ---------------------------------------------------------------------------
	public static function warning($id,$message)
	{
		self::set('warning',$id,$message);
	}
	
	
	// Success
	// ---------------------------------------------------------------------------
	public static function success($id,$message)
	{
		self::set('success',$id,$message);
	}
	
	
	// Get
	// ---------------------------------------------------------------------------
	public static function get($id,$type=FALSE)
	{
		// Type specified
		if($type)
		{
			if($note = input::cookie("note-$type-$id"))
			{
				self::delete($id);
				return array('id'=>$id,'type'=>$type,'content'=>$note);
			}
			else
			{
				return FALSE;
			}
		}
		
		// Type not specified
		else
		{
			// Regular
			if($note = input::cookie("note-regular-$id"))
			{
				self::delete($id);
				return array('id'=>$id,'type'=>'regular','content'=>$note);
			}
			
			// Error
			elseif($note = input::cookie("note-error-$id"))
			{
				self::delete($id);
				return array('id'=>$id,'type'=>'error','content'=>$note);
			}
			
			// Warning
			elseif($note = input::cookie("note-warning-$id"))
			{
				self::delete($id);
				return array('id'=>$id,'type'=>'warning','content'=>$note);
			}
			
			// Sucess
			elseif($note = input::cookie("note-success-$id"))
			{
				self::delete($id);
				return array('id'=>$id,'type'=>'success','content'=>$note);
			}
			
			else
			{
				return FALSE;
			}
		}
	}
	
	
	// All
	// ---------------------------------------------------------------------------
	public static function all($regex=FALSE)
	{
		$res = array();
		
		foreach($_COOKIE as $name=>$content)
		{
			if(preg_match('/^note\-(regular|error|warning|success)/',$name))
			{
				$id = preg_replace('/^note\-(regular|error|warning|success)\-/','',$name);
				
				if(!$regex OR preg_match($regex,$id))
				{
					$type = preg_replace('/^note\-(regular|error|warning|success)\-([\-_ a-zA-Z0-9\!\,\~\&\.\:\+\@]+)/','$1',$name);
					$res[] = array('id'=>$id,'type'=>$type,'content'=>$content);
					self::delete($id);
				}
			}
		}
		
		if(!empty($res))
		{
			return $res;
		}
		else
		{
			return FALSE;
		}
	}
	
	
	// Delete
	// ---------------------------------------------------------------------------
	public static function delete($id)
	{
		$c = config::get('notes');
		
		$c['name'] = "note-regular-$id";
		cookie::delete($c);
		
		$c['name'] = "note-error-$id";
		cookie::delete($c);
		
		$c['name'] = "note-warning-$id";
		cookie::delete($c);
		
		$c['name'] = "note-success-$id";
		cookie::delete($c);
	}
}