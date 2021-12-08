=== Code ===

Description:	Set of shortcodes which can be used for manual syntax highlighting of code.
Version:		1.3.2
Tags:			code,syntax,highlighting
Author:			azurecurve
Author URI:		https://development.azurecurve.co.uk/
Plugin URI:		https://development.azurecurve.co.uk/classicpress-plugins/code/
Download link:	https://github.com/azurecurve/azrcrv-code/releases/download/v1.3.2/azrcrv-code.zip
Donate link:	https://development.azurecurve.co.uk/support-development/
Requires PHP:	5.6
Requires:		1.0.0
Tested:			4.9.99
Text Domain:	code
Domain Path:	/languages
License: 		GPLv2 or later
License URI: 	http://www.gnu.org/licenses/gpl-2.0.html

Set of shortcodes which can be used for manual syntax highlighting of code.

== Description ==

# Description

Set of shortcodes which can be used for manual syntax highlighting of code:
* **formatcode** adds pre and span tags
* **copyright** displays user defined copyright message
* **highlight** highlights text
* **sqlblue**
* **sqlred**
* **sqlgrey**
* **sqlgreen**
* **sqlpink**
* **phpgrey**
* **phpblue**
* **phpgreen**

This plugin is multisite compatible; each site will need settings to be configured in the admin dashboard.

== Installation ==

# Installation Instructions

 * Download the latest release of the plugin from [GitHub](https://github.com/azurecurve/azrcrv-code/releases/latest/).
 * Upload the entire zip file using the Plugins upload function in your ClassicPress admin panel.
 * Activate the plugin.
 * Configure relevant settings via the configuration page in the admin control panel (azurecurve menu).

== Frequently Asked Questions ==

# Frequently Asked Questions

### Can I translate this plugin?
Yes, the .pot file is in the plugins languages folder; if you do translate this plugin, please sent the .po and .mo files to translations@azurecurve.co.uk for inclusion in the next version (full credit will be given).

### Is this plugin compatible with both WordPress and ClassicPress?
This plugin is developed for ClassicPress, but will likely work on WordPress.

== Changelog ==

# Changelog

### [Version 1.3.2](https://github.com/azurecurve/azrcrv-code/releases/tag/v1.3.2)
 * Update azurecurve menu.
 * Update readme files.

### [Version 1.3.1](https://github.com/azurecurve/azrcrv-code/releases/tag/v1.3.1)
 * Update azurecurve menu and logo.
 
### [Version 1.3.0](https://github.com/azurecurve/azrcrv-code/releases/tag/v1.3.0)
 * Fix plugin action link to use admin_url() function.
 * Rewrite option handling so defaults not stored in database on plugin initialisation.
 * Update azurecurve plugin menu.
 * Amend to load stylesheet only if a code shortcode is on the page.

### [Version 1.2.0](https://github.com/azurecurve/azrcrv-code/releases/tag/v1.2.0)
 * Add plugin icon and banner.

### [Version 1.1.6](https://github.com/azurecurve/azrcrv-code/releases/tag/v1.1.6)
 * Remove calls to wpautop to prevent display issues.

### [Version 1.1.5](https://github.com/azurecurve/azrcrv-code/releases/tag/v1.1.5)
 * Fix bug with setting of default options.
 * Fix bug with plugin menu.
 * Update plugin menu css.

### [Version 1.1.4](https://github.com/azurecurve/azrcrv-code/releases/tag/v1.1.4)
 * Rewrite default option creation function to resolve several bugs.
 * Upgrade azurecurve plugin to store available plugins in options.
 
### [Version 1.1.3](https://github.com/azurecurve/azrcrv-code/releases/tag/v1.1.3)
 * Update Update Manager class to v2.0.0.
 * Update action link.
 * Update azurecurve menu icon with compressed image.

### [Version 1.1.2](https://github.com/azurecurve/azrcrv-code/releases/tag/v1.1.2)
 * Fix bug with version number.

### [Version 1.1.1](https://github.com/azurecurve/azrcrv-code/releases/tag/v1.1.1)
 * Fix bug with incorrect language load function name and text-domain.

### [Version 1.1.0](https://github.com/azurecurve/azrcrv-code/releases/tag/v1.1.0)
 * Add integration with Update Manager for automatic updates.
 * Fix bug with closing of tags in formatcode shortcode.
 * Fix issue with display of azurecurve menu.
 * Change settings page heading.
 * Add load_plugin_textdomain to handle translations.

### [Version 1.0.1](https://github.com/azurecurve/azrcrv-code/releases/tag/v1.0.1)
 * Update azurecurve menu for easier maintenance.
 * Move require of azurecurve menu below security check.
 * Localization fixes.

### [Version 1.0.0](https://github.com/azurecurve/azrcrv-code/releases/tag/v1.0.0)
 * Initial release.

== Other Notes ==

# About azurecurve

**azurecurve** was one of the first plugin developers to start developing for Classicpress; all plugins are available from [azurecurve Development](https://development.azurecurve.co.uk/) and are integrated with the [Update Manager plugin](https://directory.classicpress.net/plugins/update-manager) for fully integrated, no hassle, updates.

Some of the other plugins available from **azurecurve** are:
 * Add Open Graph Tags - [details](https://development.azurecurve.co.uk/classicpress-plugins/add-open-graph-tags/) / [download](https://github.com/azurecurve/azrcrv-add-open-graph-tags/releases/latest/)
 * Add Twitter Cards - [details](https://development.azurecurve.co.uk/classicpress-plugins/add-twitter-cards/) / [download](https://github.com/azurecurve/azrcrv-add-twitter-cards/releases/latest/)
 * BBCode - [details](https://development.azurecurve.co.uk/classicpress-plugins/bbcode/) / [download](https://github.com/azurecurve/azrcrv-bbcode/releases/latest/)
 * Call-out Boxes - [details](https://development.azurecurve.co.uk/classicpress-plugins/call-out-boxes/) / [download](https://github.com/azurecurve/azrcrv-call-out-boxes/releases/latest/)
 * Conditional Links - [details](https://development.azurecurve.co.uk/classicpress-plugins/conditional-links/) / [download](https://github.com/azurecurve/azrcrv-conditional-links/releases/latest/)
 * Flags - [details](https://development.azurecurve.co.uk/classicpress-plugins/flags/) / [download](https://github.com/azurecurve/azrcrv-flags/releases/latest/)
 * Icons - [details](https://development.azurecurve.co.uk/classicpress-plugins/icons/) / [download](https://github.com/azurecurve/azrcrv-icons/releases/latest/)
 * Insult Generator - [details](https://development.azurecurve.co.uk/classicpress-plugins/insult-generator/) / [download](https://github.com/azurecurve/azrcrv-insult-generator/releases/latest/)
 * Page Index - [details](https://development.azurecurve.co.uk/classicpress-plugins/page-index/) / [download](https://github.com/azurecurve/azrcrv-page-index/releases/latest/)
 * Taxonomy Index - [details](https://development.azurecurve.co.uk/classicpress-plugins/taxonomy-index/) / [download](https://github.com/azurecurve/azrcrv-taxonomy-index/releases/latest/)
