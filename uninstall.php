<?php
/**
 * Fired when the plugin is deleted
 */
defined( 'ABSPATH' ) or die( "Cheating........Uh!!" );

//if uninstall not called from WordPress, exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

// check if current user is eligible to perform uninstall
if ( ! current_user_can( 'activate_plugins' ) ) {
	return;
}

$heateor_fbl_options = get_option( 'heateor_fbl' );
$heateor_fbl_options_to_delete = array(
	'heateor_fbl',
	'heateor_fbl_version',
	'widget_heateorfacebooklogin'
);

if ( isset( $heateor_fbl_options['delete_options'] ) ) {
	global $wpdb;
	
	// For Multisite
	if ( function_exists( 'is_multisite' ) && is_multisite() ) {
		$heateor_fbl_blog_ids = heateor_fbl_get_blog_ids();
		$heateor_fbl_original_blog_id = get_current_blog_id();
		foreach ( $heateor_fbl_blog_ids as $blog_id ) {
			switch_to_blog( $blog_id );
			foreach ( $heateor_fbl_options_to_delete as $option ) {
				delete_site_option( $option );
			}
		}
		switch_to_blog( $heateor_fbl_original_blog_id );    // should use "restore_current_blog"?
	} else {
		foreach ( $heateor_fbl_options_to_delete as $option ) {
			delete_option( $option );
		}
	}
}

/**
 * Get all blog IDs of blogs in the current network that are not archived, spam, deleted
 */
function heateor_fbl_get_blog_ids() {
	global $wpdb;

	$sql = <<<SQL
SELECT blog_id
FROM {$wpdb->blogs}
WHERE archived = '0'
AND spam = '0'
AND deleted = '0'
SQL;

	return $wpdb->get_col( esc_sql( $sql ) );
}
