<?php
session_start();
require_once('functions/user.php');
$error = False;
// collecting each data from array

$first_name = $_POST['first_name'] != ""? $_POST['first_name'] : $error = True;
$last_name = $_POST['last_name'] != "" ? $_POST['last_name'] : $error = True;
$email = $_POST['email'] != "" ? $_POST['email'] : $error = True;
$password = $_POST['password'] != "" ? $_POST['password'] : $error = True;
$gender = $_POST['gender'] != "" ? $_POST['gender'] : $error = True;
$designation = $_POST['designation'] != "" ? $_POST['designation'] : $error = True;
$department = $_POST['department'] != "" ? $_POST['department'] : $error = True;
$house_address = $_POST['house_address'] != "" ? $_POST['house_address'] : $error = True;


$_SESSION["first_name"] = $first_name;
$_SESSION["last_name"] = $last_name;
$_SESSION["email"] = $email;
$_SESSION["department"] = $department;
$_SESSION["house_address"] = $house_address;
$_SESSION["gender"] = $gender;
$_SESSION["designation"] = $designation;


if ($error == True) {
   // print a more advanced error message with accurate feedback
   header("Location: register.php");
   $_SESSION["error"] = "Please fill the form completely";
}
elseif ((!preg_match("/^[a-zA-Z ]*$/",$first_name)) || strlen($first_name) < 2){
   $_SESSION["first_name_error"] = "Name should not have numbers" . "<br>" . "Name should not be less than 2";
   header("Location: register.php");
}
// elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//    $_SESSION["emailError"] = "Please enter a valid email";
//    // header("Location: register.php");
// }

else{
   $idCount = count(scandir("db/users/"));

   $userDetails = [
   'id' => $userCount = $idCount - 1,
   'first_name' => $first_name,
   'last_name' => $last_name,
   'email' => $email,
   'password' => password_hash($password, PASSWORD_DEFAULT),
   'department' => $department,
   'house_address' => $house_address,
   'gender' => $gender,
   'designation' => $designation
   ];
   $userExists = search_patient($email) ?: search_mt($email);

   if($userExists){
      $_SESSION["error"] = "Sorry, This email is already registered! Please, try another email.";
      header("Location: register.php");
      die();
   }
   if($designation == 'Medical Team (MT)'){
      save_mt($userDetails);
   }else{
      save_patient($userDetails);
      
   }
   
   $_SESSION["success"] = "Congratulations, You are now registered! Please, You can now log in.";
   header("Location: login.php");
}
?>