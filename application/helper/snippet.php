<?
/**
* File: Snippet
*/


/**
* Function: get_snippet
*	Function call passing the $slug to retrieve the snippet.
*
* Parameters:
*	$slug - String
*
* Returns:
*	String
*/
function get_snippet( $slug ) {
	$snippet = load::model( 'snippet' );
	$snippet_single = $snippet->get_slug( $slug );
	
	return $snippet_single->content;
	}