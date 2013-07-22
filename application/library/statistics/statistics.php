<?php

function build_stats( )
{
    load::library('uaparser');

    $ua = $_SERVER['HTTP_USER_AGENT'];

    if ( isset( $ua ) )
    {
        $parser = new UAParser;
        $result = $parser->parse($ua);

        $geo_meta                       = maybe_encoded( get::url_contents('http://geo.tentaclecms.com/'.$_SERVER['REMOTE_ADDR']) );

        $statistics                     = load::model('statistics');
        $page                           = load::model('page');
        #$post_id 		                = $page->get_by_uri( URI );

        $meta                           = array();
        $page_view                      = array();
        $meta_id                        = array();

        // statistics_meta
        // Loop $meta and add the page_view ID
        if (isset($geo_meta->countryName)) {
            $meta['country'] 	        = $geo_meta->countryName;
            $meta['region'] 	        = $geo_meta->regionName;
            $meta['city'] 		        = $geo_meta->cityName;
            $meta['latitude'] 		    = $geo_meta->latitude;
            $meta['longitude'] 		    = $geo_meta->longitude;
        }

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