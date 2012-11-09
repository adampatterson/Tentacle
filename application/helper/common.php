<?
class date
{
    /**
    * Function: distance_of_time_in_words
    *	Distance of time $fromTime $toTime in words.
    *
    * Parameters:
    *	$fromTime -
	*	$toTime -
	*	$includeSeconds - 
    *
    * Returns:
    *	String
    */
    public function distance_of_time_in_words($fromTime, $toTime = 0, $includeSeconds = false)
    {
        $distanceInMinutes = round(((abs($toTime - $fromTime)/60)));
        $distanceInSeconds = round(abs($toTime - $fromTime));

        if ($distanceInMinutes >= 0 && $distanceInMinutes <= 1) {
            if (! $includeSeconds) {
                return ($distanceInMinutes == 0) ? 'less than a minute' : '1 minute';
            }

            if ($distanceInSeconds >= 0 && $distanceInSeconds <= 4) {
                return 'less than 5 seconds';
            } else if ($distanceInSeconds >= 5 && $distanceInSeconds <= 9) {
                return 'less than 10 seconds';
            } else if ($distanceInSeconds >= 10 && $distanceInSeconds <= 19) {
                return 'less than 20 seconds';
            } else if ($distanceInSeconds >= 20 && $distanceInSeconds <= 39) {
                return 'half a minute';
            } else if ($distanceInSeconds >= 40 && $distanceInSeconds <= 59) {
                return 'less than a minute';
            } else {
                return '1 minute';
            }
        } else if ($distanceInMinutes >= 2 && $distanceInMinutes <= 44) {
            return "$distanceInMinutes minutes";
        } else if ($distanceInMinutes >= 45 && $distanceInMinutes <= 89) {
            return 'about 1 hour';
        } else if ($distanceInMinutes >= 90 && $distanceInMinutes <= 1439) {
            return 'about ' . round($distanceInMinutes / 60) . ' hours';
        } else if ($distanceInMinutes >= 1440 && $distanceInMinutes <= 2879) {
            return '1 day';
        } else if ($distanceInMinutes >= 2880 && $distanceInMinutes <= 43199) {
            return intval($distanceInMinutes / 1440) . ' days';
        } else if ($distanceInMinutes >= 43200 && $distanceInMinutes <= 86399) {
            return 'about 1 month';
        } else if ($distanceInMinutes >= 86400 && $distanceInMinutes <= 525959) {
            return round(($distanceInMinutes / 43200)) . ' months';
        } else if ($distanceInMinutes >= 525960 && $distanceInMinutes <= 1051919) {
            return 'about 1 year';
        } else {
            return 'over ' . round($distanceInMinutes / 525600) . ' years';
        }
    }


    /**
    * Function: time_ago_in_words
    *	Like distance_of_time_in_words, but where <tt>to_time</tt> is fixed to 
    *	<tt>Time.now</tt>.
    *
    * Parameters:
    *	$fromTime - 
    *	$includeSeconds - 
	*
    * Returns:
    *	String
    */
    public function time_ago_in_words($fromTime, $includeSeconds=false)
    {
        return $this->distance_of_time_in_words($fromTime, time(), $includeSeconds);
    }


    /**
    * Function: distance_of_time_in_words_to_now
    *	Distance of time $fromTime to now in words.
    *
    * Parameters:
    *	$fromTime - 
	*	$includeSeconds - 
    *
    * Returns:
    *	String
    */
    public function distance_of_time_in_words_to_now($fromTime, $includeSeconds=false)
    {
        return $this->time_ago_in_words($fromTime, $includeSeconds);
    }
} // class date


