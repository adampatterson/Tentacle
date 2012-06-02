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
	?>
	</ul>
	<?
}

/**
 * Process the page object.
 *
 * @author Adam Patterson
 */

function nav_menu ( )
{
	define ( 'FRONT'		,'true' );
	
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

/**
* Navigation
*/
class nav
{
	
	public function build_tree_object ( $items ) {
		$childs = array();

		foreach($items as $item)
		    $childs[$item->parent][] = $item;

		foreach($items as $item) if (isset($childs[$item->id]))
		    $item->childs = $childs[$item->id];

		$tree = $childs[0];
		
		return $tree;
	}

	// http://www.sitepoint.com/forums/showthread.php?448787-Creating-an-Unordered-List-from-The-Adjacency-List-Model
	public function build_menu($currentPageId, $menuItems, $output = '')
	    {
	        // Loop through menu items
	        if(count($menuItems) > 0)
	        {
	            $output .= "\n<ul>\n";
	            foreach($menuItems as $item)
	            {
	                $pageId = !empty($item->alias) ? $item->alias : 'page/view/' . $item->id;
	                $current = ($item->id == $currentPageId) ? ' class="active"' : '';
	                $output .= "  <li><a href=\"" . $pageId . "\" title=\"" . $item->title . "\" " . $current . ">" . $item->title . "</a>";
	                // Child menu
	                if(isset($item->childs))
	                {
	                    // Recursive function call
	                    $thisFunction = __FUNCTION__;
	                    $output = $this->$thisFunction($currentPageId, $item->childs, $output);
	                }
	                $output .= "  </li>\n";
	            }
	            //$output .= "  <li><a href=\"#\" class=\"end\"></a></li>\n";
	            $output .= "</ul>\n";
	        } else {
	            $output = "&nbsp;";
	        }

	        return $output;
	    }

}

