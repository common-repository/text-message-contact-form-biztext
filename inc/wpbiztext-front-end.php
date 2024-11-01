<?php 		
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    
?>	    
<style>
    .wpbiztext-cform-fixed {
        z-index: <?php echo $wpbiztext_cform_display_zindex; ?>;
    }

    .wpbiztext-cform-fixed-button {
        z-index: <?php echo $wpbiztext_cform_display_zindex; ?>;
        top: <?php echo $wpbiztext_cform_display_icon_distance; ?>px;
    }
    
    .wpbiztext-cform-fixed .wpb-form-fixed-wrapper {
        padding-top: <?php echo $wpbiztext_cform_display_form_padding;?>px
    }
    
    .wpbiztext-cform-fixed .wpbiztext-cform-wrapper {
        padding-bottom: <?php echo $wpbiztext_cform_display_form_padding_bottom; ?>px;
    }
</style>

<script type="text/javascript">

    function btnDisplayTimer(fixedBTBtn,fixedBTText, isEventXbutton){
        if ((fixedBTBtn && fixedBTBtn.offsetLeft > 0) || isEventXbutton ){
            setTimeout(function (){
                    fixedBTBtn.style.display = 'block';
                    fixedBTText.style.display = 'block';
            }, 500);
        }
    }

    function resizeFixedFormElements(fixedBT, fixedBTBtn, fixedBTText, widthUse){

        if (widthUse < window.innerWidth){
            fixedBT.style.width = (parseInt(widthUse) + 10).toString() + "px";
            fixedBTBtn.style.right = ( parseInt(widthUse)  + 10) + "px";
            fixedBTText.style.right = ( parseInt(widthUse) + 10) + "px";
            btnDisplayTimer(fixedBTBtn,fixedBTText, false);
      
        } else {
            fixedBT.style.width = '100%';
            fixedBTBtn.style.display = 'none';
            fixedBTText.style.display = 'none';
        }
        
        var iconBt = btLeft = document.querySelector('#wpbiztext-cform-fixed-button');
        if (iconBt) {
            var btLeft = iconBt.offsetLeft;

            if (btLeft <= 0){
                fixedBTBtn.style.display = 'none';
                fixedBTText.style.display = 'none';
            } else {
                fixedBTBtn.style.right = ( parseInt(widthUse)  + 10) + "px";
                fixedBTText.style.right = ( parseInt(widthUse) + 10) + "px";
                btnDisplayTimer(fixedBTBtn,fixedBTText, false);
            }
        }

    }

    function openBizTextForm() {

        var fixedBT = document.getElementById("wpbiztext-cform-fixed");
        var fixedBTBtn = document.getElementById("wpbiztext-cform-fixed-button");
        var fixedBTText = document.getElementById("wpbiztext-cform-fixed-button-text");

        if (fixedBT.style.width == 0 || fixedBT.style.width == "0px"){
        
            var widthUse = ("<?php echo  $display_width ?>" == "") ?  "<?php echo $cform_fixed_width_main ?>" : "<?php echo  $display_width ?>";
        
            resizeFixedFormElements(fixedBT, fixedBTBtn, fixedBTText, widthUse);
        
        } else {
            
            fixedBT.style.width = "0";
            fixedBTText.style.right = "10px";
            fixedBTBtn.style.right = "10px";
        
        }
        

    }
    
    function closeBizTextForm(){
    
        var fixedBT = document.getElementById("wpbiztext-cform-fixed");
        var fixedBTBtn = document.getElementById("wpbiztext-cform-fixed-button");
        var fixedBTText = document.getElementById("wpbiztext-cform-fixed-button-text");
        
        
        fixedBT.style.width = "0";
        fixedBTText.style.right = "10px";
        fixedBTBtn.style.right = "10px";
        btnDisplayTimer(fixedBTBtn,fixedBTText, true);
      

    
    
    }

    function renderCaptcha() {
    
        if ("<?php echo $cform_display_recaptcha ?>" && "<?php echo $cform_display_key?>" != ""){
        
            return true;
        
        }
    
    }
    
    if (renderCaptcha()) {
    
        // add recaptcha script if enabled in settings
        var add_recaptcha_api = document.createElement('script');

        add_recaptcha_api.setAttribute('src','https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit');
        add_recaptcha_api.setAttribute('defer','');
    
        document.head.appendChild(add_recaptcha_api);
    
    }
    
    function btFormatNumber(thisInput) {

    var number = thisInput["wpbiztext-cform-phone"].value;
        formatNumber = number.replace(/[^\d]+/g, '')
            .replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');

        thisInput["wpbiztext-cform-phone"].value = formatNumber;

    }
    
    function receiveBy(fromForm) {
    
        var number = fromForm.getElementsByClassName("wpbiztext-cform-phone")[0];
        var numberLabel = number.innerHTML;
        var email =  fromForm.getElementsByClassName("wpbiztext-cform-email")[0];
        var emailLabel = email.innerHTML;

        var emailDiv = fromForm.querySelector('.wpbiztext-fieldtype-email'); 
        var phoneDiv = fromForm.querySelector('.wpbiztext-fieldtype-phone'); 
        
    

        if (fromForm["wpbiztext-cform-by"].value == "email"){
           emailDiv.style.display = 'block';
           phoneDiv.style.display = 'none';
            
        } else {
            phoneDiv.style.display = 'block';
            emailDiv.style.display = 'none';

        }
        
    
    }

    function sendText(currentForm) {
    
        var emailFieldPresent = currentForm["wpbiztext-cform-email"] != undefined;
    
        var formName = currentForm.dataset.formname;
    
        //validate required fields
        var number = currentForm["wpbiztext-cform-phone"].value.trim();
        var numberError = currentForm.getElementsByClassName("error-wpbiztext-cform-phone")[0];
        var email = (emailFieldPresent) ? currentForm["wpbiztext-cform-email"].value.trim() : "";
        var emailError = (emailFieldPresent) ? currentForm.getElementsByClassName("error-wpbiztext-cform-email")[0] : "";
        var name = currentForm["wpbiztext-cform-name"].value.trim();
        var nameError = currentForm.getElementsByClassName("error-wpbiztext-cform-name")[0];
        var subject = currentForm["wpbiztext-cform-subject"].value.trim();
        var subjectError = currentForm.getElementsByClassName("error-wpbiztext-cform-subject")[0];
        var message = currentForm["wpbiztext-cform-message"].value.trim();
        var messageError = currentForm.getElementsByClassName("error-wpbiztext-cform-message")[0];
        var messageCaptchaError = currentForm.getElementsByClassName("error-wpbiztext-cform-ecaptcha")[0];

        var recaptchaID = currentForm.getElementsByClassName("g-recaptcha")[0].getAttribute('dt-widget-id');
        
        var replyBy = '';
        var radioOptions = currentForm.querySelector('input[name="wpbiztext-cform-by"]');
        if (radioOptions){
            replyBy = currentForm.querySelector('input[name="wpbiztext-cform-by"]:checked').value;
        } else {
            if (emailFieldPresent){
                replyBy = 'textemail';
            } else {
                replyBy = 'text';
            }
        }

        function varify() {

            var error = 0;
            numberError.innerHTML = "";
            if(emailFieldPresent){ emailError.innerHTML = "";}
            nameError.innerHTML = "";
            subjectError.innerHTML = "";
            messageError.innerHTML = "";
            messageCaptchaError.innerHTML = "";


            if ((number.trim() == "" && replyBy != "email") || (number.length != 14 && number != "") ) {

                numberError.innerHTML = "<?php echo $wpbiztext_cform_display_number_validation ?>"
                error = error + 1;

            }
            
            if ((emailFieldPresent && email.trim() == "" && replyBy != "text") ||  !validateEmail(email) && email.trim() != "" ) { 
            
                emailError.innerHTML = "<?php echo $wpbiztext_cform_display_email_validation ?>";
                error = error + 1;
            
            
            }
            
            function validateEmail(emailcheck) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(emailcheck).toLowerCase());
                
            }        

            if (name.trim() == "") {

                nameError.innerHTML = "<?php echo $wpbiztext_cform_display_name_validation ?>"
                error = error + 1;

            }

            if (subject.trim() == "" && "<?php echo $cform_display_subject_requried ?>" == "*") {

                subjectError.innerHTML = "<?php echo $wpbiztext_cform_display_subject_validation ?>"
                error = error + 1;

            }

            if (message.trim() == "") {

                messageError.innerHTML = "<?php echo $wpbiztext_cform_display_message_validation ?>"
                error = error + 1;

            }
            
            if (renderCaptcha()) {
            
               if (grecaptcha.getResponse(recaptchaID) === "" && recaptchaID != null){
                    messageCaptchaError.innerHTML = "Please click reCAPCHA"
                    error = error + 1;
            
                }
            
            }
            

            if (error != 0) {


                return false;

            } else {

                return true;

            }

        }
      
        if (varify()) {
        
            function successMsg() {
        
                var bTSuccess = currentForm.getElementsByClassName("success-wpbiztext-cform-sent")[0];
            
                currentForm.reset();

                if(currentForm["wpbiztext-cform-by"] != undefined){
                    receiveBy(currentForm);
                }
                
                bTSuccess.innerHTML = "<?php echo $cform_display_send_success_message ?>";
                
                setTimeout(function(){
                
                    bTSuccess.innerHTML = "";
                
                }, 5000);
                
            
            }
            
            function errorMsg() {
            
                 var btError = currentForm.getElementsByClassName("error-wpbiztext-cform-sent")[0];
                
                 btError.innerHTML = "<?php echo $cform_display_send_error_message?> ";
                 
                 setTimeout(function(){
                
                    btError.innerHTML = "";
                        
                 }, 5000);
            
            
            } 
            
            function bizTextAPI(data,type,message) {
            
                // type = to-business (send text from business to client )
                // type = to-client (send text from client to business)
                
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "https://www.biztextsolutions.com/api/send/" + type, true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send(JSON.stringify(data));

                xhr.onreadystatechange = function() {
              
                    if (this.readyState == 4 && this.status == 200) {
                    
                        if(message){
                        
                            successMsg();
                            
                        }
                        
                    } 
                    if (this.readyState == 4 && this.status != 200){
                    
                        if(message){
                            
                            errorMsg();
                            
                        }
                
                    }

                };
                
            
            }
        
            if (renderCaptcha()){
                if (recaptchaID != null){
                    grecaptcha.reset(recaptchaID);
                }
            }
            
            var addEmail = (email == '') ? '' : " (" + email + ")";
            
            var bizTextData = {

                "websiteId": "<?php echo $cform_display_web_id ?>", // the encrypted website id from my-account
                "txt": "(website-" + formName + ") Re: " + subject + ", " + message + addEmail,
                "from": "1" + number.replace(/[^0-9]/g, ''),
                "response": "<?php echo $cform_display_auto_message ?>" + " Your Message: " + "(" + subject + ") " + message + " - Reply STOP to unsubscribe" // client’s phone number

            }

            if (name.trim() != "") {

                bizTextData.nickname = name;

            } 
            
            if (replyBy == "text" || replyBy == 'textemail'){
            
                bizTextAPI(bizTextData,"to-business", true);
            
            }
            
            // email 
            
            if (replyBy != "text" ) {


             

                var parm ='action=biztext_send_email&message=' + message + '&subject=' + subject + '&name=' + name + '&email=' + email + '&form=' + formName;
        
                var exhr = new XMLHttpRequest();
                exhr.open("POST", "<?php echo admin_url('admin-ajax.php')?>", true);
                exhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded;');
                exhr.send(parm);

                exhr.onreadystatechange = function() {
            
                    if (this.readyState == 4 && this.status == 200) {
                        var response = exhr.responseText.replace(/[^0-9]/g,"");
                        // email success
                        if (response== "1"){
                            
                            successMsg();
                         
                                if ("<?php echo trim($wpbiztext_cform_display_email_phone_number) ?>" != ""){
                                
                                    var bizTextData2 = {

                                        "websiteId": "<?php echo $cform_display_web_id ?>", 
                                        "txt": "(" + formName + " - Email Sent " + email + ") From: " + name +  " Re: " + subject + ", " + message ,
                                        "from": "1<?php echo $wpbiztext_cform_display_email_phone_number ?>",
                                        "nickname": "<?php echo get_bloginfo( 'name' ); ?>" + " - Website"

                                    }

                                    bizTextAPI(bizTextData2,"to-business",false);
                                }
                            
                            

                        
                        } else {
                            if (replyBy != 'textemail'){
                                errorMsg();
                            }
                                
                                    if ("<?php echo trim($wpbiztext_cform_display_email_phone_number) ?>" != ""){
                                
                                    var bizTextData2 = {

                                        "websiteId": "<?php echo $cform_display_web_id ?>", 
                                        "txt": "(" + formName + " - Email Not Sent " + email + ") From: " + name +  " Re: " + subject + ", " + message ,
                                        "from": "<?php echo $wpbiztext_cform_display_email_phone_number ?>",
                                        "nickname": "<?php echo get_bloginfo( 'name' ); ?>" + " - Website"

                                    }

                                    bizTextAPI(bizTextData2,"to-business",false);
                                
                                }
                              
                        
                        }
                        
                   
                    } 
                    
                    if (this.readyState == 4 && this.status != 200) {
                     
                        errorMsg()
                     
                    }
                
            };  
            
            
            }
            
        

        }

    }
    
        try {
            var CaptchaCallback = function() {
                var captchas = document.getElementsByClassName("g-recaptcha");
                for (var i = 0; i < captchas.length; i++) {
                    var widgetID = grecaptcha.render(captchas[i], {
                        'sitekey': "<?php echo $cform_display_key ?>"
                    });
                    captchas[i].setAttribute('dt-widget-id', widgetID);
                }
                
                
            }
        } catch(error) {} //this is to catch duplicate renderings of widgets
     
     // IE8+ for $(document).ready(function() {}
