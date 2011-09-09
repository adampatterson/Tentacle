<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Pagination Library For Dingo Framework
 *
 * @author          Evan Byrne
 * @copyright       2008 - 2010
 * @project page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/pagination-library
 */

class pagination
{
	private $resource;
	private $page;
	public $limit;
	public $count;
	
	private $total_pages;
	private $page_results;
	public $min;
	public $max;
	
	
	// Construct
	// ---------------------------------------------------------------------------
	public function __construct($resource,$page=1,$limit=10)
	{
		$this->page = $page;
		$this->limit = $limit;
		$this->min = (($this->page*$this->limit)-$this->limit);
		$this->max = (($this->page*$this->limit)-1);
		
		if(is_array($resource))
		{
			$this->resource = $resource;
			$this->count = count($resource);
			$this->calculate();
		}
		else
		{
			$this->resource = array();
			$this->count = $resource;
			$this->calculate();
		}
	}
	
	
	// Calculate
	// ---------------------------------------------------------------------------
	public function calculate()
	{
		$this->total_pages = ceil($this->count/$this->limit);
		$this->page_results = array();
		
		if(!empty($this->resource))
		{
			$x = 0;
			foreach($this->resource as $row)
			{
				if(($x >= $this->min) AND ($x <= $this->max))
				{
					$this->page_results[] = $row;
				}
				
				$x++;
			}
		}
	}
	
	
	// Results
	// ---------------------------------------------------------------------------
	public function results()
	{
		return $this->page_results;
	}
	
	
	// Next
	// ---------------------------------------------------------------------------
	public function next()
	{
		if($this->page < $this->total_pages)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	
	// Prev
	// ---------------------------------------------------------------------------
	public function prev()
	{
		if($this->page > 1)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	
	// Next Page
	// ---------------------------------------------------------------------------
	public function next_page()
	{
		return ($this->page+1);
	}
	
	
	// Prev Page
	// ---------------------------------------------------------------------------
	public function prev_page()
	{
		return ($this->page-1);
	}
	
	
	// Total
	// ---------------------------------------------------------------------------
	public function total()
	{
		return $this->total_pages;
	}
}