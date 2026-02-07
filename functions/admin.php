<?php
/**
 * Admin functions
 * ext Domain: wprs //please change text domain globally
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//add options page
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'General Settings',
        'menu_title'    => 'Site Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

//add superadmin class 
function wprs_add_role_to_body($classes) {
    global $current_user;
    if($current_user->ID === 1){
        $classes .= 'role-superadmin';
    } else {
        $classes .= 'role-user';
    }
    return $classes;
}
add_filter('admin_body_class', 'wprs_add_role_to_body');

//disable plugin updates
function wprs_filter_plugin_updates( $value ) {
    if( isset( $value->response['all-in-one-wp-migration/all-in-one-wp-migration.php'] ) ) {        
        unset( $value->response['all-in-one-wp-migration/all-in-one-wp-migration.php'] );
    }
    return $value;
}
add_filter( 'site_transient_update_plugins', 'wprs_filter_plugin_updates' );

//wpadminbar css
if(is_user_logged_in()) add_action('wp_footer', 'wprs_add_adminbar_css');
function wprs_add_adminbar_css(){
    echo '<style>html {margin-top: 0!important;}#wpadminbar{opacity: .1;}#wpadminbar:hover{opacity: 1;}</style>';
}