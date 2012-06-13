<?php
/**
 * File: State
 */

/**
* Function: current_page
* If CURRENT_PAGE == $page, outputs active
*
* Parameters:
*     $page - String ( Slug )
*
* Returns:
* 		String
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
*	   $return - Return @ selected="selected"@ instead of outputting it
*
* Returns:
*     String
*
* See Also:
*	<checked>
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
*
* See Also:
*	<selected>
*/
function checked( $val1, $val2, $return = false ) 
{
	if ( is_array( $val2 ) ) 
	{
		foreach ($val2 as $value) 
		{

			if ( $val1 == $value->id )
				if ($return)
					return ' checked="checked"';
				else
					echo ' checked="checked"';
		}	
	} 
	else 
	{
		if ( $val1 == $val2 )
		if ($return)
			return ' checked="checked"';
		else
			echo ' checked="checked"';
	}
}


/**
* Function: odd_even
* Even Odd
*
* Returns:
*     String - Even : Odd
*
* See Also:
*	<even_odd>
*/
function odd_even() {
	static $odd = true;
	return ($odd = !$odd) ? 'even': 'odd';
}


/**
* Function: even_odd
* Odd Even
*
* Returns:
*     String - Even : Odd
*
* See Also:
*	<odd_even>
*/
function even_odd() {
	return odd_even();
}
	
?>