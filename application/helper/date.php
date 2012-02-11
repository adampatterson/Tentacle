<?
class date
{
    /**
     * @todo possibly convert from time object
     */
    public function distanceOfTimeInWords($fromTime, $toTime = 0, $includeSeconds = false)
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
     * Like distance_of_time_in_words, but where <tt>to_time</tt> is fixed to 
     * <tt>Time.now</tt>.
     */ 
    public function timeAgoInWords($fromTime, $includeSeconds=false)
    {
        return $this->distanceOfTimeInWords($fromTime, time(), $includeSeconds);
    }

    /**
     * alias method to timeAgoInWords
     */ 
    public function distanceOfTimeInWordsToNow($fromTime, $includeSeconds=false)
    {
        return $this->timeAgoInWords($fromTime, $includeSeconds);
    }

    public function dateSelect($objectName, $method, $options = array())
    {
        $object = isset($options['object']) ? $options['object'] : null;
        unset($options['object']);
        $tag = new $this->_instanceTag($objectName, $method, $this->_view, $object);
        return $tag->toDateSelectTag($options);        
    }
}

function current_date( $unit ){
	
	$time_stamp = time();
	
	switch ($unit) {
		case 'year':
			echo strftime("%Y", $time_stamp );
			break;
			
		case 'month':
				$curr_month = date("m");
				$month = array (1=>"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
				$select = "<select id=\"month\" name=\"month\" tabindex=\"4\" class=\"span4\">\n";
				foreach ($month as $key => $val) {
				    $select .= "\t<option val=\"".$key."\"";
				    if ($key == $curr_month) {
				        $select .= " selected=\"selected\">".$val."</option>\n";
				    } else {
				        $select .= ">".$val."</option>\n";
				    }
				}
				$select .= "</select>";
				echo $select;
			break;
		
		case 'day':
			echo strftime("%d", $time_stamp );
			break;

		case 'hour':
			echo strftime("%H", $time_stamp );
			break;
		
		case 'minute':
			echo strftime("%S", $time_stamp );
			break;
		
		default:
			return false;
			break;
	}
	
}