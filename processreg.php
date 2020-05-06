<?php
session_start();
require_once('functions/user.php');
require_once('functions/alert.php');
require_once('functions/redirect.php');

$error = False;
$check = false;
// collecting each data from array

// $email = $_POST['email'] != "" ? $_POST['email'] : $error = True;
$password = $_POST['password'] != "" ? $_POST['password'] : $error = True;
$gender = $_POST['gender'] != "" ? $_POST['gender'] : $error = True;
$designation = $_POST['designation'] != "" ? $_POST['designation'] : $error = True;
$department = $_POST['department'] != "" ? $_POST['department'] : $error = True;
$house_address = $_POST['house_address'] != "" ? $_POST['house_address'] : $error = True;

if (preg_match('/^[a-zA-Z\s]+$/', $_POST['first_name']) && strlen($_POST['first_name']) > 2){
   $first_name = $_POST['first_name'];
}else{
   set_Alert('error', "Name should not have numbers" . "<br>" . "Name should not be less than 2");
   $check = true;
}

if (preg_match('/^[a-zA-Z\s]+$/', $_POST['last_name']) && strlen($_POST['last_name']) > 2){
   $last_name = $_POST['last_name'];
}else{
   set_Alert('error', "Name should not have numbers" . "<br>" . "Name should not be less than 2");
   $check = true;
}
if(filter_has_var(INPUT_POST, 'email')){
   if(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)){
      $email = $_POST['email'];
   }else{
      set_Alert('error', 'Email is invalid');
      $check = true;
   }
}
$_SESSION["first_name"] = $first_name;
$_SESSION["last_name"] = $last_name;
$_SESSION["email"] = $email;
$_SESSION["department"] = $department;
$_SESSION["house_address"] = $house_address;
$_SESSION["gender"] = $gender;
$_SESSION["designation"] = $designation;


if ($error == true) {
   set_Alert("error","Please fill the form completely");
   redirect_to("register.php");
}
elseif ($check == true) {
   redirect_to("register.php");
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
   
   set_Alert("success","Congratulations, You are now registered! Please, You can now log in.");
   redirect_to("login.php");
}
?>