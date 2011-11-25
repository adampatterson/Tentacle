<?php

/**
 * DB PDO Driver For Dingo Framework DB Library
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 */

class pdo_db_connection
{
	public $con;
	public $last_result;
	public $driver;
	
	private $host;
	private $username;
	private $password;
	private $database;
	
	
	// Construct
	// ---------------------------------------------------------------------------
	public function __construct($driver,$host,$username,$password,$database)
	{
		$this->driver = $driver;
		$this->host = $host;
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;
		
		try
		{
			$this->con = new pdo("{$this->driver}:dbname={$this->database};host={$this->host}",$this->username,$this->password);
		}
		catch(PDOException $e)
		{
			dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
		}
	}
	
	
	// Query
	// ---------------------------------------------------------------------------
	public function query($sql,$orm=FALSE)
	{
		// If SQL statement is a SELECT statement
		if(preg_match('/^SELECT/is',$sql))
		{
			$res = $this->con->prepare($sql);
			//$res->setFetchMode(PDO::FETCH_ASSOC);
			
			if($orm)
			{
				load::orm_class($orm);
				$res->setFetchMode(PDO::FETCH_CLASS,$orm.'_orm');
			}
			else
			{
				$res->setFetchMode(PDO::FETCH_CLASS,'dingo');
			}
			
			
			$res->execute();
			
			$this->last_result = $res->fetchAll();
		}
		
		// Any other kind of statement
		else
		{
			$this->last_result = $this->con->exec($sql);
		}
		
		return $this->last_result;
	}
	
	
	// Clean
	// ---------------------------------------------------------------------------
	public function clean($data)
	{
		return substr($this->con->quote($data),1,-1);
	}
	
	
	// Quote
	// ---------------------------------------------------------------------------
	public function quote($data)
	{
		return $this->con->quote($data);
	}
	
	
	// Select Table
	// ---------------------------------------------------------------------------
	public function table($table)
	{
		$t = new pdo_db_table($table);
		$t->db = $this;
		$t->name = $table;
		
		return $t;
	}
	
	
	// Truncate Table
	// ---------------------------------------------------------------------------
	public function truncate($table)
	{
		return $this->query("TRUNCATE TABLE {$this->quote($table)}");
	}
	
	
	// Drop Table
	// ---------------------------------------------------------------------------
	public function drop($table)
	{
		return $this->query("DROP TABLE {$this->quote($table)}");
	}
}



/**
 * DB Table Class For Dingo Framework DB Library
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 */

class pdo_db_table
{
	public $db;
	public $table;
	public $name;
	public $_orm;
	
	
	// ORM
	// ---------------------------------------------------------------------------
	public function orm($orm)
	{
		$this->_orm = $orm;
		return $this;
	}
	
	
	// All
	// ---------------------------------------------------------------------------
	public function all()
	{
		return $this->select('*')->execute();
	}
	
	
	// Total
	// ---------------------------------------------------------------------------
	public function total()
	{
		return $this->count()->execute();
	}
	
	
	// Select
	// ---------------------------------------------------------------------------
	public function select()
	{
		$query = new DingoQuery('select');
		$query->table = $this;
		$args = func_get_args();
		
		if((func_num_args() == 3) AND (!empty($args[1])) AND in_array($args[1],array('=','!=','<','>','>=','<=','LIKE')))
		{
			$query->columns[] = '*';
			return $query->where($args[0],$args[1],$args[2])->execute();
		}
		else
		{
			$query->columns = $args;
			return $query;
		}
	}
	
	
	// Count
	// ---------------------------------------------------------------------------
	public function count()
	{
		$query = new DingoQuery('count');
		$query->table = $this;
		return $query;
	}
	
	
	// Select Distinct
	// ---------------------------------------------------------------------------
	public function distinct()
	{
		$cols = func_get_args();
		
		return $this->db->query(DingoSQL::build_distinct($cols,$this->name));
	}
	
	
	// Update
	// ---------------------------------------------------------------------------
	public function update($cols)
	{
		$query = new DingoQuery('update');
		$query->table = $this;
		
		// Clean the data
		foreach($cols as $col=>$val)
		{
			$query->columns[$col] = $this->db->clean($val);
		}
		
		return $query;
	}
	
	
	// Delete
	// ---------------------------------------------------------------------------
	public function delete()
	{
		$query = new DingoQuery('delete');
		$query->table = $this;
		
		if(func_num_args() == 3)
		{
			$args = func_get_args();
			return $query->where($args[0],$args[1],$args[2])->execute();
		}
		else
		{
			return $query;
		}
	}
	
	
	// Insert
	// ---------------------------------------------------------------------------
	public function insert($data,$query=TRUE)
	{
		if(!is_array($data))
		{
			trigger_error('DB Error: Incorrect data type passed to insert function. You must supply an associative array',E_USER_ERROR);
		}
		else
		{
			// Clean data before inserting
			$clean = array();
			$select = $this->select('*');
			$x=0;
			
			foreach($data as $key=>$val)
			{
				$clean[$key] = $this->db->clean($val);
				
				if($x > 0)
				{
					$select->clause('AND')
					       ->where($key,'=',$val);
				}
				else
				{
					$select->where($key,'=',$val);
				}
				
				$x++;
			}
			
			// Build and run SQL query
			$sql = DingoSQL::build_insert($clean,$this->name,$this->db->driver);
			$this->db->query($sql);
			
			// Return Select
			//return $this->db->con->insert_id;
			if($query)
			{
				$row = array_reverse($select->execute());
				return $row[0];
			}
		}
	}
	
	
	// Execute
	// ---------------------------------------------------------------------------
	public function execute($query)
	{
		// Selects
		if($query->type == 'select')
		{
			$data = $this->db->query(DingoSQL::build_select($query,$this->db->driver),$this->_orm);
			
			// Combos
			if(!empty($query->_combos))
			{
				$r = 0;
				foreach($data as $row)
				{
					foreach($query->_combos as $combo)
					{
						// No Limit
						if(!$combo['limit'])
						{
							$data[$r][$combo['key']] = $this->db->table($combo['table'])
																->select($combo['where'][0],$combo['where'][1],$row[$combo['where'][2]]);
						}
						
						// Limit
						else
						{
							$data[$r][$combo['key']] = $this->db->table($combo['table'])
																->select('*')
																->where($combo['where'][0],$combo['where'][1],$row[$combo['where'][2]])
																->limit($combo['limit'])
																->execute();
						}
					}
					
					$r++;
				}
			}
		}
		// Counts
		elseif($query->type == 'count')
		{
			$tmp = $this->db->query(DingoSQL::build_count($query,$this->db->driver));
			$data = $tmp[0]->num;
			
		}
		// Updates
		elseif($query->type == 'update')
		{
			$data = $this->db->query(DingoSQL::build_update($query,$this->db->driver));
		}
		// Deletes
		elseif($query->type == 'delete')
		{
			$data = $this->db->query(DingoSQL::build_delete($query,$this->db->driver));
		}
		
		return $data;
	}
}