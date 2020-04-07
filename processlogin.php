<?php
session_start();
$error1 = 0;
$error2 = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $error = 1;
$password = $_POST['password'] != "" ? $_POST['password'] : $error2 = 1;

$_SESSION["email"] = $email;

if($error1 == 1) {
   $errorMessage = "Please enter an email address";
   }
elseif ($error2 == 1) {
   $errorMessage = "Please enter a password";}
elseif ($error1 == 1 && $error2 == 1) {
   $errorMessage = "Please enter email and password";
   header("Location: login.php");
   $_SESSION["error"] = $errorMessage;}
else{
   $dbArray = scandir("db/users/");
   $idCount = count($dbArray);

   for ($i = 0; $i <= $idCount ; $i++){
      $currentUser = $dbArray[$i];
      if($currentUser == $email . ".json"){
       $userDetails = json_decode(file_get_contents("db/users/" . $currentUser));
       $dbPassword = $userDetails -> password;
       $userPassword = password_verify($password, $dbPassword);
       if ($dbPassword == $userPassword){
          echo 'correct password';
          die();
       }
      }
   }
      $_SESSION["error"] = "Sorry, This email is not registered! Please, try again.";
      header("Location: login.php");
      die();

}
?>