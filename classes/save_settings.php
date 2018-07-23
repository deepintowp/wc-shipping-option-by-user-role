<?php 
/**
 * @package WC Shipping Option by User Role
 */
if(!class_exists('Sour_save_settings')){
	class Sour_save_settings {
		public function sour_save_settings_fields(){
			
			
			/*
			*	Check current user capability for edit settings
			*/
			if(!current_user_can('manage_options')){
				wp_die('You are not allowed to edit this page.');
			}
			
			/*
			*	Verify nonce field
			*/
			check_admin_referer('sour_save_settings_fields_verify');
			
			$settings = array();
			
			
			//Enable input field value
			if(isset($_POST['enable_sour'])){
				if('yes' === $_POST['enable_sour'] ){
					$settings['enable_sour'] = 'yes';
				}
			}
			
			/*
			*	Validate input value
			*  ( only accept active Shipping methods id as input value )
			*	
			*	function reference: sour_get_active_shipping_methods() 
			*   To get all user role: sour_get_avaliable_users_roles()
			*/
			
			$avaliable_methods = sour_get_active_shipping_methods();
			
			$all_users_roles = sour_get_avaliable_users_roles();
			
			//get value from $_POST['user_role'] and chechk value exist on active shipping methods or not
			foreach($all_users_roles as $role_id => $role_name){
				if( isset( $_POST[$role_id] ) ){
					foreach( $_POST[$role_id] as $role_shipping ){
						//sanitize before matching
						$role_shipping = sanitize_text_field($role_shipping);
						if(!array_key_exists($role_shipping, $avaliable_methods) ){
							
							wp_redirect(get_admin_url().'admin.php?page=sour_setting&sour_save_error=true' );
							exit();
						}
					}
				$settings[$role_id] = $_POST[$role_id];
				}
			}
			
			//update settings
			update_option( 'sour_settings', $settings);
			
			wp_redirect(get_admin_url().'admin.php?page=sour_setting&sour_success=true' );
			exit();
			
		}
	}

}