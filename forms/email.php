<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once('PHPMailer/src/Exception.php');
require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/SMTP.php');

function ToUser_email(){
    $mail               = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth     = true;
    $mail->SMTPSecure   = 'ssl';
    $mail->Host         = 'smtp.gmail.com';
    $mail->Port         = '465';
    $mail->isHTML();
    $mail->Username     = $_ENV["EMAIL_ACCOUNT"];
    $mail->Password     = $_ENV["EMAIL_PASS"];
    $mail->SetFrom($_ENV["EMAIL_ACCOUNT"]);
    $mail->Subject   = 'Contact form completed';
    $mail->Body         = 'Hi '.$_POST['name'].'! Thanks for sending your message.';
    $mail->AddAddress($_POST['email']);
    
    if($mail->Send()){
        return true;
    }
    else{
        return false;
    }
}

function ToAdmin_email(){
    $mail               = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth     = true;
    $mail->SMTPSecure   = 'ssl';
    $mail->Host         = 'smtp.gmail.com';
    $mail->Port         = '465';
    $mail->isHTML();
    $mail->Username     = $_ENV["EMAIL_ACCOUNT"];
    $mail->Password     = $_ENV["EMAIL_PASS"];
    $mail->SetFrom($_ENV["EMAIL_ACCOUNT"]);
    $mail->Subject      = 'New Contact Form. Subject: '.$_POST['subject'];
    $mail->Body         = "
        <h3>From: <p>".$_POST['name']."</p> </h3>
        <h3>Email: <p>".$_POST['email']."</p> </h3>
        <h3>Message: <br>
        <p>".$_POST['message']."</p> 
        </h3>   
    
    ";
    $mail->AddAddress($_ENV["EMAIL_ACCOUNT"]);
    
    if($mail->Send()){
        return true;
    }
    else{
        return false;
    }
}

if(ToAdmin_email()){
    ToUser_email();
    echo "Your message has been sent. Thank you!";
}
else{
    echo "Your message has NOT been sent. Check the input data!";
}

?>