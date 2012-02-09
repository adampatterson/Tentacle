<?php
	
	/**
	* current_page function
	*
	* @author Adam Patterson
	*
	* @param $page - current page 
	*
	* @return current
	*/

    function current_page ($page) {
		if (CURRENT_PAGE == $page)
			echo 'active';
    }


    /**
     * Function: selected
     * If $val1 == $val2, outputs or returns @ selected="selected"@
     *
     * Parameters:
     *     $val1 - First value.
     *     $val2 - Second value.
     *     $return - Return @ selected="selected"@ instead of outputting it
     */
    function selected( $val1, $val2, $return = false ) 
	{
        if ( $val1 == $val2 )
            if ($return)
                return ' selected="selected"';
            else
                echo ' selected="selected"';
    }


    /**
     * Function: checked
     * If $val == 1 (true), outputs ' checked="checked"'
     *
     * Parameters:
     *     $val - Value to check.
     */
    function checked( $val1, $val2, $return = false ) 
	{
		if ( is_array( $val2 ) ) {
			foreach ($val2 as $value) {
			
				if ( $val1 == $value->id )
					if ($return)
						return ' checked="checked"';
					else
						echo ' checked="checked"';
			}
		} else {
			if ( $val1 == $val2 )
				if ($return)
					return ' checked="checked"';
				else
					echo ' checked="checked"';
		}
    }
	 
	
	function odd_even() {
	    static $odd = true;
	    return ($odd = !$odd) ? 'even': 'odd';
	}

	function even_odd() {
	    return odd_even();
	}
	
?>