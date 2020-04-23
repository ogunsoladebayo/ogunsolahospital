<?php
require_once('functions/alert.php');
require_once('functions/redirect.php');
require_once('functions/token.php');
require_once('functions/user.php');
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
      $dbArray = scandir("db/users/");
      $idCount = count($dbArray);

      for ($i = 0; $i <= $idCount ; $i++){
         $currentUser = $dbArray[$i];
         if($currentUser == $email . '.json'){
            
            $token = set_token();

            $subject = "Password Reset Link";
            $message = "A password reset has been initiated on your account, if you did not did not request a password reset, please ignore this message or visit localhost:8080/ogunsolahospitals/reset.php?token=" . $token . " to change your password.";
            file_put_contents("db/token/" . $email . ".json", json_encode(['token'=>$token]));

            send_mail($subject, $message, $email);
            die();

         }
      }
      set_Alert('error', "This email is not registered. ERR:" . $email);
      redirect_to("forgot.php");
   }

   ?>