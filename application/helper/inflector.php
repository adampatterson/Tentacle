<?
class inflector {

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
    public static function camelize($string, $keep_spaces = false) {
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
	* Return a de_camel_cased string.
	*
	* See Also:
	*     <camelize>
	*/
    public static function decamelize($string) {
        return strtolower(preg_replace("/([a-z])([A-Z])/", "\\1 \\2", $string));
    }


    /**
     * Return an underscore_syntaxed (like_this_dear_reader) from something LikeThisDearReader.
     *
     * @param  string $string CamelCased word to be "underscorized"
     * @return string Underscored version of the $string
     */
    public static function underscore($string) {
        return strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $string));
    }

    /**
     * Return an dashed-syntaxed (like-this-dear-reader) from something LikeThisDearReader.
     *
     * @param  string $string CamelCased word to be "underscorized"
     * @return string Underscored version of the $string
     */
    public static function dash($string) {
        return strtolower(preg_replace('/(?<=\\w)([A-Z])/', '-\\1', $string));
    }
    
    /**
     * Return a Humanized syntaxed (Like this dear reader) from something like-this-dear-reader.
     *
     * @param  string $string CamelCased word to be "underscorized"
     * @return string Underscored version of the $string
     */
    public static function humanize($string) {
        return ucfirst(str_replace('-', ' ', $string));
    }


	
	/**
	* Determines if a string contains all uppercase characters.
	*
	* @param string $s string to check
	* @return bool
	*/
	public static function is_upper($s)
	{
		return (strtoupper($s) === $s);
	}
	

	/**
	* Determines if a string contains all lowercase characters.
	*
	* @param string $s string to check
	* @return bool
	*/
	public static function is_lower($s)
	{
		return (strtolower($s) === $s);
	}

}// 	