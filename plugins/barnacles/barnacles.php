<?php
class Barnacles extends Plugins {

    public function __init() {
        $this->add_alias("shortcode", "shortcode", 1);
		add_shortcode( 'snippet', 'snippet' );
    }

    public function settings_nav() {
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

	public function shortcode($text='') {
		if (function_exists('do_shortcode'))
		    return do_shortcode( $text );
	}

    public function barnacle() {
        return 'Incy Wincy spider climbed up the water spout.';
    }
}


function snippet( $slug ) {
	$snippet = load::model( 'snippet' );
	$snippet_single = $snippet->get_slug( $slug['slug'] );

	return $snippet_single->content;
}