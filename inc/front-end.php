<?php


if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Check that the class exists before trying to use it
if (!class_exists('Mobile_Detect')) {

    require_once 'Mobile_Detect.php';
} 

include_once 'wpbiztext-front-end.php'; 

$detect = new Mobile_Detect;

    
if (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') && !strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') && $displayDev != 'all') {
    $BizTextbrowserUsed = 'Safari';
    ?>
    <style>
        @media screen and (max-width: 1024px){
            #<?php $wpbiztext_widget_id ?> {
                display: none;
            }

            #wpbiztext-cform-fixed {
                display: none;
            }
        }
       
    </style>
    <?php
}

$bt_cform_label = array($cform_display_phone_label, $cform_display_name_label, $cform_display_subject_label, $cform_display_message_label);
$bt_cform_requried = array($cform_display_phone_requried, $cform_display_name_requried, $cform_display_subject_requried, $cform_display_message_requried);
$bt_cform_id =  array("phone", "name","subject", "message");

if ($cform_display_email_use == "true") {
    
    $insert_label = array( $cform_display_email_label ); 
    array_splice( $bt_cform_label, 1, 0, $insert_label); 

    $insert_requried = array($cform_display_name_requried); 
    array_splice( $bt_cform_requried, 1, 0, $insert_requried); 

    $insert_id = array( 'email' ); 
    array_splice( $bt_cform_id, 1, 0, $insert_id ); 

}

