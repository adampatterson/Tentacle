<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * ORM Library For Dingo Framework (Highly Experimental)
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 */

class orm
{
	public $_orm_default_columns = array();
	public $_orm_query;
	public $results;
	
	
	// Construct
	// ---------------------------------------------------------------------------
	public function __construct()
	{
		// Connection
		$this->connection = (isset($this->connection)) ? $this->connection : 'default';
		
		// ORM
		$this->orm = (isset($this->orm)) ? $this->orm : FALSE;
		
		// Columns
		foreach($this->columns as $key)
		{
			if(!empty($this->$key))
			{
				$this->_orm_default_columns[$key] = $this->$key;
			}
		}
	}
	
	
	// Get Vars
	// ---------------------------------------------------------------------------
	public function _orm_vars($obj)
	{
		$res = array();
		
		foreach($this->columns as $key)
		{
			if(isset($this->$key))
			{
				$res[$key] = $this->$key;
			}
		}
		
		return $res;
	}
	
	
	// Build Where
	// ---------------------------------------------------------------------------
	public function _orm_build_where($query,$cols)
	{
		$start = TRUE;
		foreach($cols as $key=>$val)
		{
			if($start)
			{
				$query->where($key,'=',$val);
				$start = FALSE;
			}
			else
			{
				$query->clause('AND')->where($key,'=',$val);
			}
		}
		
		return $query;
	}
	
	
	// Build Result Where
	// ---------------------------------------------------------------------------
	public function _orm_build_result_where($query,$res)
	{
		$where = array();
			
		// Build where array
		foreach($this->columns as $c)
		{
			if(property_exists($res,$c))
			{
				$where[$c] = $res->$c;
			}
		}
		
		$query = $this->_orm_build_where($query,$where);
		return $query;
	}
	
	
	// Table
	// ---------------------------------------------------------------------------
	public function _orm_table()
	{
		return (isset($this->connection)) ? db($this->table,$this->orm,$this->connection) : db($this->table,$this->orm);
	}
	
	
	// Query Method
	// ---------------------------------------------------------------------------
	public function _orm_query_method($func,$args=array())
	{
		$this->_orm_query = (!empty($this->_orm_query)) ? $this->_orm_query : $this->_orm_table()->select('*');
		call_user_func_array(array($this->_orm_query,$func),$args);
	}
	
	
	// Column
	// ---------------------------------------------------------------------------
	public function column()
	{
		$this->_orm_query_method('column',func_get_args());
		return $this;
	}
	
	
	// Join
	// ---------------------------------------------------------------------------
	public function join()
	{
		$this->_orm_query_method('join',func_get_args());
		return $this;
	}
	
	
	// Where
	// ---------------------------------------------------------------------------
	public function where()
	{
		$this->_orm_query_method('where',func_get_args());
		return $this;
	}
	
	
	// On
	// ---------------------------------------------------------------------------
	public function on()
	{
		$this->_orm_query_method('on',func_get_args());
		return $this;
	}
	
	
	// Clause
	// ---------------------------------------------------------------------------
	public function clause()
	{
		$this->_orm_query_method('clause',func_get_args());
		return $this;
	}
	
	
	// Order By
	// ---------------------------------------------------------------------------
	public function order_by()
	{
		$this->_orm_query_method('order_by',func_get_args());
		return $this;
	}
	
	
	// Limit
	// ---------------------------------------------------------------------------
	public function limit()
	{
		$this->_orm_query_method('limit',func_get_args());
		return $this;
	}
	
	
	// Offset
	// ---------------------------------------------------------------------------
	public function offset()
	{
		$this->_orm_query_method('offset',func_get_args());
		return $this;
	}
	
	
	// Paginate
	// ---------------------------------------------------------------------------
	public function paginate($page=1,$limit=10,&$p=FALSE)
	{
		$this->_orm_query_method('paginate',array($page,$limit,&$p));
		return $this;
	}
	
	
	// Combine
	// ---------------------------------------------------------------------------
	public function combine()
	{
		$this->_orm_query_method('combine',func_get_args());
		return $this;
	}
	
	
	// All
	// ---------------------------------------------------------------------------
	public function all()
	{
		$this->results = $this->_orm_table()->all();
		return $this->results;
	}
	
	
	// Total
	// ---------------------------------------------------------------------------
	public function total()
	{
		$this->results = $this->_orm_table()->total();
		return $this->results;
	}
	
	
	// Select
	// ---------------------------------------------------------------------------
	public function select()
	{
		// Query
		if(!empty($this->_orm_query))
		{
			$this->results = $this->_orm_query->execute();
			$this->_orm_query = null;
		}
		
		
		// Object
		else
		{
			$query = $this->_orm_table()->select('*');
			$cols = array();
			
			foreach($this->columns as $c)
			{
				if(isset($this->$c))
				{
					$cols[$c] = $this->$c;
				}
			}
			
			$query = $this->_orm_build_where($query,$cols);
			$this->results = $query->execute();
		}
		
		return $this->results;
	}
	
	
	// Count
	// ---------------------------------------------------------------------------
	public function count()
	{
		// Query
		if(!empty($this->_orm_query))
		{
			$this->_orm_query->type = 'count';
			$this->results = $this->_orm_query->execute();
			$this->_orm_query = null;
		}
		
		
		// Object
		else
		{
			$query = $this->_orm_table()->count();
			$cols = array();
			
			foreach($this->columns as $c)
			{
				if(isset($this->$c))
				{
					$cols[$c] = $this->$c;
				}
			}
			
			$query = $this->_orm_build_where($query,$cols);
			$this->results = $query->execute();
		}
		
		return $this->results;
	}
	
	
	// Delete
	// ---------------------------------------------------------------------------
	public function delete()
	{
		// Query
		if(!empty($this->_orm_query))
		{
			$this->_orm_query->type = 'delete';
			$this->results = $this->_orm_query->execute();
			$this->_orm_query = null;
		}
		
		
		// Results
		elseif(is_array($this->results) and !empty($this->results))
		{		
			$new_results = 0;
			
			// Loop results
			foreach($this->results as $res)
			{
				$query = $this->_orm_table()->delete();
				$query = $this->_orm_build_result_where($query,$res);
				$new_results += $query->execute();
			}
			
			$this->results = $new_results;
		}
		
		
		// Object
		else
		{
			$query = $this->_orm_table()->delete();
			$cols = array();
			
			foreach($this->columns as $c)
			{
				if(isset($this->$c))
				{
					$cols[$c] = $this->$c;
				}
			}
			
			$query = $this->_orm_build_where($query,$cols);
			$this->results = $query->execute();
		}
		
		return $this->results;
	}
	
	
	// Update
	// ---------------------------------------------------------------------------
	public function update()
	{
		// Query
		if(!empty($this->_orm_query))
		{
			$this->_orm_query->type = 'update';
			$this->_orm_query->columns = $this->_orm_vars($this);
			$this->results = $this->_orm_query->execute();
			$this->_orm_query = null;
		}
		
		
		// Results as array
		if(is_array($this->results) and !empty($this->results))
		{		
			$new_results = 0;
			
			// Loop results
			foreach($this->results as $res)
			{
				$query = $this->_orm_table()->update($this->_orm_vars($this));
				$query = $this->_orm_build_result_where($query,$res);
				$new_results += $query->execute();
			}
			
			$this->results = $new_results;
		}
		
		
		// Result as single object
		elseif(is_object($this->results))
		{
			$query = $this->_orm_table()->update($this->_orm_vars($this));
			$query = $this->_orm_build_result_where($query,$this->results);
			$this->results = $query->execute();
		}
		
		
		// Object
		elseif(!empty($this->_orm_default_columns))
		{
			$query = $this->_orm_table()->update($this->_orm_vars($this));
			$query = $this->_orm_build_where($query,$this->_orm_default_columns);
			$this->results = $query->execute();
		}
		
		return $this->results;
	}
		
	
	// Insert
	// ---------------------------------------------------------------------------
	public function insert()
	{
		// Object
		$cols = array();
		
		foreach($this->columns as $c)
		{
			if(isset($this->$c))
			{
				$cols[$c] = $this->$c;
			}
		}
		
		$this->results = $this->_orm_table()->insert($cols);
		
		foreach($this->results as $key=>$val)
		{
			$this->$key = $val;
		}
		
		return $this->results;
	}
}