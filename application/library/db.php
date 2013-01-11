<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * DB Library For Dingo Framework
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 */


load::config('db');


function db($table=FALSE,$orm=FALSE,$connection='default')
{
	// If no table given, return connection
	if(!$table) return db::connection($connection);
	
	// Otherwise, return table
	return ($orm) ? db::connection($connection)->table($table)->orm($orm) : db::connection($connection)->table($table);
}


class db
{
	private static $connections = array();
	private static $pdo = array('mysql','pgsql');

	// Add Connection
	// ---------------------------------------------------------------------------
	public static function add_connection($name)
	{
		$config = config::get('db');
		
		// Check for configuration
		if(empty($config[$name]))
		{
			dingo_error(E_USER_ERROR,"DB Connection Settings For '$name' Not Found.");
			return FALSE;
		}
		
		$config = $config[$name];
		
		$driver_class = 'pdo_db_connection';


		// Connect
		self::$connections[$name] = new $driver_class(
			
			$config['driver'],
			$config['host'],
			$config['username'],
			$config['password'],
			$config['database']
		
		);
		
		// Return connection
		return self::$connections[$name];
	}
	
	
	// Connection
	// ---------------------------------------------------------------------------
	public static function connection($name)
	{
		if(!isset(self::$connections[$name]))
		{
			return self::add_connection($name);
		}
		else
		{
			return self::$connections[$name];
		}
	}
	
	
	// Query
	// ---------------------------------------------------------------------------
	public static function query($sql)
	{
		return self::$connections['default']->query($sql);
	}
	
	
	// Clean
	// ---------------------------------------------------------------------------
	public static function clean($data)
	{
		return self::$connections['default']->clean($data);
	}
	
	
	// Quote
	// ---------------------------------------------------------------------------
	public static function quote($data)
	{
		return self::$connections['default']->con->quote($data);
	}
	
	
	// Select Table
	// ---------------------------------------------------------------------------
	public static function table($table)
	{
		return self::$connections['default']->table($table);
	}
	
	
	// Truncate Table
	// ---------------------------------------------------------------------------
	public static function truncate($table)
	{
		return self::$connections['default']->truncate($table);
	}
	
	
	// Drop Table
	// ---------------------------------------------------------------------------
	public static function drop($table)
	{
		return self::$connections['default']->drop($table);
	}
}



/**
 * SQL Query Building Class For Dingo Framework DB Drivers
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 */

