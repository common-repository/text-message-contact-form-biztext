<?php

/*
 *	Plugin Name: Text Message Contact Form 
 *	Plugin URI: http://biztextsolutions.com/
 *	Description: Receive a Text or email, from your website, with The Text Message Contact Form by Biz Text. SMS notification of email received, no apps are needed.
 *	Version: 2.0
 *	Author: Biz Text
 *  Author URI: https://www.biztextsolutions.com/
 *	License: GPL2
 *
*/

/*
 *	Assign global variables
 *	 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly


$plugin_url = plugins_url('', __FILE__);


$options = array();

$CFORM_options = array();

/*
 *	Add a link to our plugin in the admin menu
 *	under 'Settings > Biz Text'
 *
*/

// Check to see if custom role is already in DB

function biztext_custom_role_contact() {
    if ( get_option( 'biztext_custom_role_contact' ) < 1 ) {
        add_role( 'biztext_admin', 'Biz Text Admin', array( 'read' => true, 'level_0' => true ) );
        update_option( 'biztext_custom_role_contact', 1 );
    }
}
add_action( 'init', 'biztext_custom_role_contact' );

function biztext_cform_menu_form()
{

	/*
	 * 	Use the add_options_page function
	 * 	add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )
	 *
	*/
	
	// add the capatility to each role
	
    $editor = get_role('editor');
    $admin = get_role('administrator');
    $biztext_admin = get_role('biztext_admin');
    
    $editor->add_cap('biztext_contact_form_edit');
    $admin->add_cap('biztext_contact_form_edit');
    
    if ( $biztext_admin != null ) {
    
        $biztext_admin->add_cap('biztext_contact_form_edit');
    
    }

	add_menu_page(
		'Text Message Contact Form Plugin',
		'Biz Text',
		'biztext_contact_form_edit',
		'biz-text_form',
		'biztext_options_page_form',
		'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDE2IDE2IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwYXRoIGZpbGw9IiNFRTgxMjIiIGQ9Ik04LjEyNiwxLjkxOGMtNC40MTEsMC03Ljk5OCwyLjM1Mi03Ljk5OCw1LjI0MWMwLDEuMDM4LDAuNDc4LDIuMDQ4LDEuMzgxLDIuOTI0bDAuMDI0LDAuMDIzbDAuMDI0LDAuMDI1DQoJYzAuMTEyLDAuMTIsMC4yNTgsMC4yNjcsMC4zMTcsMC4zMmMwLjc5LDEsMC4yNywxLjQzMi0wLjk4OSwyLjYzOWMyLjk1NywwLjQzMiw1LjA5OS0wLjk1Miw1LjA5OS0wLjk1Mg0KCWMwLjU2MSwwLjAxNCwxLjEyMiwwLjA3NCwxLjYxNywwLjEyOWgwLjAwM2wwLjAyLDAuMDAxYzAuMzk2LDAuMDQ0LDAuODQ0LDAuMDkzLDEuMjI2LDAuMTAzbDAuMjgzLDAuMDAzDQoJYzMuOTg4LTAuMDA0LDYuOTk1LTIuMjQ0LDYuOTk1LTUuMjE1QzE2LjEyOCw0LjI3LDEyLjUzOCwxLjkxOCw4LjEyNiwxLjkxOHogTTQuMjkxLDcuNzU3Yy0wLjQ0MSwwLTAuODAzLTAuMjk5LTAuODAzLTAuNjY5DQoJYzAtMC4zNjksMC4zNjEtMC42NjksMC44MDMtMC42NjljMC40NDMsMCwwLjgwMiwwLjMsMC44MDIsMC42NjlDNS4wOTMsNy40NTgsNC43MzQsNy43NTcsNC4yOTEsNy43NTd6IE04LjAwMiw4LjI3Nw0KCWMtMC43ODUsMC0xLjQyNC0wLjUzMy0xLjQyNC0xLjE4OGMwLTAuNjU1LDAuNjM5LTEuMTg5LDEuNDI0LTEuMTg5YzAuNzg2LDAsMS40MjQsMC41MzQsMS40MjQsMS4xODkNCglDOS40MjYsNy43NDQsOC43ODgsOC4yNzcsOC4wMDIsOC4yNzd6IE0xMi4yNTgsOC43MzdjLTEuMDkyLDAtMS45NzgtMC43MzgtMS45NzgtMS42NDdjMC0wLjkxLDAuODg2LTEuNjUsMS45NzgtMS42NQ0KCWMxLjA5LDAsMS45NzYsMC43NCwxLjk3NiwxLjY1QzE0LjIzMyw3Ljk5OSwxMy4zNDgsOC43MzcsMTIuMjU4LDguNzM3eiIvPg0KPC9zdmc+DQo='
	);
	//implementation note: checks to see if text message plugin is active; 
	//users can change plugin names so its better to check if the text message plugin functions have been loaded
	if ( function_exists('biztext_options_page') && current_user_can('biztext_menu_access') ) {
	
		remove_menu_page('biz-text_form');
		add_submenu_page( 
			'biz-text', 
			'Biz Text Contact Form', 
			'Biz Text Contact Form', 
			'biztext_contact_form_edit', 
			'biz-text_form', 
			'biztext_options_page_form' 
		);
	} else {
	
	  add_submenu_page( 
			'biz-text_form', 
			'Biz Text Contact Form', 
			'Biz Text Contact Form', 
			'biztext_contact_form_edit', 
			'admin.php?page=biz-text_form', 
			'' 
		);
	
	
	}

	
}

