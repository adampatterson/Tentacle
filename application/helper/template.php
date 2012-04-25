<?
// Include tempalte files
    function get_header () {echo 'get the header';}
    function get_sidebar () {echo 'get the sidebar';}
    function get_footer () {echo 'get the footer';}
    function get_part () {echo 'get the template parts';}
    function get_search () {echo 'get the search form';}
    function get_comment () {echo 'get the comments';}
    function get_bloginfo () {echo 'get the bloginfo';}

// Blog Info
    function bloginfo() 
    {
        // http://codex.wordpress.org/Function_Reference/bloginfo
    }
   
// Author Tags
    function the_author () {
		clean_out( $user );
		
	}
    function get_the_author () {}
    function the_author_link () {}
    function get_the_author_link () {}
    function the_author_meta () {}
    function the_author_posts () {}
    function the_author_posts_link () {}
    function wp_dropdown_users () {}
    function wp_list_authors () {}
    function get_author_posts_url () {}
    
// Content Information
    function get_title ()  {}
    function get_titles ()  {}
    function get_menue () {}
    function single_cat_title () {
           // Single or list
           // accept before and after code IE: <li>
        }
    function get_categories ()  {}
    function single_tag_title () {
           // Single or list
           // accept before and after code IE: <li>
        }
    function get_tags () {}
    function the_search_query () {}
    
// Date and Time
    function get_date ( $d = '', $before = '', $after = '', $echo = true )  {}
    function get_modified_date ( $d = '', $before = '', $after = '', $echo = true )  {}
    function get_time( $d = '' )  {}
    function get_modified_time ($d = '')  {}

// Permalinks
    function get_permalink () {}
    function get_post_permalink () {}
    function permalink_anchor () {}
    function permalink_single_rss () {}
    function post_permalink () {}
    function the_permalink  () {}
    
// Post

// Render classes in the template
//----------------------------------------------------------------------------------------------
	
	/**
	 * Converts the URI into a list of classes
	 *
	 * @return string
	 * @author Adam Patterson
	 */
	function body_class () {
		// Separates classes with a single space, collates classes for body element
		echo 'class="'.join( ' ', explode("/", URI ) ).'"';
		//echo 'class="' . join( ' ', get_body_class( $class ) ) . '"';
	}
	
	/**
	 * Converts the URI for a post into a class
	 *
	 * @return string
	 * @author Adam Patterson
	 */
	function post_class() {
		return true;
	}
	

