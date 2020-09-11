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
    $mail->Username     = 'liquid.team.contact@gmail.com';
    $mail->Password     = 'Emailpentruliquid1';
    $mail->SetFrom('liquid.team.contact@gmail.com');
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
    $mail->Username     = 'liquid.team.contact@gmail.com';
    $mail->Password     = 'Emailpentruliquid1';
    $mail->SetFrom('liquid.team.contact@gmail.com');
    $mail->Subject      = 'New Contact Form. Subject: '.$_POST['subject'];
    $mail->Body         = "
        <h1>From: <p>".$_POST['name']."</p> </h1>
        <h1>Email: <p>".$_POST['email']."</p> </h1>

        <h1>Message: <br>
        <p>".$_POST['message']."</p> 
        </h1>   
    
    ";
    $mail->AddAddress("liquid.team.contact@gmail.com");
    
    if($mail->Send()){
        return true;
    }
    else{
        return false;
    }
}

if(ToAdmin_email()){
    ToUser_email();
    echo "<h1>Email sent</h1>";
}
else{
    echo "<h1>Email not sent</h1>";
}

?>