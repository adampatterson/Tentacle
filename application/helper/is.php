<?
/*
 * These functions should return TRUE of FALSE
 * They should be used to logic in templates and the admin area.
 */

	function is_blog_installed() {
		if ( get_option( 'is_blog_installed' ) ) {
			return true;
		} else {
			return false;
		}
	}
	
	function is_agree() {
		if ( get_option( 'is_agree' ) ) {
			return true;
		} else {
			return false;
		}
	}
	
	function is_rtl() {}
	
	function is_front_page() {}
	function is_home() {}
	function is_date() {}
	function is_search() {}
	function is_paged() {}
	function is_page() {}
	function is_page_template() {}
	function is_attachment() {}
	function is_404() {}
	function is_error() {}
	function is_single() {}
	function is_archive() {}
	function is_post_type_archive() {}
	function is_author() {}
	function is_user_logged_in() {}
	function is_category() {}
	function is_tag() {}
	function is_tax() {}
	function is_admin_bar_showing() {}

