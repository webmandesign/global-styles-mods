<?php
/**
 * Global Styles Mods MU
 *
 * "Must use" plugin component.
 * Copy this file into your WordPress `./wp-content/mu-plugins/` folder
 * and the plugin will be automatically loaded in your WordPress.
 *
 * @link  https://wordpress.org/support/article/must-use-plugins/
 *
 * @package    Global Styles Mods
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since  1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( file_exists( WPMU_PLUGIN_DIR . '/global-styles-mods/global-styles-mods.php' ) ) {
	require_once WPMU_PLUGIN_DIR . '/global-styles-mods/global-styles-mods.php';
} elseif ( file_exists( WP_PLUGIN_DIR . '/global-styles-mods/global-styles-mods.php' ) ) {
	require_once WP_PLUGIN_DIR . '/global-styles-mods/global-styles-mods.php';
}
