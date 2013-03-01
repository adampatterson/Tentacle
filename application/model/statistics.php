<?

class statistics_model
{

/*
 * Top Content:
 * SELECT `uri_id`, COUNT(*) AS total FROM `statistics` WHERE `date` BETWEEN '1361920693' AND '1361924147' GROUP BY `uri_id` ORDER BY total DESC
 */


    public function count_by_chunks( $count = '6' )
    {

        $number_array   = array();
        $return         = array('total' => 0);

        $number_array = array();

        $i = 0;

        while ( $count > $i ){

            if ( $i == 0 )
                $time = time();

            $results = db::query("SELECT COUNT(*) AS total FROM `statistics` WHERE `date`  BETWEEN ".strtotime( '-4 hours',  $time )." AND ".$time);

            if ( !empty($results[0])  ):
                $return['chunks'][] = $results[0]->total;
                $return['total'] = $return['total'] + $results[0]->total;
            else:
                $return['chunks'][] = 0;
            endif;

            $time = strtotime( '-4 hours',  $time );

            $i++;
        }

        return $return;
    }


    public function count_by_unique_chunks( $count = '6' )
    {
        $number_array   = array();
        $return         = array('total' => 0);

        $number_array = array();

        $i = 0;

        while ( $count > $i ){

            if ( $i == 0 )
                $time = time();

            $results = db::query("SELECT COUNT(*) AS total FROM `statistics` WHERE `date` BETWEEN '".strtotime( '-4 hours',  $time )."' AND '".$time."' GROUP BY `ip` ORDER BY total DESC");

            if ( !empty($results[0])  ):
                $return['chunks'][] = $results[0]->total;
                $return['total'] = $return['total'] + $results[0]->total;
            else:
                $return['chunks'][] = 0;
            endif;

            $time = strtotime( '-4 hours',  $time );

            $i++;
        }

        return $return;
    }


    public function get_by_range( $from = '', $to = '' )
    {
        $now            = time();
        $one_hour       = strtotime( '-1 hour',  $now );
        $six_hours      = strtotime( '-6 hour',  $now );
        $yesterday      = strtotime( '-1 day',   $now );
        $last_week      = strtotime( '-1 week',  $now );
        $last_month     = strtotime( '-1 month', $now );
        $last_year      = strtotime( '-1 year',  $now );

        return db::query("SELECT * FROM `statistics` WHERE `date` BETWEEN ".$one_hour." AND ".$now);
    }

    public  function add( $page_view ){
        $statisitics = db('statistics');

        $statisitics->insert( array(
            'ip'            => $page_view['ip'],
            'date'          => time(),
            'uri_id'        => $page_view['uri_id'],
            'referer'       => $page_view['referer'],
            'country'       => $page_view['country'],
            'region'        => $page_view['region'],
            'city'          => $page_view['city'],
            'latitude'      => $page_view['latitude'],
            'longitude'     => $page_view['longitude'],
            'browser'       => $page_view['browser'],
            'browser_full'  => $page_view['browser_full'],
            'version'       => $page_view['version'],
            'user_agent'    => $page_view['user_agent'],
            'os'            => $page_view['os'],
            'os_version'    => $page_view['os_version']
        ), FALSE );
    }


    public function add_meta( $key, $value )
    {
        $statistics_meta = db('statistics_meta');

        $result = $this->look_up( $value );

        if ( $result == false ):

            $id = $statistics_meta->insert( array(
                'key'           => $key,
                'value'         => $value
            ) );
            return $id->id;
        else:
            return $result;
        endif;
    }


    public function get_meta( $key )
    {
        $setting = db ( 'statistics_meta' );

        $get_settings = $setting->select( '*' )
            ->where( 'key', '=', $key )
            ->execute();

        $count = $setting->count()
            ->where( 'key', '=', $key )
            ->execute();

        if ( $count == 0 )
            return false;
        else
            return $get_settings[0]->value;
    }


    public function look_up( $value )
    {
        $statisitics = db ( 'statistics_meta' );

        $get_statisitics = $statisitics->select( '*' )
            ->where( 'value', '=', $value )
            ->execute();

        $count = $statisitics->count()
            ->where( 'value', '=', $value )
            ->execute();

        if ( $count == 0 )
            return false;
        else
            return $get_statisitics[0]->id;
    }
}