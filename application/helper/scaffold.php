<?php
/**
* File: Scaffold
*/


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

    static public function processThis( $scaffold_data ) 
    {  
        $return_data = "";
      
		$inflector = new inflector();

        if ( $scaffold_data[ 'display' ] == 'admin' ):
			foreach ($scaffold_data as $input):
			
				$input_name = $inflector->underscore( $inflector->camelize( $input['name']) );

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
			
	            if ($input['input'] == 'input'):
	                switch($input['type']) {
	                    case 'text':
	                       	$return_data .= '<div class="clearfix">
												<label for="scaffold'.$input_name.'">'.$input['name'].'</label>
												<div class="input">
													<input type="text" class="xlarge" name="'.$input_name.'" />
													<!--<span class="help-block">'.$input['notes'].'</span>-->
												</div>
											</div>';
						break;
						case 'password':
	 						$return_data .= '<div class="clearfix">
												<label for="'.$input_name.'">'.$input['name'].'</label>
												<div class="input">
													<input type="password" class="xlarge" name="'.$input_name.'" />
													<span class="help-block">'.$input['notes'].'</span>
												</div>
											</div>';
						break;    
					    case 'button':
							
							if ( $scaffold_data[ 'display' ] != 'admin' ):
								$return_data .= self::createButton($input['button_name']);
							endif;
	                    break; 
						default:
							
						break;          
					}// switch 
	
	                elseif($input['input'] == 'option'):
						$return_data .= '<select>';
							foreach ($input['options'] as $option) {	
								$return_data .= '<option value="'.$option.'">'.$option.'</option>';
							}
						$return_data .= '</select><br />';
	                elseif ($input['input'] == 'multiline'):
	                    $return_data .= '<div class="clearfix">
											<label for="'.$input_name.'">'.$input['name'].'</label>
											<div class="input">
												<textarea cols="40" rows="5" name="'.$input_name.'" class="xxlarge"></textarea>
												<span class="help-block">'.$input['notes'].'</span>
											</div>
										</div>';
	                endif;
	            endforeach;
	
			endif;
        
        echo $return_data;
        
    } // function process  
  
    static public function populateThis( $data ='', $get_page_meta )
    {
	if ( $page_id = '' )
		return false;

        $return_data = "";

		$inflector = new inflector();
		
        if ( $data[ 'display' ] != 'front' ):
			foreach ($data as $input):
			
				$input_name =$inflector->underscore( $inflector->camelize( $input['name']) );
				
	            if ($input['input'] == 'input'):
	                switch($input['type']) {
	                    case 'text':
	                        $return_data .= '<div class="clearfix"><label for="'.$input_name.'">'.$input['name'].'</label><div class="input"><input type="text" class="xlarge" name="'.$input_name.'" value="'.$get_page_meta->$input_name.'"/></div></div>';
						break;
						case 'password':
	 						$return_data .= '<div class="clearfix"><label for="'.$input['name'].'">'.$input['name'].'</label><div class="input"><input type="password" class="xlarge" name="'.$input['name'].'" value="'.$get_page_meta->$input_name.'"/></div></div>';
						break;    
					    case 'button':
							
							if ( $data[ 'display' ] != 'admin' ):
								$return_data .= self::createButton($input['button_name']);
							endif;
	                    break;               
	                    }// switch 
	                elseif($input['input'] == 'option'):
						$return_data .= '<select>';
							foreach ($input['options'] as $option) {	
								$return_data .= '<option value="'.$option.'">'.$option.'</option>';
							}
						$return_data .= '</select><br />';
	                elseif ($input['input'] == 'multiline'):
	                    $return_data .= '<div class="clearfix"><label for="'.$input_name.'">'.$input['name'].'</label><div class="input"><textarea cols="40" rows="5" name="'.$input_name.'">'.$get_page_meta->message.'</textarea></div></div>';
	                endif;
	            endforeach;
	
			endif;
        
        echo $return_data;
        
    } // function populate

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