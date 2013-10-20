<?
/**
 * File: Cache
 */
class cache
{

    public function __construct()
    {
        # code...
    }


    /**
     * Function: set
     *	Set cache
     *
     * Parameters:
     *	$key - string
     *	$data - Array or Object
     *	$expires - http://php.net/manual/en/function.strtotime.php
     *
     * Returns:
     *	Object
     */


    public function set( $key, $data, $expire='+720 minutes' )
    {
        $cache['expire'] = strtotime($expire);
        $cache['data'] = $data;

        $cache_data = serialize( $cache );

        $settings = load::model( 'settings' );

        $set = $settings->add('_transient_'.$key, $cache_data, null );

        return $this->get($key);
    }


    /**
     * Function: get
     *	Get cache
     *
     * Parameters:
     *	$key - string
     *
     * Returns:
     *	Object / False
     */
    public function get( $key )
    {
        $settings = load::model( 'settings' );
        $get = $settings->get('_transient_'.$key);

        $cache_data = unserialize($get);

        if ($cache_data['expire'] < time() ) {
            // if the cache has expired then reload the cache.
            $this->delete( $key );
            return false;
        } else {
            return $cache_data['data'];
        }
    }


    /**
     * Function: delete
     *	Delete cache
     *
     * Parameters:
     *	$key - string
     *
     * Returns:
     *	True
     */
    public function delete( $key )
    {
        $settings = load::model( 'settings' );

        $delete_cache = $settings->delete( '_transient_'.$key );

        return true;
    }


    public function clear()
    {

    }


    public function flush()
    {

    }

    /**
     * Function: look_up
     *	Find a cache object by key
     *
     * Parameters:
     *	$key - String
     *
     * Returns:
     *	Boolean
     */
    public function look_up( $key)
    {
        $settings = load::model('settings');

        $get = $settings->get('_transient_'.$key);

        $cache_data = unserialize($get);

        if ($cache_data['expire'] < time() ) {
            // if the cache has expired then reload the cache.
            $this->delete( $key );
            return false;
        } else {
            return true;
        }
    }
}