function ready(fn) {
    if (document.readyState != 'loading') {
        fn();
    } else if (document.addEventListener) {
        document.addEventListener('DOMContentLoaded', fn);
    } else {
        document.attachEvent('onreadystatechange', function () {
            if (document.readyState != 'loading') {
                fn();
            }
        });
    }
}

ready(function () {

        function placeTextButton() {
            // document.querySelector('.wpbiztext-cform-fixed-button-text').setAttribute('visibility: hidden;');
                
            var iconOffsetTop = document.querySelector('#wpbiztext-cform-fixed-button').offsetTop;
            var iconClientHeight = document.querySelector('#wpbiztext-cform-fixed-button').clientHeight;
            var iconClientWidth = document.querySelector('#wpbiztext-cform-fixed-button').clientHeight;
            var textClientWidgth = document.querySelector('#wpbiztext-cform-fixed-button-text').clientWidth;
            
            var textTop = iconOffsetTop + iconClientHeight + textClientWidgth + 10 + 'px' ;
            
            //to remove these, might have to call removeAttribute 
            document.querySelector('.wpbiztext-cform-fixed-button-text').setAttribute(
                "style", "top: " + textTop +'; visibility: visible;');
        }

        placeTextButton();
      


        var elementsArray = document.querySelectorAll("label");

       for (var i=0; i < elementsArray.length; i++){
           elementsArray[i].addEventListener("click", function(){
                this.nextSibling.focus();
           });
       }
        // elementsArray.forEach(function(elem) {
        //     elem.addEventListener("click", function() {
        //         this.nextSibling.focus();
        //     });
        // });
        
        // fix from here!!!
        
        // Create Element.remove() function if not exist
        if (!('remove' in Element.prototype)) {
            Element.prototype.remove = function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            };
        }

        var existingSideFormNodes = document.querySelectorAll('#wpbiztext-cform-fixed');
        if (existingSideFormNodes.length > 0){
            var parentNode = document.querySelector('body');
            var sideBarFormNode = existingSideFormNodes[0];
            //sideBarFormNode.parentNode.style.display="none";
            var referenceNode = parentNode.querySelector('*');
            parentNode.insertBefore(sideBarFormNode, referenceNode);
            
            for (var i = 1; i < existingSideFormNodes.length; i++){
                existingSideFormNodes[i].remove();
            }
         }
        
        var resizeId;
       window.addEventListener('resize', function(){
           clearTimeout(resizeId);
           resizeId = setTimeout(doneResizing, 500);
       });

       function doneResizing() {
        var fixedBT = document.getElementById("wpbiztext-cform-fixed");
        var fixedBTBtn = document.getElementById("wpbiztext-cform-fixed-button");
        var fixedBTText = document.getElementById("wpbiztext-cform-fixed-button-text");

        var widthUse = ("<?php echo  $display_width ?>" == "") ?  "<?php echo $cform_fixed_width_main ?>" : "<?php echo  $display_width ?>";
        if (fixedBT.style.width != 0 && fixedBT.style.width != "0px"){
            
            resizeFixedFormElements(fixedBT, fixedBTBtn, fixedBTText, widthUse);
        }
        var icon = document.getElementById("wpbiztext-cform-fixed-button");
        var fixedButton = document.getElementById("wpbiztext-cform-fixed-button-text"); 
        if (fixedButton && icon){

            var iconTop = document.getElementById("wpbiztext-cform-fixed-button").offsetTop;
            var buttonTextTop = document.getElementById("wpbiztext-cform-fixed-button-text").offsetTop;
     
            if (buttonTextTop < iconTop){
                placeTextButton();
            }
        }
      


       }
});
 
        
</script>




