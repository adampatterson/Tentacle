<?
/**
* File: Snippet
*/


function get_snippet( $atts ) {
	$snippet = load::model( 'snippet' );
	$snippet_single = $snippet->get_slug( $atts );
	
	return $snippet_single->content;
	}
	
	
function snippet( $atts ) {
	$snippet = load::model( 'snippet' );
	$snippet_single = $snippet->get_slug( $atts['slug'] );
	
	return $snippet_single->content;
	}