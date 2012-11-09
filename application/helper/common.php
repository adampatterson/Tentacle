<?

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
* File: Numbers
*
* Provides methods for converting a numbers into formatted strings.
* Methods are provided for phone numbers, currency, percentage,
* precision, positional notation, and file size.
*
* @category   Mad
* @package    Mad_View
* @subpackage Helper
* @copyright  (c) 2007-2009 Maintainable Software, LLC
* @license    http://opensource.org/licenses/bsd-license.php BSD
*/

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