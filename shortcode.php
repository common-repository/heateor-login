<?php
/** 
 * Shortcode for Facebook Login
 */ 
function heateor_fbl_login_shortcode( $params ) {
		extract( shortcode_atts( array (
			'style' => '',
			'show_username' => 'OFF'
		), $params ) );
		if ( $show_username == 'ON' && is_user_logged_in() ) {
			global $user_ID;
			$userInfo = get_userdata( $user_ID );
			$html = "<div style='height:80px;width:180px'><div style='width:63px;float:left;'>";
			$html .= @get_avatar( $user_ID, 60, $default, $alt );
			$html .= "</div><div style='float:left; margin-left:10px'>";
			$html .= str_replace( '-', ' ', $userInfo -> user_login );
			$html .= '<br/><a href="' . wp_logout_url( esc_url ( home_url() ) ) . '">' . __( 'Logout', 'heateor-login' ) . '</a></div></div>';
		} else {
			$html = '<div ';
			// style 
			if ( $style != "" ) {
				if ( strpos( $style, 'float' ) === false ) {
					$style = 'float: left;' . $style;
				}
				$html .= 'style="' . $style . '"';
			}
			$html .= '>';
			$html .= heateor_fbl_render_facebook_login_button();
		}
		return $html;
}
add_shortcode( 'Heateor_Facebook_Login', 'heateor_fbl_login_shortcode' );