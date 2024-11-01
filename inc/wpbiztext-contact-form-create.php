<?php 		
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

        $cform_loaded_options_front = get_option('wpbiztext-cform');
	    $cform_display_phone_label = $cform_loaded_options_front['wpbiztext-cform-phone-number-label'];
	    $cform_display_phone_requried =  "*";
	    
	    $cform_display_email_label = $cform_loaded_options_front['wpbiztext-cform-email-label'];
	    $wpbiztext_cform_email_to = $cform_loaded_options_front['wpbiztext-cform-send-to-email'];
	    $cform_display_email_use = ($cform_loaded_options_front['wpbiztext-cform-send-to-email-comments-notify'] == 1)? "true" : "false";
	    $cform_display_email_requried =  "*";
	    
	    $cform_display_name_label = $cform_loaded_options_front['wpbiztext-cform-name-label'];
		$cform_display_name_requried = "*" ;
		
		$wpbiztext_cform_email_text_display = $cform_loaded_options_front['wpbiztext-email-text-options-radio'];
	    
	    $cform_display_message_label = $cform_loaded_options_front['wpbiztext-cform-message-label'];
	    $cform_display_message_requried =  "*";
	    $cform_display_send_label = $cform_loaded_options_front['wpbiztext-cform-send-label'];
	    $cform_display_subject_label = $cform_loaded_options_front['wpbiztext-cform-subject-label'];
	    $cform_display_subject_requried = ($cform_loaded_options_front['wpbiztext-cform-subject-required-comments-notify'] == 1) ? "*" : "";
		$cform_display_subject = (trim($display_overide_subjects) == "") ? $cform_loaded_options_front['wpbiztext-cform-subject-options'] : explode(",", $display_overide_subjects);
		$cform_enable_auto_message = $cform_loaded_options_front['wpbiztext-cform-auto-text-message-reply-comments-notify'];
		$cform_display_auto_message = $cform_loaded_options_front['wpbiztext-cform-auto-text-message-reply'];
		$cform_display_web_id = $cform_loaded_options_front['wpbiztext-cform-biz-text-id'];
		$cform_display_key = $cform_loaded_options_front['wpbiztext-cform-google-recaptcha-key'];
		$cform_display_send_success_message = $cform_loaded_options_front['wpbiztext-cform-success-message'];
		$cform_display_send_error_message = $cform_loaded_options_front['wpbiztext-cform-error-message'];
		$cform_display_classes = $cform_loaded_options_front['wpbiztext-cform-classes'];
		
		
		$wpbiztext_cform_display_required = $cform_loaded_options_front['wpbiztext-cform-required-message'];
		$wpbiztext_cform_display_reply_by = $cform_loaded_options_front['wpbiztext-cform-reply-by-message'];
		
		
		$wpbiztext_cform_display_number_validation = $cform_loaded_options_front['wpbiztext-cform-phone-number-validation'];
		$wpbiztext_cform_display_email_validation = $cform_loaded_options_front['wpbiztext-cform-email-validation'];
		$wpbiztext_cform_display_name_validation = $cform_loaded_options_front['wpbiztext-cform-name-validation'];
		$wpbiztext_cform_display_message_validation = $cform_loaded_options_front['wpbiztext-cform-message-validation'];
		$wpbiztext_cform_display_subject_validation = $cform_loaded_options_front['wpbiztext-cform-subject-validation'];
		
		$cform_display_recaptcha = ($cform_loaded_options_front['wpbiztext-cform-google-recaptcha-key-comments-notify'] == 1) ? true : false;
		
		$cform_fixed_width_main = $cform_loaded_options_front['wpbiztext-cform-fixed-width'];
		
		$wpbiztext_cform_display_zindex = $cform_loaded_options_front['wpbiztext-cform-z-index'];

		$wpbiztext_cform_display_icon_distance = $cform_loaded_options_front['wpbiztext-cform-icon-distance-from-top'];
	
		$wpbiztext_cform_display_email_phone_number = $cform_loaded_options_front['wpbiztext-cform-text-notification-phone-number'];
		
		$wpbiztext_cform_display_form_padding =$cform_loaded_options_front['wpbiztext-cform-padding-from-top-of-form-window'];

		$wpbiztext_cform_display_form_padding_bottom = $cform_loaded_options_front['wpbiztext-cform-padding-from-bottom-of-form-window'];
	    
?>	    