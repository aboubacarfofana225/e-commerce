<?php
/**
 * Plugin Name:	Di Themes Demo Site Importer
 * Description:	Import demo website of theme developed by Di Themes.
 * Version:		1.0.5
 * Author:		Di Themes
 * Author URI:	https://dithemes.com
 * License:		GPLv2 or later
 * License URI:	http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: dtdsi
 * Domain Path: /languages
 *
 */

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No direct access, please!' );

/**
 * Display admin error message if PHP version is older than 5.3.2.
 * Otherwise execute the main plugin class.
 */
if ( version_compare( phpversion(), '5.3.2', '<' ) ) {

	/**
	 * Display an admin error notice when PHP is older the version 5.3.2.
	 * Hook it to the 'admin_notices' action.
	 */
	function dtdsi_old_php_admin_error_notice() {
		$message = sprintf( esc_html__( 'The %2$s Di Themes Demo Site Importer %3$s plugin requires %2$sPHP 5.3.2+%3$s to run properly. Please contact your hosting company and ask them to update the PHP version of your site to at least PHP 5.3.2.%4$s Your current version of PHP: %2$s%1$s%3$s', 'dtdsi' ), phpversion(), '<strong>', '</strong>', '<br>' );

		printf( '<div class="notice notice-error"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}
	add_action( 'admin_notices', 'dtdsi_old_php_admin_error_notice' );
} else {

	define( 'DTDSI_VERSION' , '1.0.5' ); // Return version of this plugin.
	define( 'DTDSI_FILE', __FILE__ ); // Return 'path of this file'.
	define( 'DTDSI_PATH', wp_normalize_path( plugin_dir_path( DTDSI_FILE ) ) ); // Return 'path of this directory'.
	define( 'DTDSI_URL', plugin_dir_url( DTDSI_FILE ) ); // Return 'URL of this directory'.
	define( 'DTDSI_BASENAME', plugin_basename( DTDSI_FILE ) ); // Return base name like 'plugin-name/plugin-name.php'
	define( 'DTDSI_DIR_NAME', dirname( DTDSI_BASENAME ) ); // Return name of directory like 'plugin-name'

	// Require main plugin file.
	require DTDSI_PATH . 'inc/class-dtdsi-main.php';

	// Instantiate the main plugin class *Singleton*.
	$DTDSI_Import = DTDSI_Import::getInstance();

	// Find the correct template name.
	if( wp_get_theme()->Template ) {
		$DTDSI_Template = wp_get_theme()->Template;
	} else {
		$DTDSI_Template = 'not-set';
	}

	// Set import files and settings according template name.
	if( $DTDSI_Template == 'di-business' ) {

		require DTDSI_PATH . 'inc/di-themes/di-business/import-settings.php';

	} elseif( $DTDSI_Template == 'di-blog' ) {

		require DTDSI_PATH . 'inc/di-themes/di-blog/import-settings.php';

	} elseif( $DTDSI_Template == 'di-responsive' ) {

		require DTDSI_PATH . 'inc/di-themes/di-responsive/import-settings.php';

	} elseif( $DTDSI_Template == 'di-ecommerce' ) {

		require DTDSI_PATH . 'inc/di-themes/di-ecommerce/import-settings.php';

	} elseif( $DTDSI_Template == 'di-magazine' ) {

		require DTDSI_PATH . 'inc/di-themes/di-magazine/import-settings.php';

	} elseif( $DTDSI_Template == 'di-restaurant' ) {

		require DTDSI_PATH . 'inc/di-themes/di-restaurant/import-settings.php';

	} else {

		$what = 'nothing to do, just display form to select import files.';

	}


}