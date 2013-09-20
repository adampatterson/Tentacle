<?
load::helper( 'data_properties' );

class statistics_model extends properties
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


    public  function add( $page_view )
    {
        $this->statistics_table()->insert( array(
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
        $result = $this->look_up( $value );

        if ( $result == false ):

            $id = $this->statistics_meta_table()
                ->insert( array(
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
        $get_statisitics = $this->statistics_meta_table()
            ->select( '*' )
            ->where( 'key', '=', $key )
            ->execute();

        if ( empty( $get_statisitics ) )
            return false;
        else
            return $get_statisitics[0]->value;
    }


    public function look_up( $value )
    {
        $get_statisitics = $this->statistics_meta_table()
            ->select( '*' )
            ->where( 'value', '=', $value )
            ->execute();

        if ( empty( $get_statisitics ) )
            return false;
        else
            return $get_statisitics[0]->id;
    }

    public function mixpanel_server( $is_install = false )
    {
        load::helper('serverstats');
        load::library('mixpanel','Mixpanel');

        // We need a unique ID for the host so hash it to keep it private and send it over
        $id = ( $_SERVER['HTTP_HOST'] == "localhost" ? $_SERVER['HTTP_HOST'].time() : $_SERVER['HTTP_HOST'] );

        $info['id'] = ( function_exists('sha1') ? sha1($id) : md5($id) );

        $stats = build_mixpanel_stats( $is_install, '', 'utf8');

        #var_dump( $stats );

        // get the Mixpanel class instance, replace with your project token
        $mp = Mixpanel::getInstance("3e2c0144aadd3e7a622e1ce45ead49c4");

        // associate a user id to subsequent events
        $mp->identify( $info['id'] );

        if ( $stats['is_install'] == 'true' )
            $mp->track("Install");
        else
            $mp->track("Update");

        $mp->track("Server Stats", array(
            "is_install" => $stats['is_install'],
            "prev_version" => $stats['prev_version'],
            "current_version" => $stats['current_version'],
            "charset" => $stats['charset'],
            "phpversion" => $stats['phpversion'],
            "iconvlib" => $stats['iconvlib'],
            "gd" => $stats['gd'],
            "cgimode" => $stats['cgimode'],
            "server_software" => $stats['server_software'],
            "post_max_size" => $stats['post_max_size'],
            "upload_max_filesize" => $stats['upload_max_filesize'],
            "safe_mode" => $stats['safe_mode'],
            "memory_limit" => $stats['memory_limit'],
            "get_browser" => $stats['get_browser'],
            "short_open_tag" => $stats['short_open_tag'],
            "hostname" => $stats['hostname'],
            "hosturl" => $stats['hosturl'],
        ));

        $mp->track("Database", array(
            "mysql" => $stats['mysql'],
            "pgsql" => $stats['pgsql'],
            "sqlite" => $stats['sqlite']
        ));

        $mp->track("Classes", array(
            "DOMElement" => $stats['classes']['DOMElement'],
            "SoapClient" => $stats['classes']['SoapClient'],
            "XMLWriter" => $stats['classes']['XMLWriter']
        ));

        $mp->track("Extensions", array(
            "Zend Optimizer" => $stats['extensions']['Zend Optimizer'],
            "XCache" => $stats['extensions']['XCache'],
            "eAccelerator" => $stats['extensions']['eAccelerator'],
            "eAccelerator" => $stats['extensions']['eAccelerator'],
            "ionCube Loader" => $stats['extensions']['ionCube Loader'],
            "PDO" => $stats['extensions']['PDO'],
            "pdo_mysql" => $stats['extensions']['pdo_mysql'],
            "pdo_pgsql" => $stats['extensions']['pdo_pgsql'],
            "pdo_sqlite" => $stats['extensions']['pdo_sqlite'],
            "pdo_oci" => $stats['extensions']['pdo_oci'],
            "pdo_odbc" => $stats['extensions']['pdo_odbc']
        ));

        $mp->track("PHP Info", array(
            "mbstring" => $stats['phpinfo']['mbstring'],
            "exif" => $stats['phpinfo']['exif'],
            "zlib" => $stats['phpinfo']['zlib']
        ));

        $mp->track("Functions", array(
            "fsockopen"             => $stats['functions']['fsockopen'],
            "mcrypt_encrypt"        => $stats['functions']['mcrypt_encrypt'],
            "simplexml_load_string" => $stats['functions']['simplexml_load_string'],
            "ldap_connect"          => $stats['functions']['ldap_connect'],
            "mysqli_connect"        => $stats['functions']['mysqli_connect'],
            "imap_open"             => $stats['functions']['imap_open'],
            "ftp_login"             => $stats['functions']['ftp_login'],
            "apc_cache_info"        => $stats['functions']['apc_cache_info'],
            "curl_init"             => $stats['functions']['curl_init'],
            "iconv"                 => $stats['functions']['iconv']
        ));

        $mp->track("User Agent", array(
            "browser" => $stats['useragent']['browser'],
            "browser_full" => $stats['useragent']['browser_full'],
            "version" => $stats['useragent']['version'],
            "os" => $stats['useragent']['os'],
            "os_version" => $stats['useragent']['os_version']
        ));

//        $mp->people->set($info['id'], array(
//            '$first_name'       => "Adam",
//            '$last_name'        => "Patterson",
//            '$email'            => "hello@adampatterson.ca",
//        ));

        $mp->unregister("distinct_id");
    }
}