class DingoSQL
{
	static function backtick($driver='mysql')
	{
		if($driver == 'mysql')
		{
			return '`';
		}
		elseif($driver == 'pgsql' OR $driver == 'sqlite3')
		{
			return '"';
		}
	}
	
	
	// Build WHERE portion of a query
	// ---------------------------------------------------------------------------
	static function build_where($where_list,$driver)
	{
		$sql = ' WHERE';
		$tick = DingoSQL::backtick($driver);
		
		
		foreach($where_list as $i)
		{
			if($i['type'] == 'column')
			{
				if($i['operator'] == 'LIKE')
				{
					$sql .= " $tick{$i['column']}$tick {$i['operator']} '%{$i['value']}'";
				}
				else
				{
					$sql .= " $tick{$i['column']}$tick {$i['operator']} '{$i['value']}'";
				}
			}
			elseif($i['type'] == 'on')
			{
				$sql .= " $tick{$i['col1']}$tick {$i['operator']} $tick{$i['col2']}$tick";
			}
			elseif($i['type'] == 'clause')
			{
				$sql .= " {$i['clause']}";
			}
			
		}
		
		return $sql;
	}
	
	
	// Build columns portion of query
	// EX: SELECT[ *] or SELECT[ `col1`,`col2`]
	// ---------------------------------------------------------------------------
	static function build_columns($columns,$type,$driver)
	{
		$tick = DingoSQL::backtick($driver);
		$sql = '';
		$x = 0;
		
		// SELECT queries
		if($type == 'select')
		{
			foreach($columns as $col)
			{
				if($col != '*')
				{
					if($x > 0)
					{
						$sql .= ",$tick$col$tick";
					}
					else
					{
						$sql .= " $tick$col$tick";
					}
					
					$x++;
				}
				else
				{
					$sql .= ' *';
				}
			}
		}
		
		return $sql;
	}
	
	
	// Build CREATE TABLE query
	// ---------------------------------------------------------------------------
	static function build_create_table($name,$columns,$driver)
	{
		$tick = DingoSQL::backtick($driver);
		$sql = "CREATE TABLE $tick$name$tick\n(";
		$primary = FALSE;
		$x = 0;
		
		foreach($columns as $name=>$col)
		{
			if($x != 0)
			{
				$sql .= ',';
			}
			else
			{
				$x++;
			}
			
			// If specific length is set
			if(isset($col['length']))
			{
				$sql .= "\n$tick$name$tick {$col['type']}({$col['length']})";
			}
			else
			{
				$sql .= "\n$tick$name$tick {$col['type']}";
			}
			
			// NOT NULL
			if(isset($col['not_null']))
			{
				$sql .= ' NOT NULL';
			}
			
			// AUTO_INCREMENT
			if(isset($col['auto_increment']))
			{
				$sql .= ' AUTO_INCREMENT';
				$primary = $name;
			}
		}
		
		// PRIMARY KEY
		if($primary)
		{
			$sql .= ",\nPRIMARY KEY ($tick$primary$tick)";
		}
		
		$sql .= "\n)";
		
		return $sql;
	}
	
	
	// Build INSERT query
	// ---------------------------------------------------------------------------
	static function build_insert($data,$table,$driver)
	{
		$tick = DingoSQL::backtick($driver);
		$cols = '(';
		$vals = '(';
		$x = 0;
	
		foreach($data as $col=>$val)
		{
			if($x > 0)
			{
				$cols .= ",$tick$col$tick";
				$vals .= ",'$val'";
			}
			else
			{
				$cols .= "$tick$col$tick";
				$vals .= "'$val'";
			}
			
			$x++;
		}
		
		$cols .= ')';
		$vals .= ')';
		
		return "INSERT INTO $tick$table$tick $cols VALUES $vals";
	}
	
	
	// Build UPDATE query
	// ---------------------------------------------------------------------------
	static function build_update($query,$driver)
	{
		$tick = DingoSQL::backtick($driver);
		$sql = "UPDATE $tick{$query->table->name}$tick SET ";
		$x = 0;
		
		foreach($query->columns as $col=>$val)
		{
			if($x == 0)
			{
				$sql .= "$tick$col$tick='$val'";
				$x++;
			}
			else
			{
				$sql .= ",$tick$col$tick='$val'";
			}
		}
		
		$sql .= DingoSQL::build_where($query->where_list,$driver);
		
		// LIMIT
		if($query->_limit !== FALSE)
		{
			$sql .= " LIMIT {$query->_limit}";
		}
		
		return $sql;
	}
	
	
	// Build DELETE query
	// ---------------------------------------------------------------------------
	static function build_delete($query,$driver)
	{
		$tick = DingoSQL::backtick($driver);
		$sql = "DELETE FROM $tick{$query->table->name}$tick";
		
		$sql .= DingoSQL::build_where($query->where_list,$driver);
		
		// LIMIT
		if($query->_limit !== FALSE)
		{
			$sql .= " LIMIT {$query->_limit}";
		}
		
		return $sql;
	}
	
	
	// Build SELECT query
	// ---------------------------------------------------------------------------
	static function build_select($query,$driver)
	{
		$tick = DingoSQL::backtick($driver);
		$sql = 'SELECT';
			
		// Columns to select
		$sql .= DingoSQL::build_columns($query->columns,'select',$driver);
		
		$sql .= " FROM $tick{$query->table->name}$tick";
		
		// JOIN
		if(!empty($query->_join))
		{
			$sql .= " INNER JOIN $tick{$query->_join['table']}$tick ON {$query->_join['on']['col1']} {$query->_join['on']['operator']} {$query->_join['on']['col2']}";
		}
		
		// WHERE
		if(!empty($query->where_list))
		{
			$sql .= DingoSQL::build_where($query->where_list,$driver);
		}
		
		// ORDER BY
		if(!empty($query->order_list))
		{
			$sql .= ' ORDER BY ';
			
			$order_clauses = array();
			
			// Build each order clause into the correct SQL string format
			foreach($query->order_list as $order_clause)
			{
				$order_clauses[] = $tick . $order_clause['column'] . $tick . ' ' . $order_clause['order'];
			}
			
			// Join the order clauses together with commas
			$sql .= implode(', ', $order_clauses);
		}
		
		// LIMIT
		if($query->_limit !== FALSE)
		{
			$sql .= " LIMIT {$query->_limit}";
		}
		
		// OFFSET
		if($query->_offset !== FALSE)
		{
			$sql .= " OFFSET {$query->_offset}";
		}

        If (DEBUG_SQL)
            logger::set('SQL', $sql);

		return $sql;
	}
	
	
	// Build COUNT query
	// ---------------------------------------------------------------------------
	static function build_count($query,$driver)
	{
		$tick = DingoSQL::backtick($driver);
		$sql = "SELECT COUNT(*) AS {$tick}num{$tick} FROM $tick{$query->table->name}$tick";
		
		// WHERE
		if(!empty($query->where_list))
		{
			$sql .= DingoSQL::build_where($query->where_list,$driver);
		}
		
		// ORDER BY
		if(!empty($query->order_list))
		{
			$sql .= ' ORDER BY ';
			
			$order_clauses = array();
			
			// Build each order clause into the correct SQL string format
			foreach($query->order_list as $order_clause)
			{
				$order_clauses[] = $tick . $order_clause['column'] . $tick . ' ' . $order_clause['order'];
			}
			
			// Join the order clauses together with commas
			$sql .= implode(', ', $order_clauses);
		}
		
		// LIMIT
		if($query->_limit !== FALSE)
		{
			$sql .= " LIMIT {$query->_limit}";
		}
		
		// OFFSET
		if($query->_offset !== FALSE)
		{
			$sql .= " OFFSET {$query->_offset}";
		}
		
		//echo "<hr/>\n$sql<hr/>\n";
		//return $this->db->query($sql);
		return $sql;
	}
	
	
	// Build DISTINCT query
	// ---------------------------------------------------------------------------
	static function build_distinct($cols,$table,$driver)
	{
		$tick = DingoSQL::backtick($driver);
		if($cols[0] == '*')
		{
			return "SELECT DISTINCT * FROM $tick$table$tick";
		}
		else
		{
			return "SELECT DISTINCT $tick".implode("$tick,$tick",$cols)."$tick FROM $tick$table$tick";
		}
	}
}



