<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ){
    die();
}

function biztext_cform_menu_form_delete_plugin(){
    global $wpdb;

    delete_option('wpbiztext-cform');
    delete_option('biztext_custom_role_contact');
    
    if(get_option( 'biztext_custom_role' ) != 1) {
        
        remove_role('biztext_admin');
    
    }
    
}

biztext_cform_menu_form_delete_plugin();
?>