<?php
/**
 * Widget for Facebook Login
 */
class HeateorFacebookLoginWidget extends WP_Widget { 
	/** constructor */ 
	public function __construct() { 
		parent::__construct( 
			'HeateorFacebookLogin', //unique id 
			__( 'Heateor Facebook Login' ), //title displayed at admin panel
			array(  
				'description' => __( 'Let visitors login/register at your website using their Facebook account', 'heateor-login' ) ) 
			); 
	}
	
	/** This is rendered widget content */ 
	public function widget( $args, $instance ) {
		extract( $args ); 
		if ( $instance['hide_for_logged_in']==1 && is_user_logged_in() ) return;
		echo $before_widget;
		if ( ! empty( $instance['before_widget_content'] ) ) { 
			echo '<div>' . $instance['before_widget_content'] . '</div>';
		}
		if ( ! is_user_logged_in() ) {
			if ( ! empty( $instance['title'] ) ) { 
				$title = apply_filters( 'widget_title', $instance[ 'title' ] ); 
				echo $before_title . $title . $after_title;
			}
			echo heateor_fbl_render_facebook_login_button();
		} else {
			if ( ! empty( $instance['title_after'] ) ) { 
				$title = apply_filters( 'widget_title', $instance[ 'title_after' ] ); 
				echo $before_title . $title . $after_title;
			}
			global $user_ID;
			$userInfo = get_userdata( $user_ID );
			echo "<div style='height:80px;width:180px'><div style='width:63px;float:left;'>";
			echo @get_avatar( $user_ID, 60, '', '' );
			echo "</div><div style='float:left; margin-left:10px'>";
			echo str_replace( '-', ' ', $userInfo -> user_login );
			do_action( 'heateor_fbl_login_widget_hook', $userInfo -> user_login );
			echo '<br/><a href="' . wp_logout_url( esc_url( home_url() ) ) . '">' . __( 'Log Out', 'heateor-login' ) . '</a></div></div>';
		}
		echo '<div style="clear:both"></div>';
		if ( ! empty( $instance['after_widget_content'] ) ) { 
			echo '<div>' . $instance['after_widget_content'] . '</div>';
		}
		echo $after_widget; 
	}  

	/** Everything which should happen when user edit widget at admin panel */ 
	public function update( $new_instance, $old_instance ) { 
		$instance = $old_instance; 
		$instance['title'] = strip_tags( $new_instance['title'] ); 
		$instance['title_after'] = strip_tags( $new_instance['title_after'] ); 
		$instance['before_widget_content'] = $new_instance['before_widget_content']; 
		$instance['after_widget_content'] = $new_instance['after_widget_content']; 
		$instance['hide_for_logged_in'] = $new_instance['hide_for_logged_in'];  

		return $instance; 
	}  

	/** Widget options in admin panel */ 
	public function form( $instance ) { 
		/* Set up default widget settings. */ 
		$defaults = array( 'title' => __( 'Login with your Social Account', 'heateor-login' ), 'title_after' => '', 'before_widget_content' => '', 'after_widget_content' => '' );  

		foreach( $instance as $key => $value ) {  
			if ( is_string( $value ) ) {
				$instance[ $key ] = esc_attr( $value );  
			}
		}

		$instance = wp_parse_args( ( array )$instance, $defaults ); 
		?> 
		<p> 
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (before login):', 'heateor-login' ); ?></label> 
			<input style="width: 95%" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" /> 
			<label for="<?php echo $this->get_field_id( 'title_after' ); ?>"><?php _e( 'Title (after login):', 'heateor-login' ); ?></label> 
			<input style="width: 95%" class="widefat" id="<?php echo $this->get_field_id( 'title_after' ); ?>" name="<?php echo $this->get_field_name( 'title_after' ); ?>" type="text" value="<?php echo $instance['title_after']; ?>" /> 
			<label for="<?php echo $this->get_field_id( 'before_widget_content' ); ?>"><?php _e( 'Before widget content:', 'heateor-login' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'before_widget_content' ); ?>" name="<?php echo $this->get_field_name( 'before_widget_content' ); ?>" type="text" value="<?php echo $instance['before_widget_content']; ?>" /> 
			<label for="<?php echo $this->get_field_id( 'after_widget_content' ); ?>"><?php _e( 'After widget content:', 'heateor-login' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'after_widget_content' ); ?>" name="<?php echo $this->get_field_name( 'after_widget_content' ); ?>" type="text" value="<?php echo $instance['after_widget_content']; ?>" /> 
			<br /><br />
			<label for="<?php echo $this->get_field_id( 'hide_for_logged_in' ); ?>"><?php _e( 'Hide for logged in users:', 'heateor-login' ); ?></label> 
			<input type="checkbox" id="<?php echo $this->get_field_id( 'hide_for_logged_in' ); ?>" name="<?php echo $this->get_field_name( 'hide_for_logged_in' ); ?>" type="text" value="1" <?php if ( isset( $instance['hide_for_logged_in'] ) && $instance['hide_for_logged_in'] == 1 ) echo 'checked="checked"'; ?> /> 
		</p> 
		<?php 
	} 
} 
add_action( 'widgets_init', function() { return register_widget( "HeateorFacebookLoginWidget" ); } );