<?php

function build_stats( )
{
    $statistics = load::model('statistics');

    #stats_user_agent
    #stats_operating_system
    #stats_browser
    #statas_country
    // no string just return the key
    // if the key is new then add the value
    #var_dump($statistics->set('stats_test', 'Chrome 24.0.1312'));
    var_dump($statistics->set('stats_browser', 'Chrome 25.0.1312'));
    var_dump($statistics->get('stats_browser'));
    var_dump($statistics->lookup('stats_browser', 'Chrome 24.0.1312'));

    die;
    load::library('uaparser');

    $ua = UA::parse();

    $geo_meta = maybe_encoded(get::url_contents('http://geo.tentaclecms.com/'.$_SERVER['REMOTE_ADDR']));

    $info = array();

    if (isset($geo_meta)) {
        $info['country'] 	= $geo_meta->countryName;
        $info['region'] 	= $geo_meta->regionName;
        $info['city'] 		= $geo_meta->cityName;
    }

    $info['browserFull'] = $ua->browserFull;
    $info['browser'] = $ua->browser;
    $info['version'] = $ua->version;
    $info['os'] = $ua->os;
    $info['osFull'] = $ua->osFull;
    $info['osVersion'] = $ua->osVersion;
    $info['url'] = HISTORY;

    var_dump($info);
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