add_action('admin_menu', 'biztext_cform_menu_form', 2);
// back end 
function biztext_styles_form($version){
    
    $my_css_ver = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'wpbiztext-cform.css' ));
	wp_enqueue_style('wpbiztext_cform_styles', plugins_url('wpbiztext-cform.css', __FILE__), 'false', $my_css_ver);
}

function biztext_scripts_form($version){

    $my_js_ver  = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'js/biztext_cform_script.js' ));
	wp_enqueue_script('wpbiztext_cform_script', plugins_url('js/biztext_cform_script.js', __FILE__), array(), $my_js_ver);
	
}

// front end 
function biztext_styles_form_front($version){
    
    $my_css_ver_front = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'wpbiztext-cform-front.css' ));
	wp_enqueue_style('wpbiztext_cform_styles_front', plugins_url('wpbiztext-cform-front.css', __FILE__), 'false', $my_css_ver_front);
}

function biztext_script_form_front($version){

    $my_js_ver_front  = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'js/biztext_cform_script_front.js' ));
	wp_enqueue_script('wpbiztext_cform_front_script', plugins_url('js/biztext_cform_script_front.js', __FILE__), array(), $my_js_ver_front);

}

add_action('wp_enqueue_scripts', 'biztext_styles_form_front');
add_action('wp_enqueue_scripts', 'biztext_script_form_front', 5);

if (isset($_GET['page'])) {

	if ($_GET['page'] == "biz-text_form") {

		add_action('admin_print_scripts', 'biztext_scripts_form', 5);
		add_action('admin_head', 'biztext_styles_form');
	}
}


