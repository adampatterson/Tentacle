<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * RSS Library Dingo Framework
 *
 * @Author          Evan Byrne
 * @Copyright       2008 -2010
 * @Project Page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/rss-helper
 */

class rss
{
	private $tab = "\t";
	private $line = "\n";
	private $items = array();
	private $channel = array(
		'title'=>NULL,
		'link'=>NULL,
		'description'=>NULL,
		'language'=>NULL,
		'pubDate'=>NULL,
		'lastBuildDate'=>NULL,
		'docs'=>NULL,
		'generator'=>'Dingo Framework',
		'managingEditor'=>NULL,
		'webMaster'=>NULL
	);
	
	
	// Construct
	// ---------------------------------------------------------------------------
	public function __construct($title,$link)
	{
		$this->channel['title'] = $title;
		$this->channel['link'] = $link;
	}
	
	
	// Change Channel Setting
	// ---------------------------------------------------------------------------
	public function channel($key,$value)
	{
		$this->channel[$key] = $value;
		return $this;
	}
	
	
	// Item
	// ---------------------------------------------------------------------------
	public function item()
	{
		return new rss_item();
	}
	
	
	// Add
	// ---------------------------------------------------------------------------
	public function add($item)
	{
		$this->items[] = $item;
		return $this;
	}
	
	
	// Compressed
	// ---------------------------------------------------------------------------
	public function compressed($is=TRUE,$tab="\t",$line="\n")
	{
		if($is)
		{
			$this->tab = '';
			$this->line = '';
		}
		else
		{
			$this->tab = $tab;
			$this->line = $line;
		}
		
		return $this;
	}
	
	
	// Build
	// ---------------------------------------------------------------------------
	public function build()
	{
		$xml = "<?xml version='1.0' ?>{$this->line}<rss version='2.0'>{$this->line}{$this->tab}<channel>{$this->line}";
		
		// Main Feed Settings
		foreach($this->channel as $key=>$val)
		{
			if(!empty($val))
			{
				$xml .= "{$this->tab}{$this->tab}<$key>$val</$key>{$this->line}";
			}
		}
		
		
		// Items
		foreach($this->items as $item)
		{
			$xml .= "{$this->line}{$this->tab}{$this->tab}<item>{$this->line}";
			
			foreach($item->settings as $key=>$val)
			{
				if(!empty($val))
				{
					$xml .= "{$this->tab}{$this->tab}{$this->tab}<$key><![CDATA[$val]]></$key>{$this->line}";
				}
			}
			
			$xml .= "{$this->tab}{$this->tab}</item>{$this->line}";
		}
		
		$xml .= "{$this->tab}</channel>{$this->line}</rss>";
		
		return $xml;
	}
	
	
	// RSS Date/Time Formatting
	// ---------------------------------------------------------------------------
	static function date($date)
	{
		$d = new DateTime($date);
		return $d->format(DATE_RSS);
	}
}



/* RSS Item Class */
class rss_item
{
	public $settings = array(
		'title'=>NULL,
		'link'=>NULL,
		'description'=>NULL,
		'pubDate'=>NULL,
		'guide'=>NULL
	);
	
	
	// Set
	// ---------------------------------------------------------------------------
	public function set($key,$val)
	{
		$this->settings[$key] = $val;
		return $this;
	}
	
	
	// Title
	// ---------------------------------------------------------------------------
	public function title($title)
	{
		$this->set('title',$title);
		return $this;
	}
	
	
	// Date
	// ---------------------------------------------------------------------------
	public function date($date)
	{
		$this->set('pubDate',rss::date($date));
		return $this;
	}
	
	
	// Link
	// ---------------------------------------------------------------------------
	public function link($link)
	{
		$this->set('link',$link);
		return $this;
	}
	
	
	// Description
	// ---------------------------------------------------------------------------
	public function description($desc)
	{
		$this->set('description',$desc);
		return $this;
	}
}