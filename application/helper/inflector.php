<?
/**
* File: Inflector
*/
	/**
	* Function: camelize
	* Converts a given string to camel-case.
	*
	* Parameters:
	*     $string - The string to camelize.
	*     $keep_spaces - Whether or not to convert underscores to spaces or remove them.
	*
	* Returns:
	*     A CamelCased string.
	*
	* See Also:
	*     <decamelize>
	*/
    function camelize($string, $keep_spaces = false) 
    {
        $lower = strtolower($string);
        $deunderscore = str_replace("_", " ", $lower);
        $dehyphen = str_replace("-", " ", $deunderscore);
        $final = ucwords($dehyphen);

        if (!$keep_spaces)
            $final = str_replace(" ", "", $final);

        return $final;
    }


	/**
	* Function: decamelize
	* Decamelizes a string.
	*
	* Parameters:
	*     $string - The string to decamelize.
	*
	* Returns:
	* 	  a de_camel_cased string.
	*
	* See Also:
	*     <camelize>
	*/
    function decamelize($string) 
    {
        return strtolower(preg_replace("/([a-z])([A-Z])/", "\\1 \\2", $string));
    }


	/**
	* Function: underscore
	* Return an underscore_syntaxed (like_this_dear_reader) from something LikeThisDearReader.
	*
	* Parameters:
	*     string $string CamelCased word to be "underscorized"
	*
	* Returns:
	*     string Underscored version of the $string
	*
	* See Also:
	*     <dash>
	*/
    function underscore($string) 
    {
        return strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $string));
    }

	/**
	* Function: dash
	* Return an dashed-syntaxed (like-this-dear-reader) from something LikeThisDearReader.
	*
	* Parameters:
	*     string $string CamelCased word to be "underscorized"
	*
	* Returns:
	*     string Underscored version of the $string
	*
	* See Also:
	*     <underscore>
	*/
    function dash($string) 
    {
        return strtolower(preg_replace('/(?<=\\w)([A-Z])/', '-\\1', $string));
    }
    
	/**
	* Function: humanize
	* Return a Humanized syntaxed (Like this dear reader) from something like-this-dear-reader.
	*
	* Parameters:
	*     string $string CamelCased word to be "underscorized"
	*
	* Returns:
	*	  string Underscored version of the $string
	*/
    function humanize($string) 
    {
		$string = str_replace('_', ' ', $string);
		$string = str_replace('-', ' ', $string);
		
        return ucfirst( $string );
    }


	/**
	* Function: is_upper
	* Determines if a string contains all uppercase characters.
	*
	* Parameters:
	*     string $string string to check
	*
	* Returns:
	*	  bool
	*
	* See Also:
	*     <is_lower>
	*/
	function is_upper($string)
	{
		return (strtoupper($string) === $string);
	}
	

	/**
	* Function: is_lower
	* Determines if a string contains all lowercase characters.
	*
	* Parameters:
	*     string $string string to check
	*
	* Returns:
	*     bool
	*
	* See Also:
	*     <is_upper>
	*/
	function is_lower($string)
	{
		return (strtolower($string) === $string);
	}	