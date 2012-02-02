<?

/**
 * Generate HTML output for Naviogation
 *
 * @author Adam Patterson
 */
function nav_generate ( $tree )
{
	
	$depth = -1;
	$flag = false;
	foreach ($tree as $row) {
	    while ($row['level'] > $depth) {
	        echo "<ul>\n", "<li>";
	        $flag = false;
	        $depth++;
	    }
	    while ($row['level'] < $depth) {
	        echo "</li>\n", "</ul>\n";
	        $depth--;
	    }
	    if ($flag) {
	        echo "</li>\n", "<li>";
	        $flag = false;
	    }
	    echo '<a href="'.BASE_URL.$row['uri'].'">'.$row['title'].'</a>';
	    $flag = true;
	}
}

/**
 * Process the page object.
 *
 * @author Adam Patterson
 */

function nav_menu ( )
{
	
	$page = load::model( 'page' );
	$pages = $page->get( );
	// Current URI to be used with .current page
	$uri = URI;


	$page_tree = $page->get_page_tree( $pages );

	$page_object = $page->get_page_children( 0, $pages );
	/*
	$get_page_level = $page->get_page_level( $page_object, 'portfolio/design/print' );

	$get_page_by_level = $page->get_page_by_level( $page_object, $get_page_level );

	$get_home = $page->get_home( );

	$get_flat_page_hierarchy = $page->get_flat_page_hierarchy( $pages );

	$get_descendant_ids = $page->get_descendant_ids( 3 );

	$page_children = $page->get_page_children( 0, $pages );
	*/
	// Generate the HTML output.
	nav_generate ( (array)$page_object );

}
