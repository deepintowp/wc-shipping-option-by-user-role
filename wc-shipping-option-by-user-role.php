<?php
/**
 * @package WC Shipping Option by User Role
 */
/*
Plugin Name: WC Shipping Option by User Role
Plugin URI: https://github.com/deepintowp/wc-shipping-option-by-user-role
Description:  This plugin provides an interface for role-based control over WooCommerce payment and shipping methods.
Version: 1.0.0
Author: Subhasish Manna
Author URI: http://subhasishmanna.com
License: GPLv2 or later
Text Domain: sour
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}
/*****************************************
CHECK WORDPRESS WERSION
*****************************************/
if ( version_compare( get_bloginfo('version'), '4.5', '<') )  {
    $message = "WordPress version is lower than 4.5.Need WordPress version 4.5 or higher.";
	die($message);
}

/*********
constants
**********/
define( 'SOUR_PATH', plugin_dir_path(__FILE__)   );
define( 'SOUR_URI', plugin_dir_url( __FILE__ )   );

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    if(!class_exists( 'Sour_core' )){
    	class Sour_core{
    		public function __construct(){
    			/**
    			 * Include Files
    			 */
				 require(SOUR_PATH.'/includes/activation.php');
				 require(SOUR_PATH.'/includes/uninstall.php');
				 require(SOUR_PATH.'/includes/functions.php');
				
				
				/**
    			 * Include Classes
    			 */
				require(SOUR_PATH.'/classes/sour_setting_page.php');
    			require(SOUR_PATH.'/classes/save_settings.php');
    			require(SOUR_PATH.'/classes/filter_methods.php');
    			


    			/**
    			 * HOOKS 
    			 */
				
				register_activation_hook( __FILE__, 'sour_activation' );
				register_uninstall_hook( __FILE__, 'sour_uninstall' );
    			add_action( 'admin_menu', array( new Sour_setting_page() , 'sour_create_setting_page'));
				add_action( 'admin_post_sour_save_settings_fields', array( new Sour_save_settings() , 'sour_save_settings_fields') );
				add_filter( 'woocommerce_package_rates', array(new Sour_filter_shipping_methods(), 'sour_frontend_filter_shipping_methods'), 150 );
				add_filter('woocommerce_checkout_update_order_review', array(new Sour_filter_shipping_methods(), 'sour_clear_wc_shipping_rates_cache'));
				add_action('woocommerce_after_cart', array(new Sour_filter_shipping_methods(), 'sour_clear_wc_shipping_rates_cache'));

    		}
    	}
    	$sour_init = new Sour_core();
    }
}


