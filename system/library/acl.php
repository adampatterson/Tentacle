<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Access Control List Library Main Class For Dingo Framework
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/acl-library
 */

class acl
{
	private static $acls = array();
	
	
	// Create ACL
	// ---------------------------------------------------------------------------
	public static function create($name)
	{
		self::$acls[$name] = new acl_resource();
		return self::$acls[$name];
	}
	
	
	// Get ACL
	// ---------------------------------------------------------------------------
	public static function get($name)
	{
		return self::$acls[$name];
	}
}


/**
 * Access Control List Library ACL Class For Dingo Framework
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 */
class acl_resource
{
	private $roles = array();
	private $resources = array();
	
	
	// Add Role
	// ---------------------------------------------------------------------------
	public function role($role,$parents=array())
	{
		$this->roles[$role] = $parents;
		return $this;
	}
	
	
	// Add Resource
	// ---------------------------------------------------------------------------
	public function resource($res,$allow=array(),$deny=array())
	{
		$this->resources[$res] = array('allow'=>$allow,'deny'=>$deny);
		return $this;
	}
	
	
	// Allow Resource
	// ---------------------------------------------------------------------------
	public function allow($role,$res)
	{
		$this->resources[$res]['allow'][] = $role;
		return $this;
	}
	
	
	// Deny Resource
	// ---------------------------------------------------------------------------
	public function deny($role,$res)
	{
		$this->resources[$res]['deny'][] = $role;
		return $this;
	}
	
	
	// Is Allowed
	// ---------------------------------------------------------------------------
	public function is_allowed($role,$res)
	{
		$tmp = $this->parents_allowed($role,$res);
		
		
		if(in_array($role,$this->resources[$res]['deny']))
		{
			$tmp = FALSE;
		}
		elseif(in_array($role,$this->resources[$res]['allow']) OR $tmp == TRUE)
		{
			$tmp = TRUE;
		}
		else
		{
			$tmp = FALSE;
		}
		
		return $tmp;
	}
	
	
	// Parents Allowed (Recursive)
	// ---------------------------------------------------------------------------
	public function parents_allowed($role,$res)
	{
		$tmp = FALSE;
	
		foreach($this->roles[$role] as $parent)
		{
			if(in_array($parent,$this->resources[$res]['deny']))
			{
				$tmp = FALSE;
			}
			elseif(in_array($parent,$this->resources[$res]['allow']))
			{
				$tmp = TRUE;
			}
			else
			{
				$tmp = $this->parents_allowed($parent,$res);
			}
		}
		
		return $tmp;
	}
}
