=== WordPress Reset ===
Contributors: sivel, jdingman
Donate Link: http://sivel.net/donate
Tags: wordpress-reset, wordpress, reset, admin
Requires at least: 2.7
Tested up to: 3.0
Stable tag: 1.2

Resets the WordPress database back to it's defaults.  Deletes all customizations and content.  Does not modify files only resets the database.

== Description ==

Resets the WordPress database back to it's defaults.  Deletes all customizations and content.  Does not modify files only resets the database.

This plugin is very helpful for plugin and theme developers.

If the admin user exists and has level_10 permissions it will be recreated with its current password and email address.  If the admin user does not exist or is a dummy account without admin permissions the username that is logged in will be recreated with its email address and current password.  The blog name is also kept.

The plugin will add an entry to the favorites drop down and also reactivate itself after the reset.  There is however a configuration option to keep it from reactivating after the reset.

Props to [Jonathan Dingman](http://www.ginside.com/) for the idea behind this plugin, testing and feedback.

== Installation ==

1. Upload the `wordpress-reset` folder to the `/wp-content/plugins/` directory or install directly through the plugin installer.
1. Activate the plugin through the 'Plugins' menu in WordPress or by using the link provided by the plugin installer

== Frequently Asked Questions ==

= How can I keep the plugin from automatically reactivating after the reset? =

Open the wordpress-reset.php file in an editor and modify the line that reads `var $auto_reactivate = true;` to be `var $auto_reactivate = false;`

== Upgrade ==

1. Use the plugin updater in WordPress or...
1. Delete the previous `wordpress-reset` folder from the `/wp-content/plugins/` directory
1. Upload the new `wordpress-reset` folder to the `/wp-content/plugins/` directory

== Usage ==

1. Visit the WordPress Reset Tools page by either clicking the link in the favorites dropdown menu or Tools>WordPress Reset
1. Type 'reset' in the text field and click reset.

== Upgrade Notice ==

This release fixes deprecated notices for WordPress 3.0, correctly disables the password nag and removes the randomly generate password from the new blog email.

== Changelog ==

= 1.2 (2010-04-04: =
* Updates to fix deprecated notices for WP 3.0
* Updates for 3.0 to disable password nag
* Modify new blog email to not include the generated password

= 1.1 (2009-10-01): =
* WordPress 2.8 Updates, do not show auto generated password nag after reset

= 1.0 (2009-03-17): =
* Initial Public Release
