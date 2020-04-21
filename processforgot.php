<?php
session_start();
$error = False;

$email = $_POST['email'] != "" ? $_POST['email'] : $error = True;

$_SESSION["email"] = $email;

if ($error == True) {
   // print a more advanced error message with accurate feedback
   header("Location: forgot.php");
   $_SESSION["error"] = "Please type in your email correctly";
   }else{
      $dbArray = scandir("db/users/");
      $idCount = count($dbArray);

      for ($i = 0; $i <= $idCount ; $i++){
         $currentUser = $dbArray[$i];
         if($currentUser == $email . '.json'){
            
            $token = "";
            $s = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
            for($i = 0; $i < 20; $i++){
              $index = mt_rand(20, strlen($s) - 1);
              $token .= $s[$index];
            }



            $subject = "Password Reset Link";
            $message = "A password reset has been initiated on your account, if you did not did not request a password reset, please ignore this message or visit localhost:8080/ogunsolabank/reset.php?token=" . $token . " to change your password.";
            $headers = "From: no_reply@ogunowo.com" . "\r\n" .
            "CC: admin@ogunowo.com";
            file_put_contents("db/token/" . $email . ".json", json_encode(['token'=>$token]));

            $try = mail($$email,$subject,$message,$headers);
            if ($try){
               $_SESSION["success"] = "Password reset link has been successfully sent to " . $email . ". Please click the link sent to your email ";
               header("Location: login.php");
            }else{
               $_SESSION["error"] = "Sorry, something went wrong... Unable to send reset link to " . $email . ". Please try again.";
               header("Location: forgot.php");
            }
            die();

         }
      }
      $_SESSION["error"] = "This email is not registered. ERR:" . $email;
      header("Location: forgot.php");
   }

   ?>