<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once 'db.php';
require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendReply($recipient,$subject,$old,$message){
    if(isset($recipient) && isset($subject) && isset($old) && isset($message)){
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = SMTP_HOST;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = SMTP_USER;                 // SMTP username
            $mail->Password = SMTP_PASS;                           // SMTP password
            $mail->SMTPSecure = SMTP_SECUR;                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = SMTP_PORT;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom(SMTP_SENDER, SITENAME);
            $mail->addAddress($recipient);     // Add a recipient

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'RE: '.$subject;
            $mail->Body    = $message.'<br><br>--------------------<br>'.htmlentities($old);

            $mail->send();
            return 'success';
        } catch (Exception $e) {
            return 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
        }
    }else{
        echo 'Empty data';
    }
}