<?php
session_start();
require_once('functions/user.php');
$error = False;
// collecting each data from array

// $email = $_POST['email'] != "" ? $_POST['email'] : $error = True;
$password = $_POST['password'] != "" ? $_POST['password'] : $error = True;
$gender = $_POST['gender'] != "" ? $_POST['gender'] : $error = True;
$designation = $_POST['designation'] != "" ? $_POST['designation'] : $error = True;
$department = $_POST['department'] != "" ? $_POST['department'] : $error = True;
$house_address = $_POST['house_address'] != "" ? $_POST['house_address'] : $error = True;

// if(filter_has_var(INPUT_POST, 'email')){
// if ((!preg_match("/^[a-zA-Z ]*$/",$first_name)) || strlen($first_name) < 2){
//    $_SESSION["first_name_error"] = "Name should not have numbers" . "<br>" . "Name should not be less than 2";
//    header("Location: register.php");
// }else{
   $last_name = $_POST['last_name'];
// }

// if ((!preg_match("/^[a-zA-Z ]*$/",$first_name)) || strlen($first_name) < 2){
//    $_SESSION["first_name_error"] = "Name should not have numbers" . "<br>" . "Name should not be less than 2";
//    header("Location: register.php");
// }else{
   $first_name = $_POST['first_name'];
// }

if(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)){
   $email = $_POST['email'];
}else{
   $_SESSION['error'] = 'Please enter a valid email address';
   header('Location: register.php');
   die;
}
$_SESSION["first_name"] = $first_name;
$_SESSION["last_name"] = $last_name;
$_SESSION["email"] = $email;
$_SESSION["department"] = $department;
$_SESSION["house_address"] = $house_address;
$_SESSION["gender"] = $gender;
$_SESSION["designation"] = $designation;


if ($error == true) {
   header("Location: register.php");
   $_SESSION["error"] = "Please fill the form completely";
}
else{
   $idCount = count(scandir("db/users/"));
   $id =  uniqid('OG-');

   $userDetail = get_file($designation);
   $userDetail[] = Array(
      'id' => $id,
      'first_name' => $first_name,
      'last_name' => $last_name,
      'email' => $email,
      'house_address' => $house_address,
      'gender' => $gender,
      'department' => $department,
      );
   $userDetails = [
   'id' => $id,
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
      save_mt($userDetails, $userDetail);

   }elseif($designation == 'Patient'){
      save_patient($userDetails, $userDetail);
   }
   
   $_SESSION["success"] = "Congratulations, You are now registered! Please, You can now log in.";
   header("Location: login.php");
}
?>