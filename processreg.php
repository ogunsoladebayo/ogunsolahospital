<?php
print_r($_POST);

// collecting each data from array

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$designation = $_POST['designation'];
$department = $_POST['department'];
$house_address = $_POST['house_address'];

$errorArray = [];

// validation

if($first_name == "") {
   $errorArray = "First name cannot be blank";
}
print_r($errorArray);
?>