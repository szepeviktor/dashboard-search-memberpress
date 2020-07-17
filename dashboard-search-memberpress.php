<?php
/**
 * Plugin Name: Dashboard Search for MemberPress
 * Description: Adds a widget to search MemberPress member information by any field (email, username, first and last name, id) from the WordPress Dashboard.
 * Version: 1.0.0
 * Author: WPJohnny
 * Author URI: https://wpjohnny.com/
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add widget to the dashboard.
 *
 * @since 0.1.0
 * @access public
 * @return void
 */
add_action( 'wp_dashboard_setup', function() {

	wp_add_dashboard_widget(
		'wpj_mp_dashboard_search_widget',
		__( 'Search MemberPress Member', 'wpj-mp-dashboard-search' ),
		'wpj_mp_dashboard_search_widget_function'
	);
});

/**
 * Callback function to output the contents of the widget.
 *
 * @since 0.1.0
 * @access public
 * @return void
 */
function wpj_mp_dashboard_search_widget_function() {
	?>
		<div class="wpj_mp_dashboard_search">
			<p class="wpj_mp_dashboard_search__wrap">
				<input type="text" id="wpj_mp_dashboard_search__value" value="" />
				<input type="submit"  id="wpj_mp_dashboard_search__submit" class="button button-primary" value="<?php esc_html_e( 'Go', 'wpj-mp-dashboard-search' ); ?>" />
			</p>
		</div>
	<?php
}

/**
 * Load script for handling the search events.
 *
 * @since 0.1.0
 * @access public
 * @return void
 */
add_action( 'admin_enqueue_scripts', function( $hook ) {
	if ( 'index.php' === $hook || 'memberpress_page_memberpress-members' === $hook ) {
		wp_enqueue_script(
			'wpj-mp-dashboard-search-script',
			plugin_dir_url(__FILE__) . 'assets/scripts/admin.js',
			array( 'jquery' ),
			'0.1.1',
			true
		);
	}
});
