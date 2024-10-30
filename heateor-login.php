<?php
/*
Plugin Name: Heateor Login
Plugin URI: https://heateor.com
Description: Allow your website visitors to login to your website via their Facebook accounts
Version: 1.1.9
Author: Team Heateor
Author URI: https://www.heateor.com
Text Domain: heateor-login
Domain Path: /languages
License: GPL2+
*/
defined( 'ABSPATH' ) or die( "Cheating........Uh!!" );
define( 'HEATEOR_FBL_VERSION', '1.1.9' );

$heateor_fbl_options = get_option( 'heateor_fbl' );

require_once "widget.php";
require_once "shortcode.php";

/**
 * Render Facebook login button
 */
function heateor_fbl_render_facebook_login_button() {
	if ( is_user_logged_in() ) {
		return '';
	}
	global $heateor_fbl_options;
	$heateor_fbl_login_url = '';
	$heateor_fbl_fb_id = $heateor_fbl_options['facebook_app_id'];
	$heateor_fbl_fb_sec = $heateor_fbl_options['facebook_app_secret'];

	if ( ! isset( $_GET['code'] ) && ! isset( $_GET['HeateorFblAuth'] ) && ! empty( $heateor_fbl_fb_id ) && ! empty( $heateor_fbl_fb_sec ) ) {
		$heateor_fbl_current_page_url = heateor_fbl_get_http() . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
		$facebook_login_state = mt_rand();
		update_user_meta( $facebook_login_state, 'heateor_fbl_redirect_url', heateor_fbl_get_valid_url( $heateor_fbl_current_page_url ) );
		$heateor_fbl_permissions = ['email']; // Optional permissions
		$heateor_fbl_login_url =  "https://www.facebook.com/v17.0/dialog/oauth?scope=email&client_id=" . $heateor_fbl_options['facebook_app_id'] . "&state=" . $facebook_login_state . "&redirect_uri=" . home_url() . "/?HeateorFblAuth=Facebook";
	}

	$title = get_option( 'heateor_fbl' )['facebook_title'];
	$html = '';
	$custom_interface = apply_filters( 'heateor_fbl_interface_filter', '', $heateor_fbl_login_url , $heateor_fbl_options );
	if ( $custom_interface != '' ) {
		$html = $custom_interface;
	} else {
		$html = heateor_fbl_notifications( $heateor_fbl_options );
		if ( isset( $heateor_fbl_options['center_align'] ) ) {
			$html .= '<style type="text/css">div.heateor_fbl_social_login_title,div.heateor_fbl_login_container{text-align:center}ul.heateor_fbl_login_ul{width:100%;text-align:center;}div.heateor_fbl_login_container ul.heateor_fbl_login_ul li{float:none!important;display:inline-block;}</style>';
			$html .= '<center>';
		}

		$gdpr_optin = "";

		if ( isset( $heateor_fbl_options['gdpr_enable'] ) ) {
			$gdpr_optin = '<div class="heateor_fbl_sl_optin_container"><label><input type="checkbox" class="heateor_fbl_social_login_optin" value="1">' . str_replace( array( $heateor_fbl_options['ppu_placeholder'], $heateor_fbl_options['tc_placeholder'] ), array( '<a href="' . $heateor_fbl_options['privacy_policy_url'] . '" target="_blank">' . $heateor_fbl_options['ppu_placeholder'] . '</a>', '<a href="' . $heateor_fbl_options['tc_url'] . '" target="_blank">' . $heateor_fbl_options['tc_placeholder'] . '</a>' ), wp_strip_all_tags( $heateor_fbl_options['privacy_policy_optin_text'] ) ) . '</label></div>';
		}
		$html .= '<div style="clear:both"></div>';
		if ( isset( $heateor_fbl_options['same_window'] ) ) {
			$html .= '<div class="heateor_fbl_outer_login_container"><div class="heateor_fbl_social_login_title">' . $title . '</div><div class="heateor_fbl_login_container">';
				
			if ( isset( $heateor_fbl_options['gdpr_enable'] ) && $heateor_fbl_options['gdpr_placement'] == 'above' ) {
				 $html .= $gdpr_optin;
			}

			$html .= '<ul class="heateor_fbl_login_ul"><li><i class="heateorFblLogin heateorFblFacebookBackground heateorFblFacebookLogin" alt="Login with Facebook" title="' . __( 'Login with Facebook', 'heateor-login' ) . '" onclick="var heateorFblLoginContainer=jQuery(this).parents(\'div.heateor_fbl_outer_login_container\').find(\'.heateor_fbl_social_login_optin\');if(heateorFblLoginContainer.length>0&&!jQuery(heateorFblLoginContainer).is(\':checked\')){jQuery(heateorFblLoginContainer).parent().css(\'color\',\'red\');return;}location.href=\'' . $heateor_fbl_login_url . '\'" style="display: block;"><div class="heateorFblFacebookLogoContainer"><ss style="display:block" class="heateorFblLoginSvg heateorFblFacebookLoginSvg"></ss></div></i></li></ul>';
			if ( isset( $heateor_fbl_options['gdpr_enable'] ) && $heateor_fbl_options['gdpr_placement'] == 'below' ) {
				$html .= $gdpr_optin;
			}
			$html .= '</div></div>';
		} else {
			$html .= '<div class="heateor_fbl_outer_login_container"><div class="heateor_fbl_social_login_title">' . $title . '</div><div class="heateor_fbl_login_container">';
			if ( isset( $heateor_fbl_options['gdpr_enable'] ) && $heateor_fbl_options['gdpr_placement'] == 'above' ) {
			 	$html .= $gdpr_optin;
			}
			$html .= '<ul class="heateor_fbl_login_ul"><li><i class="heateorFblLogin heateorFblFacebookBackground heateorFblFacebookLogin" alt="Login with Facebook" title="Login with Facebook" onclick="var heateorFblLoginContainer=jQuery(this).parents(\'div.heateor_fbl_outer_login_container\').find(\'.heateor_fbl_social_login_optin\');if(heateorFblLoginContainer.length>0&&!jQuery(heateorFblLoginContainer).is(\':checked\')){jQuery(heateorFblLoginContainer).parent().css(\'color\',\'red\');return;}window.open(\'' . $heateor_fbl_login_url . '\', \'_blank\', \'width=1000,height=500\' )" style="display: block;"><div class="heateorFblFacebookLogoContainer"><ss style="display:block" class="heateorFblLoginSvg heateorFblFacebookLoginSvg"></ss></div></i></li></ul>';
			if ( isset( $heateor_fbl_options['gdpr_enable'] ) && $heateor_fbl_options['gdpr_placement'] == 'below' ) { 
				$html .= $gdpr_optin;
			} 
			$html .= '</div></div>';
		
			if ( isset( $heateor_fbl_options['center_align'] ) ) {
				$html .= '</center>';
			}		
		}
		$html .= '<div style="clear:both"></div>';

		$html .= '<br/>';
	}
	return $html;
}

