<?php

session_start();
$error = False;

if (!$_SESSION['logged_in']){
$token = $_POST['token'] != "" ? $_POST['token'] : $error = True;
$_SESSION["token"] = $token;
}
$email = $_POST['email'] != "" ? $_POST['email'] : $error = True;
$password = $_POST['password'] != "" ? $_POST['password'] : $error = True;

$_SESSION["email"] = $email;

if ($error == True) {
   // print a more advanced error message with accurate feedback
   header("Location: register.php");
   $_SESSION["error"] = "Please fill the form completely";
}
else {
      $tokendata = scandir("db/token/");
      $$tokencount = count($tokendata);

      for ($i = 0; $i < $tokencount ; $i++){
         $$currentTokenFile = $tokendata[$i];
         if($currentTokenFile == $email . ".json"){
            $tokenContent = json_decode(file_get_contents("db/token/" . $currentTokenFile));
            $userToken = $tokenContent -> token;

            if ($_SESSION['logged_in']){
                  $checkToken = true;
            }else{
                  $checkToken = $userToken == $token;
            }
            if ($checkToken){
                  $dbArray = scandir("db/users/");
                  $idCount = count($dbArray);
               
                  for ($i = 0; $i < $idCount ; $i++){
                     $currentUser = $dbArray[$i];
                     if($currentUser == $email . ".json"){
                      $userDetails = json_decode(file_get_contents("db/users/" . $currentUser));
                      $userDetails -> password = password_hash($password, PASSWORD_DEFAULT);

                      unlink("db/users/" . $currentUser);
                      file_put_contents("db/users/" . $email . ".json", json_encode($userDetails));

                      $_SESSION["success"] = "Password successfully changed,Please log in.";
                      header("Location: login.php");  
                      die();                    
                      }
                  }
            }   
            }
         }
      $_SESSION["error"] = "Password reset failed: Invalid request/Token expired";
      header("Location: login.php");
      }

?>