function biztext_options_page_form(){

	if (!current_user_can('biztext_contact_form_edit')) {

		wp_die('You do not have sufficient permissions to access this page.');
	}

	//loading and storing cform data
	global $cform_options;

	// this saves and loads values from settings fields in database
	if (isset($_POST['wpbiztext-cform-settings-submit-button'])) {

		   $retrieved_nonce_settings = $_REQUEST['wpbiztext-cform-settings-nonce'];
		   if (!wp_verify_nonce($retrieved_nonce_settings,'biztext-cform-settings') ) wp_die( 'Failed security check' );

		$cform_settings_hidden_field = sanitize_text_field($_POST['wpbiztext-cform-settings-submitted']);
		
		if ($cform_settings_hidden_field == 'Y') {

			$fields_to_store = array(
				"wpbiztext-cform-biz-text-id",
				"wpbiztext-cform-auto-text-message-reply",
				"wpbiztext-cform-send-to-email",
				"wpbiztext-cform-send-to-email-comments-notify",
				"wpbiztext-cform-auto-text-message-reply-comments-notify",
				"wpbiztext-cform-google-recaptcha-key",
				"wpbiztext-cform-google-recaptcha-key-comments-notify",
				"wpbiztext-cform-web-id-verification",
				"wpbiztext-cform-text-notification-phone-number",
				"wpbiztext-email-text-options-radio"
				
			);

			//loop deals with processing values from form and storing it inside options area
			for ($x = 0; $x <= sizeof($fields_to_store) - 1; $x++) {

				$wpbiztext_field = "";

				if (strpos($fields_to_store[$x], "comments-notify")) {
					$wpbiztext_field = (isset($_POST["$fields_to_store[$x]"])) ? true : false;
				} else {
					$wpbiztext_field = sanitize_text_field($_POST["$fields_to_store[$x]"]);
				}

				$cform_options["$fields_to_store[$x]"] = $wpbiztext_field;
			}

			//this merges new values we processed with old values in the database
			//otherwise without merging, the database gets overwritten with the new values only
			$current_options = get_option('wpbiztext-cform', array());
			$merged_options = wp_parse_args($cform_options, $current_options);
			update_option('wpbiztext-cform', $merged_options);
		}
	}

	// this is just a repeat of the previous if statement except with fields specific to editing the form display
	if (isset($_POST['wpbiztext-cform-edit-submit-button'])) {

		$retrieved_nonce_form = $_REQUEST['wpbiztext-cform-edit-nonce'];
		if (!wp_verify_nonce($retrieved_nonce_form, 'biztext-cform-edit-form') ) wp_die( 'Failed security check' );

		$cform_edit_hidden_field = sanitize_text_field($_POST['wpbiztext-cform-edit-submitted']);

		if ($cform_edit_hidden_field == 'Y') {

			$fields_to_store = array(
				"wpbiztext-cform-phone-number-label",
				"wpbiztext-cform-phone-number-validation",
				"wpbiztext-cform-email-label",
				"wpbiztext-cform-email-validation",
				"wpbiztext-cform-name-label",
				"wpbiztext-cform-name-validation",
				"wpbiztext-cform-message-label",
				"wpbiztext-cform-message-validation",
				"wpbiztext-cform-message-required-comments-notify",
				"wpbiztext-cform-send-label",
				"wpbiztext-cform-subject-label",
				"wpbiztext-cform-subject-options",
				"wpbiztext-cform-subject-validation",
				"wpbiztext-cform-subject-required-comments-notify",
				"wpbiztext-cform-required-message",
				"wpbiztext-cform-reply-by-message",
				"wpbiztext-cform-success-message",
				"wpbiztext-cform-error-message",
				"wpbiztext-cform-classes",
				"wpbiztext-cform-fixed-width",
				"wpbiztext-cform-z-index",
				"wpbiztext-cform-icon-distance-from-top",
				"wpbiztext-cform-padding-from-top-of-form-window",
				"wpbiztext-cform-padding-from-bottom-of-form-window"
			);

			for ($x = 0; $x <= sizeof($fields_to_store) - 1; $x++) {

				$wpbiztext_field = "";

				if (strpos($fields_to_store[$x], "comments-notify")) {
					$wpbiztext_field = (isset($_POST["$fields_to_store[$x]"])) ? true : false;
				} else {
					$wpbiztext_field = sanitize_text_field($_POST["$fields_to_store[$x]"]);
					if ($fields_to_store[$x] == "wpbiztext-cform-subject-options") {
						$wpbiztext_field = explode(",", $wpbiztext_field);
					}
					if ($fields_to_store[$x] == "wpbiztext-cform-subject-send-classes") {
						$wpbiztext_field = explode(" ", $wpbiztext_field);
					}
				}

				$cform_options["$fields_to_store[$x]"] = $wpbiztext_field;
			}

			$current_options = get_option('wpbiztext-cform');
			$merged_options = wp_parse_args($cform_options, $current_options);
			update_option('wpbiztext-cform', $merged_options);
		}
	}

	//this if statement works similar to the previous if statements except its specifically for the checkbox that activates the form
	//ideally i would like to rewrite the if statements since processing the inputs and saving the data implementations are largely the same
	if (isset($_POST['wpbiztext-cform-activated-comments-notify'])) {
		$retrieved_nonce_activate = $_REQUEST['wpbiztext-cform-form-activation-nonce'];
		if (!wp_verify_nonce($retrieved_nonce_activate, 'biztext-cform-activate-form') ) wp_die( 'Failed security check' );

		$cform_form_activation_hidden_field = sanitize_text_field($_POST['wpbiztext-cform-form-activation-submitted']);

		if ($cform_form_activation_hidden_field == 'Y') {

			$fields_to_store = array(
				"wpbiztext-cform-activated-comments-notify"
			);

			for ($x = 0; $x <= sizeof($fields_to_store) - 1; $x++) {
				$wpbiztext_field = "";
				
				if (strpos($fields_to_store[$x], "comments-notify")) {
					//this line below deals specifically with the checkbox value returned by the form activation checkbox
					$wpbiztext_field = ($_POST["$fields_to_store[$x]"] == 1) ? true : false;
				} else {

					$wpbiztext_field = sanitize_text_field($_POST["$fields_to_store[$x]"]);
				}

				$cform_options["$fields_to_store[$x]"] = $wpbiztext_field;
			}

			$current_options = get_option('wpbiztext-cform');
			$merged_options = wp_parse_args($cform_options, $current_options);
			update_option('wpbiztext-cform', $merged_options);
		}
	}


	
	//give defaults to inputs
	if (!get_option('wpbiztext-cform')){
		$default_options = array();
		
		
		$default_options['wpbiztext-cform-biz-text-id'] = '';
		$default_options['wpbiztext-cform-google-recaptcha-key'] = '';
		$default_options['wpbiztext-cform-google-recaptcha-key-comments-notify'] = 0;
		$default_options['wpbiztext-cform-send-to-email-comments-notify'] = 0;
		$default_options['wpbiztext-cform-auto-text-message-reply-comments-notify'] = 0;
		$default_options['wpbiztext-cform-message-required-comments-notify'] = 0;
		$default_options['wpbiztext-cform-subject-required-comments-notify'] = 0;
		
		$default_options['wpbiztext-cform-auto-text-message-reply'] = 'Thank you for Your Text';
		$default_options['wpbiztext-cform-phone-number-label'] = 'Your Mobile Number';
		$default_options['wpbiztext-cform-auto-text-message-reply'] = 'Thank you for your Text.';
		$default_options['wpbiztext-cform-send-to-email'] = '';
		$default_options['wpbiztext-cform-phone-number-label'] = 'Your Mobile Number';
		$default_options['wpbiztext-cform-phone-number-validation'] = 'Enter a Valid Mobile Number';
		$default_options['wpbiztext-cform-email-label'] = 'Your Email';
		$default_options['wpbiztext-cform-email-validation'] = 'Enter a Valid Email';
		$default_options['wpbiztext-cform-name-label'] = 'Your Name';
		$default_options['wpbiztext-cform-name-validation'] = 'Enter Your Name';
		$default_options['wpbiztext-cform-message-label'] = 'Your Message';
		$default_options['wpbiztext-cform-message-validation'] = 'Enter Your Message';
		$default_options['wpbiztext-cform-send-label'] = 'Send Text Now';
		$default_options['wpbiztext-cform-required-message'] = 'Required fields';
		$default_options['wpbiztext-cform-reply-by-message'] = 'Receive a Reply by';
		$default_options['wpbiztext-cform-success-message'] = 'Form successfully submitted.';
		$default_options['wpbiztext-cform-error-message'] = 'Form was not able to be submitted.';
		$default_options['wpbiztext-cform-classes'] = '';
		$default_options['wpbiztext-cform-subject-label'] = 'Subject';
		$default_options['wpbiztext-cform-subject-options'] =  explode(",", "Contact, Info, Services, Other" );
		$default_options['wpbiztext-cform-subject-validation'] = 'Select a Subject';
		$default_options['wpbiztext-cform-activated-comments-notify'] = false;
		$default_options['wpbiztext-cform-fixed-width'] = "500";
		$default_options['wpbiztext-cform-web-id-verification'] = 'N';
		$default_options['wpbiztext-cform-z-index'] = '200';
		$default_options['wpbiztext-cform-icon-distance-from-top'] = 200;
		$default_options['wpbiztext-cform-text-notification-phone-number'] = "";
		$default_options['wpbiztext-cform-padding-from-top-of-form-window'] = 0;
		$default_options['wpbiztext-email-text-options-radio'] = "receive-email-text";
		$default_options['wpbiztext-cform-padding-from-bottom-of-form-window'] = 0;
		update_option('wpbiztext-cform', $default_options);

	} 

	$cform_loaded_options = get_option('wpbiztext-cform');

	//setting fields

	$wpbiztext_cform_biztext_web_id = $cform_loaded_options['wpbiztext-cform-biz-text-id'];

	$wpbiztext_cform_biztext_web_id_verification = $cform_loaded_options['wpbiztext-cform-web-id-verification'];
	
	$wpbiztext_cform_atext_message = $cform_loaded_options['wpbiztext-cform-auto-text-message-reply'];
	
	$wpbiztext_cform_email = $cform_loaded_options['wpbiztext-cform-send-to-email'];
	
	$wpbiztext_cform_enail_checkbx = $cform_loaded_options['wpbiztext-cform-send-to-email-comments-notify'];

	$wpbiztext_cform_atext_message_checkbx = $cform_loaded_options['wpbiztext-cform-auto-text-message-reply-comments-notify'];
	
	$wpbiztext_cform_recaptcha_checkbx = $cform_loaded_options['wpbiztext-cform-google-recaptcha-key-comments-notify'];
	
	$wpbiztext_cform_email_phone_number = $cform_loaded_options['wpbiztext-cform-text-notification-phone-number'];

	$wpbiztext_cform_email_text_option = $cform_loaded_options['wpbiztext-email-text-options-radio'];
	

	//phone numbers fields
	$wpbiztext_cform_phone_number_label = $cform_loaded_options['wpbiztext-cform-phone-number-label'];

	$wpbiztext_cform_phone_number_verification = $cform_loaded_options['wpbiztext-cform-phone-number-validation'];
	
	//email fields
	
	$wpbiztext_cform_email_label = $cform_loaded_options['wpbiztext-cform-email-label'];

	$wpbiztext_cform_emial_verification = $cform_loaded_options['wpbiztext-cform-email-validation'];

	//name fields				
	$wpbiztext_cform_name_label = $cform_loaded_options['wpbiztext-cform-name-label'];

	$wpbiztext_cform_name_validation = $cform_loaded_options['wpbiztext-cform-name-validation'];

	//message fields
	$wpbiztext_cform_message_label = $cform_loaded_options['wpbiztext-cform-message-label'];

	$wpbiztext_cform_message_validation = $cform_loaded_options['wpbiztext-cform-message-validation'];

	$wpbiztext_cform_message_required_checkbx = $cform_loaded_options['wpbiztext-cform-message-required-comments-notify'];

	//form activations
	$wpbiztext_cform_activate_form_checkbx = $cform_loaded_options['wpbiztext-cform-activated-comments-notify'];

	// subject fields
	$wpbiztext_cform_subject_label = $cform_loaded_options['wpbiztext-cform-subject-label'];

	$wpbiztext_cform_subject_options = $cform_loaded_options['wpbiztext-cform-subject-options'];

	$wpbiztext_cform_subject_validation = $cform_loaded_options['wpbiztext-cform-subject-validation'];

	$wpbiztext_cform_subject_required_checkbx = $cform_loaded_options['wpbiztext-cform-subject-required-comments-notify'];

	$wpbiztext_cform_recaptcha_key = $cform_loaded_options['wpbiztext-cform-google-recaptcha-key'];
	
	//form fields
	
	$wpbiztext_cform_required_message = $cform_loaded_options['wpbiztext-cform-required-message'];
    
    $wpbiztext_cform_reply_by_message = $cform_loaded_options['wpbiztext-cform-reply-by-message'];
	
	$wpbiztext_cform_send_label = $cform_loaded_options['wpbiztext-cform-send-label'];

	$cform_display_send_success_message = $cform_loaded_options['wpbiztext-cform-success-message'];

	$cform_display_send_error_message = $cform_loaded_options['wpbiztext-cform-error-message'];

	$cform_display_send_classes_message = $cform_loaded_options['wpbiztext-cform-classes'];
	
	$wpbiztext_cform_fixed_width = $cform_loaded_options['wpbiztext-cform-fixed-width'];

	$wpbiztext_cform_zindex = $cform_loaded_options['wpbiztext-cform-z-index'];

	$wpbiztext_cform_icon_distance = $cform_loaded_options['wpbiztext-cform-icon-distance-from-top'];

	$wpbiztext_cform_form_padding = $cform_loaded_options['wpbiztext-cform-padding-from-top-of-form-window'];

	$wpbiztext_cform_form_padding_bottom = $cform_loaded_options['wpbiztext-cform-padding-from-bottom-of-form-window'];
	
	require('inc/wpbiztext-contact-form.php');
}