if ( isset( $heateor_fbl_options['login_enable'] ) ) {
	add_action( 'login_form', 'heateor_fbl_fb_login_html' );
}
if ( isset( $heateor_fbl_options['register_enable'] ) ) {
	add_action( 'register_form', 'heateor_fbl_fb_login_html' );
}
if ( isset( $heateor_fbl_options['enable_in_comment'] ) ) {
	add_action( 'comment_form_must_log_in_after', 'heateor_fbl_fb_login_html' );
	add_action( 'comment_form_top', 'heateor_fbl_fb_login_html' );
}
if ( isset( $heateor_fbl_options['enable_before_wc'] ) ) {
	add_action( 'woocommerce_before_customer_login_form', 'heateor_fbl_fb_login_html' );
}
if ( isset( $heateor_fbl_options['enable_after_wc'] ) ) {
	add_action( 'woocommerce_login_form', 'heateor_fbl_fb_login_html' );
}
if( isset( $heateor_fbl_options['enable_register_wc'] ) ) {
	add_action( 'woocommerce_register_form', 'heateor_fbl_fb_login_html' );
}
if ( isset( $heateor_fbl_options['enable_wc_checkout'] ) && $heateor_fbl_options['enable_wc_checkout'] == 1 ) {
	add_action( 'woocommerce_checkout_before_customer_details', 'heateor_fbl_fb_login_html' );
}

/**
 * HTML of Facebook login button
 */
function heateor_fbl_fb_login_html() {
	echo heateor_fbl_render_facebook_login_button();
}


/**
 * Show Social Avatar options at profile page
 *
 * @since     1.1.7
 */
function heateor_fbl_show_avatar_option( $user ) {
	global $user_ID, $heateor_fbl_options;
	if ( isset( $heateor_fbl_options['gdpr_enable'] ) ) {
		$gdpr_consent = get_user_meta( $user->ID, 'heateor_fbl_gdpr_consent', true );
		?>
		<h3><?php _e( 'GDPR', 'heateor-login' ) ?></h3>
		<table class="form-table">
			<tr>
	            <th><label for="heateor_fbl_gdpr_consent"><?php _e( 'I agree to my personal data being stored and used as per Privacy Policy and Terms and Conditions', 'heateor-login' ) ?></label></th>
	        	<td><input id="heateor_fbl_gdpr_consent" style="margin-right:5px" type="radio" name="heateor_fbl_gdpr_consent" value="yes" <?php echo ! $gdpr_consent || $gdpr_consent == 'yes' ? 'checked' : '' ?> /></td>
	        </tr>
	        <tr>
	            <th><label for="heateor_fbl_revoke_gdpr_consent"><?php _e( 'I revoke my consent to store and use my personal data. Kindly delete my personal data saved in this website.', 'heateor-login' ) ?></label></th>
	        	<td><input id="heateor_fbl_revoke_gdpr_consent" style="margin-right:5px" type="radio" name="heateor_fbl_gdpr_consent" value="no" <?php echo $gdpr_consent == 'no' ? 'checked' : '' ?> /></td>
	        </tr>
	    </table>
		<?php
	}
	if ( isset( $heateor_fbl_options['social_avatar'] ) ) {
		$dont_update_avatar = get_user_meta( $user_ID, 'heateor_fbl_dontupdate_avatar', true );
		?>
		<h3><?php _e( 'Social Avatar', 'heateor-login' ) ?></h3>
		<table class="form-table">
	        <tr>
	            <th><label for="heateor_fbl_small_avatar"><?php _e( 'Small Avatar Url', 'heateor-login' ) ?></label></th>
	            <td><input id="heateor_fbl_small_avatar" type="text" name="heateor_fbl_small_avatar" value="<?php echo esc_attr(get_user_meta( $user->ID, 'heateor_fbl_avatar', true ) ); ?>" class="regular-text" /></td>
	        </tr>
	        <tr>
	            <th><label for="heateor_fbl_large_avatar"><?php _e( 'Large Avatar Url', 'heateor-login' ) ?></label></th>
	            <td><input id="heateor_fbl_large_avatar" type="text" name="heateor_fbl_large_avatar" value="<?php echo esc_attr(get_user_meta( $user->ID, 'heateor_fbl_large_avatar', true ) ); ?>" class="regular-text" /></td>
	        </tr>
	        <tr>
	            <th><label for="heateor_fbl_dontupdate_avatar_1"><?php _e( 'Do not fetch and update social avatar from my profile, next time I Social Login', 'heateor-login' ) ?></label></th>
	            <td><input id="heateor_fbl_dontupdate_avatar_1" style="margin-right:5px" type="radio" name="heateor_fbl_dontupdate_avatar" value="1" <?php echo $dont_update_avatar ? 'checked' : '' ?> /></td>
	        </tr>
	        <tr>
	            <th><label for="heateor_fbl_dontupdate_avatar_0"><?php _e( 'Update social avatar, next time I Social Login', 'heateor-login' ) ?></label></th>
	            <td><input id="heateor_fbl_dontupdate_avatar_0" style="margin-right:5px" type="radio" name="heateor_fbl_dontupdate_avatar" value="0" <?php echo ! $dont_update_avatar ? 'checked' : '' ?> /></td>
	        </tr>
	    </table>
		<?php
	}
}
add_action( 'edit_user_profile', 'heateor_fbl_show_avatar_option' );
add_action( 'show_user_profile', 'heateor_fbl_show_avatar_option' );
add_action( 'personal_options_update', 'heateor_fbl_save_avatar' );
add_action( 'edit_user_profile_update', 'heateor_fbl_save_avatar' );

