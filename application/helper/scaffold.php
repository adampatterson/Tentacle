<?php
/*
 * Process PHP Array and convert it to Forum Input fields.
 * @todo humanize the label name from the input name.
 */

class  Scaffold 
{
	
    static public function constructForm() 
    {
        $start =  '<form>';
        return $start;
        }    

    static public function processThis( $data ) 
    {
        
        //$firephp = FirePHP::getInstance(TRUE);
       
        $return_data = "";
      
        foreach ($data as $input) {
            //print_r($input);
            /*  
            echo $input['name'];
			@todo get the label name by using some of the string functions with the $input['name']
            echo $input['label_name'];
            echo $input['input'];
            echo $input['type'];
            echo $input['notes'];
            echo $input['options'];
            */

            if ($input['input'] == 'input') {
                switch($input['type']) {
                    case 'text':
                        $return_data .= $input['name'].': <input type="text" name="'.$input['name'].'" /><br />';
                    break;
                    case 'password':
                    	$return_data .= 'Password: <input type="password"  name="'.$input['name'].'" /><br />';
                    break;    
				    case 'button':
						$return_data .= self::createButton($input['button_name']);
                    break;               
                    }// switch 
                } elseif($input['input'] == 'option') {
					$return_data .= '<select>';
						foreach ($input['options'] as $option) {	
							$return_data .= '<option value="'.$option.'">'.$option.'</option>';
						}
					$return_data .= '</select><br />';
                } elseif ($input['input'] == 'multiline') {
                    $return_data .= '<textarea></textarea><br />';
                }
            } // foreach
          
        //$firephp->log($input, 'Scaffold array');
        
        return $return_data;
        
    } // function process  
    
   static public function createButton( $name = '' ) 
   {
            if (isset($name)){
                $button =  '<input type="submit" value="'.$name.'"><br />';   
            } else {
                $button =  '<input type="submit" value="Submit"><br />';   
            }
        return $button;
        }
    
  static public function destructForm() {
        $end = '</form>';
        
        return $end;
        }
} // class scaffold
 
 
?>