/**
 * Query Class For Dingo Framework DB Drivers
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingocode.com/framework
 */

class DingoQuery
{
	public $table;
	public $type;
	public $columns = array();
	public $where_list = array();
	public $order_list = array();
	public $_limit = FALSE;
	public $_offset = FALSE;
	public $_combos = array();
	public $_join = array();
	
	
	public function __construct($type)
	{
		$this->type = $type;
	}
	
	
	// Column
	// ---------------------------------------------------------------------------
	public function column($col,$val=FALSE)
	{
		if($this->type == 'update')
		{
			$this->columns[] = array('column'=>$col,'value'=>$this->table->db->clean($val));
		}
		else
		{
			$this->columns[] = $col;
		}
		
		return $this;
	}
	
	
	// JOIN
	// ---------------------------------------------------------------------------
	public function join($table)
	{
		$this->_join = array('table'=>$table);
		return $this;
	}
	
	
	// WHERE Statement
	// ---------------------------------------------------------------------------
	public function where($col,$operator,$val)
	{
		if(
			($operator != '=') AND
			($operator != '!=') AND
			($operator != '<') AND
			($operator != '>') AND
			($operator != '>=') AND
			($operator != '<=') AND
			($operator != 'LIKE')
		){
			trigger_error("Database error: The WHERE operator '$operator' is not recognized.",E_USER_ERROR);
		}
		
		$this->where_list[] = array(
			'type'=>'column',
			'column'=>$col,
			'operator'=>$operator,
			'value'=>$this->table->db->clean($val)
		);
		
		return $this;
	}
	
	
	// ON Statement
	// ---------------------------------------------------------------------------
	public function on($col1,$operator,$col2)
	{
		if(
			($operator != '=') AND
			($operator != '!=') AND
			($operator != '<') AND
			($operator != '>') AND
			($operator != '>=') AND
			($operator != '<=')
		){
			trigger_error("Database error: The ON operator '$operator' is not recognized.",E_USER_ERROR);
		}
		
		$this->_join['on'] = array(
			'col1'=>$col1,
			'operator'=>$operator,
			'col2'=>$col2
		);
		
		return $this;
	}
	
	
	// AND/OR clauses
	// ---------------------------------------------------------------------------
	public function clause($c)
	{
		$c = strtoupper($c);
		
		if($c != 'AND' AND $c != 'OR')
		{
			throw new Exception("mysql error: The WHERE clause '$c' is not recognized.");
		}
		
		$this->where_list[] = array('type'=>'clause','clause'=>$c);
		
		return $this;
	}
	
	
	// ORDER BY clause
	// ---------------------------------------------------------------------------
	public function order_by($col, $order='ASC')
	{
		// Sanitise order by checking for ASC or DESC.  Default to ASC.
		$order = ('DESC' == strtoupper($order)) ? 'DESC' : 'ASC';
		
		// Store pairs (name of column, order direction) for column sorting in
		// an associative array, as this should minimise sorting inconsistencies. 
		
		$this->order_list[strtolower($col)] = array('column' => $col, 'order' => $order);
		
		return $this;
	}
	
	
	// Limit
	// ---------------------------------------------------------------------------
	public function limit($limit)
	{
		$this->_limit = $limit;
		return $this;
	}
	
	
	// Offset
	// ---------------------------------------------------------------------------
	public function offset($offset=0)
	{
		$this->_offset = $offset;
		return $this;
	}
	
	
	// Combine
	// ---------------------------------------------------------------------------
	public function combine($table,$key,$where,$limit=FALSE)
	{
		$this->_combos[] = array('table'=>$table,'key'=>$key,'where'=>$where,'limit'=>$limit);
		return $this;
	}
	
	
	// Paginate
	// ---------------------------------------------------------------------------
	public function paginate($page=1,$limit=10,&$p=FALSE)
	{
		// Get row count
		$q = new DingoQuery('count');
		$q->table = $this->table;
		$q->where_list = $this->where_list;
		$q->order_list = $this->order_list;
		$q->_join = $this->_join;
		$count = $q->execute();
		
		// Paginate
		load::library('pagination');
		$p = new pagination($count,$page,$limit);
		$this->offset($p->min);
		$this->limit($limit);
		
		return $this;
	}
	
	
	// Execute
	// ---------------------------------------------------------------------------
	public function execute()
	{
		return $this->table->execute($this);
	}
}


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

    public $query_run;


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

            $this->query_run = DingoSQL::build_insert($clean,$this->name,$this->db->driver);

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

            $this->query_run = DingoSQL::build_select($query,$this->db->driver);
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

            $this->query_run = DingoSQL::build_count($query,$this->db->driver);
        }
        // Updates
        elseif($query->type == 'update')
        {
            $data = $this->db->query(DingoSQL::build_update($query,$this->db->driver));

            $this->query_run = DingoSQL::build_update($query,$this->db->driver);
        }
        // Deletes
        elseif($query->type == 'delete')
        {
            $data = $this->db->query(DingoSQL::build_delete($query,$this->db->driver));

            $this->query_run = DingoSQL::build_delete($query,$this->db->driver);
        }


        return $data;
    }
}