<?php 
/**
 * @package WC Shipping Option by User Role
 */
/**
 * [sour_setting_page_callback description]
 * @return [type] [description]
 */
if( !function_exists( 'sour_setting_page_callback' ) ){
	/**
	 *  Callback function ( add_submenu_page ) for plugin settings page.
	 * Use: To add plugin settings page's view template
	 */
	function sour_setting_page_callback(){
		require(SOUR_PATH.'/views/settings_page.php');
	}

}

/**
 * Use: to get all avaliable of all zones if found any woocommerce shipping settings
 * @return [array]
 */
if( !function_exists( 'sour_get_active_shipping_methods' ) ){
	function sour_get_active_shipping_methods() {
		$zones = array();

		// Rest of the World zone
		$zone                                              = new \WC_Shipping_Zone(0);
		$zones[$zone->get_id()]                            = $zone->get_data();
		$zones[$zone->get_id()]['formatted_zone_location'] = $zone->get_formatted_location();
		$zones[$zone->get_id()]['shipping_methods']        = $zone->get_shipping_methods();

		// Merging shipping zones
		$shipping_zones = array_merge( $zones, WC_Shipping_Zones::get_zones() );
		$active_shipping_methods = array();
		foreach ( $shipping_zones as $shipping_zone ) {
			
			global $woocommerce;
			
			if ( version_compare( $woocommerce->version, '3.0', ">=" ) ) {
				$zone_id = $shipping_zone['id'];
			}else{
				
				$zone_id = $shipping_zone['zone_id'];
			}
		    
			$zone_name = $zone_id == '0' ? __('Rest of the word', 'woocommerce') : $shipping_zone['zone_name'];
		    $zone_locations = $shipping_zone['zone_locations']; // (It's an array)
		    $zone_location_name = $shipping_zone['formatted_zone_location'];
		    $zone_shipping_methods = $shipping_zone['shipping_methods'];

		    foreach ( $zone_shipping_methods as $shipping_method_obj ) {
		        $rate_id = $shipping_method_obj->get_rate_id();
				if( 'yes' === $shipping_method_obj->enabled ){
				$active_shipping_methods[$rate_id] = $shipping_method_obj->get_title();
				}
		        
		    }
		}

		return $active_shipping_methods;
	}
}

/**
 * Use: to get all  avaliable users roles in array
 * @return [array] [avaliable users roles]
 */
if( !function_exists( 'sour_get_avaliable_users_roles' ) ){
	function sour_get_avaliable_users_roles(){
		$roles_array = wp_roles()->roles;
		$roles = array();
		foreach($roles_array as $role_id => $role_array){
			$roles[$role_id] = $role_array['name']; 
		}
		$roles['guest'] = 'Guest (Not logged in user)';
		return $roles;
	}
}

/**
 * Use: check user has shipping method as plugin setting with given shipping id
 * @param  [string] $user_role       [user role (example: Customer) ]
 * @param  [string] $shipping_method [shipping method id (example: flat_rate:2 ) ]
 * @return [boolean] 
 */
if( !function_exists( 'sour_if_this_user_role_has_this_shipping_methods' ) ){
	function sour_if_this_user_role_has_this_shipping_methods($user_role, $shipping_method){
		$settings = get_option( 'sour_settings' );
		if($settings){
			if(count($settings) > 0 ){
				if(isset($settings[$user_role])){
					if(in_array( $shipping_method, $settings[$user_role])){
						return true;
					}
				}
			}
		}
		return false;
	}
}

/**
 * Use: To check plugin enable or not as per plugin settings
 * @return [boolean] 
 */
if( !function_exists( 'sour_if_enabled' ) ){
	function sour_if_enabled(){
		$settings = get_option( 'sour_settings' );
		if($settings){
			if(count($settings) > 0 ){
				if(isset($settings['enable_sour'])){
					if(in_array( 'yes', $settings)){
						return true;
					}
				}
			}
		}
		return false;
	}
}

/**
 * Use: To get shipping methods as per setting by given user role
 * @param  [string] $user_roles [user role (example: Customer) ]
 * @return [array]
 */
if( !function_exists( 'sour_user_roles_methods' ) ){
	function sour_user_roles_methods($user_roles){
		$settings = get_option( 'sour_settings' );
		if( $settings ){
			if(count($settings) > 0 ){
				$methods = array();
				foreach($user_roles as $user_role){
					if(isset($settings[$user_role])){
						foreach($settings[$user_role] as $method){
							if(!in_array( $method, $methods)){
								$methods[] = $method;
							}
						}
					}
				}
				if(count($methods) > 0 ){
					return $methods;
				}
			}
		}
		return false;
	}
}

