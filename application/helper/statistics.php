<?php

function build_stats( )
{
    load::library('uaparser');
    $ua                             = UA::parse();

    $geo_meta                       = maybe_encoded(get::url_contents('http://geo.tentaclecms.com/'.$_SERVER['REMOTE_ADDR']));

    $statistics                     = load::model('statistics');
    $page                           = load::model('page');
    #$post_id 		                = $page->get_by_uri( URI );

    $meta                           = array();
    $page_view                      = array();
    $meta_id                        = array();

//    stats_user_agent
//    stats_operating_system
//    stats_browser
//    statas_country

    // statistics_meta
    // Loop $meta and add the page_view ID
    if (isset($geo_meta)) {
        $meta['country'] 	        = $geo_meta->countryName;
        $meta['region'] 	        = $geo_meta->regionName;
        $meta['city'] 		        = $geo_meta->cityName;
        $meta['latitude'] 		    = $geo_meta->latitude;
        $meta['longitude'] 		    = $geo_meta->longitude;
    }

    $meta['browser']                = $ua->browser;
    $meta['browser_full']           = $ua->browserFull;
    $meta['version']                = $ua->version;
    $meta['user_agent']             = $ua->uaOriginal;
    $meta['os']                     = $ua->os;
    $meta['os_version']             = $ua->osVersion;

    logger::set('Stats - browser'       , $ua->browser );
    logger::set('Stats - browser_full'  , $ua->browserFull );
    logger::set('Stats - version'       , $ua->version );
    logger::set('Stats - user_agent'    , $ua->uaOriginal );
    logger::set('Stats - os'            , $ua->os );
    logger::set('Stats - os_version'    , $ua->osVersion );
    logger::set('Stats - country'       , $geo_meta->countryName );
    logger::set('Stats - region'        , $geo_meta->regionName );
    logger::set('Stats - city'          , $geo_meta->cityName );
    logger::set('Stats - latitude'      , $geo_meta->latitude );
    logger::set('Stats - longitude'     , $geo_meta->longitude );


    # loop the meta and rebuild an array with Key Value, where Value is the ID returned
    foreach ( $meta as $key => $value ){
        $page_view[$key] = $statistics->add_meta( $key, $value);
    }

    // statistics
    $page_view['uri_id']             = URI;

    $page_view['referer']            = (isset ($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
    $page_view['ip']                 = $_SERVER['REMOTE_ADDR'];

    $statistics->add($page_view);
}

function check ( $key, $array )
{
    if ( is_serialized( $array ) )
        $array = unserialize( $array );

    if ( in_array( $key, $array ) )
        return true;
    else
        return false;
}