/**
 * Save social avatar options from profile page
 *
 * @since     1.1.7
 */
function heateor_fbl_save_avatar( $user_id ) {
 	if ( ! current_user_can( 'edit_user', $user_id ) ) {
 		return false;
 	}
 	if ( isset( $_POST['heateor_fbl_gdpr_consent'] ) && $_POST['heateor_fbl_gdpr_consent'] == 'no' ) {
		global $wpdb;
		// delete user's social avatar saved in the website locally
		$avatar_path = ABSPATH . 'wp-content/uploads/heateor/' . get_user_meta( $user_id, 'heateor_fbl_id', true ) . '.jpeg';
		$large_avatar_path = ABSPATH . 'wp-content/uploads/heateor/' . get_user_meta( $user_id, 'heateor_fbl_id', true ) . '_large.jpeg';
		if ( file_exists( $avatar_path ) ) {
			unlink( $avatar_path );
		}
		if ( file_exists( $large_avatar_path ) ) {
			unlink( $large_avatar_path );
		}
		// delete personal data from the user meta 
		$wpdb->query( $wpdb->prepare( 'DELETE FROM ' . $wpdb->prefix . 'usermeta WHERE user_id = %d and meta_key LIKE "heateor_fbl%"', $user_id ) );
 	}
 	if ( ( ! isset( $_POST['heateor_fbl_gdpr_consent'] ) || $_POST['heateor_fbl_gdpr_consent'] == 'yes' ) && isset( $_POST['heateor_fbl_small_avatar'] ) ) {
 		update_user_meta( $user_id, 'heateor_fbl_avatar', esc_url( trim( $_POST['heateor_fbl_small_avatar'] ) ) );
 	}
 	if ( ( ! isset( $_POST['heateor_fbl_gdpr_consent'] ) || $_POST['heateor_fbl_gdpr_consent'] == 'yes' ) && isset( $_POST['heateor_fbl_large_avatar'] ) ) {
 		update_user_meta( $user_id, 'heateor_fbl_large_avatar', esc_url( trim( $_POST['heateor_fbl_large_avatar'] ) ) );
 	}
	if ( isset( $_POST['heateor_fbl_dontupdate_avatar'] ) ) {
		update_user_meta( $user_id, 'heateor_fbl_dontupdate_avatar', intval( $_POST['heateor_fbl_dontupdate_avatar'] ) );
	}
	if ( isset( $_POST['heateor_fbl_gdpr_consent'] ) ) {
	    update_user_meta( $user_id, 'heateor_fbl_gdpr_consent', $_POST['heateor_fbl_gdpr_consent'] == 'yes' ? 'yes' : 'no' );
    }
}

/**
 * Replace default avatar with Facebook profile picture
 */
function heateor_fbl_social_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
	global $heateor_fbl_options;
    $user = false;
	
    if ( is_numeric( $id_or_email ) ) {
        $id = ( int ) $id_or_email;
        $user = get_user_by( 'id' , $id );
    } elseif ( is_object( $id_or_email ) ) {
        if ( ! empty( $id_or_email->user_id ) ) {
            $id = ( int ) $id_or_email->user_id;
            $user = get_user_by( 'id' , $id );
        }
    } else {
        $user = get_user_by( 'email', $id_or_email );	
    }
	
    if ( $user && is_object( $user ) ) {
		$avatar_small = get_user_meta( $user->data->ID, 'heateor_fbl_avatar', true );
		$avatar_large = get_user_meta( $user->data->ID, 'heateor_fbl_large_avatar', true );
		if ( $heateor_fbl_options['avatar_quality'] == 'average' && heateor_fbl_validate_url( $avatar_small ) ) {
       		$avatar = "<img alt='{$alt}' src='" . $avatar_small . "' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
    	} elseif ( $heateor_fbl_options['avatar_quality'] == 'best' && heateor_fbl_validate_url( $avatar_large ) ) {
			$avatar = "<img alt='{$alt}' src='" . $avatar_large . "' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
		}
    }
	 
    return $avatar;
}
if ( isset( $heateor_fbl_options['social_avatar'] ) ) {
	add_filter( 'get_avatar' , 'heateor_fbl_social_avatar' , 1 , 5 ); 
}

/**
 * Get http/https protocol of website
 */
function heateor_fbl_get_http() {
	if ( isset( $_SERVER['HTTPS'] ) && ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) {
		return "https://";
	} else {
		return "http://";
	}
}

/**
 * Delete the redirection url saved in the user meta
 */
function heateor_fbl_clear_state( $state ) {
	delete_user_meta( $state, 'heateor_fbl_redirect_url' );
}

/**
 * Check querystring variables and form submission
 */
