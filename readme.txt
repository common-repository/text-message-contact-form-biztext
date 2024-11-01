=== Text Message Contact Form ===
Contributors: biztextsolutions
Tags: contact form, sms, email, text messages
Requires at least: 4.0
Tested up to: 6.4.3
Requires PHP: 7.0
Stable tag: 3.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Receive a Text or email, from your website through the Text Message Contact Form by Biz Text. SMS notification of email received, no third-party apps are needed. 

== Description ==

Using Texting for ***customer service*** and ***support*** is easy with the Text Message Contact Form Plugin by [Biz Text](https://biztextsolutions.com?ref=wp%20text%20message%20contact%20form). It lets visitors to your website Text you from any device, or even send an email. Easily integrate with our [Text Message SMS Plugin](https://wordpress.org/plugins/text-message/) to receive, reply, and send Texts right from your WordPress site. 

Desktops can't send SMS without an app connected to a mobile phone's SMS. With the Text Message Contact Form, your visitors fill out a contact form with their Mobile Phone Number, Email, Name, and Text Message. Their Text goes to your online Texting Dashboard, and a mobile phone's SMS, and they receive an autoresponse message that their Text was received. Reply to the Texts from your Texting Dashboard or mobile phone, without showing your personal phone number. If they choose to send an email, you can receive a notification and summary of the email by Text so you can see which ones need immediate attention. 

The Text Message Contact Form requires an affordable, no-contract, cancel any time Biz Text plan, [see our plans at Biz Text Solutions](https://www.biztextsolutions.com/pricing?ref=wp%20text%20message%20contact%20form). A Biz Text plan allows you to choose a ‘Biz Text Number’ which is a local phone (or Toll Free number). Your Contact Form(s) displayed on your website allow you to receive Text messages or emails. Customize and display a Button or Link with your Biz Text Number for Mobile with our [Text Message SMS Plugin](https://wordpress.org/plugins/text-message/).

The Text Message Contact Form Plugin makes it easy for you to display one or many contact forms anywhere on your website. 

**Features and Benefits**

* Customize your field names and messages
* Google ReCaptcha option to protect your site from spam and abuse
* Allow your visitors to decide whether to have the reply by Text or Email
* Receive text and email 
* Display on your pages or posts with a shortcode or widget
* Receive and reply to Texts on Texting Dashboard or mobile phone(s). 
* An automatic reply Text Message sent to your visitor with their message and your Biz Text Number
* Text notification of an email sent
* Fix a form by shortcode or widget to the right side of any page or pages on your website, opened by clicking the Biz Text Icon
* Customize each forms, form name, subject options, and button label
* Assign Biz Text Admin role to user or custom capability to other roles to access plugin settings


**How Biz Text Works - Receive, Reply, and Send Text Messages for Customer Service**

* Choose a ‘Biz Text Number’, a local or Toll Free number and display it on your website
* Your Biz Text Number lets you receive, reply and send text messages
* Reply to Texts received from your Texting Dashboard (Install the [Text Message SMS Plugin](https://wordpress.org/plugins/text-message/) or receive in your WordPress Dashboard) or forward texts to your mobile phone(s)
* When you reply to Texts from your personal mobile phone, your personal number is hidden from your visitors
* Affordable, no-contract, cancel any time Biz Text plans available now, [see our plans at Biz Text Solutions](https://www.biztextsolutions.com/pricing?ref=wp%20text%20message%20contact%20form).
* Send a Text to a single contact or group of contacts. 
* Add groups with selected contacts. 
* Less phone calls, better service, change your business forever.

= To Sign Up =

To sign up and get information on our plan, visit our page [Biz Text Solutions](https://biztextsolutions.com?ref=wp%20text%20message%20contact%20form).

== Installation ==
= Upload Manually =

1. Download and unzip the plugin
1. Upload the folder into the \’/wp-content/plugins/\’ directory
1. Go to the Plugins admin page and activate the plugin


== Frequently Asked Questions ==

= How do I get a Biz Text Number and display a form? =

1. Sign up for a Biz Text plan. Visit [Biz Text Solutions](https://www.biztextsolutions.com/pricing?ref=wp%20text%20message%20contact%20form) for information.
1. Install and activate the Text Message Contact Form plugin
1. Find ‘Biz Text Form’ in the admin menu 
1. Enter you Biz Text Id, choose your form options, and then activate your form
1. Place the shortcode on your site or use the Biz Text widget to place the shortcode for you

= How do I include and use the shortcode in a page, post, or text widget? =

* To add the shortcode to a page, post, or text widget place in [BT_CONTACT_FORM]. By default this will not show on mobile phones.
* To have your contact form shown on all devices (mobile and desktop), add the attribute devices='all'. Example: [BT_BUTTON devices='all']
* To fix your contact form to the right side of your website add the attribute fixed="true". You can also change your label with the attribute label="Text Us Now" ("Text Us Now" is default). Change the width of your form when open by adding the attribute width="500" (500 is default). Example: [BT_BUTTON fixed="true" label="Text Us Now" width="500"]
* Override the subject options set in settings by adding the attribute subjects="one, two, three". Example: [BT_CONTACT_FORM subjects="one, two, three"]
* Override the button label set in settings by adding the attribute button="button two". Example: [BT_CONTACT_FORM button="button two"]
* To override the email option set in the plugin admin section, there are three options: 'none', 'both', 'choose'. Example: [BT_CONTACT_FORM email='both']


= How do I use a widget to display a form? = 

1. Under appearance, choose Widgets and locate the Biz Text Widget under Available Widgets.
1. To activate a widget drag it to a sidebar or click on it. To deactivate a widget and delete its settings, drag it back off the sidebar.
1. Under the location of the Biz Text Widget, click the widget and enter a title.
1. You can enable, display on Mobile Phone, Show Form, Fix to Right Side, and subjects for that specific form only. 

= How many forms can I fix to the right side on my website? =

* At any time, there will be only one fixed form displayed on your website. If you enable the fixed option for multiple forms, only the first form will appear. 
* Fixed forms created by shortcodes take priority over fixed forms created by the widget. 
* You are still able to have multiple forms displayed on your website that are not fixed to the right side.

= How come my fixed form is displayed behind images and text on my website? = 

* This is due to the fact that the z-index attribute of the form is too low, and as a result, other elements of your website will appear above the form. To fix this, you must increase your z-index value until it is higher than other element's z-index.
* We recommend incrementing your z-index value by 200 until your fixed form is displayed above any overlapping images and/or text. 
* In the Biz Text Contact Form plugin, the z-index value can be found in 'Edit Contact Form' under 'Fixed Form Sidebar CSS Options'. 


= I am not receiving any email notifications from the contact form. What is happening? = 

* First, ensure you have to send to email option enabled. This checkbox can be found in the admin section, in 'Settings' under  'Allow to Receive Email'. If you are using shortcodes to display the contact form, you can also enable the send to email option by adding the attribute email="True" to your shortcode. 
* Another possible solution is to install a third-party SMTP plugin to help with your configurations.
* You can also add your phone number to recieve text notifications about email inquiries from the contact. This feature allows you to remain informed about any emails even if there are issues with email notifications.

= Why aren't my forms showing up on the page? = 

* First, check if you have a verified Biz Text Id saved in the administrative settings in your WordPress Dashboard. Next, check if you have clicked in the "Activate Form" checkbox in the administrative settings. Without these two values, no forms will appear on the website.
* If you are adding a form via widgets, ensure that you have clicked the "Show Form" checkbox in the widget settings.
* If you are adding a form via shortcode, double-check the formatting of your attributes. 
Every attribute must enclose their values within a pair of quotes like this: [BT_CONTACT_FORM email="choose"].

= Can I add my own styles or classes to the Form? =

Yes, under 'Edit Contact Form' in Admin you can enter one or many classes, with each class separated by a comma. 

= What roles can see the plugin? =

Biz Text Admin, Editor, and Administrator. Assign access to a role with biztext_menu_access_contact capability. 

= How can I show a SMS Button or Link with my Biz Text number on a mobile device? =

Customize and display a Button or Link with your Biz Text Number for Mobile devices with our [Text Message SMS Plugin](https://wordpress.org/plugins/text-message/). It easily integrates with the Text Message Contact Form plugin. Display your Button or Link on mobile to open your visitors SMS and Contact Form on desktops. 

== Screenshots ==
1. Administrative settings for your contact forms in WordPress Dashboard screenshot-1.(png|jpg|jpeg|gif).
2. Form customizations for your WordPress Biz Text widgets screenshot-2.(png|jpg|jpeg|gif).
3. Various shortcodes attributes to customize your forms to your liking screenshot-3.(png|jpg|jpeg|gif).
4. Display your form fixed on the side of your website.  screenshot-4.(png|jpg|jpeg|gif).
5. Advanced form options - display as many forms as you would like, each customized for a specific method to receive and send text and email. screenshot-5.(png|jpg|jpeg|gif).
6. How to find your Biz Text Id screenshot-6.(png|jpg|jpeg|gif).


== Changelog ==

= 3.0 =
* Tested for WordPress 6.4.1
* Tested for PHP 8.1
* use wp_is_mobile() to detect mobile devices and wordpress global $is_safari to detect safari
* remove using Mobile_Detect.php to detect mobile
* option to change fixed icon and label color added in Fields and Labels for Contact Form in Biz Text Contact Form Settings


= 2.0 =
* Tested for WordPress 6.1.1
* Fix for PHP 8, removal null for $content line 437 text-message-form.php

= 1.6 =
* Removed biztext_phpmailer_init( PHPMailer $phpmailer ) and SMTP option, caused errors with WordPress 5.5
* Declared Variables for Widget Instance, function form($instance)
* Tested for WordPress 5.5
* Added capability biztext_contact_form_edit to Editor, Administrator, and Biz Text Admin. Allows menu to show in admin and access to the plugin. 
* Added uninstall.php

= 1.5 =
* Safari browser does now not recognize if viewed on mobile and will show desktop. To correct, if not to show on all devices (mobile, tablet, etc...), when viewed in the Safari browser screens under 1024px in width will not show the form

= 1.1 =
* Fixed id verification bug in FireFox and Safari
* Fixed top padding on fixed form
* Added bottom padding to fixed form

= 1.0.2 =
* Fixed Safari display bug with fixed buttons
* Made fixed form and fixed buttons responsive

= 1.0.1 =
* Fixed alignment issue when pressing the x button on a fixed form

= 1.0 =
* Initial release. This is the first version, no updates available yet.

== Upgrade Notice ==

= 2.0 =
* Tested for WordPress 6.1.1
* Fix for PHP 8, removal null for $content line 437 text-message-form.php 

= 1.6 =
* Removed biztext_phpmailer_init( PHPMailer $phpmailer ) and SMTP option, caused errors with WordPress 5.5
* Declared Variables for Widget Instance, function form($instance)
* Tested for WordPress 5.5
* Added capability biztext_contact_form_edit to Editor, Administrator, and Biz Text Admin. Allows menu to show in admin and access to the plugin. 
* Added uninstall.php

= 1.5 =
* Safari browser does now not recognize if viewed on mobile and will show desktop. To correct, if not to show on all devices (mobile, tablet, etc...), when viewed in the Safari browser screens under 1024px in width will not show the form

= 1.1 =
* Fixed id verification bug in FireFox and Safari
* Fixed top padding on fixed form
* Added bottom padding to fixed form
* Made fixed form and fixed buttons responsive

= 1.0 =
* Initial release. This is the first version, no updates available yet.