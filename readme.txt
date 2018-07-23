=== WC Shipping Option by User Role ===
Contributors: deepintowp
Donate link: 
Tags: Woocommerce user based shipping, Shipping by user role, Woocommerce shipping
Requires at least: 4.0
Tested up to: 4.8
Stable tag: trunk
Requires PHP: 5.6
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Here is a short description of the plugin.  This should be no more than 150 characters.  No markup here.

== Description ==

WC Shipping Option by User Role gives site administrators the ability to control shipping option based on user role

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Go to Woocommerce > Shipping Option to manage settings


== Frequently Asked Questions ==

= Why isn’t shipping method not appearing in the plugin settings page? =

Verify that your shipping method is both installed and enabled. Disabled methods are not shown in the settings page.

= I have a shipping method enabled for a role, but when I checkout as that role, the shipping option is not available. =

Confirm that the shipping method  is available to the user when the extension is disabled. A shipping method still won’t appear at checkout if the method or gateway has used its own parameters to determine unavailability.
For example, a shipping method may not be available to customers entering certain billing information, or if products in the cart don’t have dimension or weight information available.

Additionally, the site Admin may have disabled certain shipping sub-methods. 


== Screenshots ==

1. Plugin's settings page view
2. Cart page view
3. Checkout Page View

== Changelog ==


== Upgrade Notice ==