function biztext_shortcode_form($atts, $content, $tag)
{

	global $post;

	extract(shortcode_atts(array(

		'devices' => '',
		'fixed' => '',
		'label' => 'Send Us A Text',
		'width' => '500',
		'subjects' => '',
		'button' => '',
		'email' => ''

	), $atts));

	$cform_loaded_options = get_option('wpbiztext-cform');

	$biztext_activated = $cform_loaded_options['wpbiztext-cform-activated-comments-notify'];
	$biztext_web_id_activated = $cform_loaded_options['wpbiztext-cform-web-id-verification'];
	$display_overide_subjects = "";

	require('inc/wpbiztext-contact-form-create.php');

	if ($devices == 'all') {

		$displayDev = "all";
	}
	
	if ($button != '' ){
	    
	    $cform_display_send_label = $button;
	    
	}
	
	if ($email == 'none'){
		$cform_display_email_use = 'false';
	}
	
	if ($email == 'both' ){
	    
	    $cform_display_email_use = 'true';
	    $wpbiztext_cform_email_text_display = 'receive-email-text';
	}
	
	if ($email == 'choose' ){
	    
		$cform_display_email_use = 'true';
		$wpbiztext_cform_email_text_display = 'reply-email-text';
		
	}
	
	if ($fixed == 'true') {
	
	    $display_fixed = 1;    
	    $display_logo = plugin_dir_url( dirname( __FILE__ ) ).'/text-message-form/images/bizTextIcon.png';
	    $display_width = $width;
	    $title = $label;
	    
	} else {
	
	    $display_width=0;
	
	
	}
	
	$biztext_cform_name = $label;
	
	if (trim($subjects) != ''){
	
	
	    $cform_display_subject = explode(",", $subjects);
	
	}
	
	if ($biztext_activated && $biztext_web_id_activated == 'Y') {

		ob_start();

		require('inc/front-end.php');

		$content = ob_get_clean();

		return $content;
	}
}

