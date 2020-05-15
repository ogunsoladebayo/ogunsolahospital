<?php
require_once('functions/alert.php');
require_once('functions/redirect.php');
require_once('functions/token.php');
require_once('functions/user.php');
require_once('functions/email.php');
session_start();
$error = False;

$email = $_POST['email'] != "" ? $_POST['email'] : $error = True;

$_SESSION["email"] = $email;

if ($error == True) {
   // print a more advanced error message with accurate feedback
   header("Location: forgot.php");
   // $_SESSION["error"] = "Please type in your email correctly";
   set_Alert('error');
   }else{
      $currentPatient = search_patient($email);
      $currentMt = search_mt($email);
   
      if($currentPatient || $currentMt){
         if (file_exists("db/users/mt/" . $currentMt-> email . ".json")){
            $userDetails = json_decode(file_get_contents("db/users/mt/" . $currentMt-> email . ".json"));
        }
        elseif(file_exists("db/users/patient/" . $currentPatient-> email . ".json")){
            $userDetails = json_decode(file_get_contents("db/users/patient/" . $currentPatient-> email . ".json"));
               
            $token = set_token();

            $subject = "Password Reset Link";
            $message = "A password reset has been initiated on your account, if you did not did not request a password reset, please ignore this message or visit localhost/ogunsolahospital-sng-v3/reset.php?token=" . $token . " to change your password.";
            file_put_contents("db/token/" . $email . ".json", json_encode(['token'=>$token]));

            send_mail($subject, $message, $email);
            die();

         }
      }
      set_Alert('error', "This email is not registered. ERR:" . $email);
      redirect_to("forgot.php");
   }

   ?>