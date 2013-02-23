<?
class statistics_model
{
    /*
     * Adds a value if it does not exist
     */
    public function set ( $key, $value )
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

        return $get;
    }


    /*
     * Returns an array matching the key
     */
    public function get ( $key )
    {
        return unserialize( get::option( $key ) );
    }


    /*
     * Returns the array key from a matching value
     */
    public function lookup( $key, $value )
    {
        $get =  unserialize( get::option ($key ) );

        foreach( $get as $get_key => $get_value )
        {
            if ( $get_value == $value )
                return $get_key;
        }
    }
}
