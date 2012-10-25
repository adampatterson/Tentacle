<?
/**
* File: Is
*/

	
	/**
	* Function: is_blog_installed
	*	Simply checks to see if the blog is installed.
	*
	* Returns:
	*	Bool
	*/
	function is_blog_installed() {
		$touch = load::model( 'sql' );
		
		$touch_db = $touch->touch_db();

		if ( $touch_db === false ) {
			url::redirect('install/step5');
		} else {
			return true;
		}		
	}
	
	
	/**
	* Function: is_agree
	*	Has the owner agreed to the terms and services.
	*
	* Returns:
	*	Bool
	*/
	function is_agree() {
		if ( get_option( 'is_agree' ) ) {
			return true;
		} else {
			return false;
		}
	}
	
	
	/**
	* Function: is_availible_updates
	*	Are there any updates?
	*
	* Returns:
	*	Bool
	*/
	function is_availible_updates() {
		if ( get_option( 'is_updates' ) ) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	* Function: is_update
	*	Is the new version newer than the current version.
	*
	* Returns:
	*	Bool
	*/
	function is_update( $current, $new ) {
		if ($current < $new) {
			return true;
		} else {
			return false;
		}
	}
	
	
	/**
	* Function: is_mobile
	*	Is the page being viewed with a mobile device?
	*
	* Returns:
	*	Bool
	*/
	function is_mobile() 
	{
		$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
		$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
		$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
		$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

		if ($iphone || $android || $palmpre || $ipod || $berry == true) 
		{ 
			return true;
		} else {
			return false;
		}
	}
	
	
	function is_rtl () {}
	function is_front_page () {}
	function is_home () {}
	function is_date () {}
	function is_search () {}
	function is_paged () {}
	function is_page () {}
	function is_preview () {}
	function is_page_template () {}
	function is_404 () {}
	function is_error () {}
	function is_single () {}
	function is_sticky () {}
	function is_admin () {}
	function is_archive () {}
	function is_post_type_archive () {}
	function is_author () {}
	function is_user_logged_in () {}
	function is_category () {}
	function is_tag () {}
	function is_tax () {}
	function is_trackback () {}
	function is_serialized () {}
	function is_admin_bar_showing () {}
