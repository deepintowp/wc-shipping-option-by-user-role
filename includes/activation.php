<?php 
/**
 * @package WC Shipping Option by User Role
 */
if(!function_exists('sour_activation')){

	/**
	 * Add option (empty array ) for plugin settings if any setting not avaliable
	 * @return Added option with sour_settings option name
	 */
	function sour_activation (){
		if(!get_option( 'sour_settings' )){

				add_option( 'sour_settings', array());

		}
		
	}
}