function heateor_fbl_connect() {
	global $heateor_fbl_fb_id , $heateor_fbl_fb_sec , $heateor_fbl_options;

	if ( isset( $_POST['heateor_fbl_email_submit'] ) && isset( $_POST['heateor_fbl_unique_id'] ) ) {
		$state = sanitize_text_field( trim( $_POST['heateor_fbl_unique_id'] ) );
		if ( ( $user_fb_data = get_user_meta( $state, 'heateor_fbl_temp_userdata', true ) ) !== false ) {
			$user_fb_data = maybe_unserialize( $user_fb_data );
			$email = sanitize_email( trim( $_POST['heateor_fbl_email'] ) );
			$error_msg = '';
		 	if ( ! is_email( $email ) ) {
		 		$error_msg = __( 'Email address is not valid', 'heateor-login' );
		 	}
		 	if ( email_exists( $email ) ) {
		 		$error_msg = __( "This email already exists. Please specify another email", 'heateor-login' );
		 	}
		 	if ( $error_msg != '' ) {
		 		$redirection = esc_url( trim( $_POST['heateor_fbl_redirection'] ) );
		 		$redirection = heateor_fbl_validate_url( $redirection ) ? $redirection : esc_url( home_url() );
			 	?>
			 	<div id="heateor_fbl_popup_bg"></div>
				 	<div id="heateor_fbl_sharing_more_providers"><button id="heateor_fbl_sharing_popup_close" onclick="jQuery(this).parent().prev().remove();jQuery(this).parent().remove();" class="close-button separated"><img src="<?php echo plugins_url( 'images/close.png', __FILE__ ) ?>" /></button><div id="heateor_fbl_sharing_more_content"><div class="filter"></div><div class="all-services">
			 		<form action="<?php echo esc_url( home_url() ) . '/index.php'; ?>" method="post">
						<div><?php echo esc_html( $heateor_fbl_options['email_popup_text'] ); ?></div>
						<div style="color:red"><?php echo $error_msg; ?></div>
						<input name="heateor_fbl_email" id="defaultForm-email" value="<?php echo $email; ?>" placeholder="<?php _e( 'Email', 'heateor-login' ); ?>" type="text"/>
						<input name="heateor_fbl_unique_id" value="<?php echo $state; ?>" type="hidden"/>
						<input name="heateor_fbl_redirection" value="<?php echo $redirection; ?>" type="hidden"/>
						<input  class="btn btn-default" type="submit" name="heateor_fbl_email_submit" value="<?php _e( 'Submit', 'heateor-login' ) ?>" />
					</form>
				 </div></div></div>
			 	<?php
			 	return;
			}

			$userdata = array(
				'user_login' => $user_fb_data['first_name'],
				'user_pass' => wp_generate_password(),
				'user_nicename' => sanitize_user( $user_fb_data['first_name'], true ),
				'user_email' => $email,
				'display_name' => $user_fb_data['first_name'],
				'nickname' => $user_fb_data['first_name'],
				'first_name' => $user_fb_data['first_name'],
				'last_name' => $user_fb_data['last_name'],
				'description' => '',
				'user_url' => '',
				'role' => get_option( 'default_role' )
			);
			// delete the user data saved temporarily in the user meta
			delete_user_meta( $state, 'heateor_fbl_temp_userdata' );
			// delete the redirection url saved in the user meta
			heateor_fbl_clear_state( $state );
			heateor_fbl_create_user( $userdata, $user_fb_data['first_name'], $user_fb_data['id'], $heateor_fbl_options, $user_fb_data['avatar'], $user_fb_data['avatar_large'], $redirection );
		}
	}

	if ( isset( $_GET['code'] )  && isset( $_GET['state'] ) && ( $redirection = get_user_meta( esc_attr( trim( $_GET['state'] ) ), 'heateor_fbl_redirect_url', true ) ) !== false ) {
		$post_data = array(
            'code' => esc_attr( trim( $_GET['code'] ) ),
            'redirect_uri' => esc_url( home_url() ) . "/?HeateorFblAuth=Facebook",
            'client_id' => sanitize_text_field( $heateor_fbl_options['facebook_app_id'] ),
            'client_secret' => sanitize_text_field( $heateor_fbl_options['facebook_app_secret'] )
        );
         
        $response  = wp_remote_post( "https://graph.facebook.com/v17.0/oauth/access_token", array(
            'method' => 'POST',
            'timeout' => 15,
            'redirection' => 5,
            'httpversion' => '1.0',
            'sslverify' => false,
            'headers' => array(
                'Content-Type' => 'application/x-www-form-urlencoded'
            ),
            'body' => http_build_query( $post_data )
        ) );

        if ( ! is_wp_error( $response ) && isset( $response['response']['code'] ) && 200 === $response['response']['code'] ) {
            $body = json_decode( wp_remote_retrieve_body( $response ) );
            if ( ! empty( $body->access_token ) ) {
	            $response = wp_remote_get( "https://graph.facebook.com/me?fields=id,name,about,link,email,first_name,last_name,picture.width(60).height(60).as(picture_small),picture.width(320).height(320).as(picture_large)&access_token=" . sanitize_text_field( $body->access_token ), array(
	                'timeout' => 15
	            ) );
	            if ( ! is_wp_error( $response ) && isset( $response['response']['code'] ) && 200 === $response['response']['code'] ) {
	                $profile_data = json_decode( wp_remote_retrieve_body( $response ) );
	                
					// sanitization
					$user['first_name'] = isset( $profile_data->first_name ) ? sanitize_text_field( $profile_data->first_name ) : '';
					$user['last_name'] = isset( $profile_data->last_name ) ? sanitize_text_field( $profile_data->last_name ) : '';
					$user['id'] = isset( $profile_data->id ) ? sanitize_text_field( $profile_data->id ) : '';
					$user['email'] = isset( $profile_data->email ) ? sanitize_email( $profile_data->email ) : '';
					$user['avatar'] = isset( $profile_data->picture_small ) && isset( $profile_data->picture_small->data->url ) && heateor_fbl_validate_url( $profile_data->picture_small->data->url  ) ? trim( $profile_data->picture_small->data->url  ) : '';
					$user['avatar_large'] = isset( $profile_data->picture_large ) && isset($profile_data->picture_large->data->url ) && heateor_fbl_validate_url( $profile_data->picture_large->data->url ) ? trim( $profile_data->picture_large->data->url ) : '';

					// state
					$state = esc_attr( trim( $_GET['state'] ) );

					// if social id is blank, halt and redirect to homepage
					if ( ! $user['id'] ) {
						heateor_fbl_clear_state( $state );
						heateor_fbl_close_login_popup( esc_url( home_url() ) );
						die;
					}

					// check if Facebook ID exists in DB
					$existing_user = get_users( 'meta_key=heateor_fbl_id&meta_value=' . $user['id'] );
					
					if ( count( $existing_user ) > 0 ) {
						// Facebook ID exists in the database
						if ( isset( $existing_user[0]->ID ) ) {
							$user_obj = get_user_by( 'id', $existing_user[0]->ID );
							heateor_fbl_clear_state( $state );
							heateor_fbl_login_user( $user_obj, $user_obj->data->user_login, $user['avatar'], $user['avatar_large'], $user['id'] );
							heateor_fbl_close_login_popup( $redirection );
							die;
						}
					}

					// check if email exists in database
					if ( $user['email'] && $user_id = email_exists( $user['email'] ) ) {
						$user_obj = get_user_by( 'email', $user['email'] );
						heateor_fbl_clear_state( $state );
						heateor_fbl_login_user( $user_obj, $user_obj->data->user_login, $user['avatar'], $user['avatar_large'], $user['id'] );
						heateor_fbl_close_login_popup( $redirection );
						die;
					}

					if ( isset( $heateor_fbl_options['disable_reg'] ) ) {
						$redirection_url = esc_url( home_url() );
						if ( isset( $heateor_fbl_options['disable_reg_redirect'] ) && $heateor_fbl_options['disable_reg_redirect'] != '' ) {
							$redirection_url = $heateor_fbl_options['disable_reg_redirect'];
						}
						wp_redirect( $redirection_url );
						die();
					}

					if ( ! isset( $user['email'] ) || $user['email'] == "" ) {
						if ( isset( $heateor_fbl_options['E-mail'] ) ) {
							$state = mt_rand();
							update_user_meta( $state, 'heateor_fbl_temp_userdata', maybe_serialize( $user ) );
							?>
							<div id="heateor_fbl_popup_bg"></div>
					 		<div id="heateor_fbl_sharing_more_providers"><button id="heateor_fbl_sharing_popup_close" onclick="jQuery(this).parent().prev().remove();jQuery(this).parent().remove();" class="close-button separated"><img src="<?php echo plugins_url( 'images/close.png', __FILE__ ) ?>" /></button><div id="heateor_fbl_sharing_more_content"><div class="filter"></div><div class="all-services">
							<form action="<?php echo esc_url( home_url() ) . '/index.php'; ?>" method="post">
						        <div><?php echo esc_html( $heateor_fbl_options['email_popup_text'] ); ?></div>
						        <input type="text" name="heateor_fbl_email" id="defaultForm-email" placeholder="<?php _e( 'Email', 'heateor-login' ); ?>" class="form-control validate">
						        <input name="heateor_fbl_unique_id" value="<?php echo $state; ?>" type="hidden" />
						        <input name="heateor_fbl_redirection" value="<?php echo $redirection; ?>" type="hidden" />
						        <input class="btn btn-default" type="submit" name="heateor_fbl_email_submit" value="<?php _e( 'Submit', 'heateor-login' ) ?>"/>
							</form>
							</div></div></div>
							<?php
							return;
						} else {
							$email = $user['id'] . '@facebook.com';
						}
					}

					$id = $user['id'];
					$password = wp_generate_password();
					$username = $first_name = $user['first_name'];
					$name_exists = true;
					$temp_username = $username;
					$index = 1;
					while ( $name_exists == true ) {
						if ( username_exists( $temp_username ) ) {
							$index++;
							$temp_username = $username . $index;
						} else {
							$name_exists = false;
						}
					}
					$username = $temp_username;
					
					$email = $user['email'];
					$userdata = array(
						'user_login' => $username,
						'user_pass' => $password,
						'user_nicename' => sanitize_user( $first_name, true ),
						'user_email' => $email,
						'display_name' => $first_name,
						'nickname' => $first_name,
						'first_name' => $first_name,
						'last_name' => $user['last_name'],
						'description' => '',
						'user_url' => '',
						'role' => get_option( 'default_role' )
					);
					heateor_fbl_clear_state( $state );
					heateor_fbl_create_user( $userdata, $username, $id, $heateor_fbl_options, $user['avatar'], $user['avatar_large'], $redirection );
                }
            }
        }
	}
}
add_action( 'parse_request', 'heateor_fbl_connect' );

