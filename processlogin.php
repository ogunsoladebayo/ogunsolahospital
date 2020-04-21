<?php
session_start();
$error1 = 0;
$error2 = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $error1 = 1;
$password = $_POST['password'] != "" ? $_POST['password'] : $error2 = 1;

$_SESSION["email"] = $email;

if($error1 == 1) {
   $errorMessage = "Please enter an email address";
   header("Location: login.php");
   die();
   }
elseif ($error2 == 1) {
   $errorMessage = "Please enter a password";
   header("Location: login.php");
   }
// elseif ($error1 == 1 && $error2 == 1) {
//    $errorMessage = "Please enter email and password";
//    header("Location: login.php");
   $_SESSION["error"] = $errorMessage;
   $dbArray = scandir("db/users/");
   $idCount = count($dbArray);

   for ($i = 0; $i <= $idCount ; $i++){
      $currentUser = $dbArray[$i];
      if($currentUser == $email . ".json"){
       $userDetails = json_decode(file_get_contents("db/users/" . $currentUser));
       $dbPassword = $userDetails -> password;
       $userPassword = password_verify($password, $dbPassword);
       if ($dbPassword == $userPassword){
         $_SESSION["id"] = $userDetails -> id;
         $_SESSION["email"] = $userDetails -> email;
         $_SESSION["full_name"] = $userDetails -> first_name . " " . $userDetails -> last_name;
         $_SESSION["role"] = $userDetails -> designation;
         $_SESSION["logged_in"] = True;
         header("Location: dashboard.php");
         die();
      }
      else{
         echo "password is not correct";
      }
      }

      $_SESSION["error"] = "Sorry, This email is not registered! Please, try again.";
      header("Location: login.php");

}
?>