// Get and is functions
//----------------------------------------------------------------------------------------------
	
	/**
	 * Retrieve the classes for the body element as an array.
	 *
	 * @since 2.8.0
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function get_body_class( $class = '' ) {
		/*
		global $wp_query, $wpdb;
	
		$classes = array();
	
		if ( is_rtl() )
			$classes[] = 'rtl';
	
		if ( is_front_page() )
			$classes[] = 'home';
		if ( is_home() )
			$classes[] = 'blog';
		if ( is_archive() )
			$classes[] = 'archive';
		if ( is_date() )
			$classes[] = 'date';
		if ( is_search() )
			$classes[] = 'search';
		if ( is_paged() )
			$classes[] = 'paged';
		if ( is_attachment() )
			$classes[] = 'attachment';
		if ( is_404() )
			$classes[] = 'error404';
	
		if ( is_single() ) {
			$post_id = $wp_query->get_queried_object_id();
			$post = $wp_query->get_queried_object();
	
			$classes[] = 'single';
			$classes[] = 'single-' . sanitize_html_class($post->post_type, $post_id);
			$classes[] = 'postid-' . $post_id;
	
			// Post Format
			$post_format = get_post_format( $post->ID );
	
			if ( $post_format && !is_wp_error($post_format) )
				$classes[] = 'single-format-' . sanitize_html_class( $post_format );
			else
				$classes[] = 'single-format-standard';
	
			if ( is_attachment() ) {
				$mime_type = get_post_mime_type($post_id);
				$mime_prefix = array( 'application/', 'image/', 'text/', 'audio/', 'video/', 'music/' );
				$classes[] = 'attachmentid-' . $post_id;
				$classes[] = 'attachment-' . str_replace( $mime_prefix, '', $mime_type );
			}
		} elseif ( is_archive() ) {
			if ( is_post_type_archive() ) {
				$classes[] = 'post-type-archive';
				$classes[] = 'post-type-archive-' . sanitize_html_class( get_query_var( 'post_type' ) );
			} else if ( is_author() ) {
				$author = $wp_query->get_queried_object();
				$classes[] = 'author';
				$classes[] = 'author-' . sanitize_html_class( $author->user_nicename , $author->ID );
				$classes[] = 'author-' . $author->ID;
			} elseif ( is_category() ) {
				$cat = $wp_query->get_queried_object();
				$classes[] = 'category';
				$classes[] = 'category-' . sanitize_html_class( $cat->slug, $cat->term_id );
				$classes[] = 'category-' . $cat->term_id;
			} elseif ( is_tag() ) {
				$tags = $wp_query->get_queried_object();
				$classes[] = 'tag';
				$classes[] = 'tag-' . sanitize_html_class( $tags->slug, $tags->term_id );
				$classes[] = 'tag-' . $tags->term_id;
			} elseif ( is_tax() ) {
				$term = $wp_query->get_queried_object();
				$classes[] = 'tax-' . sanitize_html_class( $term->taxonomy );
				$classes[] = 'term-' . sanitize_html_class( $term->slug, $term->term_id );
				$classes[] = 'term-' . $term->term_id;
			}
		} elseif ( is_page() ) {
			$classes[] = 'page';
	
			$page_id = $wp_query->get_queried_object_id();
	
			$post = get_page($page_id);
	
			$classes[] = 'page-id-' . $page_id;
	
			if ( $wpdb->get_var( $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_parent = %d AND post_type = 'page' AND post_status = 'publish' LIMIT 1", $page_id) ) )
				$classes[] = 'page-parent';
	
			if ( $post->post_parent ) {
				$classes[] = 'page-child';
				$classes[] = 'parent-pageid-' . $post->post_parent;
			}
			if ( is_page_template() ) {
				$classes[] = 'page-template';
				$classes[] = 'page-template-' . sanitize_html_class( str_replace( '.', '-', get_post_meta( $page_id, '_wp_page_template', true ) ), '' );
			} else {
				$classes[] = 'page-template-default';
			}
		} elseif ( is_search() ) {
			if ( !empty( $wp_query->posts ) )
				$classes[] = 'search-results';
			else
				$classes[] = 'search-no-results';
		}
	
		if ( is_user_logged_in() )
			$classes[] = 'logged-in';
	
		if ( is_admin_bar_showing() )
			$classes[] = 'admin-bar';
	
		$page = $wp_query->get( 'page' );
	
		if ( !$page || $page < 2)
			$page = $wp_query->get( 'paged' );
	
		if ( $page && $page > 1 ) {
			$classes[] = 'paged-' . $page;
	
			if ( is_single() )
				$classes[] = 'single-paged-' . $page;
			elseif ( is_page() )
				$classes[] = 'page-paged-' . $page;
			elseif ( is_category() )
				$classes[] = 'category-paged-' . $page;
			elseif ( is_tag() )
				$classes[] = 'tag-paged-' . $page;
			elseif ( is_date() )
				$classes[] = 'date-paged-' . $page;
			elseif ( is_author() )
				$classes[] = 'author-paged-' . $page;
			elseif ( is_search() )
				$classes[] = 'search-paged-' . $page;
			elseif ( is_post_type_archive() )
				$classes[] = 'post-type-paged-' . $page;
		}
	
		if ( ! empty( $class ) ) {
			if ( !is_array( $class ) )
				$class = preg_split( '#\s+#', $class );
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}
	
		$classes = array_map( 'esc_attr', $classes );
	
		return apply_filters( 'body_class', $classes, $class );
		*/
	}

    function next_image_link () {}
    function next_post_link () {}
    function next_posts_link () {}
    function post_password_required () {}
    function posts_nav_link () {}
    function previous_image_link () {}
    function previous_post_link () {}
    function previous_posts_link () {}
    function single_post_title () {}
    function sticky_class () {}
    function the_category () {}
    function the_category_rss () {}
    function the_content () {}
    function the_content_rss () {}
    function the_excerpt () {}
    function the_excerpt_rss () {}
    function the_ID () {}
    function the_meta () {}
    function the_shortlink () {}
    function the_tags () {}
    function the_title () {}
    function the_title_attribute () {}
    function the_title_rss () {}
    function wp_link_pages () {}
    
// Comment 
    function cancel_comment_reply_link () {}
    function comment_author () {}
    function comment_author_email () {}
    function comment_author_email_link () {}
    function comment_author_IP () {}
    function comment_author_link () {}
    function comment_author_rss () {}
    function comment_author_url () {}
    function comment_author_url_link () {}
    function comment_class () {}
    function comment_date () {}
    function comment_excerpt () {}
    function comment_form_title () {}
    function comment_form () {}
    function comment_ID () {}
    function comment_id_fields () {}
    function comment_reply_link () {}
    function comment_text () {}
    function comment_text_rss () {}
    function comment_time () {}
    function comment_type () {}
    function comments_link () {}
    function comments_number () {}
    function comments_popup_link () {}
    function comments_popup_script () {}
    function comments_rss_link () {}
    function get_avatar () {}
    function next_comments_link () {}
    function paginate_comments_links () {}
    function permalink_comments_rss () {}
    function previous_comments_link () {}
    function wp_list_comments () {}

// Post Media
    function get_post_thumbnail_id () {}
    function get_the_post_thumbnail () {}
    function has_post_thumbnail () {}
    function the_post_thumbnail () {}
    function get_attachment_link () {}
    function is_attachment () {}
    function the_attachment_link () {}
    function wp_attachment_is_image () {}
    function wp_get_attachment_image () {}
    function wp_get_attachment_image_src () {}
    function wp_get_attachment_metadata () {}
    
// Link content
    function get_stylesheet() {}
    function get_template_directory() {}
    function get_feed_link () {}
    
// Edit Links
    function edit_comment_link () {}
    function edit_post_link () {}

// for plugins to load data in selected areas.
    function add_header () {}
    function add_sidebar () {}
    function add_footer () {}
?>