/**
 * Get url of the image after saving it locally 
 */
function heateor_fbl_save_social_avatar( $url = NULL, $name = NULL ) {    
    $url = stripslashes( $url );
	if ( ! filter_var( $url, FILTER_VALIDATE_URL ) ) {
	    return false;
	}
	if ( empty( $name ) ) {
	    $name = basename( $url );
	}
	$dir = wp_upload_dir();
	try {
	    $image = wp_remote_get( $url, array(
	        'timeout' => 15 
	    ) );
	    if ( !is_wp_error( $image ) && isset( $image['response']['code'] ) && 200 === $image['response']['code'] ) {
	        $image_content    = wp_remote_retrieve_body( $image );
	        $image_type       = isset( $image['headers'] ) && isset( $image['headers']['content-type'] ) ? $image['headers']['content-type'] : '';
	        $image_type_parts = array();
	        $extension        = '';
	        if ( $image_type ) {
	            $image_type_parts = explode( '/', $image_type );
	            $extension        = $image_type_parts[1];
	        }
	        if ( ! is_string( $image_content ) || empty( $image_content ) ) {
	            return false;
	        }
	        if ( ! is_dir( $dir['basedir'] . '/heateor' ) ) {
	            wp_mkdir_p( $dir['basedir'] . '/heateor' );
	        }
	        $save = file_put_contents( $dir['basedir'] . '/heateor/' . $name . '.' . $extension, $image_content );
	        if ( ! $save ) {
	            return false;
	        }
	        return $dir['baseurl'] . '/heateor/' . $name . '.' . $extension;
	    }
	} catch ( Exception $e ) {
	    return false;
	}
}

/**
 * Login user to website
 */
function heateor_fbl_login_user( $user, $username, $avatar, $avatar_large, $social_id ) {
	update_user_meta( $user->ID, 'heateor_fbl_id', $social_id );
	if ( $avatar ) {
		$local_avatar_url = heateor_fbl_save_social_avatar( $avatar, $social_id );
		if ( $local_avatar_url ) {
			update_user_meta( $user->ID, 'heateor_fbl_avatar', $local_avatar_url );
		}
	}
	if ( $avatar_large ) {
		$local_avatar_url = heateor_fbl_save_social_avatar( $avatar_large, $social_id . '_large' );
		if ( $local_avatar_url ) {
			update_user_meta( $user->ID, 'heateor_fbl_large_avatar', $local_avatar_url );
		}
	}
	wp_set_current_user( $user->ID, $username );

	global $heateor_fbl_options;
	if ( isset( $heateor_fbl_options['gdpr_enable'] ) ) {
		update_user_meta( $user->ID, 'heateor_fbl_gdpr_consent', 'yes' );
	}
	wp_set_auth_cookie( $user->ID, true );
	do_action( 'wp_login', $user->user_login, $user );
}

