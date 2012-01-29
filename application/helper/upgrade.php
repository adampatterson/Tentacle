<?

public function get_db_version ()
{
	return load::model ( 'settings' )->get( 'db_version' );
}

function tentacle_upgrade() {
	global $wp_current_db_version, $wp_db_version, $wpdb;

	$wp_current_db_version = __get_option('db_version');

	// We are up-to-date.  Nothing to do.
	if ( $wp_db_version == $wp_current_db_version )
		return;

	if ( ! is_blog_installed() )
		return;

	get_db_version();
	upgrade_all();
}



/**
 * Functions to be called in install and upgrade scripts.
 *
 * @since 1.0.0
 */
function upgrade_all() {
	global $wp_current_db_version, $wp_db_version, $wp_rewrite;
	$wp_current_db_version = __get_option('db_version');

	// We are up-to-date.  Nothing to do.
	if ( $wp_db_version == $wp_current_db_version )
		return;

	if ( $wp_current_db_version < 3308 )
		upgrade_160();

	if ( $wp_current_db_version < 4772 )
		upgrade_210();

	maybe_disable_automattic_widgets();

	update_option( 'db_version', $wp_db_version );
	update_option( 'db_upgraded', true );
}


/**
 * Execute changes made in Tentacle CMS 1.0.1.
 *
 * @since 1.0.1
 */
function upgrade_101() {
	global $wpdb;

	// Clean up indices, add a few
	add_clean_index($wpdb->posts, 'post_name');
	add_clean_index($wpdb->posts, 'post_status');
	add_clean_index($wpdb->categories, 'category_nicename');
	add_clean_index($wpdb->comments, 'comment_approved');
	add_clean_index($wpdb->comments, 'comment_post_ID');
	add_clean_index($wpdb->links , 'link_category');
	add_clean_index($wpdb->links , 'link_visible');
}
