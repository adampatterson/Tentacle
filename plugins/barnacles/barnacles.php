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

event::on('shortcode', 'barnacles::shortcode', 1);
add_shortcode( 'snippet', 'snippet' );

#event::on('plugin_navigation', 'barnacles::settings_nav', 7);

logger::set('Shortcode', 'Plugin');

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

	static function shortcode($text='')
    {
		if (function_exists('do_shortcode'))
		    return do_shortcode( $text );
	}

    static function barnacle()
    {
        return 'Incy Wincy spider climbed up the water spout.';
    }
}


function snippet( $slug )
{
	$snippet = load::model( 'snippet' );
	$snippet_single = $snippet->get_slug( $slug['slug'] );

	return $snippet_single->content;
}