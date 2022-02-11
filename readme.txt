=== Global Styles Mods ===
Contributors:      webmandesign
Author URI:        https://www.webmandesign.eu
Plugin URI:        https://github.com/webmandesign/global-styles-mods
Donate link:       https://www.webmandesign.eu/contact/#donation
Requires at least: 5.9
Tested up to:      5.9
Requires PHP:      7.0
Stable tag:        1.0.0
License:           GNU General Public License v3
License URI:       http://www.gnu.org/licenses/gpl-3.0.html
Tags:              webman, webman design, global styles, stylesheet, styles, css, Gutenberg, block, editor

Modifies WordPress 5.9+ global stylesheet CSS code.


== Description ==

After updating to WordPress 5.9+, do you experience sudden font size change on your website? Or maybe even a color change issues?

This plugin may help! It lowers specificity of WordPress 5.9+ global CSS styles by removing `!important` rules and using `:root` instead of `body` selector for setting up CSS properties. It also enqueues the stylesheet early enough so your theme or plugin stylesheets have a better chance to override global styles.

= More details =

WordPress 5.9 started to apply `!important` CSS rule and declares its CSS properties within `body` selector in global stylesheet. This rises the global styles specificity and overrides Gutenberg compatible theme styles. This plugin fixes the issue by lowering the specificity of WordPress global CSS styles.

Example of [global styles produced by WordPress 5.9+](https://make.wordpress.org/core/2022/01/08/updates-for-settings-styles-and-theme-json/#changes-to-the-global-stylesheet) by default:
```
body {
	--wp--preset--<PRESET_TYPE>--<PRESET_SLUG>: <DEFAULT_VALUE>;
}
.has-<PRESET_SLUG>-<PRESET_TYPE> {
	property: var(--wp--preset--<PRESET_TYPE>--<PRESET_SLUG>) !important;
}
```

More information about the issue can be found in [Gutenberg GitHub repository](https://github.com/WordPress/gutenberg/issues/38252#issuecomment-1024348024).


== Installation ==

1. Unzip the plugin download file and upload `global-styles-mods` folder into the `/wp-content/plugins/` directory.
2. Activate the plugin through the *"Plugins"* menu in WordPress. Or, you can copy the `global-styles-mods--mu.php` file into your WordPress `/wp-content/mu-plugins/` directory to force the plugin activation (even for all sites in multi-site setup) as a ["must use" plugin](https://wordpress.org/support/article/must-use-plugins/).
3. Plugin has no options, works immediately after activation. The plugin requires WordPress of version 5.9 and above. If you experienced issues with font sizes and/or colors previously, these should be fixed - that's how you know the plugin is working.


== Frequently Asked Questions ==

= It does not work? =

The plugin requires WordPress 5.9 and newer. Also, this plugin works quietly behind the scenes and simply modifies WordPress global CSS styles code - check your website page source in the browser for comparison.

If you experienced issues with font sizes and/or colors previously, these should be fixed after plugin activation - that's how you know the plugin is doing its magic.


== Changelog ==

Please see the [`changelog.md` file](https://github.com/webmandesign/global-styles-mods/blob/master/changelog.md) for details.


== Upgrade Notice ==

= 1.0.0 =
Initial release.
