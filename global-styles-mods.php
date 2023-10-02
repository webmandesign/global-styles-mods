<?php
/**
 * Plugin Name:  Global Styles Mods
 * Plugin URI:   https://github.com/webmandesign/global-styles-mods
 * Description:  Lowers specificity of WordPress 5.9+ global styles by removing `!important` rule and using `:root` instead of `body` selector for setting up CSS properties.
 * Version:      1.1.0
 * Author:       WebMan Design, Oliver Juhas
 * Author URI:   https://www.webmandesign.eu/
 * License:      GNU General Public License v3
 * License URI:  http://www.gnu.org/licenses/gpl-3.0.txt
 *
 * Requires at least: 5.9
 * Requires PHP:      7.0
 *
 * Provides fix for this issue:
 * WordPress 5.9 started to apply `!important` CSS rule and declares
 * its CSS properties within `body` selector in global stylesheet.
 * This rises the global styles specificity and overrides Gutenberg
 * compatible theme styles.
 * This plugin fixes the issue by lowering the specificity of WordPress
 * global CSS styles.
 *
 * @example  Global styles produced by WordPress 5.9+ by default:
 *   body {
 *     --wp--preset--<PRESET_TYPE>--<PRESET_SLUG>: <DEFAULT_VALUE>;
 *   }
 *   .has-<PRESET_SLUG>-<PRESET_TYPE> {
 *     property: var(--wp--preset--<PRESET_TYPE>--<PRESET_SLUG>) !important;
 *   }
 *
 * @link  https://make.wordpress.org/core/2022/01/08/updates-for-settings-styles-and-theme-json/#changes-to-the-global-stylesheet
 * @link  https://github.com/WordPress/gutenberg/issues/38252#issuecomment-1024348024
 * @link  https://github.com/webmandesign/global-styles-mods
 * @link  https://www.webmandesign.eu
 *
 * @package  Global Styles Mods
 *
 * @copyright  WebMan Design, Oliver Juhas
 * @license    GPL-3.0, https://www.gnu.org/licenses/gpl-3.0.html
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class WebMan_Global_Styles_Mods {

	/**
	 * WordPress global stylesheet handle.
	 *
	 * @since  1.0.0
	 * @var    string
	 */
	private static $handle = 'global-styles';

	/**
	 * WordPress global stylesheet enqueue priority.
	 *
	 * @since  1.0.0
	 * @var    int
	 */
	private static $priority = 0;

	/**
	 * Initialization.
	 *
	 * Dequeues original WordPress global styles
	 * and enqueues them again but earlier and modified.
	 * Modifies also editor (Gutenberg) global styles.
	 *
	 * @since    1.0.0
	 * @version  1.1.0
	 *
	 * @return  void
	 */
	public static function init() {

		// Requirements check

			// WP5.9+ only.
			if ( ! function_exists( 'wp_get_global_stylesheet' ) ) {
				return;
			}


		// Processing

			// Actions

				remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
				remove_action( 'wp_enqueue_scripts', 'gutenberg_enqueue_global_styles' );

				add_action( 'wp_enqueue_scripts', __CLASS__ . '::enqueue', (int) self::$priority );

			// Filters

				add_filter( 'block_editor_settings_all', __CLASS__ . '::get_editor_settings_mod' );

	} // /init

	/**
	 * Re-registers and enqueues modified global stylesheet.
	 *
	 * @since    1.0.0
	 * @version  1.1.0
	 *
	 * @return  void
	 */
	public static function enqueue() {

		// Variables

			$css        = ( is_callable( 'gutenberg_get_global_stylesheet' ) ) ? ( gutenberg_get_global_stylesheet() ) : ( wp_get_global_stylesheet() );
			$stylesheet = self::get_css_mod( $css );


		// Requirements check

			if ( empty( $stylesheet ) ) {
				return;
			}


		// Processing

			wp_register_style( self::$handle, false );
			wp_add_inline_style( self::$handle, $stylesheet );
			wp_enqueue_style( self::$handle );

	} // /enqueue

	/**
	 * Gets modified editor settings.
	 *
	 * CSS is being modified here.
	 *
	 * @since  1.0.0
	 *
	 * @param  array $editor_settings
	 *
	 * @return  array
	 */
	public static function get_editor_settings_mod( array $editor_settings ): array {

		// Requirements check

			if (
				empty( $editor_settings['styles'] )
				|| ! is_array( $editor_settings['styles'] )
			) {
				return $editor_settings;
			}


		// Processing

			$editor_settings['styles'] = array_map(
				function( $style ) {
					if ( ! empty( $style['css'] ) ) {
						$style['css'] = self::get_css_mod( $style['css'] );
					}
					return $style;
				},
				$editor_settings['styles']
			);


		// Output

			return $editor_settings;

	} // /get_editor_settings_mod

	/**
	 * Gets modified CSS styles string.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $css
	 *
	 * @return  string
	 */
	public static function get_css_mod( string $css ): string {

		// Output

			return str_replace(
				[ 'body', '!important', ' ;' ],
				[ ':root', '', ';' ],
				$css
			);

	} // /get_css_mod

}

add_action( 'init', 'WebMan_Global_Styles_Mods::init' );
