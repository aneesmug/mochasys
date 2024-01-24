<?php
    //library added in download source.
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP();                            // enable SMTP
    $mail->SMTPDebug = 1;                       // debugging: 1 = errors and messages, 2 = messages only
    //Authentication
    $mail->SMTPAuth = true;                     // authentication enabled
    $mail->SMTPSecure = 'ssl';                  // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "secure.emailsrvr.com";       // email smtp server address
    $mail->Port = 465;                          // or 587
    $mail->IsHTML(true);
    $mail->Username = "it@mochachino.co";       // login username
    $mail->Password = "Hain6539306";            // login password
    //Set Params
    $mail->SetFrom("it@mochachino.co");         // sent emailfrom
    $mail->Subject = "Test";                    // Subject
    $mail->Body = "hello";                      // Body message
    $mail->AddAddress("aneesmug2007@yahoo.com");// Sent from TO
    // $mail->AddCC('cc@phpgang.com.com', 'CC: to phpgang.com');    // CC Email To
    // $mail->AddAttachment("reload.png"); // $path: is your file path which you want to attach like $path = "reload.png";
     if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
        echo "Message has been sent";
     }
?>