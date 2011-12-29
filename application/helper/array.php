<?php
/**
 * ELF PHP:	Extra Light php Framework
 *
 * LICENSE:	MIT License
 *
 * ELF PHP is an extra light php framework released under MIT License
 * You should have received a copy of the MIT License along with this program.  
 * If not, see http://www.opensource.org/licenses/mit-license.php
 * 
 *
 * @copyright  2008 - 2010 Alin Alexa
 * @author     Alin Alexa - framework@alinalexa.ro
 * @license    http://www.opensource.org/licenses/mit-license.php
 * @version    1.1
 * @link       http://code.google.com/p/elf-php/
 *
 */

/**
* Array to object - Takes an array as input and returns an object
* @return object
* @param  $array
*/

	function array_to_object($array = array())
	{
	    $tmp = new stdClass;

	    foreach ($array as $key => $value) {
	        if (is_array($value)) {
	            $tmp->$key = array_to_object($value);
	        } else {
	            if (is_numeric($key)) {
	                exit('Cannot turn numeric arrays into objects!');
	            }

	            $tmp->$key = $value;
	        }
	    }

	    return $tmp;
	}

/**
* Object to array - Takes an object as input and returns an array
* @param  $object Object
*/

	function object_to_array($object)
	{
	    $array = array();

	    if (is_object($object)) {
	        foreach ($object as $obj => $value) {
	            $array[$obj] = $value;
	        }

	        return $array;
	    }

	    return false;
	}
?>