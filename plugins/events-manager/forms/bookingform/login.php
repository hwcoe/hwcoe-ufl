<?php
/* 
 * This file generates the default login form within the booking form (if enabled in options).
 */
?>
<div class="em-login">
		<div class="em-login-content">
			<p><?php esc_html_e('Log in if you already have an account with us.','events-manager'); ?></p>
			<form class="em-form em-login-form" action="<?php echo site_url('wp-login.php', 'login_post'); ?>" method="post">
				<p>
					<label><?php esc_html_e( 'Username','events-manager') ?></label>
					<input type="text" name="log" class="input" value="">
				</p>
				<p>
					<label><?php esc_html_e( 'Password','events-manager') ?></label>
					<input type="password" name="pwd" class="input" value="">
				</p>
				<?php do_action('login_form'); ?>
		   	<div class="em-login-actions">
		    	<div class="em-login-buttons">
					<button type="submit" name="wp-submit" class="button-primary em-login-submit btn"><?php esc_attr_e('Log In', 'events-manager'); ?></button>
					<button type="button" class="em-login-cancel btn"><?php esc_html_e('Cancel', 'events-manager'); ?></button>
					<input type="hidden" name="redirect_to" value="<?php echo esc_url($_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']); ?>#em-booking">
				</div>
				<div class="em-login-meta">
					<label class="em-login-rememberme"><input name="rememberme" type="checkbox" value="forever"> <?php esc_html_e( 'Remember Me','events-manager') ?></label>
					<div class="em-login-links">
						<?php
						//Signup Links
						if ( get_option('users_can_register') ) {
							if ( function_exists('bp_get_signup_page') ) { //Buddypress
								$register_link = bp_get_signup_page();
							}elseif ( file_exists( ABSPATH."/wp-signup.php" ) ) { //MU + WP3
								$register_link = site_url('wp-signup.php', 'login');
							} else {
								$register_link = site_url('wp-login.php?action=register', 'login');
							}
							?>
							<a href="<?php echo $register_link ?>"><?php esc_html_e('Sign Up','events-manager') ?></a>
							<?php
						}
						?>
						<a href="<?php echo site_url('wp-login.php?action=lostpassword', 'login') ?>" title="<?php esc_html_e('Password Lost and Found', 'events-manager') ?>"><?php esc_html_e('Lost your password?', 'events-manager') ?></a>
						
					</div>
				</div>
			</div>
		</form>
	</div>
</div>