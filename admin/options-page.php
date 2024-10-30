<h1><?php _e( 'Heateor Login', 'heateor-login' ) ?></h1>
<div id="fb-root"></div>
	<div>
		<?php
		echo sprintf( __( 'You can appreciate the effort put in this free plugin by rating it <a href="%s" target="_blank">here</a>', 'heateor-login' ), 'https://wordpress.org/support/view/plugin-reviews/heateor-login' );
		?>
	</div>

	<div class="metabox-holder">
	<form action="options.php" method="post">
	<?php settings_fields( 'heateor_fbl_options' ); ?>
	<div class="menu_div" id="tabs">
		<h2 class="nav-tab-wrapper" style="height:34px">
			<ul>
				<li style="margin-left:9px"><a style="margin:0; line-height:auto !important; height:23px" class="nav-tab" href="#tabs-1"><?php _e( 'Basic Configuration', 'heateor-login' ) ?></a></li>
				<li style="margin-left:9px"><a style="margin:0; line-height:auto !important; height:23px" class="nav-tab" href="#tabs-2"><?php _e( 'GDPR' , 'heateor-login' ) ?></a></li>
				<li style="margin-left:9px"><a style="margin:0; height:23px" class="nav-tab" href="#tabs-3"><?php _e( 'Shortcode & Widget', 'heateor-login' ) ?></a></li>
				<li style="margin-left:9px"><a style="margin:0; height:23px" class="nav-tab" href="#tabs-4"><?php _e( 'FAQ', 'heateor-login' ) ?></a></li>
			</ul>
		</h2>

		<div class="menu_containt_div" id="tabs-1">
			<div class="heateor_fbl_clear"></div>
			<div class="heateor_fbl_left_column">
				<div class="stuffbox">
					<h3 class="hndle"><label><?php _e( 'Basic Configuration', 'heateor-login' );?></label></h3>
					<div class="inside">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="form-table editcomment menu_content_table">
							<tr>
								<td colspan="2"><a href="https://www.heateor.com/social-login-buttons" target="_blank" style="text-decoration:none"><input style="width: auto;padding: 10px 42px;" type="button" value="<?php _e( 'Customize Facebook Login Icon', 'heateor-login' ); ?> >>>" class="heateor_fbl_demo"></a></td>
							</tr>
							<tr>
								<th>
								<label for="heateor_fbl_sl_disable_reg"><?php _e( "Disable user registration via Facebook Login", 'heateor-login' ); ?></label><img id="heateor_fbl_sl_disable_reg_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />

								</th>
								<td>
								<input id="heateor_fbl_sl_disable_reg" name="heateor_fbl[disable_reg]" onclick="if ( this.checked ) {jQuery( '#heateor_fbl_disable_reg_options' ).css( 'display', 'table-row-group' ) } else { jQuery( '#heateor_fbl_disable_reg_options' ).css ( 'display', 'none' ) }" type="checkbox" <?php echo isset( $heateor_fbl_options['disable_reg'] ) ? 'checked = "checked"' : '';?> value="1" />
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_sl_disable_reg_help_cont">
								<td colspan="2">
								<div>
								<?php _e( 'After enabling this option, new users will not be able to login through Facebook Login. Only existing users will be able to Facebook Login.', 'heateor-login' ) ?>
								</div>
								</td>
							</tr>

							<tbody id="heateor_fbl_disable_reg_options" <?php echo ! isset( $heateor_fbl_options['disable_reg'] ) ? 'style = "display: none"' : '';?> >
								<tr>
									<th>
									<label for="heateor_fbl_disable_reg_redirect"><?php _e( "Redirection url", 'heateor-login' ); ?></label>
									<img id="heateor_fbl_disable_reg_redirect_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
									</th>
									<td>
									<input id="heateor_fbl_disable_reg_redirect" name="heateor_fbl[disable_reg_redirect]" type="text" value="<?php echo isset( $heateor_fbl_options['disable_reg_redirect'] ) ? $heateor_fbl_options['disable_reg_redirect'] : '' ?>" />
									</td>
								</tr>
								
								<tr class="heateor_fbl_help_content" id="heateor_fbl_disable_reg_redirect_help_cont">
									<td colspan="2">
									<div>
									<?php _e( 'User will be redirected to this page after unsuccessful registration attempt via Facebook Login. You can specify the url of registration form or of a page showing message regarding disabled registration through Facebook Login.', 'heateor-login' ); ?>
									</div>
									</td>
								</tr>
							</tbody>
							<tr>
								<th>
									<label for="heateor_fbl_fb_app_id"><?php _e( "Facebook App ID", 'heateor-login' ); ?></label>
									<img id="heateor_fbl_fb_app_id_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td>
									<input id="heateor_fbl_fb_app_id" type="text" name="heateor_fbl[facebook_app_id]" value="<?php echo $heateor_fbl_options['facebook_app_id']?>">
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_fb_app_id_help_cont">
								<td colspan="2">
								<div>
								<?php echo sprintf( __( 'Required for Facebook Login to work. Please follow the documentation at <a href="%s" target="_blank">this link</a> to get Facebook App ID', 'heateor-login' ), 'http://support.heateor.com/how-to-get-facebook-app-id/' ) ?>
								</div>
								</td>
							</tr>

							<tr>
								<th>
								<label for="heateor_fbl_fb_app_sec"><?php _e( "Facebook App Secret", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_fb_app_sec_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td>
								<input id="heateor_fbl_fb_app_sec" type="text" name="heateor_fbl[facebook_app_secret]" value="<?php echo $heateor_fbl_options['facebook_app_secret']?>">
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_fb_app_sec_help_cont">
								<td colspan="2">
								<div>
								<?php echo sprintf( __( 'Required for Facebook Login to work. Please follow the documentation at <a href="%s" target="_blank">this link</a> to get Facebook App Secret', 'heateor-login' ), 'http://support.heateor.com/how-to-get-facebook-app-id/' ) ?>
								</div>
								</td>
							</tr>

							<tr>
								<th>
								
								<label for="heateor_fbl_fb_title"><?php _e( "Title", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_fb_title_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td>
								<input id="heateor_fbl_fb_title" type="text" name="heateor_fbl[facebook_title]" value="<?php echo $heateor_fbl_options['facebook_title']?>">
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_fb_title_help_cont">
								<td colspan="2">
								<div>
								<?php _e( 'Text to display above the Facebook Login icon', 'heateor-login' ) ?>
								</div>

								</td>
							</tr>

							<tr>
								<th>
								
								<label for="heateor_fbl_same"><?php _e( "Trigger Facebook Login in the same browser tab", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_same_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td>
								<input id="heateor_fbl_same" type='checkbox' name='heateor_fbl[same_window]' value='1' <?php if ( isset( $heateor_fbl_options['same_window'] ) ) {echo 'checked'; } ?>>
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_same_help_cont">
								<td colspan="2">
								<div>
								<?php _e( 'Trigger Facebook Login in the same browser tab instead of a popup window', 'heateor-login' ) ?>
								</div>
								</td>
							</tr>

							<tr>
								<th>
							
								<label for="heateor_fbl_fb_app_sec"><?php _e( "Center align", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_center_align_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td>
								<input id="heateor_fbl_center_align" type="checkbox" name="heateor_fbl[center_align]" value='1'<?php if ( isset( $heateor_fbl_options['center_align'] ) ) { echo 'checked'; } ?>>
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_center_align_help_cont">
								<td colspan="2">
								<div>
								<?php _e( 'Center align Facebook Login icon', 'heateor-login' ) ?>
								</div>
								</td>
							</tr>

							<tr>
								<th>
								<label for="heateor_fbl_page"><?php _e( "Enable at login page", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_page_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td>
								<input id="heateor_fbl_page" type="checkbox" name="heateor_fbl[login_enable]" value='1'<?php if ( isset( $heateor_fbl_options['login_enable'] ) ) { echo 'checked'; } ?>>
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_page_help_cont">
								<td colspan="2">
								<div>
								<?php _e( 'Integrate Facebook Login at the login page of your website', 'heateor-login' ) ?>
								</div>
								</td>
							</tr>

							<tr>
								<th>
								<label for="heateor_fbl_register_page"><?php _e( "Enable at register page", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_register_page_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td>
								<input id="heateor_fbl_register_page"  type="checkbox" name="heateor_fbl[register_enable]" value='1'<?php if ( isset( $heateor_fbl_options['register_enable'] ) ) { echo 'checked'; } ?>>
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_register_page_help_cont">
								<td colspan="2">
								<div>
								<?php _e( 'Integrate Facebook Login at registration page of your website', 'heateor-login' ) ?>
								</div>
								</td>
							</tr>

							<tr>
								<th>
								<label for="heateor_fbl_enable_cmnt"><?php _e( "Enable at comment form", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_enable_cmnt_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td>
								<input id="heateor_fbl_enable_cmnt"  type="checkbox" name="heateor_fbl[enable_in_comment]" value='1'<?php if ( isset( $heateor_fbl_options['enable_in_comment'] ) ) { echo 'checked'; } ?>>
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_enable_cmnt_help_cont">
								<td colspan="2">
								<div>
								<?php _e( 'Integrate Facebook Login interface at comment form', 'heateor-login' ) ?>
								</div>
								</td>
							</tr>

							<?php
							/**
							 * Check if WooCommerce is active
							 **/
							if ( heateor_fbl_is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
							    ?>
							    <tr>
									<th>
									<label for="heateor_fbl_sl_wc_before_form"><?php _e( "Enable before WooCommerce Customer Login Form", 'heateor-login' ); ?><img id="heateor_fbl_sl_wc_before_form_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" /></label>
									</th>
									<td>
									<input id="heateor_fbl_sl_wc_before_form" name="heateor_fbl[enable_before_wc]" type="checkbox" <?php echo isset( $heateor_fbl_options['enable_before_wc'] ) ? 'checked = "checked"' : '';?> value="1" />
									</td>
								</tr>
								
								<tr class="heateor_fbl_help_content" id="heateor_fbl_sl_wc_before_form_help_cont">
									<td colspan="2">
									<div>
									<?php _e( 'Integrate Facebook Login button before customer login form at WooCommerce My Account page', 'heateor-login' ) ?>
									</div>
									</td>
								</tr>

								<tr>
									<th>
									<label for="heateor_fbl_sl_wc_after_form"><?php _e( "Enable at WooCommerce Customer Login Form", 'heateor-login' ); ?><img id="heateor_fbl_sl_wc_after_form_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" /></label>
									</th>
									<td>
									<input id="heateor_fbl_sl_wc_after_form" name="heateor_fbl[enable_after_wc]" type="checkbox" <?php echo isset( $heateor_fbl_options['enable_after_wc'] ) ? 'checked = "checked"' : '';?> value="1" />
									</td>
								</tr>
								
								<tr class="heateor_fbl_help_content" id="heateor_fbl_sl_wc_after_form_help_cont">
									<td colspan="2">
									<div>
									<?php _e( 'Integrate Facebook Login button with customer login form at WooCommerce My Account page', 'heateor-login' ) ?>
									</div>
									</td>
								</tr>

								<tr>
									<th>
									<label for="heateor_fbl_sl_wc_register_form"><?php _e( "Enable at WooCommerce Customer Register Form", 'heateor-login' ); ?><img id="heateor_fbl_sl_wc_register_form_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" /></label>
									</th>
									<td>
									<input id="heateor_fbl_sl_wc_register_form" name="heateor_fbl[enable_register_wc]" type="checkbox" <?php echo isset( $heateor_fbl_options['enable_register_wc'] ) ? 'checked = "checked"' : '';?> value="1" />
									</td>
								</tr>
								
								<tr class="heateor_fbl_help_content" id="heateor_fbl_sl_wc_register_form_help_cont">
									<td colspan="2">
									<div>
									<?php _e( 'Integrate Facebook Login button with customer register form at WooCommerce My Account page', 'heateor-login' ) ?>
									</div>
									</td>
								</tr>

								<tr>
									<th>
									<label for="heateor_fbl_sl_wc_checkout"><?php _e( "Enable at WooCommerce checkout page", 'heateor-login' ); ?><img id="heateor_fbl_sl_wc_checkout_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" /></label>
									</th>
									<td>
									<input id="heateor_fbl_sl_wc_checkout" name="heateor_fbl[enable_wc_checkout]" type="checkbox" <?php echo isset( $heateor_fbl_options['enable_wc_checkout'] ) ? 'checked = "checked"' : '';?> value="1" />
									</td>
								</tr>
								
								<tr class="heateor_fbl_help_content" id="heateor_fbl_sl_wc_checkout_help_cont">
									<td colspan="2">
									<div>
									<?php _e( 'Integrate Facebook Login button with WooCommerce checkout page', 'heateor-login' ) ?>
									</div>
									</td>
								</tr>
							    <?php
							}
							?>

							<tr>
								<th>
								<label for="heateor_fbl_social_avatar"><?php _e( "Enable social avatar", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_social_avatar_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td>
								<input id="heateor_fbl_social_avatar" type="checkbox" name="heateor_fbl[social_avatar]" value='1'<?php if ( isset( $heateor_fbl_options['social_avatar'] ) ) { echo 'checked'; } ?>>
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_social_avatar_help_cont">
								<td colspan="2">
								<div>
								<?php _e( 'Social profile picture of the logged in user will be displayed as profile avatar', 'heateor-login' ) ?>
								</div>
								</td>
							</tr>

							<tr>
								<th>
								<label for="heateor_fbl_avatar_quality"><?php _e( "Avatar quality", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_avatar_quality_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td>
								<input id="heateor_fbl_average_avatar" name="heateor_fbl[avatar_quality]" type="radio" <?php echo ! isset( $heateor_fbl_options['avatar_quality'] ) || $heateor_fbl_options['avatar_quality'] == 'average' ? 'checked' : '';?> value="average" /> <label for="heateor_fbl_average_avatar"><?php _e( "Average", 'heateor-login' ); ?></label><br/>
								
								<input id="heateor_fbl_best_avatar" name="heateor_fbl[avatar_quality]" type="radio" <?php echo isset( $heateor_fbl_options['avatar_quality'] ) && $heateor_fbl_options['avatar_quality'] == 'best' ? 'checked' : '';?> value="best" /> <label for="heateor_fbl_best_avatar"><?php _e( "Best", 'heateor-login' ); ?></label>
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_avatar_quality_help_cont">
								<td colspan="2">
								<div>
								<?php _e( 'Choose avatar quality', 'heateor-login' ) ?>
								</div>
								</td>
							</tr>

							<tr>
								<th>
								<label for="heateor_fbl_email_required"><?php _e( "E-mail required", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_email_required_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td>
								<input id="heateor_fbl_email_required" type="checkbox" name="heateor_fbl[E-mail]" value='1'<?php if ( isset( $heateor_fbl_options['E-mail'] ) ) { echo 'checked'; } ?>>
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_email_required_help_cont">
								<td colspan="2">
								<div>
								<?php _e( 'If enabled and Social ID provider does not provide users email address on login, user will be asked to provide his/her email address. Otherwise, a dummy email will be generated', 'heateor-login' ) ?>
								</div>
								<img src="<?php echo plugins_url( '../images/snaps/sl_email_required.png', __FILE__ ); ?>" />
								</td>
							</tr>

							<tr>
								<th>
								<label for="heateor_fbl_email_req_popup"><?php _e( "Text on 'Email required' popup", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_email_req_popup_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td>
									<textarea rows="5" cols="40" id="heateor_fbl_email_req_popup" name="heateor_fbl[email_popup_text]"><?php echo isset( $heateor_fbl_options['email_popup_text'] ) ? $heateor_fbl_options['email_popup_text'] : '' ?></textarea>
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_email_req_popup_help_cont">
								<td colspan="2">
								<div>
								<?php _e( 'This text will be displayed on email required popup. Leave empty if not required.', 'heateor-login' ) ?>
								</div>
								</td>
							</tr>

							<tr>
								<th>
								<label for="heateor_fbl_email_to_user"><?php _e( "Send post-registration email to user to set account password", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_email_to_user_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td>
								<input id="heateor_fbl_email_to_user" type="checkbox" name="heateor_fbl[send_reg_email_acc_pass]" value='1'<?php if ( isset( $heateor_fbl_options['send_reg_email_acc_pass'] ) ) { echo 'checked'; } ?>>
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_email_to_user_help_cont">
								<td colspan="2">
								<div>
								<?php _e( 'If enabled, an email will be sent to user after registration through Facebook Login, regarding his/her login credentials (username-password to be able to login via traditional login form)', 'heateor-login' ) ?>
								</div>
								</td>
							</tr>

							<tr>
								<th>
								<label for="heateor_fbl_email_to_admin"><?php _e( "Send new user registration notification email to admin", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_email_to_admin_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td>
								<input id="heateor_fbl_email_to_admin" type="checkbox" name="heateor_fbl[send_noti_email_admin]" value='1'<?php if ( isset( $heateor_fbl_options['send_noti_email_admin'] ) ) { echo 'checked'; } ?>>
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_email_to_admin_help_cont">
								<td colspan="2">
								<div>
								<?php _e( 'If enabled, an email will be sent to admin after new user registers through Facebook Login, notifying admin about the new user registration', 'heateor-login' ) ?>
								</div>
								</td>
							</tr>

							<tr>
								<th>
								<label for="heateor_fbl_redirec"><?php _e( "Login redirection", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_redirect_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td id="heateor_fbl_login_redirection_column">
									<input id="heateor_fbl_same_page" name="heateor_fbl[login_redirect]" type="radio" <?php echo ! isset( $heateor_fbl_options['login_redirect'] ) || $heateor_fbl_options['login_redirect'] == 'same' ? 'checked = "checked"' : '';?> value="same" /> <label for="heateor_fbl_same_page"><?php _e( "Same page from where user logged in", 'heateor-login' ); ?></label><br/>
									<input id="heateor_fbl_home_page" name="heateor_fbl[login_redirect]" type="radio" <?php echo isset( $heateor_fbl_options['login_redirect'] ) && $heateor_fbl_options['login_redirect'] == 'homepage' ? 'checked = "checked"' : '';?> value="homepage" /> <label for="heateor_fbl_home_page"><?php _e( "Homepage", 'heateor-login' ); ?></label><br/>
									<input id="heateor_fbl_account_page" name="heateor_fbl[login_redirect]" type="radio" <?php echo isset( $heateor_fbl_options['login_redirect'] ) && $heateor_fbl_options['login_redirect'] == 'dashboard' ? 'checked = "checked"' : '';?> value="dashboard" /> <label for="heateor_fbl_account_page"><?php _e( "Account dashboard", 'heateor-login' ); ?></label><br/>
									<input id="heateor_fbl_login_redirection_custom" name="heateor_fbl[login_redirect]" type="radio" <?php echo isset( $heateor_fbl_options['login_redirect'] ) && $heateor_fbl_options['login_redirect'] == 'custom' ? 'checked = "checked"' : '';?> value="custom" /> <label for="heateor_fbl_login_redirection_custom"><?php _e( "Custom Url", 'heateor-login' ); ?></label><br/>
									<input type="text" id="heateor_fbl_login_redirection_url" name="heateor_fbl[login_redirect_custom]" value="<?php echo $heateor_fbl_options['login_redirect_custom']?>">
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_redirect_help_cont">
								<td colspan="2">
								<div>
								<?php _e( 'User will be redirected to the selected page after Facebook Login', 'heateor-login' ) ?>
								</div>
								</td>
							</tr>

							<tr>
								<th>
								<label for="heateor_fbl_register_redirect"><?php _e( "Registration redirection", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_register_redirect_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td id="heateor_fbl_register_redirection_column">
									<input id="heateor_fbl_reg_same_page" name="heateor_fbl[register_redirect]" type="radio" <?php echo ! isset( $heateor_fbl_options['register_redirect'] ) || $heateor_fbl_options['register_redirect'] == 'same' ? 'checked = "checked"' : '';?> value="same" /> <label for="heateor_fbl_reg_same_page"><?php _e( "Same page from where user registered", 'heateor-login' ); ?></label><br/>

									<input id="heateor_fbl_reg_home_page" name="heateor_fbl[register_redirect]" type="radio" <?php echo isset( $heateor_fbl_options['register_redirect'] ) && $heateor_fbl_options['register_redirect'] == 'homepage' ? 'checked = "checked"' : '';?> value="homepage" /> <label for="heateor_fbl_reg_home_page"><?php _e( "Homepage", 'heateor-login' ); ?></label><br/>

									<input id="heateor_fbl_reg_account_page" name="heateor_fbl[register_redirect]" type="radio" <?php echo isset( $heateor_fbl_options['register_redirect'] ) && $heateor_fbl_options['register_redirect'] == 'dashboard' ? 'checked = "checked"' : '';?> value="dashboard" /> <label for="heateor_fbl_reg_account_page"><?php _e( "Account dashboard", 'heateor-login' ); ?></label><br/>

									<input id="heateor_fbl_register_redirection_custom" name="heateor_fbl[register_redirect]" type="radio" <?php echo isset( $heateor_fbl_options['register_redirect'] ) && $heateor_fbl_options['register_redirect'] == 'custom' ? 'checked = "checked"' : '';?> value="custom" /> <label for="heateor_fbl_register_redirection_custom"><?php _e( "Custom Url", 'heateor-login' ); ?></label><br/>
									<input type="text" id="heateor_fbl_register_redirection_url" name="heateor_fbl[register_redirect_custom]" value="<?php echo $heateor_fbl_options['register_redirect_custom']?>">
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_register_redirect_help_cont">
								<td colspan="2">
								<div>
								<?php _e( 'User will be redirected to the selected page after registration (first Facebook Login) through Facebook Login', 'heateor-login' ) ?>
								</div>
								</td>
							</tr>

							<tr>
								<th>
								<label for="heateor_fbl_custom_css"><?php _e( "Custom CSS", 'heateor-login' ); ?></label><img id="heateor_fbl_custom_css_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td>
								<textarea rows="7" cols="63" id="heateor_fbl_custom_css" name="heateor_fbl[custom_css]"><?php echo isset( $heateor_fbl_options['custom_css'] ) ? $heateor_fbl_options['custom_css'] : '' ?></textarea>
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_custom_css_help_cont">
								<td colspan="2">
								<div>
								<?php _e('You can specify any additional CSS rules (without &lt;style&gt; tag)', 'heateor-login' ) ?>
								</div>
								</td>
							</tr>

							<tr>
								<th>
								<label for="heateor_fbl_delete_options"><?php _e( "Delete all the options on plugin deletion", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_delete_options_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
								</th>
								<td>
								<input id="heateor_fbl_delete_options" name="heateor_fbl[delete_options]" type="checkbox" <?php echo isset( $heateor_fbl_options['delete_options'] ) ? 'checked = "checked"' : '';?> value="1" />
								</td>
							</tr>
							
							<tr class="heateor_fbl_help_content" id="heateor_fbl_delete_options_help_cont">
								<td colspan="2">
								<div>
								<?php _e( 'If enabled, plugin options will get deleted when plugin is deleted/uninstalled and you will need to reconfigure the options when you install the plugin next time.', 'heateor-login' ) ?>
								</div>
								</td>
							</tr>
						</table>
						<input style="margin-left:8px; margin-top: 15px; margin-bottom: 15px;" type="submit" name="save" class="button button-primary" value="<?php _e( 'Save Changes', 'heateor-login' ) ?>" />
						<div style="margin-left:8px;">
						<?php echo sprintf( __( 'You can appreciate the effort put in this free plugin by rating it <a href="%s" target="_blank">here</a>', 'heateor-login' ), 'https://wordpress.org/support/view/plugin-reviews/heateor-login' ); ?>
						</div>
					</div>
				</div>
			</div>
		</form>
		<?php include 'help.php'; ?>
		</div>

		<div class="menu_containt_div" id="tabs-2">
		<div class="clear"></div>
			<div class="heateor_fbl_left_column">
			<div class="stuffbox">
				<h3><label><?php _e( 'GDPR', 'heateor-login' );?></label></h3>
				<div class="inside">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="form-table editcomment menu_content_table">
					<tr>
						<th>
						<label for="heateor_fbl_gdpr_enable"><?php _e( "Enable GDPR opt-in", 'heateor-login' ); ?></label>
						<img id="heateor_fbl_gdpr_enable_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
						</th>
						<td>
						<input id="heateor_fbl_gdpr_enable" name="heateor_fbl[gdpr_enable]" type="checkbox" <?php echo isset( $heateor_fbl_options['gdpr_enable'] ) ? 'checked = "checked"' : '';?> value="1" />
						</td>
					</tr>
					
					<tr class="heateor_fbl_help_content" id="heateor_fbl_gdpr_enable_help_cont">
						<td colspan="2">
						<div>
						<?php _e( 'Enable it to show GDPR opt-in for Facebook Login and social account linking', 'heateor-login' ) ?>
						</div>
						</td>
					</tr>

					<tbody id="heateor_fbl_gdpr_options" <?php echo ! isset( $heateor_fbl_options['gdpr_enable'] ) ? 'style = "display: none"' : '';?> >
						<tr> 
							<th>
							<label for="heateor_fbl_gdpr_placement_above"><?php _e( "Placement of GDPR opt-in", 'heateor-login' ); ?></label>
							<img id="heateor_fbl_gdpr_placement_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
							</th>
							<td>
							<input id="heateor_fbl_gdpr_placement_above" name="heateor_fbl[gdpr_placement]" type="radio" <?php echo ! isset( $heateor_fbl_options['gdpr_placement'] ) || $heateor_fbl_options['gdpr_placement'] == 'above' ? 'checked = "checked"' : '';?> value="above" />
							<label for="heateor_fbl_gdpr_placement_above"><?php _e( 'Above Facebook Login icon', 'heateor-login' ) ?></label><br/>
							<input id="heateor_fbl_gdpr_placement_below" name="heateor_fbl[gdpr_placement]" type="radio" <?php echo $heateor_fbl_options['gdpr_placement'] == 'below' ? 'checked = "checked"' : '';?> value="below" />
							<label for="heateor_fbl_gdpr_placement_below"><?php _e( 'Below Facebook Login icon', 'heateor-login' ) ?></label>
							</td>
						</tr>
						<tr class="heateor_fbl_help_content" id="heateor_fbl_gdpr_placement_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Placement of GDPR opt-in above or below the Facebook Login icon', 'heateor-login' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<label for="heateor_fbl_privacy_policy_optin_text"><?php _e( "Opt-in text", 'heateor-login' ); ?></label>
							<img id="heateor_fbl_privacy_policy_optin_text_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
							</th>
							<td>
							<textarea rows="7" cols="63" id="heateor_fbl_privacy_policy_optin_text" name="heateor_fbl[privacy_policy_optin_text]"><?php echo isset( $heateor_fbl_options['privacy_policy_optin_text'] ) ? $heateor_fbl_options['privacy_policy_optin_text'] : '' ?></textarea>
							</td>
						</tr>

						<tr class="heateor_fbl_help_content" id="heateor_fbl_privacy_policy_optin_text_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Text for the GDPR opt-in', 'heateor-login' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>		
								<label><?php _e( "Text to link to Terms-Conditions page", 'heateor-login' ) ; ?></label>
								<img id="heateor_fbl_tc_placeholder_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
							</th>
							<td>
								<input id="heateor_fbl_tc_placeholder" name="heateor_fbl[tc_placeholder]" type="text" value="<?php echo $heateor_fbl_options['tc_placeholder'] ?>" />
							</td>
						</tr>

						<tr class="heateor_fbl_help_content" id="heateor_fbl_tc_placeholder_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Word(s) in the opt-in text to be linked to terms-conditions page', 'heateor-login' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
								<label><?php _e( "Terms-Conditions Url", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_tc_url_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
							</th>
							<td>
								<input id="heateor_fbl_tc_url" name="heateor_fbl[tc_url]" type="text" value="<?php echo $heateor_fbl_options['tc_url'] ?>" />
							</td>
						</tr>

						<tr class="heateor_fbl_help_content" id="heateor_fbl_tc_url_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Url of the terms-conditions page of your website', 'heateor-login' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>		
								<label><?php _e( "Text to link to Privacy Policy page", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_privacy_ppu_placeholder_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
							</th>
							<td>
								<input id="heateor_fbl_privacy_ppu_placeholder" name="heateor_fbl[ppu_placeholder]" type="text" value="<?php echo $heateor_fbl_options['ppu_placeholder'] ?>" />
							</td>
						</tr>

						<tr class="heateor_fbl_help_content" id="heateor_fbl_privacy_ppu_placeholder_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Word(s) in the opt-in text to be linked to privacy policy page', 'heateor-login' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
								<label><?php _e( "Privacy Policy Url", 'heateor-login' ); ?></label>
								<img id="heateor_fbl_privacy_policy_url_help" class="heateor_fbl_help_bubble" src="<?php echo plugins_url( '../images/info.png', __FILE__ ) ?>" />
							</th>
							<td>
								<input id="heateor_fbl_privacy_policy_url" name="heateor_fbl[privacy_policy_url]" type="text" value="<?php echo $heateor_fbl_options['privacy_policy_url'] ?>" />
							</td>
						</tr>

						<tr class="heateor_fbl_help_content" id="heateor_fbl_privacy_policy_url_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Url of the privacy policy page of your website', 'heateor-login' ) ?>
							</div>
							</td>
						</tr>	
					</tbody>
					</table>
				</div>
				<input style="margin-left:8px; margin-top: 15px; margin-bottom: 15px;" type="submit" name="save" class="button button-primary" value="<?php _e( 'Save Changes', 'heateor-login' ) ?>" />
				<div style="margin-left:8px;">
				<?php echo sprintf( __( 'You can appreciate the effort put in this free plugin by rating it <a href="%s" target="_blank">here</a>', 'heateor-login' ), 'https://wordpress.org/support/view/plugin-reviews/heateor-login' ); ?>
				</div>
			</div>
			<div class="stuffbox">
				<h3 style="font-size: 14px; padding: 8px 12px; margin: 0;line-height: 1.4;">   <label><?php _e( "Instagram Shoutout", 'heateor-login' ); ?></label></h3>
				<div class="inside" style="padding-left:10px">
				<p><?php _e( 'If you can send (to hello@heateor.com) how this plugin is helping your business, we would be glad to shoutout on Instagram. You can also send any relevant hashtags and people to mention in the Instagram post.', 'heateor-login' ) ?></p>
				</div>
			</div>
			</div>
			<?php include 'help.php'; ?>
		</div>

		<div class="menu_containt_div" id="tabs-3">
			<div class="heateor_fbl_clear"></div>
			<div class="heateor_fbl_left_column">
				<div class="stuffbox">
					<h3><label><?php _e( 'Shortcode & Widget', 'heateor-login' );?></label></h3>
					<div class="inside" style="padding-left:7px">
						<p><a style="text-decoration:none" href="http://support.heateor.com/facebook-login-shortcode-and-widget/" target="_blank"><?php _e( ' Facebook Login Shortcode & Widget', 'heateor-login' ) ?></a></p>
					</div>
				</div>
				<div class="stuffbox">
					<h3 style="font-size: 14px; padding: 8px 12px; margin: 0;line-height: 1.4;">   <label><?php _e( "Instagram Shoutout", 'heateor-login' ); ?></label></h3>
					<div class="inside" style="padding-left:10px">
					<p><?php _e( 'If you can send (to hello@heateor.com) how this plugin is helping your business, we would be glad to shoutout on Instagram. You can also send any relevant hashtags and people to mention in the Instagram post.', 'heateor-login' ) ?></p>
					</div>
				</div>
			</div>
			<?php include 'help.php'; ?>	
		</div>

		<div class="menu_containt_div" id="tabs-4">
			<div class="heateor_fbl_clear"></div>
			<div class="heateor_fbl_left_column">
				<div class="stuffbox">
					<h3><label><?php _e( 'FAQ', 'heateor-login' );?></label></h3>
					<div class="inside faq" style="padding-left:7px">
						<p><?php _e( '<strong>Note:</strong> Plugin will not work on local server. You should have an online website for the plugin to function properly.', 'heateor-login' ); ?></p>
						<p>
						<a href="javascript:void(0)"><?php _e( 'Why is Facebook Login not working?', 'heateor-login' ); ?></a>
						<div><?php _e( 'Make sure that App ID and Secret( Client ID and Secret) keys you have saved, belong to the same app', 'heateor-login' ); ?></div>
						</p>
						<p><a href="https://wordpress.org/support/topic/social-login-not-working-with-cache-enabled/" target="_blank"><?php _e( 'Facebook Login not working with Varnish enabled', 'heateor-login' ) ?></a></p>
						<p><a href="https://wordpress.org/support/topic/social-login-not-working-with-cache-enabled/" target="_blank"><?php _e( 'Why the user is not appearing logged in even after Facebook Login until the webpage is refreshed manually?', 'heateor-login'  ) ?></a></p>
						<p><a href="http://support.heateor.com/gdpr-and-our-plugins" target="_blank"><?php _e( 'Is this plugin GDPR compliant?', 'heateor-login' ) ?></a></p>
					</div>
				</div>

				<div class="stuffbox">
					<h3 style="font-size: 14px; padding: 8px 12px; margin: 0;line-height: 1.4;"><label><?php _e( "Instagram Shoutout", 'heateor-login' ); ?></label></h3>
					<div class="inside" style="padding-left:10px">
					<p><?php _e( 'If you can send (to hello@heateor.com) how this plugin is helping your business, we would be glad to shoutout on Instagram. You can also send any relevant hashtags and people to mention in the Instagram post.', 'heateor-login' ) ?></p>
					</div>
				</div>
			</div>
			<?php include 'help.php'; ?>
		</div>
	<div>
	</div>		

	</div>
	</form>
</div>