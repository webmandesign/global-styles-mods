=== Global Styles Mods - WordPress 5.9 fix ===
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
Tags:              global styles, fix, Gutenberg, wp5.9, font size, colors

Fixes styling issues in WordPress 5.9 modifying global styles code.


== Description ==

= Plugin's purpose =

This plugin fixes styling issues introduced in WordPress 5.9.

= 👍 When to use this plugin =

- ✅ Your WordPress is of version 5.9 or newer
- ✅ You are using a theme that supports block editor (Gutenberg) features such as preset font sizes and color palette
- ✅ Your theme does not support [full site editing (FSE) feature](https://wordpress.org/news/2022/01/josephine/) (from [conversation about reported issues](https://github.com/WordPress/gutenberg/issues/38252) it seems they affect Gutenberg-ready themes only and FSE themes should be fine)
- ✅ You experience font size or color issues on your website after WordPress 5.9 update
- ✅ Your theme has not been updated to fix these issues

= ✋ When NOT to use this plugin =

- You are not using WordPress 5.9 or newer
- Your theme was updated and is fixing the issues
- Your theme does not support block editor features (such as preset color palette or font sizes)
- Your theme is [full site editing (FSE) ready](https://wordpress.org/news/2022/01/josephine/)
- You don't experience any font size or color issues on your website after updating to WordPress 5.9

= Technical info =

WordPress 5.9 started applying `!important` rule and is setting up CSS properties (CSS variables) within `body` selector in its global styles code. This rises the global styles specificity and may override styles coming from themes and plugins. (For more info about this change check ["Updates for Settings, Styles, and theme.json" article](https://make.wordpress.org/core/2022/01/08/updates-for-settings-styles-and-theme-json/#changes-to-the-global-stylesheet).)

**Global Styles Mods** plugin lowers the specificity of WordPress 5.9 global CSS styles by removing `!important` rules and changing `body` to `:root` selector for setting up WordPress CSS properties (CSS variables).

It also enqueues the global styles early enough so your theme or plugin stylesheet have a better chance to override global styles with minimal effort.

The fix applied is coming from issue [conversation in Gutenberg GitHub repository](https://github.com/WordPress/gutenberg/issues/38252#issuecomment-1024348024).


== Installation ==

1. Unzip the plugin download file and upload `global-styles-mods` folder into the `/wp-content/plugins/` directory.
2. Activate the plugin through the *"Plugins"* menu in WordPress.
3. Plugin has no options and works immediately after activation. The plugin requires WordPress of version 5.9 to run. If you experienced issues with font sizes and/or colors after updating to WordPress 5.9, this plugin should fix them - that's how you know the plugin is working.


== Frequently Asked Questions ==

= It does not work, help! =

The plugin requires WordPress 5.9 to work.

Also, it works quietly behind the scenes and simply modifies WordPress global CSS styles code - check your website page source in the browser for comparison when plugin is active vs. when it's inactive.

If you experienced issues with font sizes and/or colors after updating to WordPress 5.9, this plugin should fix them - that's how you know the plugin is doing its magic.


== Screenshots ==

1. Issues with font sizes after WordPress 5.9 update.


== Changelog ==

Please see the [`changelog.md` file](https://github.com/webmandesign/global-styles-mods/blob/master/changelog.md) for details.


== Upgrade Notice ==

= 1.0.0 =
Initial release.