add_shortcode('BT_CONTACT_FORM', 'biztext_shortcode_form');

/* widget example https://codex.wordpress.org/Function_Reference/register_widget */


class Biztext_Form_Widget extends WP_Widget
{

	function __construct()
	{
		// Instantiate the parent object
		parent::__construct(
			false,
			__('Biz Text Contact Form Widget', 'wpb_widget_domain'),
			array('customize_selective_refresh' => true, 'description' =>  'Display your Biz Text Contact Form',)
		);
	}

	//process widget options and display with a description on page
	function widget($args, $instance)
	{
		// Widget output
		
		extract($args);
		
		
		
		$title = apply_filters('widget_title', $instance['wpbiztext_cform_title']);
		$display_text = $instance['wpbiztext_cform_text'];
		$display_devices = $instance['wpbiztext_cform_display'];
		$display_widget = $instance['wpbiztext_cform_show'];
		$display_fixed = $instance['wpbiztext_cform_fixed'];
		$display_width = ($instance['wpbiztext_cform_fixed_width'] == "" )? "500" : $instance['wpbiztext_cform_fixed_width'];
		$display_overide_subjects = $instance['wpbiztext_cform_overide_options'];
		$display_email_enable = $instance['wpbiztext_cform_email_enable'];
		$display_text_email_options = $instance['wpbiztext_cform_email_options_display'];


		//--- contact form info ---

		// add default to display, function, or make global varaible to avoid having to duplicate 

		require('inc/wpbiztext-contact-form-create.php');

		if ($display_devices == 1) {

			$displayDev = "all";
		}

        
		if ($display_email_enable == 1) {
			$cform_display_email_use = "true";

			if ($display_text_email_options == 'receive-email-text' ){
				$wpbiztext_cform_email_text_display = 'receive-email-text';
			}
			
			if ($display_text_email_options == 'reply-email-text' ){
				$wpbiztext_cform_email_text_display = 'reply-email-text';
				
			}
		}

		$biztext_activated = $cform_loaded_options_front['wpbiztext-cform-activated-comments-notify'];
		$biztext_web_id_activated = $cform_loaded_options_front['wpbiztext-cform-web-id-verification'];
		
		$biztext_cform_name = $title;

		$wpbiztext_widget_id = $this->id;
		if ($biztext_activated && $biztext_web_id_activated == 'Y') {

			if ($display_widget == 1) {

				require('inc/front-end.php');
			}
		}
	}

