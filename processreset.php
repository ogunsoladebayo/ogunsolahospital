<?php
session_start();
require_once('functions/user.php');
require_once('functions/alert.php');
require_once('functions/redirect.php');

$error = False;

// if (!$_SESSION['logged_in']){
// $token = $_POST['token'] != "" ? $_POST['token'] : $error = True;
// $_SESSION["token"] = $token;
// }
$email = $_POST['email'] != "" ? $_POST['email'] : $error = True;
$password = $_POST['password'] != "" ? $_POST['password'] : $error = True;

$_SESSION["email"] = $email;

if ($error == True) {
   // print a more advanced error message with accurate feedback
   set_Alert('error', "Please fill the form completely");
   redirect_to("reset.php");
}
else {
      $checkToken = user_loggedIn() ? true : find_token($email);
     
      if ($checkToken){
                  
                  $userExists = search_user($email);

                  if($userExists){
                        // $userDetails = json_decode(file_get_contents("db/users/" . $currentUser));
                        $userDetails = search_user($email);
                        $userDetails -> password = password_hash($password, PASSWORD_DEFAULT);

                      unlink("db/users/" . $currentUser);
                      unlink("db/token/" . $currentUser);
                      save_user($userObject);

                      set_Alert('success', "Password successfully changed,Please log in.");

                      $subject = "Password Reset Successful";
                      $message = "A change has been made to your account (" . $email . ") at Ogunsola Hospital; Your password has been successfully changed";
                      send_mail($subject, $message, $email);

                      redirect_to("login.php");  
                      return;          
                      }
                  }
            set_Alert('error', "Password reset failed: Invalid request/Token expired");
            redirect_to("login.php");
      
      }

?>