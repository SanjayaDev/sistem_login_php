<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if (!function_exists("send_email")) {
  function send_email(array $data_email) {
    $mail = new PHPMailer(TRUE);
  
    $mail->isSmtp();
    $mail->Host       = EMAIL_HOST;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = EMAIL_ACCOUNT;                     //SMTP username
    $mail->Password   = EMAIL_PASSWORD;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = EMAIL_PORT;
  
    $mail->setFrom(EMAIL_ACCOUNT, 'Sanjaya');
    $mail->addAddress($data_email["to"]);
  
    $mail->isHTML();
    $mail->Subject = $data_email["subject"];
    $mail->Body = $data_email["message"];
  
    $send = $mail->send();
  
    return $send;
  }
}