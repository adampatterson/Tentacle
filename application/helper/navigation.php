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
	$default_args = array( 
		'menu' => '', 
		#'container' => 'div', 
		#'container_class' => '', 
		#'container_id' => '', 
		'menu_class' => 'menu', 
		'menu_id' => '',
		'menu_item' => '',
		#'echo' => true, 
		#'before' => '', 
		#'after' => '', 
		#'link_before' => '', 
		#'link_after' => '', 
		#'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth' => 0, 
		#'theme_location' => '',
		'child_of' => 0,
		'exclude' => '',
		'include' => '',
		#'number' => 'per_page',
		#'offset' => 'offset',
		#'order' => 'ASC',
		#'orderby' => 'name'
	);

/*
<ul>
	<li class="page-item"><a href="http://localhost/tentacle/docs/">Docs</a></li>
	<li class="page-item"><a href="http://localhost/tentacle/home/">Home</a></li>
	<li class="page-item"><a href="http://localhost/tentacle/portfolio/">Portfolio</a>
		<ul>
			<li class="page-item"><a href="http://localhost/tentacle/portfolio/design/">Design</a>
				<ul>
					<li class="page-item"><a href="http://localhost/tentacle/portfolio/design/print/">Print</a></li>
				</ul>
			</li>
		</ul>
	</li>
	<li class="page-item active"><a href="http://localhost/tentacle/blog/">Blog</a></li>
</ul>
*/

	$args = parse_args( $args, $default_args );
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