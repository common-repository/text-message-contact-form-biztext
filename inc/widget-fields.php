<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  ?>

<p>

	<label>Title</label>
	<input class="widefat" name="<?php echo $this->get_field_name('wpbiztext_cform_title'); ?>" type="text" value="<?php echo $title; ?>" />
	
</p>	
</p>
    <label>Display Text</label>
    <textarea name="<?php echo $this->get_field_name('wpbiztext_cform_text'); ?>"  class="widefat" name=""  rows='5'><?php echo $display_text; ?></textarea>

</p>

    <?php if($display_use_email == "false") {?>
        <div class='wpbiztext-widget-form-display-options'>
            <p>
                <input name="<?php echo $this->get_field_name('wpbiztext_cform_email_enable'); ?>" type="checkbox" value="1" onclick="test(this.parentNode.parentNode, this)" <?php checked($display_email_enable,1); ?> /> <label for="wpbiztext_widget_show">Enable Send to Email</label>		
                <div class='wpbiztext-widget-form-display-opt-checkbx' style='display: <?php echo ($display_email_enable == 1) ? 'block' : 'none'; ?>'>
                    <label title="g:i a">
                        <input type="radio" id="receive-email-text" name="<?php echo $this->get_field_name('wpbiztext_cform_email_options_display'); ?>" value="receive-email-text" <?php checked($display_text_email_options,'receive-email-text'); ?>>
                        Both Text and Email</label>
                    <br>
                    <label title="g:i a">
                        <input type="radio" id="reply-email-text" name="<?php echo $this->get_field_name('wpbiztext_cform_email_options_display'); ?>" value="reply-email-text" <?php checked($display_text_email_options,'reply-email-text'); ?>>
                        Choose Reply by Text or Email</label>
                </div>
            </p>
        </div>

    <?php } ?>
    


<p>
     <label>Override Subject Options</label>
     <input class="widefat" name="<?php echo $this->get_field_name('wpbiztext_cform_overide_options'); ?>" type="text" value="<?php echo $display_overide_subjects; ?>" />
     <br><i>Enter options for this form only. Seperate each option with a comma. Leave empty to use options set in the BizText contact form plugin settings.</i></p>

</p>
	

<div class='wpbiztext-widget-form-display-options'>
    <p>
        <input name="<?php echo $this->get_field_name('wpbiztext_cform_show'); ?>" type="checkbox" value="1" onclick="test(this.parentNode.parentNode, this)" <?php checked ($display_widget,1); ?> /> <label for="wpbiztext_cform_show">Show Form</label>		

    </p>
    <div class='wpbiztext-widget-form-display-opt-checkbx' style='display: <?php echo ($display_widget == 1) ? 'block' : 'none'; ?>'>
        <p>

            <input name="<?php echo $this->get_field_name('wpbiztext_cform_display'); ?>" type="checkbox"  value="1" <?php checked ($display_devices,1); ?> /> <label for="wpbiztext_widget_show">Display On Mobile Phone</label>		
            
            <br><i>By default, the form will not show on mobile phones and in Safari screens under 1024px in width.</i></p>
            
        </p>




        <p>

            <input name="<?php echo $this->get_field_name('wpbiztext_cform_fixed'); ?>" type="checkbox"  value="1" <?php checked ($display_fixed,1); ?> /> <label for="wpbiztext_cform_show">Fix to Right Side of Website</label>		
            <br>
            <b><i>Note: Across all shortcodes and contact form widgets, only the first fixed form will appear on the right side.</i></b>
        </p>
    </div>
</div>


<p>

     <label>Fixed Form Open Width</label>
     <input class="widefat" name="<?php echo $this->get_field_name('wpbiztext_cform_fixed_width'); ?>" type="number" value="<?php echo $display_width; ?>" />
     <br><i>Enter an integer. Default Value: 500 [read as 500px]</i></p>

</p>

<script>

function test(div, checkbx){
  
    var showDisplayOptionsCheckbx = div.getElementsByClassName('wpbiztext-widget-form-display-opt-checkbx')[0];

    if (showDisplayOptionsCheckbx.style.display != 'none'){
        showDisplayOptionsCheckbx.style.display = 'none';
    } else if (showDisplayOptionsCheckbx.style.display == 'none') {
        showDisplayOptionsCheckbx.style.display = 'block';
    }
   
}
</script>


	
				
