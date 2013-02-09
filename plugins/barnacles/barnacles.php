<?php
/**
name: Barnacles
url: http://tentaclecms.com
version: 1.0
description: Tentacles core Plugin
author:
  name: Adam Patterson
  url: http://adampatterson.ca
*/

#event::on('plugin_navigation', 'barnacles::settings_nav', 7);

class barnacles
{
    static function settings_nav() {
		$nav[] = array(
            'title'     => 'Barnacles',
            'rout'      => 'barnacle_settings',
            'uri'       => 'barnacles/view'
        );

		$nav[] = array(
            'title'     => 'Barnacles Two',
            'rout'      => 'barnacle_settings_two',
            'uri'       => 'barnacles/view'
        );

    	return $nav;
    }

    static function barnacle()
    {
        return 'Incy Wincy spider climbed up the water spout.';
    }
}


event::on('shortcode', 'shortcode', 1);
logger::set('Shortcode', 'oEmbed');


function shortcode( $content )
{
    add_shortcode( 'embed', 'oembed_content' );
    add_shortcode( 'snippet', 'snippet' );

    if (function_exists('do_shortcode'))
        return do_shortcode( $content );
}


function snippet( $slug )
{
    $snippet = load::model( 'snippet' );
    $snippet_single = $snippet->get_slug( $slug[0] );

    return $snippet_single->content;
}


function oembed_content( $url )
{
    $url = $url[0];

    $oembedUrls = array (
        'www.youtube.com' => 'http://www.youtube.com/oembed?url=$1&format=json',
        'www.dailymotion.com' => 'http://www.dailymotion.com/api/oembed?url=$1&format=json',
        'www.vimeo.com' => 'http://vimeo.com/api/oembed.xml?url=$1&format=json',
        'vimeo.com' => 'http://vimeo.com/api/oembed.xml?url=$1&format=json',
        'www.blip.tv' => 'http://blip.tv/oembed/?url=$1&format=json',
        'www.hulu.com' => 'http://www.hulu.com/api/oembed?url=$1&format=json',
        'www.viddler.com' => 'http://lab.viddler.com/services/oembed/?url=$1&format=json',
        'www.qik.com' => 'http://qik.com/api/oembed?url=$1&format=json',
        'www.revision3.com' => 'http://revision3.com/api/oembed/?url=$1&format=json',
        'www.scribd.com' => 'http://www.scribd.com/services/oembed?url=$1&format=json',
        'www.wordpress.tv' => 'http://wordpress.tv/oembed/?url=$1&format=json',
        'www.5min.com' => 'http://www.oohembed.com/oohembed/?url=$1',
        'www.collegehumor.com' => 'http://www.oohembed.com/oohembed/?url=$1',
        'www.thedailyshow.com' => 'http://www.oohembed.com/oohembed/?url=$1',
        'www.funnyordie.com' => 'http://www.oohembed.com/oohembed/?url=$1',
        'www.livejournal.com' => 'http://www.oohembed.com/oohembed/?url=$1',
        'www.metacafe.com' => 'http://www.oohembed.com/oohembed/?url=$1',
        'www.xkcd.com' => 'http://www.oohembed.com/oohembed/?url=$1',
        'www.yfrog.com' => 'http://www.oohembed.com/oohembed/?url=$1',
        'yfrog.com' => 'http://www.oohembed.com/oohembed/?url=$1',
        'www.flickr.com' => 'http://www.flickr.com/services/oembed?url=$1&format=json'
    );

    if (!empty($url)){
        $parts = parse_url($url);

        $host = $parts['host'];
        if (empty($host) || !array_key_exists($host,$oembedUrls)){
            echo 'Unrecognized host';
        } else {
            $oembedContents = @file_get_contents(str_replace('$1',$url,$oembedUrls[$host]));

            $oembedData = @json_decode( $oembedContents );

            if ( $host == 'www.flickr.com' || $host == 'flickr.com' || $host == 'yfrog.com' ) {
                return '<img src="'. $oembedData->url .'" width="'.get::option( 'embed_size_w' ).'" />';
            } else {
                $embedCode =  $oembedData->html;
            }
            return $embedCode;
        }
    }
}