/**
 * Create new user
 */
function heateor_fbl_create_user ( $userdata, $username, $id, $heateor_fbl_options, $avatar, $avatar_large, $redirection ) {
	$user_id = wp_insert_user( $userdata );
	$user = get_user_by( 'ID', $user_id );
	if ( ! is_wp_error( $user_id ) ) {
		heateor_fbl_login_user( $user, $username, $avatar, $avatar_large, $id );
		// send notification email
		heateor_fbl_new_user_notification( $user_id );
	}
	$redirection = heateor_fbl_get_login_redirection_url( $redirection, true );
	heateor_fbl_close_login_popup( $redirection  );
}

/**
 * Load CSS and Javascripts at front-end
 */
function heateor_fbl_scripts_styles() {
	global $heateor_fbl_options;
	echo $heateor_fbl_options['custom_css'] ? '<style type="text/css">' . $heateor_fbl_options['custom_css'] . '</style>' : '';
	wp_enqueue_style( 'heateor_fbl_frontend_style', plugins_url( 'css/public/front.css', __FILE__ ), false, HEATEOR_FBL_VERSION );
}

/**
 * Load CSS on initialization
 */
function heateor_fbl_init() {
	add_action( 'wp_enqueue_scripts', 'heateor_fbl_scripts_styles' );
	add_action( 'login_enqueue_scripts', 'heateor_fbl_scripts_styles' );
}
add_action( 'init', 'heateor_fbl_init' );

/**
 * Create plugin menu
 */
function heateor_fbl_create_top_admin_menu() {
	$page = add_menu_page ( 'Heateor Login', 'Heateor Login', 'manage_options', 'heateor-fbl-options', 'heateor_fbl_options_page', plugins_url ( 'images/logo.ico', __FILE__ ) );
	add_action( 'admin_print_styles-' . $page, 'heateor_fbl_admin_style' );
	add_action( 'admin_print_scripts-' . $page, 'heateor_fbl_admin_scripts' );

}
add_action( 'admin_menu', 'heateor_fbl_create_top_admin_menu' );

/**
 * Handle option form submission
 */
function heateor_fbl_handle_form_submission() {
	register_setting( 'heateor_fbl_options', 'heateor_fbl', 'heateor_fbl_validate_plugin_options' );
}

/**
 * Validate options
 */
function heateor_fbl_validate_plugin_options( $heateor_fbl_options ) {
	foreach ( $heateor_fbl_options as $k => $v ) {
		if ( is_string( $v ) ) {
			$heateor_fbl_options[$k] = esc_attr( trim( $v ) );
		}
	}

	return $heateor_fbl_options;
}
add_action( 'admin_init', 'heateor_fbl_handle_form_submission' );

/**
 * Return error message HTML
 */
function heateor_fbl_error_message($error, $heading = false){
	$html = "";
	$html .= "<div class='heateor_fbl_error'>";
	if($heading){
		$html .= "<p style='color: black'><strong>Heateor login: </strong></p>";
	}
	$html .= "<p style ='color:red; margin: 0'>". __($error, 'heateor-login') ."</p></div>";
	return $html;
}

/**
 * Display Social Login notifications
 */
function heateor_fbl_notifications($loginOptions){
	$errorHtml = '';
	if( !isset( $loginOptions['facebook_app_id'] ) || $loginOptions['facebook_app_id'] == '' || !isset($loginOptions['facebook_app_secret']) || $loginOptions['facebook_app_secret'] == '') {
		$errorHtml .= heateor_fbl_error_message('Specify Facebook App ID and Secret in <strong>Basic Configuration</strong> section at <strong>Heateor Login</strong> options page in admin panel for Facebook Login to work');
	}
	return $errorHtml;
}

/**
 * Render options page
 */
function heateor_fbl_options_page() {
	global $heateor_fbl_options;
	echo heateor_fbl_notifications($heateor_fbl_options);
	include 'admin/options-page.php';
} 

/**
 * Send new user notification email
 */
function heateor_fbl_new_user_notification( $user_id ) {
	global $heateor_fbl_options;
	$notification_type = '';
	if ( isset( $heateor_fbl_options['send_reg_email_acc_pass'] ) ) {
		$notification_type = 'both';
	} elseif ( isset( $heateor_fbl_options['send_noti_email_admin'] ) ) {
		$notification_type = 'admin';
	}
	if ( $notification_type ) {
		wp_new_user_notification( $user_id, null, $notification_type );
	}
}

/**
 * Validate url
 */
function heateor_fbl_validate_url( $url ) {
	return filter_var( trim( $url ), FILTER_VALIDATE_URL );
}

/**
 * Return valid redirection url
 */
function heateor_fbl_get_valid_url( $url ) {
	$decodedUrl = urldecode( $url );
	if ( $decodedUrl == home_url() . '/wp-login.php?action=register' || html_entity_decode( esc_url( remove_query_arg( array( 'heateor_fbl_message', 'HeateorFblVerified', 'HeateorFblUnverified', 'wp_lang', 'loggedout' ), $decodedUrl ) ) ) == wp_login_url() ) { 
		$url = esc_url( home_url() ) . '/';
	} elseif ( isset( $_GET['redirect_to'] ) ) {
		$redirect_to = esc_url( $_GET['redirect_to'] );
		if ( urldecode( $redirect_to ) == admin_url() ) {
			$url = esc_url( home_url() ) . '/';
		} elseif ( heateor_fbl_validate_url( urldecode( $redirect_to ) ) && ( strpos( urldecode( $redirect_to ), 'http://' ) !== false || strpos( urldecode( $redirect_to ), 'https://' ) !== false ) ) {
			$url = $redirect_to;
		} else {
			$url = esc_url( home_url() ) . '/';
		}
	}
	return $url;
}

