<?
/**
* File: Navigation
*/


/**
* Function: nav_menu
*	Build the page object from the page model.
*
* Parameters:
*	$args - Array
*
* Returns:
*	HTML - Formatted HTML tree.
*/
function nav_menu ( $args = array() )
{
	define ( 'FRONT'		,'true' );
	
	$page = load::model( 'page' );
	$pages = $page->get( );
	// Current URI to be used with .current page
	$uri = URI;

	$page_tree = $page->get_page_tree( $pages );
	$page_array = $page->get_page_children( 0, $pages, 0 );
	
	/*
	$get_page_level = $page->get_page_level( $page_object, 'portfolio/design/print' );
	$get_page_by_level = $page->get_page_by_level( $page_object, $get_page_level );
	$get_home = $page->get_home( );
	$get_flat_page_hierarchy = $page->get_flat_page_hierarchy( $pages );
	$get_descendant_ids = $page->get_descendant_ids( 3 );
	$page_children = $page->get_page_children( 0, $pages );
	*/
	// Generate the HTML output.
	nav_generate ( (array)$page_array, $args );

}


/**
* Function: nav_generate
*	Generate HTML output for Naviogation
*
* Parameters:
*	$tree - Tree data array
*	$args - Array
*
* Returns:
*	HTML - Formatted HTML tree.
*/
function nav_generate ( $tree, $args = array() )
{
	$default_args = array( 'menu' => '', 'container' => 'div', 'container_class' => '', 'container_id' => '', 'menu_class' => 'menu', 'menu_id' => '',
		'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth' => 0, 'walker' => '', 'theme_location' => '' );
	
	$args = wp_parse_args( $args, $default_args );
	$args = (object) $args;
	

	$output = '';
	$depth = -1;
	$flag = false;
	
	foreach ($tree as $row) {

	    while ($row['level'] > $depth) {
	        $output .= '<ul><li '.nav_class( array('uri'=> $row['uri'] ), $row['type'] ).'>';
	        $flag = false;
	        $depth++;
	    }
	    while ($row['level'] < $depth) {
	        $output .= '</li></ul>';
	        $depth--;
	    }
	    if ($flag) {
	        $output .= '</li><li '.nav_class( array('uri'=> $row['uri'] ), $row['type'] ).'>';
	        $flag = false;
	    }
	    $output .= '<a href="'.BASE_URL.$row['uri'].'">'.$row['title'].'</a>';
	    $flag = true;
	}

	$output .= '</ul>';
	
	echo $output;
}


/**
 * Merge user defined arguments into defaults array.
 *
 * This function is used throughout WordPress to allow for both string or array
 * to be merged into another array.
 *
 * @since 2.2.0
 *
 * @param string|array $args Value to merge with $defaults
 * @param array $defaults Array that serves as the defaults.
 * @return array Merged user defined values with defaults.
 */
function wp_parse_args( $args, $defaults = '' ) {
	if ( is_object( $args ) )
		$r = get_object_vars( $args );
	elseif ( is_array( $args ) )
		$r =& $args;
	else
		wp_parse_str( $args, $r );

	if ( is_array( $defaults ) )
		return array_merge( $defaults, $r );
	return $r;
}


/**
 * Parses a string into variables to be stored in an array.
 *
 * Uses {@link http://www.php.net/parse_str parse_str()} and stripslashes if
 * {@link http://www.php.net/magic_quotes magic_quotes_gpc} is on.
 *
 * @since 2.2.1
 * @uses apply_filters() for the 'wp_parse_str' filter.
 *
 * @param string $string The string to be parsed.
 * @param array $array Variables will be stored in this array.
 */
function wp_parse_str( $string, &$array ) {
	parse_str( $string, $array );
	if ( get_magic_quotes_gpc() )
		$array = stripslashes_deep( $array );
	$array = apply_filters( 'wp_parse_str', $array );
}


/**
 * Navigates through an array and removes slashes from the values.
 *
 * If an array is passed, the array_map() function causes a callback to pass the
 * value back to the function. The slashes from this value will removed.
 *
 * @since 2.0.0
 *
 * @param array|string $value The array or string to be stripped.
 * @return array|string Stripped array (or string in the callback).
 */
function stripslashes_deep($value) {
	if ( is_array($value) ) {
		$value = array_map('stripslashes_deep', $value);
	} elseif ( is_object($value) ) {
		$vars = get_object_vars( $value );
		foreach ($vars as $key=>$data) {
			$value->{$key} = stripslashes_deep( $data );
		}
	} else {
		$value = stripslashes($value);
	}

	return $value;
}

