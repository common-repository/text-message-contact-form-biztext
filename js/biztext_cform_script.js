
/*
 * Biz Text Solutions 
 * www.biztextsolutions.com
 * Text Message Contact Form
 */

"use strict";


function bizTextVerify(fromForm) {


    var bizTextData = {

        "websiteId": fromForm["wpbiztext-cform-biz-text-id"].value.trim(), // the encrypted website id from my-account
        "txt": "",
        "from": ""

    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "https://www.biztextsolutions.com/api/send/to-business", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(bizTextData));
    console.log('sent request');

    xhr.onreadystatechange = function () {
        
        console.log(this.readyState + '   ' + this.status);
        if (this.readyState == 4 && this.status == 400) {
            
            document.getElementById('wpbiztext-cform-web-id-verification').value = 'Y';
            document.getElementById('wpbiztext-cform-biz-text-id').readOnly = true;
            document.querySelector('input[type="checkbox"][name="wpbiztext-cform-activated-comments-notify"]').disabled = false;
            document.querySelector('input[type="checkbox"][name="wpbiztext-cform-activated-comments-notify"]').innerHTML = "Activate Form";
            document.getElementById('bt-verify-button').innerHTML = 'Edit Biz Text Id';
            setTimeout(document.getElementById("wpbiztext-cform-settings-submit-button").click(), 0);


        }
        if (this.readyState == 4 && this.status != 400) {
            document.getElementById('wpbiztext-cform-web-id-verification').value = 'N';
            document.getElementById('wpbiztext-cform-biz-text-id').readOnly = false;


            document.getElementById('bt-verify-button').innerHTML = 'Verify Biz Text Id';
            document.querySelector('label[for="wpbiztext-cform-activated-comments-notify"]').innerHTML = "To enable activation of form, please enter a verified Biz Text Web Id.";
            document.getElementById('biztext-verification-text').innerHTML = 'BizText Id is not verified';

            document.querySelector('input[type="checkbox"][name="wpbiztext-cform-activated-comments-notify"]').checked = true;
            setTimeout(document.getElementById("wpbiztext-cform-settings-submit-button").click(), 0);
            // var event = document.createEvent("HTMLEvents");
            // event.initEvent('change', true, false);
            // document.querySelector('input[type="checkbox"][name="wpbiztext-cform-activated-comments-notify"]').dispatchEvent(event);

        }

   



    };

}

function editBizTextWebId(fromForm) {
    document.getElementById('wpbiztext-cform-biz-text-id').readOnly = false;
    document.getElementById('bt-verify-button').innerHTML = 'Verify Biz Text Id';

    document.getElementById('bt-verify-button').onclick = function () {
        bizTextVerify(fromForm);
    };

}



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

    
    
    var acc = document.getElementsByClassName("biz-text-cform-accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("biz-text-cform-accordion-active");

        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
          panel.style.display = "none";
        } else {
          panel.style.display = "block";
        }
      });
    }
    
    var inputNumberField = document.getElementById("wpbiztext-cform-text-notification-phone-number");
    
    // validation
    inputNumberField.setAttribute("maxlength", 10);
    
    inputNumberField.addEventListener("input", function(event){
        
        var number = event.target.value;
        var formatNumber = number.replace(/[^\d]+/g, '')
            .replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');

        event.target.value = formatNumber;

   
    
    });

    
    var enableEmailChbx = document.querySelector('input[name="wpbiztext-cform-send-to-email-comments-notify"]');
    enableEmailChbx.addEventListener('change', function() {
        if(this.checked){
    
            showEmailOptions()
        }
        else {

            showEmailOptions()
        }
    });

    
function showEmailOptions(){

    var showDisplayOptions = document.querySelectorAll('.email-text-options');

    for(var i=0; i < showDisplayOptions.length; i++){
        if (showDisplayOptions[i].style.display != 'none'){
            showDisplayOptions[i].style.display = 'none';
        } else if (showDisplayOptions[i].style.display == 'none') {
            showDisplayOptions[i].style.display = 'table-row';
        }
    }
    

}


});





