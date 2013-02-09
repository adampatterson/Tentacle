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

    load::library('oembed','AutoEmbed.class');

    $AE = new AutoEmbed();

    // load the embed source from a remote url
    if ($AE->parseUrl($url)) {
        //$imageURL = $AE->getImageURL();

        $AE->setWidth( get::option( 'embed_size_w' ) );
        $AE->setHeight( get::option( 'embed_size_h' ) );

        return $AE->getEmbedCode();
    }
}