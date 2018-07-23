<?php 
/**
 * @package WC Shipping Option by User Role
 */
 
 /**
  * Delete plugin settings on uninstall
  * 
  */
 
 if( !function_exists( 'sour_uninstall' ) ){
	 function sour_uninstall(){
		if( get_option( 'sour_settings' ) ){
			delete_option( 'sour_settings' );
		}
	}
}