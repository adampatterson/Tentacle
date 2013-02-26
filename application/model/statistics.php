<?

class statistics_model
{

    public function get()
    {

    }

    public  function add( $page_view ){
        $setting = db('statistics');

        $setting->insert( array(
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
        $setting = db ( 'statistics_meta' );

        $get_settings = $setting->select( '*' )
            ->where( 'value', '=', $value )
            ->execute();

        $count = $setting->count()
            ->where( 'value', '=', $value )
            ->execute();

        if ( $count == 0 )
            return false;
        else
            return $get_settings[0]->id;
    }
}