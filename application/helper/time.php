<?

    /**
     * Function: time_in_timezone
     * Returns the appropriate time() for representing a timezone.
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
     * Returns an array of timezones that have unique offsets. Doesn't count deprecated timezones.
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