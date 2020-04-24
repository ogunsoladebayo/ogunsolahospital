<?php
session_start();
require_once('functions/user.php');
$error = False;
// collecting each data from array

$appointment_date = $_POST['email'] != "" ? $_POST['email'] : $error = True;
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
