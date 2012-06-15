<?php
class Barnacles extends Modules {

    public function __init() {
        $this->addAlias("shortcode", "shortcode", 1);
		add_shortcode( 'snippet', 'snippet' );
    }

	public function shortcode($text='') {
		if (function_exists('do_shortcode'))
		    return do_shortcode( $text );
	}

    public function barnacle() {
        return 'Incy Wincy spider climbed up the water spout.';
    }
}