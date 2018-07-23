<?php 
/**
 * @package WC Shipping Option by User Role
 */
if(!class_exists('Sour_setting_page')){
	class Sour_setting_page{
		/**
		 * Add plugin Setting page under WooCommerce page
		 * @return  [Add page for plugin settings ]
		 */
		public function sour_create_setting_page(){
			add_submenu_page( 'woocommerce', __('Shipping Option By User', 'sour'), __('Shipping Option By User', 'sour'), 'manage_options', 'sour_setting', 'sour_setting_page_callback' );
		}
	}
}