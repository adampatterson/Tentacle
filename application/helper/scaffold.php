<?php
/*
 * Process PHP Array and convert it to Forum Input fields.
 * @todo humanize the label name from the input name.
 */
/*
<div class="clearfix">
	<label for="default_role">{ NAME }</label>
	<div class="input">
		{ INPUT }
	</div>
</div>
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
                        $return_data .= '<div class="clearfix"><label for="'.$input['name'].'">'.$input['name'].'</label><div class="input"><input type="text" class="xlarge" name="'.$input['name'].'" /></div></div>';
					break;
					case 'password':
 						$return_data .= '<div class="clearfix"><label for="'.$input['name'].'``">Password</label><div class="input"><input type="password" class="xlarge" name="'.$input['name'].'" /></div></div>';
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
                    $return_data .= '<textarea cols="40" rows="5" class="markItUp"></textarea><br />';
                }
            } // foreach
          
        //$firephp->log($input, 'Scaffold array');
        
        echo $return_data;
        
    } // function process  
    
	static public function createButton( $name = '' ) 
	{
		if (isset($name)):
			$button =  '<input type="submit" value="'.$name.'" class="btn medium secondary"><br />';   
		else:
			$button =  '<input type="submit" value="Submit" class="btn medium secondary"><br />';   
		endif;
		
		return $button;
	}


	static public function destructForm() {
        echo '</form>';
    }
} // class scaffold
?>