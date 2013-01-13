<?php
event::register('shortcode', 'barnacles::shortcode', 1);
add_shortcode( 'snippet', 'snippet' );

event::register('plugin_navigation', 'example::settings_nav', 8);


class barnacles
{

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