/**
* Function: current_date
*	
*
* Parameters:
*	$unit - 
*	$get_time - 
*
* Returns:
*	String
*/
function current_date( $unit, $get_time = false ){
	
	$time_stamp = time();
	
	switch ($unit) {
		case 'year':
			if ( isset( $get_time ) ):
				echo strftime("%Y", $get_time );
			else:
				echo strftime("%Y", $time_stamp );
			endif;
		break;
			
		case 'month':
				if ( $get_time):
					$curr_month = strftime("%m", $get_time );
					
					$month = array (1=>"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
					$select = "<select id=\"month\" name=\"month\" tabindex=\"4\">\n";
					foreach ($month as $key => $val) {
					    $select .= "\t<option value=\"".$key."\"";
					    if ($key == $curr_month) {
					        $select .= " selected=\"selected\">".$val."</option>\n";
					    } else {
					        $select .= ">".$val."</option>\n";
					    }
					}
					$select .= "</select>";
					echo $select;
					
				else:
					$curr_month = date("m");
					$month = array (1=>"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
					$select = "<select id=\"month\" name=\"month\" tabindex=\"4\">\n";
					foreach ($month as $key => $val) {
					    $select .= "\t<option value=\"".$key."\"";
					    if ($key == $curr_month) {
					        $select .= " selected=\"selected\">".$val."</option>\n";
					    } else {
					        $select .= ">".$val."</option>\n";
					    }
					}
					$select .= "</select>";
					echo $select;
				
				endif;
			break;
		
		case 'day':
			if ( $get_time):
				echo strftime("%d", $get_time );
			else:
				echo strftime("%d", $time_stamp );
			endif;
			break;

		case 'hour':
			if ( $get_time):
				echo strftime("%H", $get_time );
			else:
				echo strftime("%H", $time_stamp );
			endif;
			break;
		
		case 'minute':
			if ( $get_time):
				echo strftime("%S", $get_time );
			else:
				echo strftime("%S", $time_stamp );
			endif;
			break;
		
		default:
			return false;
			break;
	}
}


/**
* Function: time_in_timezone
* Returns the appropriate time() for representing a timezone.
*
* Returns:
* 	The appropriate time() for representing a timezone.
*/
 function time_in_timezone($timezone) {
     $orig = get_timezone();
     set_timezone($timezone);
     $time = date("F jS, Y, g:i A");
     set_timezone($orig);
     return strtotime($time);
 }


/**
* Function: timezones
* 	Returns an array of timezones that have unique offsets. Doesn't count deprecated timezones.
* Returns: 
*	$zones - Array of timezones that have unique offsets. Doesn't count deprecated timezones.
*/
 function timezones() {
     $zones = array();

     $deprecated = array("Brazil/Acre", "Brazil/DeNoronha", "Brazil/East", "Brazil/West", "Canada/Atlantic", "Canada/Central", "Canada/East-Saskatchewan", "Canada/Eastern", "Canada/Mountain", "Canada/Newfoundland", "Canada/Pacific", "Canada/Saskatchewan", "Canada/Yukon", "CET", "Chile/Continental", "Chile/EasterIsland", "CST6CDT", "Cuba", "EET", "Egypt", "Eire", "EST", "EST5EDT", "Etc/GMT", "Etc/GMT+0", "Etc/GMT+1", "Etc/GMT+10", "Etc/GMT+11", "Etc/GMT+12", "Etc/GMT+2", "Etc/GMT+3", "Etc/GMT+4", "Etc/GMT+5", "Etc/GMT+6", "Etc/GMT+7", "Etc/GMT+8", "Etc/GMT+9", "Etc/GMT-0", "Etc/GMT-1", "Etc/GMT-10", "Etc/GMT-11", "Etc/GMT-12", "Etc/GMT-13", "Etc/GMT-14", "Etc/GMT-2", "Etc/GMT-3", "Etc/GMT-4", "Etc/GMT-5", "Etc/GMT-6", "Etc/GMT-7", "Etc/GMT-8", "Etc/GMT-9", "Etc/GMT0", "Etc/Greenwich", "Etc/UCT", "Etc/Universal", "Etc/UTC", "Etc/Zulu", "Factory", "GB", "GB-Eire", "GMT", "GMT+0", "GMT-0", "GMT0", "Greenwich", "Hongkong", "HST", "Iceland", "Iran", "Israel", "Jamaica", "Japan", "Kwajalein", "Libya", "MET", "Mexico/BajaNorte", "Mexico/BajaSur", "Mexico/General", "MST", "MST7MDT", "Navajo", "NZ", "NZ-CHAT", "Poland", "Portugal", "PRC", "PST8PDT", "ROC", "ROK", "Singapore", "Turkey", "UCT", "Universal", "US/Alaska", "US/Aleutian", "US/Arizona", "US/Central", "US/East-Indiana", "US/Eastern", "US/Hawaii", "US/Indiana-Starke", "US/Michigan", "US/Mountain", "US/Pacific", "US/Pacific-New", "US/Samoa", "UTC", "W-SU", "WET", "Zulu");

     foreach (timezone_identifiers_list() as $zone)
         if (!in_array($zone, $deprecated))
             $zones[] = array("name" => $zone,
                              "now" => time_in_timezone($zone));

		function by_time($a, $b) {
         return (int) ($a["now"] > $b["now"]);
     }

     usort($zones, "by_time");

     return $zones;
 }


/**
 * Function: set_timezone
 * Sets the timezone.
 *
 * Parameters:
 *     $timezone - The timezone to set.
 */
 function set_timezone($timezone) {
     if (function_exists("date_default_timezone_set"))
         date_default_timezone_set($timezone);
     else
         ini_set("date.timezone", $timezone);
 }


/**
* Function: get_timezone()
* Returns the current timezone.
*
* Returns:
*	Time Zone
*/
 function get_timezone() {
     if (function_exists("date_default_timezone_set"))
         return date_default_timezone_get();
     else
         return ini_get("date.timezone");
 }


/**
* Function: relative_time
* Returns the difference between the given timestamps or now.
*
* Parameters:
*     $time - Timestamp to compare to.
*     $from - Timestamp to compare from. If not specified, defaults to now.
*
* Returns:
*     A string formatted like "3 days ago" or "3 days from now".
*/
 function relative_time($when, $from = null) {
     fallback($from, time());

     $time = (is_numeric($when)) ? $when : strtotime($when) ;

     $difference = $from - $time;

     if ($difference < 0) {
         $word = "from now";
         $difference = -$difference;
     } elseif ($difference > 0)
         $word = "ago";
     else
         return "just now";

     $units = array("second"     => 1,
                    "minute"     => 60,
                    "hour"       => 60 * 60,
                    "day"        => 60 * 60 * 24,
                    "week"       => 60 * 60 * 24 * 7,
                    "month"      => 60 * 60 * 24 * 30,
                    "year"       => 60 * 60 * 24 * 365,
                    "decade"     => 60 * 60 * 24 * 365 * 10,
                    "century"    => 60 * 60 * 24 * 365 * 100,
                    "millennium" => 60 * 60 * 24 * 365 * 1000);

     $possible_units = array();
     foreach ($units as $name => $val)
         if (($name == "week" and $difference >= ($val * 2)) or # Only say "weeks" after two have passed.
             ($name != "week" and $difference >= $val))
             $unit = $possible_units[] = $name;

     $precision = (int) in_array("year", $possible_units);
     $amount = round($difference / $units[$unit], $precision);

     return $amount." ".pluralize($unit, $amount)." ".$word;
 }


/**
* Function: now
* Alias to strtotime, for prettiness like now("+1 day").
*/
 function now($when) {
     return strtotime($when);
 }


/**
* Function: number_to_phone
* Formats a $number into a US phone number. You can customize the format
* in the $options array:
*  - areaCode    - Adds parentheses around the area code.
*  - delimiter   - Specifies the delimiter to use, defaults to "-".
*  - extension   - Specifies an extension to add to the end of the
*                           generated number
*  - countryCode - Sets the country code for the phone number.
* 
*  - number_to_phone(1235551234)                              => 123-555-1234
*  - number_to_phone(1235551234, array('areaCode' => true))   => (123) 555-1234
*  - number_to_phone(1235551234, array('delimiter' => " "))   => 123 555 1234
*  - number_to_phone(1235551234, array('areaCode'  => true, 
*                                        'extension' => 555))   => (123) 555-1234 x 555
*  - number_to_phone(1235551234, array('countryCode => 1))    => +01 (123) 555-1234
*
* Parameters:
*	$number - integer - Phone number to format
*	$options array  Format options
*
* Returns:
* 	String - Formatted phone number
*/
function number_to_phone($number, $options = array())
{
   $areaCode    = isset($options['areaCode'])  ? $options['areaCode'] : null;
   $delimiter   = isset($options['delimiter']) ? $options['delimiter'] : '-';
   $extension   = isset($options['extension']) ? trim($options['extension']) : null;
   $countryCode = isset($options['countryCode']) ? $options['countryCode'] : null;

   $str = '';

   if ($countryCode) {
       $str .= "+$countryCode$delimiter";
   }

   if ($areaCode) {
       $str .= preg_replace('/([0-9]{1,3})([0-9]{3})([0-9]{4}$)/',
                            "(\\1) \\2$delimiter\\3", $number);
   } else {
       $str .= preg_replace('/([0-9]{1,3})([0-9]{3})([0-9]{4})$/',
                            "\\1$delimiter\\2$delimiter\\3", $number);
   }

   if (strlen($extension)) {
       $str .= " x $extension";
   }

   return $str;
}


/**
* Function: number_to_currency
* Formats a $number into a currency string. You can customize the format
* in the $options array.
*
*  - precision  - Sets the level of precision, defaults to 2
*  - unit       - Sets the denomination of the currency, defaults to "$"
*  - separator  - Sets the separator between the units, defaults to "."
*  - delimiter  - Sets the thousands delimiter, defaults to ","
*
*  - number_to_currency(1234567890.50)     => $1,234,567,890.50
*  - number_to_currency(1234567890.506)    => $1,234,567,890.51
*  - number_to_currency(1234567890.506, array('precision' => 3))  => $1,234,567,890.506
*  - number_to_currency(1234567890.50,  array('unit' => "&pound;", 
*                                                'separator' => ",", 
*                                                'delimiter' => "")  => &pound;1234567890,50
* Parameters:
*	$number - float - Currency value to format
*	$options - options - Format options
*
*	Returns: 
* 	string - Formatted currency value
*/
function number_to_currency($number, $options = array())
{
   if (! strlen($number)) {
       return $number;
   }

   $precision = isset($options['precision']) ? $options['precision'] : 2;
   $unit      = isset($options['unit']) ? $options['unit'] : '$';
   $delimiter = isset($options['delimiter']) ? $options['delimiter'] : ',';
   if ($precision > 0) {
       $separator = isset($options['separator']) ? $options['separator'] : '.'; 
   } else {
       $separator = '';
   }

   $parts = explode('.', number_with_precision($number, $precision));
   return $unit . number_with_delimiter($parts[0], $delimiter)
                . $separator . (isset($parts[1]) ? $parts[1] : '');
}


/**
* Function: number_to_percentage
* Formats a $number as a percentage string. You can customize the
* format in the $options array.
*
*  - precision  - Sets the level of precision, defaults to 3
*  - separator  - Sets the separator between the units, defaults to "."
*
*  - number_to_percentage(100)    => 100.000%
*  - number_to_percentage(100, array('precision' => 0))   => 100%
*  - number_to_percentage(302.0574, array('precision' => 2))   => 302.06%
*     
* Parameters:
* 	$number - integer|float - Number to format to a percentage
* 	$options - Array - Format options
*
* Returns:
* 	String - Formatted percentage value
*/
function number_to_percentage($number, $options = array())
{
   if (! strlen($number)) {
       return $number;
   }

   $precision = isset($options['precision']) ? $options['precision'] : 3;
   $separator = isset($options['separator']) ? $options['separator'] : '.';

   $number = number_with_precision($number, $precision);
   $parts = explode('.', $number);

   if (! isset($parts[1])) {
       return $parts[0] .= '%';
   } else {
       return $parts[0] . $separator . $parts[1] . '%';
   }
}


/**
* Function: number_with_delimiter
* Formats a $number with grouped thousands using $delimiter. You
* can customize the format using optional $delimiter and 
* $separator parameters.
*
*  - number_with_delimiter(12345678)        => 12,345,678
*  - number_with_delimiter(12345678.05)     => 12,345,678.05
*  - number_with_delimiter(12345678, ".")   => 12.345.678    
*
* Parameters:
* 	$number - integer|float - Number to format
*	$delimiter - String - Sets the thousands delimiter, defaults to ","
*	$separator - String - Sets the separator between the units, defaults to "."
*
* Returns:
* 	String - Formatted number
*/
function number_with_delimiter($number, $delimiter = ',', $separator = '.')
{
   if (! strlen($number)) {
       return $number;
   }

   $parts = explode('.', (string)$number);
   $parts[0] = preg_replace('/(\d)(?=(\d\d\d)+(?!\d))/',
                            "\\1$delimiter", $parts[0]);
   return implode($separator, $parts);
}

/** 
* Formats a $number with the specified level of $precision. 
* The default level of precision is 3.
*
*  - number_with_precision(111.2345)    => 111.235
*  - number_with_precision(111.2345, 2) => 111.24
*
* Parameters:
*	$number - integer|float - Number to format
*  $precison - integer - Level of precision
*
* Returns:
*	String - Formatted number
*/
function number_with_precision($number, $precision = 3) {
   if (is_numeric($number)) {
       return sprintf("%01.{$precision}f", $number);
   } else {
       return $number;
   }
}


/** 
* Function: number_to_human_size
* Formats the bytes in $size into a more understandable representation.
* Useful for reporting file sizes to users. This method returns NULL if
* $size cannot be converted into a number. You can change the default
* precision of 1 in $precision.
*
*  - number_to_human_size(123)           => 123 Bytes
*  - number_to_human_size(1234)          => 1.2 KB
*  - number_to_human_size(12345)         => 12.1 KB
*  - number_to_human_size(1234567)       => 1.2 MB
*  - number_to_human_size(1234567890)    => 1.1 GB
*  - number_to_human_size(1234567890123) => 1.1 TB
*  - number_to_human_size(1234567, 2)    => 1.18 MB
*
* Parameters:
*  $size - integer|float - Size to format
*	$preceision - integer - Level of precision
*
* Returns:
*	String - Formatted size value
*/
function number_to_human_size($size, $precision = 1) {
   if (! is_numeric($size)) {
       return null;
   }

   if ($size == 1) {
       $size = '1 Byte';
   } else if ($size < 1024) {
       $size = sprintf('%d Bytes', $size);
   } else if ($size < 1048576) {
       $size = sprintf("%.{$precision}f KB", $size / 1024);
   } else if ($size < 1073741824) {
       $size = sprintf("%.{$precision}f MB", $size / 1048576);
   } else if ($size < 1099511627776) {
       $size = sprintf("%.{$precision}f GB", $size / 1073741824);
   } else {
       $size = sprintf("%.{$precision}f TB", $size / 1099511627776);
   }

   return str_replace('.0', '', $size);
}


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


/**
 * Function: truncate
 * Truncates a string to the given length, optionally taking into account HTML tags, and/or keeping words in tact.
 * @author CakePHP team, code style modified.
 *
 * Parameters:
 *     $text - String to shorten.
 *     $length - Length to truncate to.
 *     $ending - What to place at the end, e.g. "...".
 *     $exact - Break words?
 *     $html - Auto-close cut-off HTML tags?*
 * Returns:
 *     String
 *
 * See Also:
 *     <truncate_middle>
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
* Function: random
*
* Parameters:
*	$length - How long the string should be.
*   $specialchars - Use special characters in the resulting string?
*
* Returns:
*	A string of random characters.
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
* Function: normalize
*	
*
* Parameters:
*	$string - String to normalize.
*
* Returns:
*	$normalized - string with normalized content
*/
function normalize($string) {
    $trimmed = trim($string);
    $newlines = str_replace("\n\n", " ", $trimmed);
    $newlines = str_replace("\n", "", $newlines);
    $normalized = preg_replace("/[\s\n\r\t]+/", " ", $newlines);
    
	return $normalized;
}


/**
* Function: pluralize
*	pluralize(3, 'bean','beans')
*
* Parameters:
*	$n - number
*   $singular
*	$plural
*
* Returns:
*	echo - string
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
* Function: escape_string
*
* Parameters:
*	$string - $sting - string containing slashes.
*	
*
* Returns:
*	$string - String without slashes
*/
function escape_string($string)
{
    $string = stripslashes($string);

    return $string;
}


/**
* Function: widont
* 	Prevents [widow words](http://www.shauninman.com/archive/2006/08/22/widont_wordpress_plugin)
* 	by inserting a non-breaking space between the last two words.
*
* Parameters:
*	$string - String to remove widow words from
*
* Returns:
*	$string - String
*/
function widont($string)
{
    $str = rtrim($string);
    $space = strrpos($string, ' ');

    if ($space !== FALSE)
    {
        $string = substr($string, 0, $space).'&nbsp;'.substr($string, $space + 1);
    }

    return $string;
}


/**
 * Function: highlight
 *   Highlights the phrase where it is found in the text by surrounding it like
 *   <strong class="highlight">I'm highlighted</strong>. The Highlighter can
 *   be customized by passing highlighter as a single-quoted string with $1
 *   where the prhase is supposed to be inserted.
 *
 * Parameters:
 *   $text
 *   $phrase
 *   $highlighter
 *
 * Returns:
 *     	string
 */
function highlight($text, $phrase, $highlighter=null)
{
    if (empty($highlighter)):
        $highlighter='<strong class="highlight">$1</strong>';
    endif;

    if (empty($phrase) || empty($text)):
        return $text;
    endif;

    return preg_replace("/($phrase)/", $highlighter, $text);
}


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
function current_page ($page)
{
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
    if ( $val1 == $val2 ):
        if ($return):
            return ' selected="selected"';
    	else:
            echo ' selected="selected"';
		endif;
	endif;
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
	if ( is_array( $val2 ) ):
		foreach ($val2 as $value):

			if ( $val1 == $value->id ):
				if ($return):
					return ' checked="checked"';
				else:
					echo ' checked="checked"';
				endif;	
			endif;
				
		endforeach;
	else:
		if ( $val1 == $val2 ):
			if ($return):
				return ' checked="checked"';
			else:
				echo ' checked="checked"';
			endif;
		endif;	
	endif;
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


/**
 * Function: current_user_can
 *
 */
function current_user_can () {

}


/**
 * Function: user_name
 * Returns a joined first and last name
 *
 * Returns:
 *     	string - first_name last_name
 */
function user_name ( ) {
    $id = user::id( );

    $user = load::model( 'user' );

    $user_meta = $user->get_meta( $id );

    return $user_meta->first_name.' '. $user_meta->last_name;
}


/**
 * Function: user_email
 * Recursively converts a SimpleXML object (and children) to an array.
 *
 * Returns:
 *     	string - users email address
 */
function user_email ( ) {
    $id = user::id( );

    $user = load::model( 'user' );

    $user_meta = $user->get( $id );

    return $user_meta->email;
}


/**
 * Function: user_editor
 * Returns what editor the user has chosen.
 *
 * Returns:
 *     	string
 */
function user_editor ( ) {
    $id = user::id( );

    $user = load::model( 'user' );

    $user_meta = $user->get_meta( $id );

    return $user_meta->editor;
}


/**
* Function: self_url
* builds the full URL for the current page.
*
* Returns:
* 	String - Full url
*/
function self_url() {
    $split = explode("/", $_SERVER['SERVER_PROTOCOL']);
    $protocol = strtolower($split[0]);
    $default_port = ($protocol == "http") ? 80 : 443 ;
    $port = ($_SERVER['SERVER_PORT'] == $default_port) ? "" : ":".$_SERVER['SERVER_PORT'] ;
    return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
}


/**
* Function: redirect_to
* Sends a redirects the page to a given URL
*
* Parameters:
*     $url - String
*     $external - true / false
*
* Returns:
* 	header
*/
function redirect_to($url = '', $external = false)
{
    if ($url == '') {
        $url = baseUrl();
    }

    header('Location: ' . $url);
	exit;
}


/**
* Function: page_not_found
* Sends 404 header
*
* Returns:
* 	header
*/
function page_not_found() {
    header("HTTP/1.0 404 Not Found");
    exit;
}


/**
* Function: refresh
* Refreshes the page every $sec
*
* Parameters:
*     $sec - Int
*
* Returns:
* 	HTML
*/
function refresh($sec = 1)
{
    return '<meta http-equiv="refresh" content="' . $sec . '"/>';
}


/**
* Function: url_title
* Refreshes the page every $sec
*
* Parameters:
*     $url - String
*
* Returns:
* 	$url - String
*/
function url_title($url)
{
    $url = str_replace(array("\xc4\x83","\xc4\x82"),"a",$url);
    $url = str_replace(array("\xc5\x9e","\xc5\x9f"),"s",$url);
    $url = str_replace(array("\xc5\xa2","\xc5\xa3"),"t",$url);
    
    $url = utf8_decode($url);
    $url = preg_replace("`\[.*\]`U","",$url);
    $url = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$url);
    $url = htmlentities($url, ENT_COMPAT, "iso-8859-1");
    $url = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i","\\1", $url );
    $url = preg_replace( "`&([a-z]+);`i","-", $url );
    $url = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $url);
    $url = strtolower(trim($url, '-'));

    return $url;
}

/*
//All major credit cards regex
'/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6011[0-9]{12}|622((12[6-9]|1[3-9][0-9])|([2-8][0-9][0-9])|(9(([0-1][0-9])|(2[0-5]))))[0-9]{10}|64[4-9][0-9]{13}|65[0-9]{14}|3(?:0[0-5]|[68][0-9])[0-9]{11}|3[47][0-9]{13})*$/'

//Alpha-numeric characters only
'/^[a-zA-Z0-9]*$/'

//Alpha-numeric characters with spaces only
'/^[a-zA-Z0-9 ]*$/'

//Alphabetic characters only
'/^[a-zA-Z]*$/'

//Amex credit card regex
'/^(3[47][0-9]{13})*$/'

//Australian Postal Codes
'/^((0[289][0-9]{2})|([1345689][0-9]{3})|(2[0-8][0-9]{2})|(290[0-9])|(291[0-4])|(7[0-4][0-9]{2})|(7[8-9][0-9]{2}))*$/'

//Canadian Postal Codes
'/^([ABCEGHJKLMNPRSTVXY][0-9][A-Z] [0-9][A-Z][0-9])*$/'

//Canadian Province Abbreviations
'/^(?:AB|BC|MB|N[BLTSU]|ON|PE|QC|SK|YT)*$/'

//Date (MM/DD/YYYY)
'/^((0?[1-9]|1[012])[- /.](0?[1-9]|[12][0-9]|3[01])[- /.](19|20)?[0-9]{2})*$/'

//Date (YYYY/MM/DD)
'#^((19|20)?[0-9]{2}[- /.](0?[1-9]|1[012])[- /.](0?[1-9]|[12][0-9]|3[01]))*$#'

//Digits only
'/^[0-9]*$/'

//Diner's Club credit card regex
'/^(3(?:0[0-5]|[68][0-9])[0-9]{11})*$/'

//Email regex
'/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})*$/'

//IP address regex
'/^((?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))*$/'

//Lowercase letters only
'/^([a-z])*$/'

//MasterCard credit card numbers
'/^(5[1-5][0-9]{14})*$/'

//Password regex
'/^(?=^.{6,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*$/'

//Phone number regex
'/^((([0-9]{1})*[- .(]*([0-9]{3})[- .)]*[0-9]{3}[- .]*[0-9]{4})+)*$/'

//SSN regex
'/^([0-9]{3}[-]*[0-9]{2}[-]*[0-9]{4})*$/'

//UK Postal Codes regex
'/^([A-Z]{1,2}[0-9][A-Z0-9]? [0-9][ABD-HJLNP-UW-Z]{2})*$/'

//Uppercase letters only
'/^([A-Z])*$/'

//URL regex
'/^(((http|https|ftp):\/\/)?([[a-zA-Z0-9]\-\.])+(\.)([[a-zA-Z0-9]]){2,4}([[a-zA-Z0-9]\/+=%&_\.~?\-]*))*$/'

//US States regex
'/^(?:A[KLRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])*$/'

//US ZIP Codes regex
'/^([0-9]{5}(?:-[0-9]{4})?)*$/'

//Visa credit card numbers
'/^(4[0-9]{12}(?:[0-9]{3})?)*$/'
*/
