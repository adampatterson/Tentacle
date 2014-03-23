<?php

class dispatcher
{
    private static $data = array();

    public static function get( $key = null )
    {
      if( isset( static::$data[ $key ] ) )
        return static::$data[ $key ];
      else
        return static::$data;
    }


    public static function set( $key, $value )
    {
        static::$data[$key] = $value;
    }


    public static function has( $key )
    {
        return isset( static::$data[ $key ] );
    }

}