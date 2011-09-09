<?
	/**
	* truncate function 
	* Truncates a string to the given length, optionally taking into account HTML tags, and/or keeping words in tact.
	* @author CakePHP team, code style modified.
	*
	* @param $text - String to shorten.
	* @param $length - Length to truncate to.
	* @param $ending - What to place at the end, e.g. "...".
	* @param $exact - Break words?
	* @param $html - Auto-close cut-off HTML tags?
	*
	* @return String 
	*
	*/

    function truncate($text, $length = 100, $ending = "...", $exact = false, $html = false) {
        if (is_array($ending))
            extract($ending);

        if ($html) {
            if (strlen(preg_replace("/<[^>]+>/", "", $text)) <= $length)
                return $text;

            $totalLength = strlen($ending);
            $openTags = array();
            $truncate = "";
            preg_match_all("/(<\/?([\w+]+)[^>]*>)?([^<>]*)/", $text, $tags, PREG_SET_ORDER);
            foreach ($tags as $tag) {
                if (!preg_match('/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param/s', $tag[2])
                    and preg_match('/<[\w]+[^>]*>/s', $tag[0]))
                    array_unshift($openTags, $tag[2]);
                elseif (preg_match('/<\/([\w]+)[^>]*>/s', $tag[0], $closeTag)) {
                    $pos = array_search($closeTag[1], $openTags);
                    if ($pos !== false)
                        array_splice($openTags, $pos, 1);
                }

                $truncate .= $tag[1];

                $contentLength = strlen(preg_replace("/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i", " ", $tag[3]));
                if ($contentLength + $totalLength > $length) {
                    $left = $length - $totalLength;
                    $entitiesLength = 0;
                    if (preg_match_all("/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i", $tag[3], $entities, PREG_OFFSET_CAPTURE))
                        foreach ($entities[0] as $entity)
                            if ($entity[1] + 1 - $entitiesLength <= $left) {
                                $left--;
                                $entitiesLength += strlen($entity[0]);
                            } else
                                break;

                    $truncate .= substr($tag[3], 0 , $left + $entitiesLength);

                    break;
                } else {
                    $truncate .= $tag[3];
                    $totalLength += $contentLength;
                }

                if ($totalLength >= $length)
                    break;
            }
        } else {
            if (strlen($text) <= $length)
                return $text;
            else
                $truncate = substr($text, 0, $length - strlen($ending));
        }

        if (!$exact) {
            $spacepos = strrpos($truncate, " ");

            if (isset($spacepos)) {
                if ($html) {
                    $bits = substr($truncate, $spacepos);
                    preg_match_all('/<\/([a-z]+)>/', $bits, $droppedTags, PREG_SET_ORDER);
                    if (!empty($droppedTags))
                        foreach ($droppedTags as $closingTag)
                            if (!in_array($closingTag[1], $openTags))
                                array_unshift($openTags, $closingTag[1]);
                }

                $truncate = substr($truncate, 0, $spacepos);
            }
        }

        $truncate .= $ending;

        if ($html)
            foreach ($openTags as $tag)
                $truncate .= '</'.$tag.'>';

        return $truncate;
    }

    /**
     * Limit a string to a given maximum length in a smarter way than just using
     * substr. Namely, cut from the MIDDLE instead of from the end so that if
     * we're doing this on (for instance) a bunch of binder names that start off
     * with the same verbose description, and then are different only at the
     * very end, they'll still be different from one another after truncating.
     *
     * <code>
     *  <?php
     *  ...
     *  $str = "The quick brown fox jumps over the lazy dog tomorrow morning.";
     *  $shortStr = truncateMiddle($str, 40);
     *  // $shortStr = "The quick brown fox... tomorrow morning."
     *  ...
     *  ?>
     * </code>
     *
     * @todo    This is not a Rails helper...
     * @param   string  $str
     * @param   int     $maxLength
     * @param   string  $joiner
     * @return  string
     */
    function truncate_middle($str, $maxLength=80, $joiner='...')
    {
        if (strlen($str) <= $maxLength) {
            return $str;
        }
        $maxLength = $maxLength - strlen($joiner);
        if ($maxLength <= 0) {
            return $str;
        }
        $startPieceLength = (int) ceil($maxLength / 2);
        $endPieceLength = (int) floor($maxLength / 2);
        $trimmedString = substr($str, 0, $startPieceLength) . $joiner;
        if ($endPieceLength > 0) {
            $trimmedString .= substr($str, (-1 * $endPieceLength));
        }
        return $trimmedString;
    }

	/**
	*  fix function
	*
	* @author Adam Patterson
	*
	* @param $string - String to fix.
	* @param $quotes - Encode quotes?
	*
	* @return a HTML-sanitized version of a string. 
	*/

    function fix($string, $quotes = false) {
        $quotes = ($quotes) ? ENT_QUOTES : ENT_NOQUOTES ;
        return htmlspecialchars($string, $quotes, "utf-8");
    }


	/**
	* unfix function
	*
	* @author Adam Patterson
	*
	* @param $string - String to unfix. 
	*
	* @return String 
	*/
	
    function unfix($string) {
        return htmlspecialchars_decode($string, ENT_QUOTES);
    }
	 

	/**
	* sanitize function
	*
	* @author Adam Patterson
	*
	* @param $string - The string to sanitize.
	* @param $force_lowercase - Force the string to lowercase?
	* @param $anal - If set to *true*, will remove all non-alphanumeric characters.
	* @param $trunc - Number of characters to truncate to (default 100, 0 to disable). 
	* 
	* @return sanitized string, typically for URLs.
	*/
    function sanitize($string, $force_lowercase = true, $anal = false, $trunc = 100) {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
                       "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                       "—", "–", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean);
        $clean = ($trunc ? substr($clean, 0, $trunc) : $clean);
        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }

	/**
	* random function
	*
	* @author Adam Patterson
	*
	* @param  $length - How long the string should be.
	* @param  $specialchars - Use special characters in the resulting string?
	*
	* @return A string of random characters.
	*/
    function random($length, $specialchars = false) {
        $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";

        if ($specialchars)
            $pattern.= "!@#$%^&*()?~";

        $len = strlen($pattern) - 1;

        $key = "";
        for($i = 0; $i < $length; $i++)
            $key.= $pattern[rand(0, $len)];

        return $key;
    }
	 

	/**
	* normalize function
	*
	* @author Adam Patterson
	*
	* @param  $string - the string to normalize.
	*
	* @return string with normalized content 
	*/
    function normalize($string) {
        $trimmed = trim($string);
        $newlines = str_replace("\n\n", " ", $trimmed);
        $newlines = str_replace("\n", "", $newlines);
        $normalized = preg_replace("/[\s\n\r\t]+/", " ", $newlines);
        return $normalized;
    }

	/**
	* pluralize function
	*
	* @author Adam Patterson
	*
	* @param $n - number
	* @param $singular
	* @param plural
	*
	* @return String
	* @example pluralize(3, 'bean','beans')
	*/
	function pluralize($n, $singular, $plural)
	{
	    if ($n == 1) {
	        echo $n . ' ' . $singular;
	    } else {
	        echo $n . ' ' . $plural;
	    }
	}

	/**
	* escapeStr function
	*
	* @author Adam Patterson
	*
	* @param  $sting - string containing slashes.
	*
	* @return String without slashes
*/
	function escapeStr($string)
	{
	    $string = stripslashes($string);

	    return $string;
	}
	
/**
 * Prevents [widow words](http://www.shauninman.com/archive/2006/08/22/widont_wordpress_plugin)
 * by inserting a non-breaking space between the last two words.
 *
 *     echo Text::widont($text);
 *
 * @param   string  text to remove widows from
 * @return  string
 */
	function widont($str)
	{
		$str = rtrim($str);
		$space = strrpos($str, ' ');

		if ($space !== FALSE)
		{
			$str = substr($str, 0, $space).'&nbsp;'.substr($str, $space + 1);
		}

		return $str;
	}
	
	
	
	/**
     * Highlights the phrase where it is found in the text by surrounding it like
     * <strong class="highlight">I'm highlighted</strong>. The Highlighter can
     * be customized by passing highlighter as a single-quoted string with $1
     * where the prhase is supposed to be inserted.
     *
     * @param   string  $text
     * @param   string  $phrase
     * @param   string  $highlighter
     */
    function highlight($text, $phrase, $highlighter=null)
    {
        if (empty($highlighter)) {
            $highlighter='<strong class="highlight">$1</strong>';
        }
        if (empty($phrase) || empty($text)) {
            return $text;
        }
        return preg_replace("/($phrase)/", $highlighter, $text);
    }


?>