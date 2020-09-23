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
    $mail->Host         = '';
    $mail->Port         = '465';
    $mail->isHTML();
    $mail->Username     = "";
    $mail->Password     = "";
    $mail->SetFrom("");
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
    $mail->Host         = '';
    $mail->Port         = '465';
    $mail->isHTML();
    $mail->Username     = "";
    $mail->Password     = "";
    $mail->SetFrom("");
    $mail->Subject      = 'New Contact Form. Subject: '.$_POST['subject'];
    $mail->Body         = "
        <h4>From: <p>".$_POST['name']."</p> </h4>
        <h4>Email: <p>".$_POST['email']."</p> </h4>
        <h4>Message: <br>
        <p>".$_POST['message']."</p> 
        </h4>
    ";
    $mail->AddAddress('', 'Contact');
    $mail->AddCC('', '');
    $mail->AddCC('', '');
    
    if($mail->Send()){
        return true;
    }
    else{
        return false;
    }
}

if(ToAdmin_email()){
    if(ToUser_email()){
        echo "Your message has been sent. Thank you!";
    }
    else{
        echo "Your message has NOT been sent. Check the input data!";
    }
}
else{
    echo "Your message has NOT been sent. Check the input data!";
}

?>