<?php
/**
 * File: oEmbed
 */


function oembed_cotnent( $url, $raw=null )
{
    $oembed_urls = array (
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
        'www.flickr.com' => 'http://www.flickr.com/services/oembed?url=$1&format=json',
        'instagram.com' => 'http://api.instagram.com/oembed?url=$1'
    );

    if (!empty($url)){

        if(is_array($url))
            $url = $url['url'];

        $parts = parse_url($url);

        $host = $parts['host'];
        if ( empty( $host ) || !array_key_exists( $host, $oembed_urls ) )
        {
            echo 'Unrecognized host';
        } else
        {
            $oembed_contents = @file_get_contents( str_replace( '$1', $url, $oembed_urls[$host] ) );

            $oembed_data = @json_decode( $oembed_contents );

            if ($raw)
                return $oembed_data;

            if ( $host == 'www.flickr.com' || $host == 'flickr.com' || $host == 'yfrog.com' )
                return '<img src="'. $oembed_data->url .'" width="'.get::option( 'embed_size_w' ).'" />';
            else
                $embed_code =  $oembed_data->html;

            $pattern = "/height=\"[0-9]*\"/";
            $content = preg_replace($pattern, 'height="'.get::option( 'embed_size_h' ).'"', $embed_code);

            $pattern = "/width=\"[0-9]*\"/";
            $embed_code = preg_replace($pattern, 'width="'.get::option( 'embed_size_w' ).'"', $content);

            return $embed_code;
        }
    }
}