// Any mobile device (phones or tablets).
if (!$detect->isMobile() || $displayDev == "all") {


    if (isset($before_widget)) {echo $before_widget;}
  
    if (isset($display_fixed)){
        if ($display_fixed != 1){

            echo $before_title . $title . $after_title;
    
        } else {
        
            echo  "<div id='wpbiztext-cform-fixed' class='wpbiztext-cform-fixed'>";
            echo  "<button id='wpbiztext-cform-fixed-button' class='wpbiztext-cform-fixed-button' onclick='openBizTextForm()'><svg  viewBox='0 0 55.3 46.63'>
                    <path class='st14' d='M27.65,4.17c-12.52,0-22.71,8-22.71,17.83c0,3.53,1.35,6.98,3.91,9.95l0.07,0.09L9,32.12
	                c0.32,0.4,0.73,0.89,0.91,1.08c2.24,3.4,0.75,4.87-2.81,8.98c8.4,1.48,14.47-3.23,14.47-3.23c1.59,0.04,3.19,0.24,4.59,0.44h0.02
	                l0.05,0.01c1.13,0.15,2.41,0.32,3.48,0.35l0.81,0c11.32,0,19.85-7.63,19.85-17.74C50.35,12.16,40.17,4.17,27.65,4.17z M16.75,24.03
	                c-1.25,0-2.27-1.02-2.27-2.27c0-1.26,1.02-2.28,2.27-2.28c1.26,0,2.28,1.02,2.28,2.28C19.03,23.01,18.02,24.03,16.75,24.03z
	                M27.29,25.8c-2.23,0-4.04-1.81-4.04-4.03c0-2.23,1.81-4.05,4.04-4.05c2.23,0,4.04,1.81,4.04,4.05
	                C31.33,23.99,29.53,25.8,27.29,25.8z M39.37,27.36c-3.1,0-5.62-2.51-5.62-5.6c0-3.1,2.52-5.61,5.62-5.61c3.09,0,5.61,2.51,5.61,5.61
	                C44.98,24.85,42.46,27.36,39.37,27.36z'/>

                    </svg></button>";
            echo    "<span id='wpbiztext-cform-fixed-button-text' class='wpbiztext-cform-fixed-button-text' onclick='openBizTextForm()'>$title</span>";
            
            echo    "<div class='wpb-form-fixed-wrapper'>";
            echo    "<span class='wpbiztext-cform-fixed-close' onclick='closeBizTextForm()'>&#10006;</span>";
        
        }
    }

    ?>

    <div class="wpbiztext-cform-wrapper">
        <iframe name="empty_iframe_form" ></iframe>
        <form name="wpbiztext-cform-frontend" method="POST" data-formname="<?php echo $biztext_cform_name?>" class="<?php echo $cform_display_classes?>" action="" target="empty_iframe_form">

            <?php
                
                if (isset($display_text)) {echo $display_text;}
                
             
                echo "<p>*$wpbiztext_cform_display_required</p>";
                echo "<input type='hidden' name='wpbiztext-cform-frontend-submitted' value='Y' />";
            
                if ($cform_display_email_use == "true" && $wpbiztext_cform_email_text_display == 'reply-email-text'){
                
                    echo "<div class='wpbiztext-cform-row'>";
                    echo "$wpbiztext_cform_display_reply_by: ";
                    echo "<label class='wpbiztext-cform-by' for='wpbiztext-cform-by-text'>Text:</label>";
                    echo "<input type='radio' name='wpbiztext-cform-by' onclick='receiveBy(this.form);' value='text' checked>";
                    echo "<label class='wpbiztext-cform-by' for='wpbiztext-cform-by-email'>Email:</label>";
                    echo "<input type='radio' name='wpbiztext-cform-by' onclick='receiveBy(this.form);' value='email'>";
                    echo "</div>";
                }

                for ($x = 0; $x < count($bt_cform_id); $x++) {
                    
                    $display_field_rows = ($bt_cform_id[$x] == 'email') ? 'none' : 'block';
                    if ($cform_display_email_use == "true" && $wpbiztext_cform_email_text_display == 'receive-email-text'){
                        $display_field_rows = 'block';
                    }
                    echo "<div class='wpbiztext-cform-row wpbiztext-fieldtype-$bt_cform_id[$x]' style='display: $display_field_rows' >";
                    echo "<label class='wpbiztext-cform-$bt_cform_id[$x]' for='wpbiztext-cform-$bt_cform_id[$x]'>$bt_cform_requried[$x]$bt_cform_label[$x]</label>";
                 
                    
                    if ($bt_cform_id[$x] == "phone" || $bt_cform_id[$x] == "name" || $bt_cform_id[$x] == "email"){
                    
                        $max_length = ($bt_cform_id[$x] == "phone") ? "Maxlength='10'" : ""; 
                        $validatedNum = ($bt_cform_id[$x] == "phone" ) ? "oninput='btFormatNumber(this.form)'" : "";
                        
                        echo "<input type='text' name='wpbiztext-cform-$bt_cform_id[$x]' $validatedNum $max_length > ";
                        
                    
                    } 
                    
                    if ($bt_cform_id[$x] == "subject") {
                    
                        echo "<select name='wpbiztext-cform-$bt_cform_id[$x]'>";
                        echo $cform_display_subject;
                        echo "<option value='' disabled selected> ---- Select a Subject --- </option>";
                        for ($y = 0; $y <= sizeof($cform_display_subject) - 1; $y++) {

                            echo "<option value='$cform_display_subject[$y]'>$cform_display_subject[$y]</option>";
                            
                        }
                        echo "</select>";
                    
                    }
                    
                    if ($bt_cform_id[$x] == "message") {
                    
                        echo "<textarea name='wpbiztext-cform-$bt_cform_id[$x]' rows='5'></textarea>";
                    
                    }

                    echo "<span class='error-wpbiztext-cform-$bt_cform_id[$x]'></span>";
                    echo "</div>";
                }
                
                echo '<div class="g-recaptcha"></div>';
                echo "<span class='error-wpbiztext-cform-ecaptcha'></span>";
                echo "<span class='success-wpbiztext-cform-sent'></span>";
                echo "<span class='error-wpbiztext-cform-sent'></span>";
                echo "<div style='margin-top:25px;'><input type='button' name='cform_widget_submit' onclick='sendText(this.form)' value='$cform_display_send_label'></div>";
                echo "</form>";
           
                echo "<small><a href='https://www.biztextsolutions.com/'>Service by Biz Text</a></small>";
                echo "</div>";	
                
              
                if (isset($display_fixed)){
                    
                    if ($display_fixed == 1){
                        echo  "</div>";
                        echo  "</div>";
                    
                                                
    
                    }
                
                }
      
            if (isset($after_widget)) {echo $after_widget;}
            
        } else {

            echo $before_widget;

            echo "<span class='" . $biz_noshow . "'></span>";

            echo $after_widget;
        }

        ?>

 
      