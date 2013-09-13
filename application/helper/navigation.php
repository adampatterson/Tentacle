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
	$page = load::model( 'content' );
	$pages = $page->type( 'page' )->get( );
	// Current URI to be used with .current page
	$uri = URI;

	$page_tree = $page->type( 'page' )->get_page_tree( $pages );
	$page_array = $page->type( 'page' )->get_page_children( 0, $pages, 0 );
	
	/*
	$get_page_level = $page->get_page_level( $page_object, 'portfolio/design/print' );
	$get_page_by_level = $page->get_page_by_level( $page_object, $get_page_level );
	$get_home = $page->get_home( );
	$get_flat_page_hierarchy = $page->get_flat_page_hierarchy( $pages );
	$get_descendant_ids = $page->get_descendant_ids( 3 );
	$page_children = $page->get_page_children( 0, $pages );
	*/
	// Generate the HTML output.
	menu( $page_tree, $args );
}


/**
 * Function: nav_generate
 *	Generate HTML output for Navigation
 *
 * Parameters:
 *	$tree - Tree data array
 *	$args - Array
 *
 * Returns:
 *	HTML - Formatted HTML tree.
 */
function menu( $items, $args = array() )
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

    $args = parse_args( $args, $default_args );
    $args = (object) $args;

    if( isset($items['children']))
	{
        menu($items['children']);
    } else {
		echo "\n<ul>\n";
        foreach($items as $item)
        {
            echo "<li ".nav_class( array('uri'=> $item['uri'] ), $item['type'] )."><a href=".BASE_URL.$item['uri'].">".$item['title']."</a>";

			 if( isset($item['children']))
                 menu($item['children']);
				
			echo "</li>\n";
        }
		echo "</ul>\n";
    }
}


/* Function menu_showNested
* @desc Create inifinity loop for nested list from database
* @return echo string
*/
function menu_show_nested( $parent_id = '' )
{
    $page = load::model( 'content' );
    $pages = $page->type( 'page' )->get_by_parent_id( $parent_id );

    if ($pages > 0):
        echo "\n";
        echo "<ol class='dd-list'>\n";
        foreach($pages as $page ) {
            echo "\n";

            echo "<li class='dd-item' data-id='{$page->id}'>\n";
            echo "<div class='dd-handle'>{$page->id}: {$page->title}</div>";

            // Run this function again (it would stop running when the mysql_num_result is 0
            menu_show_nested($page->id);

            echo "</li>\n";
        }
        echo "</ol>\n";
    endif;
}