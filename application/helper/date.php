<?
/**
* File: Date
*
* Class: date
*/
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
}


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
					$select = "<select id=\"month\" name=\"month\" tabindex=\"4\" class=\"span4\">\n";
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
					$select = "<select id=\"month\" name=\"month\" tabindex=\"4\" class=\"span4\">\n";
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