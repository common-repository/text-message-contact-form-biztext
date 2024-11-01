<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  

function biztext_site_url_form()
{
    if (isset($_SERVER['HTTPS'])) {
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    } else {
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'];
}

?>

<div class="wrap biz-text-cform-wrapper">

    <div id="icon-options-general" class="icon32"></div>

    <div id="poststuff">

        <!-- main content -->
        <div id="post-body-content">

            <div class="meta-box-sortables ui-sortable">

                <div class="postbox">

                    <div class="inside">

                        <img class='' id="bizTextLogo" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ).'images/Biz Text Logo Colour.svg'; ?>" alt="Biz Text Logo" width="200">
                        <?php
                        if (!function_exists('biztext_options_page')) {
                            $wp_plugin_search_url = get_home_url() . "/wp-admin/plugin-install.php?s=biz+text&tab=search&type=term";
                            echo "<br><p class='biztext-highlight-info' style='font-size:120%'>To receive, reply, and send Texts and to display a button and or link for mobile, install the <a href=$wp_plugin_search_url target='_self'>Biz Text Text Message Plugin</a>.</b><br>
                                  You can also find our Biz Text plugin by searching for 'Biz Text' in the Adding Plugins page in the Wordpress Dashboard.</b></p>";
                        }
                       
                        ?>

                        <!-- start of form -->
                        <form id="wpbiztext-cform-settings" name="wpbiztext-cform-settings" method='post' action=''>
                        
                            <?php
							
							    if ( function_exists('wp_nonce_field') ) {
                                    wp_nonce_field('biztext-cform-settings', 'wpbiztext-cform-settings-nonce'); 
                                }	
											
							?>	

                            <input type="hidden" name="wpbiztext-cform-settings-submitted" value="Y" />

                            <h3>Settings</h3>

                            <input id='wpbiztext-cform-web-id-verification' name='wpbiztext-cform-web-id-verification' type='hidden' value='<?php echo $wpbiztext_cform_biztext_web_id_verification?>'>
                            
                            <table class="form-table left-indent">

                                <?php
                                // create rows for settings
                                $wpbiztext_verification_text = ($wpbiztext_cform_biztext_web_id_verification  == 'Y') ? "Biz Text Id is verified" : "BizText Id is not verified";
                                $wpbiztext_verification_class = ($wpbiztext_cform_biztext_web_id_verification  == 'Y') ? 'biz-text-verification-success' : 'biz-text-verification-failure';
                                $wpbiztext_display_verification = "<p id='biztext-verification-text' class='$wpbiztext_verification_class'>".$wpbiztext_verification_text."</p><br>";

                                $biztext_web_id_input_msg = 'Copy your Biz Text Id, paste, and verify to use the contact form.<br>To find your Biz Text Id, go to your Texting Dashboard, click My Account, and look under Biz Numbers.<br>If you do not have a Biz Text Number, sign up at: <a href="https://www.biztextsolutions.com/pricing/" target="_blank">biztextsolutions.com/pricing/</a>.';
                                    
                                    
                                    echo makeRow("Biz Text Id", $wpbiztext_cform_biztext_web_id, $wpbiztext_display_verification.$biztext_web_id_input_msg, true, "", "");
                                   
                                    
                                ?>
                                    <script>
                                        if ('<?php echo $wpbiztext_cform_biztext_web_id_verification ?>' =='Y'){
                                            document.getElementById('wpbiztext-cform-biz-text-id').readOnly = true;
                                        }
                                    </script>
                                <?php
                                    
                                    $verification_text = "";
                                    if ($wpbiztext_cform_biztext_web_id_verification  == 'Y'){
                                        
                                        echo makeRowText("<button type='button' id='bt-verify-button' class='button-secondary' onclick='editBizTextWebId(this.form)'>Edit Biz Text Id</button>", '');
                                    } else {
                              
                                        echo makeRowText("<button type='button' id='bt-verify-button' class='button-secondary' onclick='bizTextVerify(this.form)'>Verify Biz Text Id</button>", '');
                                    }
                              
                                    echo makeRow("Auto Text Message Reply", $wpbiztext_cform_atext_message, "Customize the beginning of your reply message.", true, "", "");
                                    echo makeRow("Google Recaptcha Key", $wpbiztext_cform_recaptcha_key, "show", true, "", $wpbiztext_cform_recaptcha_checkbx);
                                    echo makeRowText("Recaptacha will protect your site from spam and abuse. <br>To obtain a Google recaptcha key and learn more, go to: <a href='https://www.google.com/recaptcha/intro/v3.html' target='_blank'>google.com/recaptcha/intro/v3.html</a>", '');
                                    echo "</table>";
                                    echo "<h4 class='biz-text-cform-accordion left-indent'><span style='padding-left:10px;'>Allow to Receive Email</span></h4>";
                                    echo "<div class='panel'>";
                                    echo "<table class='form-table left-indent'>";
                                    echo makeRow("Send to Email", $wpbiztext_cform_email, "show", true, "", $wpbiztext_cform_enail_checkbx);
                                    
                                    $receive_checked = ($wpbiztext_cform_email_text_option == 'receive-email-text') ? 'checked' : '';
                                    $reply_checked = ($wpbiztext_cform_email_text_option == 'reply-email-text') ? 'checked' : '';
                                  
                                    echo makeRowText("<label title='g:i a'><input type='radio' id='receive-email-text' name='wpbiztext-email-text-options-radio' value='receive-email-text' $receive_checked >Both Text and Email</label>", ['email-text-options', $wpbiztext_cform_enail_checkbx]);
                                    echo makeRowText("<label title='g:i a'><input type='radio' id='reply-email-text' name='wpbiztext-email-text-options-radio' value='reply-email-text' $reply_checked >Choose Reply by Text or Email</label>", ['email-text-options', $wpbiztext_cform_enail_checkbx]);
                                    
                                    // echo makeRowText("<label for='reply-email-text-comments-notify'><input type='checkbox' checked='checked' name='reply-email-text-comments-notify'>Enable Option for Reply By Email and Text</label>");       
                                    echo makeRowText("Enabling will give your visitors the option to receive a reply by Text or Email.<br>
                                                        If reply by email is enabled, a text notification about the email is also sent to you.", '' );   
                                    echo makeRowText("Biz Text uses PHP wp_mail(). Use a third party SMTP plugin to configure SMTP", '');       
                                                         
                                    // echo makeRow('', $fieldName[$x][$y + 1], $y, false, $fieldName[$x][0], );
                                    
                                    echo makeRow("Text Notification Phone Number", $wpbiztext_cform_email_phone_number, "Enter your Biz Text Number or a mobile phone number <br> to be sent a notification of an email.", true, "", false);
                                    
                                    echo "</table>";
                                    echo "</div><table class='form-table left-indent'>";

                                ?>
                                
                
                                <tr>
                                    <td colspan='2'><input class="button-primary" type="submit" name="wpbiztext-cform-settings-submit-button" value="Save Settings" id="wpbiztext-cform-settings-submit-button"> </td>
                                </tr>
                            </table>

                        </form>

                        <form id="wpbiztext-cform-edit" name="wpbiztext-cform-edit" method='post' action=''>
                        
                            <?php
							
							    if ( function_exists('wp_nonce_field') ) {
                                    wp_nonce_field('biztext-cform-edit-form', 'wpbiztext-cform-edit-nonce'); 	
                                }
											
							?>	

                            <input type="hidden" name="wpbiztext-cform-edit-submitted" value="Y" />
                            
                            <h3 class="biz-text-cform-accordion">1) Fields and Labels for Contact Form</h3>
                            
                            <div class="panel">

                                <table class="form-table left-indent">

                                    <?php
                                    function createInputName($name)
                                    {

                                        return 'wpbiztext-cform-' . str_replace(' ', '-', strtolower($name));
                                    }

                                    // create rows in table
                                    function makeRow($label, $inputValue, $checkboxUse, $isSettings, $nameValue, $checkBoxValue)
                                    {
                                        // makeRow(label,value of input, 2 - shows checkbox "show" - shows checkbox with label)
                                        $idName = "";

                                        if ($isSettings) {
                                            $idName = createInputName($label);
                                        } else {
                                            $idName = createInputName($nameValue . " " . $label);
                                        }
                                        
                                        $labelDisplay  = $label;
                                        
                                        if ($label == "Label") {
                                        
                                            $labelDisplay = $label . " Name";
                                        
                                        }
                                        
                                        if ($label == "Validation") {
                                        
                                            $labelDisplay = $label . " Message";
                                            
                                        }

                                        echo "<tr>
                                              <td class='label-td-form'>$labelDisplay</td>
                                              <td>";


                                        if ($checkboxUse == 2) {
                                            if ($checkBoxValue) {
                                                echo "<input type='checkbox' checked='checked' name='$idName-comments-notify'>";
                                            } else {
                                                echo "<input type='checkbox' name='$idName-comments-notify'>";
                                            }
                                        } else {
                                        
                                                $inputTypeUse = ($checkBoxValue == "password" ) ? $checkBoxValue : "text"; 
                                                echo "<input type='$inputTypeUse' id = '$idName' name='$idName' Value='$inputValue' class='regular-text wpbiztext-styles'>";
                                            if ($checkboxUse === "show") {

                                                if ($checkBoxValue) {
                                                    echo "<br><label for='$idName-comments-notify'><input type='checkbox' checked='checked' name='$idName-comments-notify'>Enable $label</label>";
                                                } else {
                                                    echo "<br><label for='$idName-comments-notify'><input type='checkbox' name='$idName-comments-notify'>Enable $label</label>";
                                                }
                                            } else if (!is_int($checkboxUse)) {

                                                //allow for descriptions of input - check if string 
                                                echo "<br><p><i>$checkboxUse</i></p>";
                                            }
                                        }

                                        echo "</td>
                                              </tr>";
                                    }
                                
                                    function makeRowText($text, $class){
                                    
                                       $use_class = "";
                                    
                                       if (is_array($class)){
                                       
                                           $display_button = ($class[1]) ? 'table-row' : 'none';
                                           
                                           $use_class = $class[0];
                                       
                                       }
                                       
                                       if ($class == ''){
                                               
                                               $display_button = 'table-row';
                                        
                                        }
                                            
                                            
                                       echo "<tr class='$use_class' style='display: $display_button'>
                                             <td class='label-td-form'></td>
                                             <td>$text</td>
                                             </tr>";
                                
                                    }

                                    $fieldName = array(
                                        array("Phone Number", $wpbiztext_cform_phone_number_label, $wpbiztext_cform_phone_number_verification),
                                        array("Email", $wpbiztext_cform_email_label, $wpbiztext_cform_emial_verification),
                                        array("Name", $wpbiztext_cform_name_label, $wpbiztext_cform_name_validation),
                                        array("Subject", $wpbiztext_cform_subject_label, $wpbiztext_cform_subject_validation, $wpbiztext_cform_subject_required_checkbx),
                                        array("Message", $wpbiztext_cform_message_label, $wpbiztext_cform_message_validation),
                                        array("Send", $wpbiztext_cform_send_label),
                                        array("Form Options"),
                                        array("Fixed Form Sidebar CSS Options")

                                    );

                                    $label = array("Label", "Validation", "Required");
                                    for ($x = 0; $x <= sizeof($fieldName) - 1; $x++) {
                                    

                                        echo "<tr><td colspan='2'><h3>" . $fieldName[$x][0] . "</h3><td></tr>";

                                        if ($fieldName[$x][0] == 'Subject') {
                                            echo makeRow('Options', implode(",", $wpbiztext_cform_subject_options), "Seperate each option with a comma", false, $fieldName[$x][0], false);
                                        }

                                        // loop is determind by value of input in the $fieldName Array
                                        for ($y = 0; $y <= sizeof($fieldName[$x]) - 2; $y++) {
                                            // echo "loop";
                                            echo makeRow($label[$y], $fieldName[$x][$y + 1], $y, false, $fieldName[$x][0], (isset($fieldName[$x][3]))? $fieldName[$x][3]:false);
                                        }

                                        if ($fieldName[$x][0] == 'Form Options') {
                                    
                                            echo makeRow("Required Message",$wpbiztext_cform_required_message, 1, true, "",false);
                                            echo makeRow("Reply By Message", $wpbiztext_cform_reply_by_message, 1, true, "",false);
                                            echo makeRow("Success Message",$cform_display_send_success_message, 1, true, "",false);
                                            echo makeRow("Error Message", $cform_display_send_error_message, 1, true, "", false);
                                            echo makeRow("Classes", $cform_display_send_classes_message,"Enter form classes, seperated by (,)", true,"", false);
                                    
                                        }

                                        if ($fieldName[$x][0] == 'Fixed Form Sidebar CSS Options') {
                                            echo makeRow("Fixed Width", $wpbiztext_cform_fixed_width ,"Enter an integer. Default value: 500 [read as 500].", true,"", false);
                                            echo makeRow("Z-index", $wpbiztext_cform_zindex, "Enter an integer. Default Value: 200 [read as 200px]", true, "", false);
                                            echo makeRow("Icon Distance From Top", $wpbiztext_cform_icon_distance, "Enter an integer. Default Value: 100 [read as 100px]", true, "", false);
                                            echo makeRow("Padding from Top of Form Window", $wpbiztext_cform_form_padding, "Enter an integer. Default Value: 0 [read as 0px]", true, "", false);
                                            echo makeRow("Padding from Bottom of Form Window",$wpbiztext_cform_form_padding_bottom, "Enter an integer. Default Value: 0 [read as 0px]", true, "", false);
                                        }
                                    }

                                    ?>
                                    <tr>
                                        <td colspan='2'><input class="button-primary" type="submit" name="wpbiztext-cform-edit-submit-button" value="Save Contact Form Options">
                                        <td>
                                    </tr>
                                
                                </table>
                                
                            </div>

                        </form>

                        <form id="wpbiztext-cform-form-activation" name="wpbiztext-cform-form-activation" method='post' action=''>
                        
                            <?php
							
							    if ( function_exists('wp_nonce_field') ) {
                                    wp_nonce_field('biztext-cform-activate-form', 'wpbiztext-cform-form-activation-nonce'); 	
                                }
											
							?>	

                            <input type="hidden" name="wpbiztext-cform-form-activation-submitted" value="Y" />

                            <h3>2) Activate Your Form</h3>
                            <div class="left-indent">
                                <input type='hidden' name='wpbiztext-cform-activated-comments-notify' value='0' />
                                <?php
                               
                                if ($wpbiztext_cform_activate_form_checkbx && $wpbiztext_cform_biztext_web_id_verification == 'Y') {
                                  
                                    echo "<input type='checkbox' id='wpbiztext-cform-activated-comments-notify' name='wpbiztext-cform-activated-comments-notify' onChange='this.form.submit()' checked='checked' value='1'>";
                                } else {
                  
                                    $isCheckboxDisabled = ($wpbiztext_cform_biztext_web_id_verification == 'N') ? 'disabled' : '';
                                    echo "<input type='checkbox' id='wpbiztext-cform-activated-comments-notify' name='wpbiztext-cform-activated-comments-notify' onChange='this.form.submit()' value='1'".
                                                                     $isCheckboxDisabled." >";
                                }
                                ?>

                                <label for="wpbiztext-cform-activated-comments-notify">
                                
                                <?php
                                if ($wpbiztext_cform_biztext_web_id_verification == 'Y'){
                                    echo "Activate Form";
                                } else {
                                    echo "To activate your forms, please enter a verified Biz Text Web Id.";
                                }
                                ?>

                                 </label>
                            </div>
                        </form>
                        <h3>3) Display on Your Website in Two Ways</h3>

                        <div class="left-indent">
                            <?php
                            if (!$wpbiztext_cform_activate_form_checkbx) {
                                echo "<p><b>Your Contact Form is not activated. Click the Activate Form checkbox to use the Biz Text short code and Biz Text Widget</b></p>";
                            }
                            ?>
                            <p>A) Place the following short code on your website pages where you want your Biz Text Message Contact Form to appear:</p>

                            <div class="left-indent">
                            
                                <p>Do not show on mobile phones:<br>[BT_CONTACT_FORM]<br><em>By default, the form will not show on mobile phones and in Safari screens under 1024px in width.</em></p>
                                <p>Show on all devices (mobile phones, tablets, and desktop computers):<br>[BT_CONTACT_FORM devices="all"]</p>
                                <p>To override the form name:<br>[BT_CONTACT_FORM label='Text Us Now']</p>
                                <p>To fix to right side:<br>[BT_CONTACT_FORM fixed="true" label="Text Us Now" width="500"]
                                    <br> 
                                    <b>Note: Across all shortcodes and contact form widgets, only the first fixed form will appear on the right side.</b>
                                </p>
                                <p>Override subject options:<br>[BT_CONTACT_FORM subjects="one, two, three"]</p>
                                <p>Override form submission button label:<br>[BT_CONTACT_FORM button="Correct"]</p>
                                <p>Override email options for form: 
                                    <br>
                                    <ul class='left-indent '>
                                        <li>To not display email text field: [BT_CONTACT_FORM email='none']</li>
                                        <li>To display both email and phone number text fields: [BT_CONTACT_FORM email='both']</li>
                                        <li>To give option to end user to display email or phone number text fields: [BT_CONTACT_FORM email='choose']</li>
                                    </ul>
                                    
                                </p>

                            </div>

                            <p>B) Add using the Biz Text Widget</p>

                            <div class="left-indent">

                                <p><span class='learn-widget'>Go under Appearance in the sidebar, choose Widgets, select position for Biz Text Contact Form Widget.</span></p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


    </div>

</div>
