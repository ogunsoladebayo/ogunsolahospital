<?php
session_start();
require_once('functions/alert.php');
require_once('functions/redirect.php');
require_once('functions/token.php');
require_once('functions/user.php');

$error1 = 0;
$error2 = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $error1 = 1;
$password = $_POST['password'] != "" ? $_POST['password'] : $error2 = 1;


if($error1 == 1) {
  $errorMessage = "Please enter an email address";
   }
   if($error2 == 1){
      $errorMessage = "Please enter a password";
   }
   if($error1 ==1 && $error2 == 1){
      $errorMessage = "Please enter email address and password";
   }

   $_SESSION["email"] = $email;

if (isset($errorMessage)){
         set_Alert('error', $errorMessage);
         redirect_to("login.php");
   }

else{
   $currentUser = search_user($email);
   if($currentUser){
      $userDetails = json_decode(file_get_contents("db/users/" . $currentUser->email . ".json"));
      $dbPassword = $userDetails -> password;
      $userPassword = password_verify($password, $dbPassword);
      if ($dbPassword == $userPassword){
      $_SESSION["id"] = $userDetails -> id;
      $_SESSION["email"] = $userDetails -> email;
      $_SESSION["full_name"] = $userDetails -> first_name . " " . $userDetails -> last_name;
      $_SESSION["role"] = $userDetails -> designation;
      $_SESSION["logged_in"] = True;
      redirect_to("dashboard.php");
      die();
   }
   else{
      set_Alert('error', 'You have entered an incorrect password');
      redirect_to("login.php");
      die;
   }
}

      set_Alert('error', "Sorry, This email is not registered! Please, try again.");
      redirect_to("login.php");
      die;

}
?>