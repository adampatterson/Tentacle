<?

class statistics_model
{

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

class old_statistics_model
{
    /*
     * Adds a value if it does not exist
     */
    public function set ( $key, $value, $retrun_key = false )
    {

        $get =  unserialize( get::option( $key ) );

        if ( isset( $get ) )
        {
            if ( !$get )
            {
                $array = array();
                array_push( $array, $value );

                set::option( $key, $array );
                return $array;
            } else
            {
                if (!in_array( $value, $get ) )
                    array_push( $get, $value );

                set::option( $key, serialize( $get ) );
            }
        } else
        {
            $new_array = array( 1 => $value);
            set::option( $key, serialize( $new_array ) );

            $get =  unserialize( get::option($key) );
        }

        if ( $retrun_key ){
            end($get);
            $retrun_key = key($get);

            return $retrun_key;
        }

        return $get;
    }


    /*
     * Returns an array matching the key
     */
    public function get ( $key )
    {
        return unserialize( get::option( $key ) );
    }


    public function page_view()
    {
        // save a page view.
    }

    /*
     * Returns the array key from a matching value
     */
    public function lookup( $key, $value )
    {
        $get =  unserialize( get::option ($key ) );

        if (is_array($get)){
            foreach( $get as $get_key => $get_value )
            {
                if ( $get_value == $value )
                    return $get_key;
            }
        }

        return false;
    }
}
