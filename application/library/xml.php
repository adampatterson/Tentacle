<?php if(!defined('DINGO')){die('External Access to File Denied');}

/**
 * Dingo Framework XML Library
 *
 * @Author          Evan Byrne
 * @Copyright       2008 - 2010
 * @Project Page    http://www.dingoframework.com
 * @docs            http://www.dingoframework.com/docs/xml-helper
 */

class xml
{
	// Parse XML
	// ---------------------------------------------------------------------------
	public static function parse($xml=FALSE)
	{
		$parser = new DOMDocument();
		
		// Silence any errors and return FALSE if XML failed to parse
		if(!$parser->loadXML($xml,LIBXML_NOERROR))
		{
			return FALSE;
		}
		
		$doc = $parser->documentElement;
		return self::parse_childnodes($doc);
	}
	
	
	// Parse XML Child Nodes
	// ---------------------------------------------------------------------------
	public static function parse_childnodes($element)
	{
		$tree = array();
		
		// Loop Child nodes
		foreach($element->childNodes AS $item)
		{
			// Text Nodes
			if($item->nodeName == '#text')
			{
				// Only Add Ones that are not empty
				if(!empty($item->nodeValue) AND !preg_match('/^([ \t\n\r]+)$/',$item->nodeValue))
				{
					$tree[] = array(
						'type'=>'text',
						'value'=>$item->nodeValue
					);
				}
			}
			
			// Regular Nodes
			else
			{
				$i = array(
					'type'=>'node',
					'name'=>$item->nodeName,
					'value'=>$item->nodeValue
				);
				
				// Node Children
				if(!empty($item->childNodes))
				{
					$x = xml::parse_childnodes($item);
					
					if(!empty($x))
					{
						$i['children'] = $x;
					}
				}
				
				$a = array();
				
				// Node Attributes
				if(!empty($item->attributes))
				{
					foreach($item->attributes as $attr)
					{
						$a[$attr->name] = $attr->value;
					}
				}
				
				if(!empty($a))
				{
					$i['attributes'] = $a;
				}
				
				$tree[] = $i;
			}
		}
		
		return $tree;
	}
	
	
	// Build XML from Tree
	// ---------------------------------------------------------------------------
	public static function build($tree,$short=array('link','img','meta','hr','br','wbr'))
	{
		$xml = '';
		
		// Loop through tree
		foreach($tree as $el)
		{
			// Text elements
			if($el['type'] == 'text')
			{
				$xml .= $el['value'];
			}
			
			// Regular nodes
			else
			{
				// Find out if element is short. EX: <img />
				if(in_array($el['name'],$short))
				{
					$is_short = TRUE;
				}
				else
				{
					$is_short = FALSE;
				}
				
				
				// If element contains attributes
				if(!empty($el['attributes']))
				{
					$xml .= "<{$el['name']}";
					
					foreach($el['attributes'] as $attr=>$value)
					{
						$xml .= " $attr=\"$value\"";
					}
					
					if($is_short)
					{
						$xml .= '/>';
					}
					else
					{
						$xml .= '>';
					}
				}
				
				// If no attributes
				else
				{
					if($is_short)
					{
						$xml .= "<{$el['name']}/>";
					}
					else
					{
						$xml .= "<{$el['name']}>";
					}
				}
				
				// If element has children
				if(!empty($el['children']))
				{
					$xml .= self::build($el['children'],$short);
				}
				
				if(!$is_short)
				{
					$xml .= "</{$el['name']}>";
				}
			}
		}
		
		return $xml;
	}
}