/**
 * Return webpage url to redirect to, after login
 */
function heateor_fbl_get_login_redirection_url( $facebook_redirect = '', $register = false ) {
	global $heateor_fbl_options, $user_ID;
	if ( $register ) {
		$option = 'register';
	} else {
		$option = 'login';
	}
	$redirection_url = esc_url( home_url() );
	if ( isset( $heateor_fbl_options[$option . '_redirect'] ) ) {
		if ( $heateor_fbl_options[$option . '_redirect'] == 'same' ) {
			$http = heateor_fbl_get_http();
			if ( $facebook_redirect != '' ) {
				$url = $facebook_redirect;
			} else {
				$url = html_entity_decode( esc_url( $http . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ) );
			}
			$redirection_url = heateor_fbl_get_valid_url( $url );
		} elseif ( $heateor_fbl_options[$option . '_redirect'] == 'homepage' ) {
			$redirection_url = esc_url( home_url() );
		} elseif ( $heateor_fbl_options[$option . '_redirect'] == 'account' ) {
			$redirection_url = admin_url();
		} elseif ( $heateor_fbl_options[$option . '_redirect'] == 'custom' && $heateor_fbl_options[$option . '_redirect_custom'] != '' ) {
			$redirection_url = esc_url( $heateor_fbl_options[$option . '_redirect_custom'] );
		} elseif ( $heateor_fbl_options[$option . '_redirect'] == 'bp_profile' && $user_ID != 0 ) {
			$redirection_url = function_exists( 'bp_core_get_user_domain' ) ? bp_core_get_user_domain( $user_ID ) : admin_url();
		}
	}
	$redirection_url = apply_filters( 'heateor_fbl_redirection_url_filter', $redirection_url, $heateor_fbl_options, $user_ID, $facebook_redirect, $register );

	return $redirection_url;
}

/**
 * CSS to load at options page
 */
function heateor_fbl_admin_style() {
	wp_enqueue_style( 'heateor_fbl_admin_style', plugins_url( 'css/admin/admin.css', __FILE__ ), false, HEATEOR_FBL_VERSION );
}

/**
 * Javascript to load at options page
 */
function heateor_fbl_admin_scripts() {
	$inline_script = 'var heateorFblWebsiteUrl = "' . esc_url( home_url() ) . '", heateorFblHelpBubbleTitle = "' . __( 'Click to toggle help', 'heateor-login' ) . '";';
	wp_enqueue_script( 'heateor_fbl_admin_scripts', plugins_url( 'js/admin/admin.js', __FILE__ ), array( 'jquery', 'jquery-ui-tabs' ), HEATEOR_FBL_VERSION );

	wp_enqueue_script( 'heateor_fbl_fb_sdk_script', plugins_url( 'js/admin/fb_sdk.js', __FILE__ ), false, HEATEOR_FBL_VERSION );
	wp_add_inline_script( 'heateor_fbl_admin_scripts', $inline_script, $position = 'before' );
}

/**
 * Close social login popup window and redirect to the parent window
 */
function heateor_fbl_close_login_popup( $redirection_url ) {
	?>
	<script>
	if ( window.opener ) {
		window.opener.location.href="<?php echo trim( $redirection_url ); ?>";
		window.close();
	} else {
		window.location.href="<?php echo trim( $redirection_url ); ?>";
	}
	</script>
	<?php
	die;
}

/**
 * Default configuration of plugin (when plugin is activated first time after installation)
 */
function heateor_fbl_save_default_options() {
	// default options
	add_option( 'heateor_fbl', array(
		'disable_reg_redirect' => '',
		'facebook_app_id' => '',
		'facebook_app_secret' => '',
		'facebook_title' => __( 'Login with Facebook', 'heateor-login' ),
		'same_window' => '1',
		'login_enable' => '1',
		'register_enable' => '1',
		'enable_in_comment' => '1',
		'social_avatar' => '1',
		'avatar_quality' => 'average',
		'E-mail' => '1',
		'email_popup_text' =>__( 'Please enter a valid email address. You might be required to verify it.', 'heateor-login' ),
		'send_reg_email_acc_pass' => '1',
		'send_noti_email_admin' => '1',
		'login_redirect' => 'same',
		'login_redirect_custom' => '',
		'register_redirect' => 'same',
		'register_redirect_custom' => '',
		'gdpr_placement' => 'below',
		'privacy_policy_optin_text' => 'I have read and agree to Terms and Conditions of website and agree to my personal data being stored and used as per Privacy Policy',
		'tc_placeholder' => 'Terms and Conditions',
		'tc_url' => '',
		'ppu_placeholder' => 'Privacy Policy',
		'privacy_policy_url' => '',
		'enable_after_wc' => '1',
		'enable_wc_checkout' => '1',
		'custom_css' => ''
	) );

	add_option( 'heateor_fbl_version', HEATEOR_FBL_VERSION ) ;
}

/**
 * Plugin activation function
 */
function heateor_fbl_activate_plugin( $network_wide ) {
	global $wpdb;
	if ( function_exists( 'is_multisite' ) && is_multisite() ) {
		//check if it is network activation if so run the activation function for each id
		if ( $network_wide ) {
			$old_blog =  $wpdb->blogid;
			//Get all blog ids
			$blog_ids =  $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );

			foreach( $blog_ids as $blog_id ) {
				switch_to_blog( $blog_id );
				heateor_fbl_save_default_options();
			}
			switch_to_blog( $old_blog );
			return;
		}
	}
	heateor_fbl_save_default_options();
	set_transient( 'heateor-fbl-admin-notice-on-activation', true, 5 );
}
register_activation_hook( __FILE__, 'heateor_fbl_activate_plugin' );

/**
 * Links to show below the name of plugin at Plugins page
 */