	//saves widget options to database
	function update($new_instance, $old_instance)
	{
		// Save widget options
		$instance = $old_instance;

		$instance['wpbiztext_cform_title'] = strip_tags($new_instance['wpbiztext_cform_title']);
		$instance['wpbiztext_cform_text'] = $new_instance['wpbiztext_cform_text'];
		$instance['wpbiztext_cform_display'] = strip_tags($new_instance['wpbiztext_cform_display']);
		$instance['wpbiztext_cform_show'] = strip_tags($new_instance['wpbiztext_cform_show']);
		$instance['wpbiztext_cform_fixed'] = strip_tags($new_instance['wpbiztext_cform_fixed']);
		$instance['wpbiztext_cform_fixed_width'] = strip_tags($new_instance['wpbiztext_cform_fixed_width']);
		$instance['wpbiztext_cform_overide_options'] = strip_tags($new_instance['wpbiztext_cform_overide_options']);
		$instance['wpbiztext_cform_email_enable'] = strip_tags($new_instance['wpbiztext_cform_email_enable']);
		$instance['wpbiztext_cform_email_options_display'] = strip_tags($new_instance['wpbiztext_cform_email_options_display']);
		
        return $instance;
        
	}

	//displays the form that will be used to set options of widget
	function form($instance)
	{
		// Output admin widget options form
		
		if(!isset($instance['wpbiztext_cform_title']) || empty($instance['wpbiztext_cform_title'])) { 
        $instance['wpbiztext_cform_title'] = ""; }
		if(!isset($instance['wpbiztext_cform_text']) || empty($instance['wpbiztext_cform_text'])) { 
        $instance['wpbiztext_cform_text'] = ""; }
		if(!isset($instance['wpbiztext_cform_display']) || empty($instance['wpbiztext_cform_display'])) { 
        $instance['wpbiztext_cform_display'] = ""; }
		if(!isset($instance['wpbiztext_cform_show']) || empty($instance['wpbiztext_cform_show'])) { 
        $instance['wpbiztext_cform_show'] = ""; }
		if(!isset($instance['wpbiztext_cform_fixed']) || empty($instance['wpbiztext_cform_fixed'])) { 
        $instance['wpbiztext_cform_fixed'] = ""; }
        if(!isset($instance['wpbiztext_cform_fixed_width']) || empty($instance['wpbiztext_cform_fixed_width'])) { 
        $instance['wpbiztext_cform_fixed_width'] = ""; }
		if(!isset($instance['wpbiztext_cform_overide_options']) || empty($instance['wpbiztext_cform_overide_options'])) { 
        $instance['wpbiztext_cform_overide_options'] = ""; }
		if(!isset($instance['wpbiztext-cform-send-to-email-comments-notify']) || empty($instance['wpbiztext-cform-send-to-email-comments-notify'])) { 
        $instance['wpbiztext-cform-send-to-email-comments-notify'] = ""; }
        if(!isset($instance['wpbiztext_cform_email_enable']) || empty($instance['wpbiztext_cform_email_enable'])) { 
        $instance['wpbiztext_cform_email_enable'] = ""; }
        if(!isset($instance['wpbiztext_cform_email_options_display']) || empty($instance['wpbiztext_cform_email_options_display'])) { 
        $instance['wpbiztext_cform_email_options_display'] = ""; }
		
		$title = esc_attr($instance['wpbiztext_cform_title']);
		$display_text = esc_attr($instance['wpbiztext_cform_text']);
	    $display_devices = esc_attr($instance['wpbiztext_cform_display']);
	    $display_widget = esc_attr($instance['wpbiztext_cform_show']);
	    $display_fixed = esc_attr($instance['wpbiztext_cform_fixed']);
	    $display_width = esc_attr($instance['wpbiztext_cform_fixed_width']);
	    $display_overide_subjects = esc_attr($instance['wpbiztext_cform_overide_options']);
	    
	    $display_use_email = (get_option('wpbiztext-cform')['wpbiztext-cform-send-to-email-comments-notify'] == 1)? "true" : "false"; 
	    
	  
		$display_email_enable = esc_attr($instance['wpbiztext_cform_email_enable']);

		$display_text_email_options = ($instance['wpbiztext_cform_email_options_display'] == "")? 'receive-email-text' : $instance['wpbiztext_cform_email_options_display'];
		$display_text_email_options = esc_attr($display_text_email_options);

		require('inc/widget-fields.php');
	}
}

