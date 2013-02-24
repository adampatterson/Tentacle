<?php

function build_stats( )
{
    load::library('uaparser');
    $ua                             = UA::parse();

    #$geo_meta                      = maybe_encoded(get::url_contents('http://geo.tentaclecms.com/'.));
    $geo_meta                       = maybe_encoded(get::url_contents('http://geo.tentaclecms.com/'));

    $statistics                     = load::model('statistics');
    $page                           = load::model('page');
    #$post 		                    = $page->get_by_uri( URI );
    $post_id 		                = $page->get_by_uri( 'docs/change-log/' );

    $meta                           = array();
    $page_view                      = array();
//    stats_user_agent
//    stats_operating_system
//    stats_browser
//    statas_country
//
//    no string just return the key
//    if the key is new then add the value
//    var_dump($statistics->set('stats_test', 'Chrome 24.0.1312'));
//
//    var_dump($statistics->set('stats_browser', 'Chrome 25.0.1312'));
//    var_dump($statistics->get('stats_browser'));
//    var_dump($statistics->lookup('stats_browser', 'Chrome 24.0.1312'));

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

    # loop the meta and rebuild an array with Key Value, where Value is the ID returned
    $meta_id = array();
    foreach ( $meta as $key => $value ){
        #$page_view[$key] = $statistics->add_meta( $key, $value);
    }

    // statistics
    // Create row, return ID
    $page_view['uri_id']             = $post_id->id;
    $page_view['referer']            = (isset ($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
    $page_view['ip']                 = $_SERVER['REMOTE_ADDR'];

    #$statistics->add($page_view);
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