function heateor_fbl_add_links ( $links ) {
    if ( is_array( $links ) ) {
	    $addons_link = '<a href="https://www.heateor.com/add-ons" target="_blank">' . __( 'Add-Ons', 'heateor-login' ) . '</a>';
	    $support_link = '<br/><a href="http://support.heateor.com" target="_blank">' . __( 'Support Documentation', 'heateor-login' ) . '</a>';
	    $settings_link = '<a href="admin.php?page=heateor-fbl-options">' . __( 'Settings', 'heateor-login' ) . '</a>';
	    
	    // place it before other links
		array_unshift( $links, $settings_link );
		
		$links[] = $addons_link;
		$links[] = $support_link;
	}
	
	return $links;
}
add_filter( 'plugin_action_links_heateor-login/heateor-login.php' , 'heateor_fbl_add_links' );

/**
 * Show notification to configure plugin after activation
 */
function heateor_fbl_configuration_notification() {
	if ( current_user_can( 'manage_options' ) ) {
		if ( get_transient( 'heateor-fbl-admin-notice-on-activation' ) ) { ?>
	        <div class="notice notice-success is-dismissible">
	            <p><strong><?php printf( __( 'Thanks for installing Heateor Login plugin', 'heateor-login' ), 'http://support.heateor.com/heateor-login-configuration' ); ?></strong></p>
	            <p>
					<a href="http://support.heateor.com/heateor-login-configuration" target="_blank" class="button button-primary"><?php _e( 'Configure the Plugin', 'heateor-login' ); ?></a>
				</p>
	        </div>
	        <?php
	        // delete transient, only display this notice once
	        delete_transient( 'heateor-fbl-admin-notice-on-activation' );
	    }

	    if ( defined( 'HEATEOR_SOCIAL_LOGIN_BUTTONS_VERSION' ) && version_compare( '1.1.16', HEATEOR_SOCIAL_LOGIN_BUTTONS_VERSION ) > 0 ) {
			?>
			<div class="error notice">
				<h3>Social Login Buttons</h3>
				<p><?php _e( 'Update "Social Login Buttons" add-on for compatibility with current version of Heateor Login', 'heateor-login' ) ?></p>
			</div>
			<?php
		}
	}
}
add_action( 'admin_notices', 'heateor_fbl_configuration_notification' );

/**
 * Update options based on plugin version check
 */
function heateor_fbl_update_options() {
	$current_version = get_option( 'heateor_fbl_version' );

	if ( $current_version && $current_version != HEATEOR_FBL_VERSION ) {
		if ( version_compare( "1.1.4", $current_version ) > 0 ) {
			global $heateor_fbl_options;
			$heateor_fbl_options['custom_css'] = '';
			update_option( 'heateor_fbl', $heateor_fbl_options );
		}
		update_option( 'heateor_fbl_version', HEATEOR_FBL_VERSION );
	}
}
add_action( 'plugins_loaded', 'heateor_fbl_update_options' );

/**
 * Check if a plugin is active
 */
function heateor_fbl_is_plugin_active( $plugin_file ) {
	return in_array( $plugin_file, apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
}

/**
 * Add column in the user list to delete social profile data
 */
function heateor_fbl_add_custom_column( $columns ) {
	$columns['heateor_fbl_delete_profile_data'] = __( 'Delete Social Profile', 'heateor-login' );
	return $columns;
}
add_filter( 'manage_users_columns', 'heateor_fbl_add_custom_column' );

/**
 * Show option to delete social profile in the custom column
 */
function heateor_fbl_delete_profile_column( $value, $column_name, $user_id ) {
	if ( 'heateor_fbl_delete_profile_data' == $column_name) {
		global $wpdb;
		$social_user = $wpdb->get_var( $wpdb->prepare( 'SELECT user_id FROM ' . $wpdb->prefix . 'usermeta WHERE user_id = %d and meta_key LIKE "heateor_fbl%"', $user_id ) );
		if ( $social_user > 0) {
			return '<a href="javascript:void(0)" title="' . __( 'Click to delete social profile data', 'heateor-login' ) . '" alt="' . __( 'Click to delete social profile data', 'heateor-login' ) . '" onclick="javascript:heateorFblDeleteSocialProfile(this, ' . $user_id . ')">' . __( 'Delete', 'heateor-login' ) . '</a>';
		}
	}
}
add_action( 'manage_users_custom_column', 'heateor_fbl_delete_profile_column', 1, 3 );

/**
 * Script to delete social profile
 */
function heateor_fbl_delete_social_profile_script() {
	global $parent_file;
	if ( $parent_file == 'users.php' ) {
		?>
		<script type="text/javascript">
			function heateorFblDeleteSocialProfile(elem, userId ) {
               	var parentElement = jQuery(elem).parent();
                jQuery(parentElement) .html( '<span><?php _e( 'Deleting', 'heateor-login' ); ?>...</span>' );
                jQuery.ajax({
                    type: 'GET',
                    url: '<?php echo get_admin_url() ?>admin-ajax.php',
                    data: {
                        action: 'heateor_fbl_delete_social_profile',
                        user_id: userId
                    },
                    success: function(data, textStatus, XMLHttpRequest) {
                        if (data == 'done' ) {
                            jQuery(parentElement) .html( '<?php _e( 'Deleted', 'heateor-login' ); ?>' );
                        } else {
                            jQuery(parentElement) .html( '<?php _e( 'Something bad happened', 'heateor-login' ); ?>' );
                        }
                    }
                });
            }
		</script>
		<?php
	}
}
add_action( 'admin_head', 'heateor_fbl_delete_social_profile_script' );

/**
 * Delete social profile of the user
 */
function heateor_fbl_delete_social_profile() {
	if ( isset( $_GET['user_id'] ) ) {
		$user_id = intval( trim( $_GET['user_id'] ) );
		global $wpdb;
		$wpdb->query( $wpdb->prepare( 'DELETE FROM '.$wpdb->prefix. 'usermeta WHERE user_id = %d and meta_key LIKE "heateor_fbl%"', $user_id ) );
		die( 'done' );
	}
	die;
}
add_action( 'wp_ajax_heateor_fbl_delete_social_profile', 'heateor_fbl_delete_social_profile' );