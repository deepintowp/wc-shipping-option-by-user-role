<?php
/**
 * @package WC Shipping Option by User Role
 */

if( !class_exists( 'Sour_filter_shipping_methods' ) ){
	
	class Sour_filter_shipping_methods {
		
		
		/**
		 * [ Filter shipping methods based on plugin settings. ]
		 * @param  [array] $rates [ Avaliable shipping methods ]
		 * @return [array]        [ Shipping methods]
		 */
		public function sour_frontend_filter_shipping_methods($rates){
			
			//check plugin enable or not 
			if(!sour_if_enabled()){
				return $rates;
			}

			$current_user_roles = is_user_logged_in() ? wp_get_current_user()->roles : array('guest');
			
			//if current user has not any shipping method as per settings
			if(!sour_user_roles_methods($current_user_roles)){
				return;
			}

			//looping through avaliable rates
			
			foreach ( $rates as $rate_id => $rate ) {
				// if $rate_id not found in current user shipping methods as per settings then unset $rate_id
				if(!in_array($rate_id, sour_user_roles_methods($current_user_roles))){
					unset($rates[$rate_id]);
				}
			}
			
			return $rates;
		}
		
		
		/**
		 * [ Clear shipping rates cache from cart  ]
		 * @return  [Cleared shipping rates cache]
		 */
		
		public function sour_clear_wc_shipping_rates_cache(){
			$packages = WC()->cart->get_shipping_packages();

			foreach ($packages as $key => $value) {
				$shipping_session = "shipping_for_package_$key";

				//clear session
				unset(WC()->session->$shipping_session);
			}
		}

	}
}

