=== WP Google Analytics ===
Contributors: aaroncampbell
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=paypal%40xavisys%2ecom&item_name=Google%20Analytics%20Plugin&no_shipping=0&no_note=1&tax=0&currency_code=USD&lc=US&bn=PP%2dDonationsBF&charset=UTF%2d8
Tags: analytics, google, google analytics
Requires at least: 1.5
Tested up to: 2.9
Stable tag: 1.2.4

Lets you use <a href="http://analytics.google.com">Google Analytics</a> to track your WordPress site statistics

== Description ==

Lets you use <a href="http://analytics.google.com">Google Analytics</a> to track
your WordPress site statistics.  It is easily configurable to:

* Not log anything in the admin area
* Log 404 errors as /404/{url}?referrer={referrer}
* Log searches as /search/{search}?referrer={referrer}
* Log outgoing links as /outgoing/{url}?referrer={referrer}
* Not log any user roles (administrators, editors, authors, etc)

== Installation ==

1. Upload the `wp-google-analytics.php` file to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Where do I put my Google Analytics Code? =

WP Google Analytics has a config page under the settings tab in the admin area
of your site.  You can paste your tracking code from Google into the textarea on
this page.

= Can't I just paste the Google Analytics code into my template file? =

Absolutely, however in order to get a better idea of what is going on with your
site, it is often nice to have your own activities ignored, track 404s, searches
and even where users go when they leave your site.  WP Google Analytics lets you
easily do all these things.


== Changelog ==

= 1.2.4 =
* Removed the optional anonymous statistics collection.  Nothing is ever collected anymore.
* Changed & to &amp; in some more places to fix validation problems.

= 1.2.3 =
* Changed & to &amp; to fix validation problems.

= 1.2.2 =
* Fixed problem with code affecting Admin Javascript such as the TinyMCE editor

= 1.2.1 =
* Bug fix for the stats gathering

= 1.2.0 =
* No longer parses outgoing links in the admin section.
* Uses get_footer instead of wp_footer.  Too many themes aren't adding the wp_footer call.
* Options page updated
* Added optional anonymous statistics collection

= 1.1.0 =
* Major revamp to work better with the new Google Tracking Code.  It seems that outgoing links weren't being tracked properly.

= 1.0.0 =
* Added to wordpress.org repository

= 0.2 =
* Fixed problem with themes that do not call wp_footer().  If you are reading this and you are a theme developer, USE THE HOOKS!  That's what they're there for!
* Updated how the admin section is handled

= 0.1 =
* Original Version
