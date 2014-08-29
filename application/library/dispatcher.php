<?php

/*
    $pages = load::model( 'content' )->type( 'page' )->get();

    dispatcher::set( 'pages', $pages );

    var_dump(dispatcher::has('pages'));

    function test_function()
    {
      return dispatcher::get( 'pages' );
    }

    var_dump(test_function());
 */

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