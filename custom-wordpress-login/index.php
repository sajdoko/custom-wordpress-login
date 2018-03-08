<?php
/**
 * Plugin Name: Custom Wordpress Login
 * Description: Customize Wordpress login page
 * Plugin URI:  https://#
 * Author:      Sajmir Doko
 * Author URI:  https://proweb.al
 * Version:     1.0.0
 * Text Domain: custom-wordpress-login
 * Prefix:      cw_login
 */


// Enqueue css and js
function cw_login_enqueue_style() {
	wp_enqueue_style( 'cu-login-css', plugin_dir_url( __FILE__ ) . '/css/cu-login-style.css', array(), '1.0.0', false ); 
}
function cw_login_enqueue_script() {
	wp_enqueue_script( 'cu-login-script-js', plugin_dir_url( __FILE__ ) . '/js/cu-login-script.js', array(), '1.0.0', false );
}
add_action( 'login_enqueue_scripts', 'cw_login_enqueue_style', 10 );
add_action( 'login_enqueue_scripts', 'cw_login_enqueue_script', 1 );


// Link on custom logo
function cw_login_logo_url() {
    return get_bloginfo('url');
}
add_filter('login_headerurl', 'cw_login_logo_url');

// Alter text on custom logo
function cw_login_logo_url_title() {
    return 'Your Site Name and Info';
}
add_filter('login_headertitle', 'cw_login_logo_url_title');

// If not administrator, redirect to homepage
function admin_login_redirect($redirect_to, $request, $user) {
    global $user;
    if (isset($user->roles) && is_array($user->roles)) {
        if (in_array("administrator", $user->roles)) {
            return $redirect_to;
        } else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}
add_filter("login_redirect", "admin_login_redirect", 10, 3);