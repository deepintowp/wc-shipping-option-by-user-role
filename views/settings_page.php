<?php 
/**
 * @package WC Shipping Option by User Role
 */
?>

<div id="wpbody" role="main">
		<style>
		table, th, td {
			border: 1px solid black;
		}
		th{
			text-align:left;
			background:#0073aa;
			color:#fff;
		}
		th, td {
			padding: 5px;
		}
		</style>
	<div id="wpbody-content" aria-label="Main content" tabindex="0">
		<div class="wrap">
			<h1><?php _e('Role Based Shipping Methods', 'sour'); ?></h1>
					<?php 
						if(isset($_GET['sour_save_error'])){
							echo '<div style="background: #ff000061; padding: 11px 5px; border-radius: 6px; font-size: 15px;" class="sour_validation_msg">Invalid input value.</div>';
						}
						if(isset($_GET['sour_success'])){
							echo '<div style="background:#00800063; padding: 11px 5px; border-radius: 6px; font-size: 15px;" class="sour_validation_msg">Settings Saved.</div>';
						}
						
						if(count(sour_get_active_shipping_methods()) > 0 ){ 
					?>	
						<form method="post" action="admin-post.php">
							
							<input type="hidden" name="action" value="sour_save_settings_fields" />
							
							<?php wp_nonce_field('sour_save_settings_fields_verify'); ?>
							
							<p style="margin:30px 0;">
								<label style="font-size: 16px; font-weight: 500; padding-right: 50px;" for="enable_sour"><?php _e('Enable', 'sour'); ?></label>
								<?php $checked = ( sour_if_enabled()  == true ) ? 'checked' : '';  ?>
								<input <?php echo $checked;  ?> id="enable_sour" name="enable_sour" type="checkbox" value="yes" />
							</p>
							
							<table style="width:100%; margin-bottom:10px;">
							  <tr>
								<th><?php _e('User Roles', 'sour'); ?></th>
								<?php
									
									foreach(sour_get_active_shipping_methods() as $id => $shipping_methods_title ){
										echo '<th>'.$shipping_methods_title.'</th>';
									}
								?>
							  </tr>
							  
								<?php foreach(sour_get_avaliable_users_roles() as $role_id => $role_name){
									echo '<tr>';
									echo '<td>'.$role_name.'</td>';
										foreach(sour_get_active_shipping_methods() as $id => $shipping_methods_title ){
											$checked = ( sour_if_this_user_role_has_this_shipping_methods($role_id, $id )  == true ) ? 'checked' : '';
											echo '<td><input  '.$checked.' type="checkbox" name="'.$role_id.'[]" value="'.$id.'" /></td>';
										}
									echo '</tr>';
								 }?>
									
							</table>
							<button name="save" class="button-primary" type="submit" value="<?php _e('Save Changes', 'sour'); ?>">Save changes</button>
						</form>
					<?php }else{ ?>
						<h3><?php _e('No active shipping method found', 'sour'); ?></h3>
					<?php } ?>
		</div>
	</div>
</div>
