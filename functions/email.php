<?php require_once('alert.php');
require_once('redirect.php');

function send_mail($subject = "", $message = "", $email = ""){
    $headers = "From: no_reply@ogunowo.com" . "\r\n" .
    "CC: admin@ogunowo.com";
    $try = mail($email, $subject, $message, $headers);
    if ($try){
        set_Alert('success', "Password reset link has been successfully sent to " . $email . ". Please click the link sent to your email ");
        redirect_to("login.php");
    }else{
        set_Alert('error', "Sorry, something went wrong... Unable to send reset link to " . $email . ". Please try again.");
        redirect_to("forgot.php");
    }

}
