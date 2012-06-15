<?php
/**
* Class: Barnacles
*/
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

/**
* Function: snippet
*	Called from the short code API.
*
* Parameters:
*	$slug - String
*
* Returns:
*	String
*/
function snippet( $slug ) {
	$snippet = load::model( 'snippet' );
	$snippet_single = $snippet->get_slug( $slug['slug'] );
	
	return $snippet_single->content;
	}