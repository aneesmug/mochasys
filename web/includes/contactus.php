<?php
    include('./includes/menu.php');

if(isset($_POST['submit'])){
    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $number = htmlentities($_POST['number']);
    $message = addslashes(htmlentities($_POST['message']));
//  $owner = "info@hpvetclinic.com";        // for another owner //
//  $owner_2 = "aneesmug2007@yahoo.com";        // for another owner //
//  $headers = "MIME-Version: 1.0\r\n";
//  $headers .= "Content-type: text/html; charset=UTF-8\r\n";
//  $headers .= 'From:'.$email.'' . "\n";
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
    //$date = date("l, F d, Y, h:i" ,time());
    $date = date("c");
    $currentyear = date("Y");
    $number = str_replace('(', '', str_replace(')', '', str_replace('-', '', str_replace(' ', '', $number))));

if (!empty($_REQUEST['captcha'])){
    if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']){
        $errors = "
        <div class='panel panel-danger'>
          <div class='panel-heading'><h4>Error ooooh!</h4></div>
          <div class='panel-body'>
            The CAPTCHA wasn't entered correctly. Go back and try it again.
          </div>
        </div>
        ";
        } else {
            if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(isset($_POST['submit'])){
    
        if($name && $email && $number && $message){
            $errors = "
            <div class='pet_view_btn'><div class='panel panel-success'>
              <div class='panel-heading'><h4>So Good!</h4></div>
              <div class='panel-body'>
                Your registration has been completed successfully. So please check your email $cus_email for <strong style='color:#C11C1C;'>hpvetclinic.com</strong> account activation.
              </div>
             </div>
            </div>
            ";
// mysql_query("INSERT INTO `contact_us` (`name`,`email`,`number`,`ip`,`date`,`message`,`action`,`status`) VALUES ('$name','$email','$number','$ip','$date','$message','in','unread')");
    //begin of HTML message
$date = date("l, F d, Y", strtotime($date));
/***********phpMailer***************/
$subject="Mochachino Contact Information";
require 'includes/PHPMailer/src/Exception.php';
require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->IsHTML(true); // send as HTML
$mail->CharSet="utf-8"; // use utf-8 character encoding
//Authentication
$mail->SMTPAuth = true;                     // authentication enabled
$mail->SMTPSecure = 'ssl';                  // secure transfer enabled REQUIRED for Gmail
$mail->Host = "secure.emailsrvr.com";       // email smtp server address
$mail->Port = 465;                          // or 587
$mail->IsHTML(true);
$mail->Username = "it@mochachino.co";       // login username
$mail->Password = "Hain6539306";            // login password
$mail->addAddress($email, $name);
//$mail->addBCC('aneesmug2007@yahoo.com', 'Anees Mughal');
$mail->addBCC('info@hpvetclinic.com', 'Happy Pet Vet. Clinic');
$mail->Subject = "Contact Information from $name";
/*$body = $mail->msgHTML(file_get_contents('./includes/emails_layout/contact_us.php'), dirname(__FILE__));
$body = preg_replace('/\\\\/','', $body);
$body = str_replace('$name', $name, $body);
$body = str_replace('$number', $number, $body);
$body = str_replace('$message', $message, $body);
$body = str_replace('$date', $date, $body);
$body = str_replace('$currentyear', $currentyear, $body);
$mail->Body=$body;*/
$mail->Body = "hello";
$mail->AltBody = 'This is a plain-text message body';
//$mail->addAttachment('phpmailer_mini.png');
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    header("Location: index.php?page=thankyoucontactus");
}
/***********phpMailer***************/

    } else {
        $errors = "
        <div class='panel panel-danger'>
          <div class='panel-heading'><h4>Error ooooh!</h4></div>
          <div class='panel-body'>
            <h5>Please fill out the all (<span style='color:#FF0000;'>*</span>) from fields!</h5>
          </div>
        </div>
        ";
    }
  }
}
}
}
}
    unset($_SESSION['captcha']);
?>


<style type="text/css">

