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

        if ( empty($page_view['country']) ) {
            $page_view['country'] = '';
            $page_view['region'] = '';
            $page_view['city'] = '';
            $page_view['latitude'] = '';
            $page_view['longitude'] = '';
        }

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


    function build_server_stats( $is_install = true, $prev_version='', $charset='' )
    {
        if ( $is_install === true ){
            load::helper('get_set');
            load::helper('tentacle');
        }

        $phpinfo_stirng = '';
        $function_string = '';

        $info = array();
        $string = "";
        $amp = "";
        $classe_string = '';

        $geo_meta = maybe_encoded(get::url_contents('http://geo.tentaclecms.com/'));

        // Is this an upgrade or an install?
        $info['is_install'] = ( $is_install === true ? true : false );

        // If we are upgrading....
        $info['prev_version'] = ( $info['is_install'] == 0 ? $prev_version : false );

        // What's our current version?
        $info['current_version'] = TENTACLE_VERSION;

        // What is our current charset?
        $info['charset'] = $charset;

        // Parse phpinfo into array
        $phpinfo = parse_php_info();

        // PHP Version
        $info['phpversion'] = phpversion();

        // MySQL Version
        $info['mysql'] = ( array_key_exists('mysql', $phpinfo ) ? $phpinfo['mysql']['Client API version'] : 0 );

        // PostgreSQL Version
        $info['pgsql'] = ( array_key_exists('pgsql', $phpinfo ) ? $phpinfo['pgsql']['PostgreSQL(libpq) Version'] : 0 );

        // SQLite Version
        $info['sqlite'] = ( array_key_exists('sqlite', $phpinfo ) ? $phpinfo['sqlite']['SQLite Library'] : 0 );

        // Iconv Library Extension Version
        $info['iconvlib'] = ( array_key_exists('iconv', $phpinfo ) ? html_entity_decode($phpinfo['iconv']['iconv implementation'])."|".$phpinfo['iconv']['iconv library version'] : 0 );

        // Check GD & Version
        $info['gd'] = ( array_key_exists('gd', $phpinfo ) ? $phpinfo['gd']['GD Version'] : false );

        // CGI Mode
        $sapi_type = php_sapi_name();

        $info['cgimode'] = (strpos($sapi_type, 'cgi') !== false ? true : false );

        // Server Software
        $info['server_software'] = $_SERVER['SERVER_SOFTWARE'];

        // Allow url fopen php.ini setting
        $info['allow_url_fopen'] = (ini_get('safe_mode') == 0 && ini_get('allow_url_fopen') ? true : false );

        // Check classes, extensions, php info, functions, and php ini settings
        $classes = array(
            'dom' 					=> 'DOMElement',
            'soap' 				    => 'SoapClient',
            'xmlwriter' 			=> 'XMLWriter',
            'imagemagick' 			=> 'Imagick');

        $extensions = array(
            'zendopt' 				=> 'Zend Optimizer',
            'xcache' 				=> 'XCache',
            'eaccelerator' 		    => 'eAccelerator',
            'ioncube' 				=> 'ionCube Loader',
            'PDO' 					=> 'PDO',
            'pdo_mysql' 			=> 'pdo_mysql',
            'pdo_pgsql' 			=> 'pdo_pgsql',
            'pdo_sqlite' 			=> 'pdo_sqlite',
            'pdo_oci' 				=> 'pdo_oci',
            'pdo_odbc' 			    => 'pdo_odbc');

        $phpinfo = array(
            'zlib' 				    => 'zlib',
            'mbstring' 			    => 'mbstring',
            'exif' 				    => 'exif');

        $functions = array(
            'sockets' 				=> 'fsockopen',
            'mcrypt' 				=> 'mcrypt_encrypt',
            'simplexml' 			=> 'simplexml_load_string',
            'ldap' 				    => 'ldap_connect',
            'mysqli' 				=> 'mysqli_connect',
            'imap' 				    => 'imap_open',
            'ftp' 					=> 'ftp_login',
            'pspell' 				=> 'pspell_new',
            'apc' 					=> 'apc_cache_info',
            'curl' 				    => 'curl_init',
            'iconv' 				=> 'iconv');

        $php_ini = array(
            'post_max_size' 		=> 'post_max_size',
            'upload_max_filesize'	=> 'upload_max_filesize',
            'safe_mode' 			=> 'safe_mode',
            'memory_limit'			=> 'memory_limit',
            'get_browser'			=> 'get_browser',
            'short_open_tag'		=> 'short_open_tag');


        foreach($classes as $name => $what)
            $classe_string .= (class_exists($what) ? $name.'|' : false );
        $info['classes'] = $classe_string;


        $extension_string = '';
        foreach($extensions as $name => $what)
            $extension_string .= (extension_loaded($what) ? $name.'|' : false );
        $info['extensions'] = $extension_string;

        foreach($phpinfo as $name => $what)
            $phpinfo_stirng .= ( array_key_exists($what, $phpinfo) ? $name.'|' : false );
        $info['phpinfo'] = $phpinfo_stirng;



        foreach($functions as $name => $what)
            $function_string .= ( function_exists($what) ? $name.'|' : false );
        $info['functions'] = $function_string;

        foreach($php_ini as $name => $what)
            $info[$name] = (ini_get($what) != 0 ? ini_get($what) : 0 );


        // Host URL & hostname
        $info['hosturl'] = $info['hostname'] = "unknown/local";

        if( $_SERVER['HTTP_HOST'] == 'localhost' )
            $info['hosturl'] = $info['hostname'] = "localhost";


        // Check the hosting company
        if( strpos($_SERVER['HTTP_HOST'], ".") !== false )
        {

            $host_url = "http://www.whoishostingthis.com/".str_replace(array('http://', 'www.'), '', $_SERVER['HTTP_HOST']);

            $hosting = get::url_contents($host_url);

            if( $hosting )
            {
                preg_match('#\<span class\="hoster"\>([^"]*)\<\/span\><\/span\>#ism', $hosting, $matches);

                $info['hosturl'] = "unknown/no-url";

                $info['hostname'] = ( isset($matches[1]) ? $matches[1] : "unknown/no-name" );

            }
        }

        if ( $geo_meta != '' ){
            $info['country'] 	= $geo_meta->countryName;
            $info['region'] 	= $geo_meta->regionName;
            $info['city'] 		= $geo_meta->cityName;
        }

        $info['useragent'] = ( isset( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : null );

        // We need a unique ID for the host so hash it to keep it private and send it over
        $id = ( $_SERVER['HTTP_HOST'] == "localhost" ? $_SERVER['HTTP_HOST'].time() : $_SERVER['HTTP_HOST'] );

        $info['id'] = ( function_exists('sha1') ? sha1($id) : md5($id) );


        foreach( $info as $key => $value )
        {
            $string .= $amp.$key."=".urlencode($value);
            $amp = "&amp;";
        }

        $server_stats_url = 'http://stats.tentaclecms.com/?'.$string;

        $return = array();

        $return['info_sent_success'] = ( get::url_contents($server_stats_url) !== false ? true : false);

        $return['info_image'] = "<img src='http://stats.tentaclecms.com/?{$string}&amp;img=1' />";
        $return['info_get_string'] = $string;

        return $return;
    }


    function build_mixpanel_stats( $is_install = true, $prev_version='', $charset='' )
    {
        if ( $is_install === true ){
            load::helper('get_set');
            load::helper('tentacle');
        }

        load::library('uaparser');

        $phpinfo_stirng = '';
        $function_string = '';

        $info = array();
        $string = "";
        $amp = "";
        $classe_string = '';

        // Is this an upgrade or an install?
        $info['server']['is_install'] = ( $is_install === true ? 'true' : 'false' );

        // If we are upgrading....
        $info['server']['prev_version'] = ( $info['server']['is_install'] == 0 ? $prev_version : 'false' );

        // What's our current version?
        $info['server']['current_version'] = TENTACLE_VERSION;

        // What is our current charset?
        $info['server']['charset'] = $charset;

        // Parse phpinfo into array
        $phpinfo = parse_php_info();

        // PHP Version
        $info['server']['phpversion'] = phpversion();

        // MySQL Version
        $info['database']['mysql'] = ( array_key_exists('mysql', $phpinfo ) ? $phpinfo['mysql']['Client API version'] : 'false' );

        // PostgreSQL Version
        $info['database']['pgsql'] = ( array_key_exists('pgsql', $phpinfo ) ? $phpinfo['pgsql']['PostgreSQL(libpq) Version'] : 'false' );

        // SQLite Version
        $info['database']['sqlite'] = ( array_key_exists('sqlite', $phpinfo ) ? $phpinfo['sqlite']['SQLite Library'] : 'false' );

        // Iconv Library Extension Version
        $info['server']['iconvlib'] = ( array_key_exists('iconv', $phpinfo ) ? $phpinfo['iconv']['iconv library version'] : 'false' );

        // Check GD & Version
        $info['server']['gd'] = ( array_key_exists('gd', $phpinfo ) ? $phpinfo['gd']['GD Version'] : 'false' );

        // CGI Mode
        $sapi_type = php_sapi_name();

        $info['server']['cgimode'] = (strpos($sapi_type, 'cgi') !== false ? 'true' : 'false' );

        // Server Software
        $info['server']['server_software'] = $_SERVER['SERVER_SOFTWARE'];

        // Allow url fopen php.ini setting
        $info['server']['allow_url_fopen'] = (ini_get('safe_mode') == 0 && ini_get('allow_url_fopen') ? 'true' : 'false' );

        // Host URL & hostname
        $info['server']['hosturl'] = $info['server']['hostname'] = "unknown/local";

        if( $_SERVER['HTTP_HOST'] == 'localhost' )
            $info['server']['hosturl'] = $info['server']['hostname'] = "localhost";


        // Check classes, extensions, php info, functions, and php ini settings
        $classes = array(
            'dom' 					=> 'DOMElement',
            'soap' 				    => 'SoapClient',
            'xmlwriter' 			=> 'XMLWriter',
            'imagemagick' 			=> 'Imagick');

        $extensions = array(
            'zendopt' 				=> 'Zend Optimizer',
            'xcache' 				=> 'XCache',
            'eaccelerator' 		    => 'eAccelerator',
            'ioncube' 				=> 'ionCube Loader',
            'PDO' 					=> 'PDO',
            'pdo_mysql' 			=> 'pdo_mysql',
            'pdo_pgsql' 			=> 'pdo_pgsql',
            'pdo_sqlite' 			=> 'pdo_sqlite',
            'pdo_oci' 				=> 'pdo_oci',
            'pdo_odbc' 			    => 'pdo_odbc');

        $phpinfo = array(
            'mbstring' 			    => 'mbstring',
            'exif' 				    => 'exif',
            'zlib' 				    => 'zlib');

        $functions = array(
            'sockets' 				=> 'fsockopen',
            'mcrypt' 				=> 'mcrypt_encrypt',
            'simplexml' 			=> 'simplexml_load_string',
            'ldap' 				    => 'ldap_connect',
            'mysqli' 				=> 'mysqli_connect',
            'imap' 				    => 'imap_open',
            'ftp' 					=> 'ftp_login',
            'apc' 					=> 'apc_cache_info',
            'curl' 				    => 'curl_init',
            'iconv' 				=> 'iconv');

        $php_ini = array(
            'post_max_size' 		=> 'post_max_size',
            'upload_max_filesize'	=> 'upload_max_filesize',
            'safe_mode' 			=> 'safe_mode',
            'memory_limit'			=> 'memory_limit',
            'get_browser'			=> 'get_browser',
            'short_open_tag'		=> 'short_open_tag');


        foreach($classes as $name => $what)
            $info['classes'][$what] = (class_exists($what) ? $name : 'false' );

        foreach( $extensions as $name => $what )
            if ( extension_loaded($what) )
                $info['extensions'][$what] = $what;

        foreach( $phpinfo as $name => $what )
            if ( array_key_exists($what, $phpinfo) )
                $info['phpinfo'][$what] = $what;

        foreach($functions as $name => $what)
            if ( function_exists($what) )
                $info['functions'][$what] = $what;

        foreach($php_ini as $name => $what)
            if ( ini_get($what) )
                $info['server'][$what] = $what;


        // Check the hosting company
        if( strpos($_SERVER['HTTP_HOST'], ".") !== 'false' )
        {

            $host_url = "http://www.whoishostingthis.com/".str_replace(array('http://', 'www.'), '', $_SERVER['HTTP_HOST']);

            $hosting = get::url_contents($host_url);

            if( $hosting )
            {
                preg_match('#\<span class\="hoster"\>([^"]*)\<\/span\><\/span\>#ism', $hosting, $matches);

                $info['server']['hosturl'] = "unknown/no-url";

                $info['server']['hostname'] = ( isset($matches[1]) ? $matches[1] : "unknown/no-name" );

            }
        }

        $ua = ( isset( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : null );

        if ( isset( $ua ) ):
            $parser = new UAParser;
            $result = $parser->parse($ua);

            $info['useragent']['browser']                = $result->ua->family;
            $info['useragent']['browser_full']           = $result->ua->toString;
            $info['useragent']['version']                = $result->ua->toVersionString;
            #$info['useragent']['user_agent']             = $result->uaOriginal;
            $info['useragent']['os']                     = $result->os->family;
            $info['useragent']['os_version']             = $result->os->toVersionString;
        else:
            $info['useragent'] = 'false';
        endif;


        // We need a unique ID for the host so hash it to keep it private and send it over
        $id = ( $_SERVER['HTTP_HOST'] == "localhost" ? $_SERVER['HTTP_HOST'].time() : $_SERVER['HTTP_HOST'] );

        $info['id'] = ( function_exists('sha1') ? sha1($id) : md5($id) );

        return $info;
    }


    function build_stats( )
    {
        load::library('uaparser');

        $ua = $_SERVER['HTTP_USER_AGENT'];

        if ( isset( $ua ) )
        {
            $parser = new UAParser;
            $result = $parser->parse($ua);

//            $geo_meta                       = maybe_encoded( get::url_contents('http://geo.tentaclecms.com/'.$_SERVER['REMOTE_ADDR']) );

            $statistics                     = load::model('statistics');
            #$post_id 		                = $page->get_by_uri( URI );

            $meta                           = array();
            $page_view                      = array();
            $meta_id                        = array();

            // statistics_meta
            // Loop $meta and add the page_view ID
//            if (isset($geo_meta->countryName)) {
//                $meta['country'] 	        = $geo_meta->countryName;
//                $meta['region'] 	        = $geo_meta->regionName;
//                $meta['city'] 		        = $geo_meta->cityName;
//                $meta['latitude'] 		    = $geo_meta->latitude;
//                $meta['longitude'] 		    = $geo_meta->longitude;
//            }

            $meta['browser']                = $result->ua->family;
            $meta['browser_full']           = $result->ua->toString;
            $meta['version']                = $result->ua->toVersionString;
            $meta['user_agent']             = $result->uaOriginal;
            $meta['os']                     = $result->os->family;
            $meta['os_version']             = $result->os->toVersionString;

            # loop the meta and rebuild an array with Key Value, where Value is the ID returned
            foreach ( $meta as $key => $value ){
                $page_view[$key] = $statistics->add_meta( $key, $value);
            }

            // statistics
            if ( defined( 'ERROR_404' ) && ERROR_404 == true )
                $page_view['referer']            = 404;
            else
                $page_view['referer']            = (isset ($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');

            $page_view['uri_id']             = URI;
            $page_view['ip']                 = $_SERVER['REMOTE_ADDR'];

            $statistics->add($page_view);
        }
    }

    public function mixpanel_server( $is_install = false, $previous_version = '' )
    {
        //load::helper('serverstats');
        load::library('mixpanel','Mixpanel');

        // We need a unique ID for the host so hash it to keep it private and send it over
        $id = ( $_SERVER['HTTP_HOST'] == "localhost" ? $_SERVER['HTTP_HOST'].time() : $_SERVER['HTTP_HOST'] );

        $info['id'] = ( function_exists('sha1') ? sha1($id) : md5($id) );

        $stats = $this->build_mixpanel_stats( $is_install, $previous_version, 'utf8');

        //var_dump( $stats );

        // get the Mixpanel class instance, replace with your project token
        $mp = Mixpanel::getInstance("61fe4c362654aac9baed7970abecfc43");

        // associate a user id to subsequent events
        $mp->identify( $info['id'] );

        if ( $is_install == 'true' )
            $mp->track( "Install" );
        else
            $mp->track( "Update" );

        $mp->track( "Server Stats", $stats['server'] );

        $mp->track( "Database", $stats['database'] );

        $mp->track( "Classes", $stats['classes'] );

        $mp->track( "Extensions", $stats['extensions'] );

        $mp->track( "PHP Info", $stats['phpinfo'] );

        $mp->track( "Functions", $stats['functions'] );

        $mp->track( "User Agent", $stats['useragent'] );

//        $mp->people->set($info['id'], array(
//            '$first_name'       => "Adam",
//            '$last_name'        => "Patterson",
//            '$email'            => "hello@adampatterson.ca",
//        ));

        $mp->unregister("distinct_id");
    }
}