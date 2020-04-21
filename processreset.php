<?php

session_start();
$error = False;

$token = $_POST['token'] != "" ? $_POST['token'] : $error = True;
$email = $_POST['email'] != "" ? $_POST['email'] : $error = True;
$password = $_POST['password'] != "" ? $_POST['password'] : $error = True;

$_SESSION["token"] = $token;
$_SESSION["email"] = $email;

if ($error == True) {
   // print a more advanced error message with accurate feedback
   header("Location: register.php");
   $_SESSION["error"] = "Please fill the form completely";
}
else {
      $tokendb = scandir("db/token/");
      $tokencount = count($tokendb);

      for ($i = 0; $i < $tokencount ; $i++){
         $currentTokenFile = $tokendb[$i];
         if($currentTokenFile == $email . ".json"){
            $tokenContent = json_decode(file_get_contents("db/users/" . $currentTokenFile));
            $dbToken = $tokenContent -> token;
            $userPassword = password_verify($password, $dbPassword);
            die;
         }
      }


      $_SESSION["error"] = "Password reset failed: Invalid request/Token expired";
      header("Location: login.php");
         
      
}

?>