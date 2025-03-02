WordCamp Talk
=============

**This WP Plugin is no more maintained and is now archived**

This repository contains a specific `wp-idea-stream-custom.php` file to extend the plugin [WP Idea Stream](https://wordpress.org/plugins/wp-idea-stream) into a tool to get WordCamp speakers talk proposals.

+ All submitted talks will be private and only viewable by the speaker who submitted them or the administrators
+ The administrators will be able to use WP Idea Stream to manage the submitted talks from WordPress Administration :
 + use comments to discuss between them about the talks
 + use the rating system to make the best talk proposals rise to the top
 + use a custom workflow to mark talks as 'pending/selected/short-listed/rejected'
 + From the WP Idea Stream settings, set the closing date for talk submissions

Available in french and english.

Configuration needed
--------------------

+ WordPress 4.1
+ WP Idea Stream 2.2.0 [Github repo](https://github.com/imath/wp-idea-stream/) or [WordPress repo](https://wordpress.org/plugins/wp-idea-stream) once 2.2.0 is released.
+ Also works fine with WP Idea Stream 2.3.0 (which is requiring WordPress 4.4)

Installation
------------

+ Take the `wp-idea-stream-custom.php` from the `WP_PLUGIN_DIR` directory of this repository and place it at the root of the `WP_PLUGIN_DIR` directory of your WordPress powered website.
+ The custom translation files are to place in :
 + `WP_LANG_DIR/wc-talk` for the `wp-idea-stream-custom.php` specific languages
 + `WP_LANG_DIR/wp-idea-stream` for the WP Idea Stream custom languages