.captcha_a {
    color: #990000 !important;
    font-size: 11px;
}
.captc {
    color: #980000 !important;
    float: none !important;
    font-size: 20px !important;
    width: 130px !important;
}
.captcha_box {
    border: 1px solid;
    padding: 10px;
    border:1px solid #dadada;
    background-color:#fbfbfb;
    margin-left:80px;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 6px;
    /*width:270px !important;*/
}

</style>


<!-- Begin content -->
<div id="page-content-wrapper" class="no-title">
<div class="inner">
<!-- Begin main content -->
<div class="inner-wrapper">
<div class="sidebar-content fullwidth">
<div data-elementor-type="wp-page" data-elementor-id="4106" class="elementor custom-css-style" data-elementor-settings="[]">
<div class="elementor-inner">
<div class="elementor-section-wrap">
    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-7817036 elementor-section-stretched elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle"
        data-id="7817036"
        data-element_type="section"
        data-settings='{"stretch_section":"section-stretched","background_background":"classic","craftcoffee_ext_is_background_parallax":"true","craftcoffee_ext_is_background_parallax_speed":{"unit":"px","size":0.8000000000000000444089209850062616169452667236328125,"sizes":[]}}'
    >
        <div class="elementor-background-overlay"></div>
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-row">
                <div
                    class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-1ec019d"
                    data-id="1ec019d"
                    data-element_type="column"
                    data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                >
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div
                                class="elementor-element elementor-element-74dd2a2 elementor-widget elementor-widget-heading"
                                data-id="74dd2a2"
                                data-element_type="widget"
                                data-settings='{"craftcoffee_ext_is_smoove":"true","craftcoffee_ext_smoove_disable":"769","craftcoffee_ext_smoove_duration":1000,"craftcoffee_ext_smoove_scalex":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_scaley":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_translatey":{"unit":"px","size":100,"sizes":[]},"craftcoffee_ext_is_fadeout_animation":"true","craftcoffee_ext_is_fadeout_animation_velocity":{"unit":"px","size":0.299999999999999988897769753748434595763683319091796875,"sizes":[]},"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_smoove_rotatex":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_rotatey":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_rotatez":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_translatex":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_translatez":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_skewx":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_skewy":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_perspective":{"unit":"px","size":1000,"sizes":[]},"craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation_direction":"up"}'
                                data-widget_type="heading.default"
                            >
                                <div class="elementor-widget-container">
                                    <h3 class="elementor-heading-title elementor-size-default">Find Us</h3>
                                </div>
                            </div>
                            <div
                                class="elementor-element elementor-element-999231e elementor-widget elementor-widget-heading"
                                data-id="999231e"
                                data-element_type="widget"
                                data-settings='{"craftcoffee_ext_is_smoove":"true","craftcoffee_ext_smoove_disable":"769","craftcoffee_ext_smoove_duration":1000,"craftcoffee_ext_smoove_scalex":{"unit":"px","size":2,"sizes":[]},"craftcoffee_ext_smoove_scaley":{"unit":"px","size":2,"sizes":[]},"craftcoffee_ext_is_fadeout_animation":"true","craftcoffee_ext_is_fadeout_animation_direction":"down","craftcoffee_ext_is_fadeout_animation_velocity":{"unit":"px","size":0.5,"sizes":[]},"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_smoove_rotatex":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_rotatey":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_rotatez":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_translatex":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_translatey":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_translatez":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_skewx":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_skewy":{"unit":"px","size":0,"sizes":[]},"craftcoffee_ext_smoove_perspective":{"unit":"px","size":1000,"sizes":[]},"craftcoffee_ext_is_infinite":"false"}'
                                data-widget_type="heading.default"
                            >
                                <div class="elementor-widget-container">
                                    <h1 class="elementor-heading-title elementor-size-default">Contact</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-ac83152 elementor-section-stretched elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle"
        data-id="ac83152"
        data-element_type="section"
        data-settings='{"stretch_section":"section-stretched","background_background":"classic","craftcoffee_ext_is_background_parallax":"false"}'
    >
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-row">
                <div
                    class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-0a8ccdd"
                    data-id="0a8ccdd"
                    data-element_type="column"
                    data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                >
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div
                                class="elementor-element elementor-element-c63482c elementor-widget elementor-widget-spacer"
                                data-id="c63482c"
                                data-element_type="widget"
                                data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                data-widget_type="spacer.default"
                            >
                                <div class="elementor-widget-container">
                                    <div class="elementor-spacer">
                                        <div class="elementor-spacer-inner"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-725040bb elementor-section-boxed elementor-section-height-default elementor-section-height-default"
        data-id="725040bb"
        data-element_type="section"
        data-settings='{"craftcoffee_ext_is_background_parallax":"false"}'
    >
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-row">
                <div
                    class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-70495302"
                    data-id="70495302"
                    data-element_type="column"
                    data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                >
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            
                            <section
                                class="elementor-section elementor-inner-section elementor-element elementor-element-197fa6bd nopadding elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="197fa6bd"
                                data-element_type="section"
                                data-settings='{"craftcoffee_ext_is_background_parallax":"false"}'
                            >
                                <div class="elementor-container elementor-column-gap-default">
                                    <div class="elementor-row">
                                        <div
                                            class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-48c82ee elementor-invisible"
                                            data-id="48c82ee"
                                            data-element_type="column"
                                            data-settings='{"animation":"fadeIn","animation_delay":500,"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                        >
                                            <div class="elementor-column-wrap elementor-element-populated">
                                                <div class="elementor-widget-wrap">
                                                    <div
                                                        class="elementor-element elementor-element-32067a3 elementor-widget elementor-widget-heading"
                                                        data-id="32067a3"
                                                        data-element_type="widget"
                                                        data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                                        data-widget_type="heading.default"
                                                    >
                                                        <div class="elementor-widget-container">
                                                            <h4 class="elementor-heading-title elementor-size-default">Address</h4>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="elementor-element elementor-element-23973719 elementor-widget elementor-widget-text-editor"
                                                        data-id="23973719"
                                                        data-element_type="widget"
                                                        data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                                        data-widget_type="text-editor.default"
                                                    >
                                                        <div class="elementor-widget-container">
                                                            <div class="elementor-text-editor elementor-clearfix">
                                                            	<p>Prince Sultan، Dist، Al Basateen, Opp side of Arab International School, Jeddah 
                                                            	Saudi Arabia</p>
                                                            	<p><b>Company CR No:</b> 4030138214</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="elementor-element elementor-element-884f6b9 elementor-widget elementor-widget-heading"
                                                        data-id="884f6b9"
                                                        data-element_type="widget"
                                                        data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                                        data-widget_type="heading.default"
                                                    >
                                                        <div class="elementor-widget-container">
                                                            <h4 class="elementor-heading-title elementor-size-default">Customer Support</h4>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="elementor-element elementor-element-1e185e5 elementor-widget elementor-widget-heading"
                                                        data-id="1e185e5"
                                                        data-element_type="widget"
                                                        data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                                        data-widget_type="heading.default"
                                                    >
                                                        <div class="elementor-widget-container">
                                                            <h4 class="elementor-heading-title elementor-size-default">
                                                            	<a href="tel:+966122348454">+966 12 234 8454</a><br />
                                                            	<a href="tel:+966122348454">+966 12 236 2854</a>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="elementor-element elementor-element-884f6b9 elementor-widget elementor-widget-heading"
                                                        data-id="884f6b9"
                                                        data-element_type="widget"
                                                        data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                                        data-widget_type="heading.default"
                                                    >
                                                        <div class="elementor-widget-container">
                                                            <h4 class="elementor-heading-title elementor-size-default">Email</h4>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="elementor-element elementor-element-1e185e5 elementor-widget elementor-widget-heading"
                                                        data-id="1e185e5"
                                                        data-element_type="widget"
                                                        data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                                        data-widget_type="heading.default"
                                                    >
                                                        <div class="elementor-widget-container">
                                                            <h4 class="elementor-heading-title elementor-size-default" style="font-size: 30px !important;">
                                                            	<a href="mailto:info@mochachino.co">info@mochachino.co</a>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <div
                    class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-376f5883"
                    data-id="376f5883"
                    data-element_type="column"
                    data-settings='{"background_background":"classic","craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                >
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <section
                                class="elementor-section elementor-inner-section elementor-element elementor-element-a0c2942 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="a0c2942"
                                data-element_type="section"
                                data-settings='{"craftcoffee_ext_is_background_parallax":"false"}'
                            >
                                <div class="elementor-container elementor-column-gap-default">
                                    <div class="elementor-row">
                                        <div
                                            class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-e3a3e0a"
                                            data-id="e3a3e0a"
                                            data-element_type="column"
                                            data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                        >
                                            <div class="elementor-column-wrap elementor-element-populated">
                                                <div class="elementor-widget-wrap">
                                                    <div
                                                        class="elementor-element elementor-element-088133c elementor-transparent elementor-widget elementor-widget-shortcode"
                                                        data-id="088133c"
                                                        data-element_type="widget"
                                                        data-settings='{"craftcoffee_ext_is_scrollme":"false","craftcoffee_ext_is_smoove":"false","craftcoffee_ext_is_parallax_mouse":"false","craftcoffee_ext_is_infinite":"false","craftcoffee_ext_is_fadeout_animation":"false"}'
                                                        data-widget_type="shortcode.default"
                                                    >
                                                        <div class="elementor-widget-container">
                                                            <div class="elementor-shortcode">
                                                                <div role="form" class="wpcf7" id="wpcf7-f19-p4106-o1" lang="en-US" dir="ltr">
                                                                    <div class="screen-reader-response">
                                                                        <p role="status" aria-live="polite" aria-atomic="true"></p>
                                                                        <ul></ul>
                                                                    </div>

                                                                    <form method="post" action="" class="forms-input" style="color: #fff;">
                                                                        <label for="Name">Name:</label>
                                                                        <input type="text" name="Name" id="Name" />
                                                                        
                                                                        <label for="Mobile">Mobile:</label>
                                                                        <input type="text" name="City" id="City" />
                                                            
                                                                        <label for="Email">Email:</label>
                                                                        <input type="text" name="Email" id="Email" />
                                                                        
                                                                        <label for="Message">Message:</label><br />
                                                                        <textarea name="Message" rows="20" cols="20" id="Message"></textarea>


                                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                                            <input type="text" name="captcha" id="captcha-form" class="form-control" autocomplete="off" required />
                                                                            <label for="captcha-form">Type Same Words <span class="required">* Human Test</span></label> 
                                                                        </div>
                                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                                        <div class="captcha_box_app">
                                                                            <!--Start Captcha -->
                                                                            <a href="javascript:void(0);" onclick="
                                                                                document.getElementById('captcha').src='./includes/captcha.php?'+Math.random();
                                                                                document.getElementById('captcha-form').value='';"
                                                                                id="change-image">
                                                                            <img src="./includes/captcha.php" id="captcha" />
                                                                            </a>
                                                                             <div>
                                                                            Not readable?
                                                                                <a href="javascript:void(0);" onclick="
                                                                                document.getElementById('captcha').src='./includes/captcha.php?'+Math.random();
                                                                                document.getElementById('captcha-form').value='';"
                                                                                id="change-image"><span class="captcha_a">Change text</span></a>
                                                                            </div>
                                                                           <!--End Captcha -->
                                                                        </div>
                                                                        <?=$errors?>
                                                                        </div>
                                                                        

                                                                        <input type="submit" name="submit" value="Send" class="submit-button" />
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-dfa7f53 elementor-section-stretched elementor-section-full_width elementor-section-height-default elementor-section-height-default"
        data-id="dfa7f53"
        data-element_type="section"
        data-settings='{"stretch_section":"section-stretched","craftcoffee_ext_is_background_parallax":"false"}'
    >
        <div class="wpgmp_map_container wpgmp-map-1" rel=map1>
            <iframe style="width:100%; height:500px; border:0; margin-bottom: -9px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3707.4629267270207!2d39.11672211531612!3d21.684740170435152!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15c3dba5e1c3ea9f%3A0x28a86623d4d7e5f3!2sMochachino%20Co.!5e0!3m2!1sen!2sus!4v1652777832151!5m2!1sen!2sus" width="600" height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" ></iframe>
            <div style="position: absolute;width: 80%;bottom: 20px;left: 0;right: 0;margin-left: auto;margin-right: auto;color: #000;">
        </div>
    </section>
</div>
</div>
</div>
<div class="comment_disable_clearer"></div>
</div>
</div>
<!-- End main content -->