//registers widget in wordpress 
function biztext_register_widget_form()
{
	register_widget('Biztext_Form_Widget');
}

//tells Wordpress to call this function on initialization
add_action('widgets_init', 'biztext_register_widget_form');

function biztext_removeslashes_form($string)

{
	$string = implode("", explode("\\", $string));
	return stripslashes(trim($string));
}


//two lines fire for both logged and not logged-in users; need both apparently
add_action('wp_ajax_biztext_send_email', 'biztext_send_email');
add_action('wp_ajax_nopriv_biztext_send_email', 'biztext_send_email');

function biztext_send_email() {
	
	//customer's email
	$sendTo = get_bloginfo( 'name' ) . "<" .get_option('wpbiztext-cform')['wpbiztext-cform-send-to-email'] . ">";
	//client email
	$email = sanitize_email($_REQUEST['email']);
	//name of client
	$name = sanitize_text_field($_REQUEST['name']);
	//name of form
	$form = sanitize_text_field($_REQUEST['form']);
	//client name + email for reply to
	$from = $name . ' <' . $email . '>'; 
	

	//option from select element
	$subject_type = sanitize_text_field($_REQUEST['subject']);
	

	$message = sanitize_text_field($_REQUEST['message']);
	
	
	$to = $sendTo;
	$full_message = $from . "\r\n" . 
					"Subject:" . $subject_type . "\r\n" . 
					"Message:" . $message . "\r\n";
    
    $full_message = wordwrap($full_message, 70, "\r\n");
    
	
	$subject = "From " . get_bloginfo( 'name' ) . " contact form " . $form;
	$headers = "From: " . $sendTo . "\r\n" .
					"Reply-To: " . $from . "\r\n";
	
	if ($to !== '' && $subject !== '' && $full_message !== '' && $headers !== ''){
		echo wp_mail($to, $subject, $full_message, $headers);
	}
	die();
}


