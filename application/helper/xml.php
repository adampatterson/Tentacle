<?
/**
* Function: xml2arr
* Recursively converts a SimpleXML object (and children) to an array.
*
* @package Tentacle 
* @author Adam Patterson   
*
* @param  $parse - The SimpleXML object to convert into an array.
* @return array
*/

    function xml_arr($parse) {
        if (empty($parse))
            return "";

        $parse = (array) $parse;

        foreach ($parse as &$val)
            if (get_class($val) == "SimpleXMLElement")
                $val = xml2arr($val);

        return $parse;
    } // END xml2arr


/**
* Function: arr2xml
* Recursively adds an array (or object I guess) to a SimpleXML object.
*
* @package Tentacle 
* @author Adam Patterson
*
* @param &$object - The SimpleXML object to modify.
* @param $data - The data to add to the SimpleXML object. 
* @return xml 
*/

    function arr_xml(&$object, $data) {
        foreach ($data as $key => $val) {
            if (is_int($key) and (empty($val) or (is_string($val) and trim($val) == ""))) {
                unset($data[$key]);
                continue;
            }

            if (is_array($val)) {
                if (in_array(0, array_keys($val))) { # Numeric-indexed things need to be added as duplicates
                    foreach ($val as $dup) {
                        $xml = $object->addChild($key);
                        arr2xml($xml, $dup);
                    }
                } else {
                    $xml = $object->addChild($key);
                    arr2xml($xml, $val);
                }
            } else
                $object->addChild($key, fix($val, false, false));
        }
    } // END arr2xml