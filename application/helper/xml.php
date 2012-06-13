<?
/**
* Function: xml_arr
* Recursively converts a SimpleXML object (and children) to an array.
*
* Parameters:
* 		$parse - The SimpleXML object to convert into an array.
* 
* Returns:
*     	array 
*
* See Also:
*     <arr_xml>
*/
function xml_arr($parse) {
    if (empty($parse))
        return "";

    $parse = (array) $parse;

    foreach ($parse as &$val)
        if (get_class($val) == "SimpleXMLElement")
            $val = xml2arr($val);

    return $parse;
}


/**
* Function: arr_xml
* Recursively adds an array (or object I guess) to a SimpleXML object.
*
* Parameters:
* 		&$object - The SimpleXML object to modify.
* 		$data - The data to add to the SimpleXML object.
* 
* Returns:
*     	xml 
*
* See Also:
*     <xml_arr>
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
}