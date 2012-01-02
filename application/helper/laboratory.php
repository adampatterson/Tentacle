<?
/**
 * Retrieve child pages from list of pages matching page ID.
 *
 * Matches against the pages parameter against the page ID. Also matches all
 * children for the same to retrieve all children of a page. Does not make any
 * SQL queries to get the children.
 *
 * @since 1.5.1
 *
 * @param int $page_id Page ID.
 * @param array $pages List of pages' objects.
 * @return array
 */
function &get_page_children($page_id, $pages) {
	$page_list = array();
	foreach ( (array) $pages as $page ) {
		if ( $page->parent == $page_id ) {
			$page_list[] = $page;
			if ( $children = get_page_children($page->id, $pages) )
				$page_list = array_merge($page_list, $children);
		}
	}
	return $page_list;
}

/**
 * Order the pages with children under parents in a flat list.
 *
 * It uses auxiliary structure to hold parent-children relationships and
 * runs in O(N) complexity
 *
 * @since 2.0.0
 *
 * @param array $pages Posts array.
 * @param int $page_id Parent page ID.
 * @return array A list arranged by hierarchy. Children immediately follow their parents.
 */
function &get_page_hierarchy( &$pages, $page_id = 0 ) {
	if ( empty( $pages ) ) {
		$result = array();
		return $result;
	}

	$children = array();
	foreach ( (array) $pages as $p ) {
		$parent_id = intval( $p->parent );
		$children[ $parent_id ][] = $p;
	}

	$result = array();
	_page_traverse_name( $page_id, $children, $result );

	return $result;
}

/**
 * function to traverse and return all the nested children post names of a root page.
 * $children contains parent-chilren relations
 *
 * @since 2.9.0
 */
function _page_traverse_name( $page_id, &$children, &$result ){
	if ( isset( $children[ $page_id ] ) ){
		foreach( (array)$children[ $page_id ] as $child ) {
			$result[ $child->id ] = $child->slug;
			_page_traverse_name( $child->id, $children, $result );
		}
	}
}