<?php
session_start();
$error = False;
// collecting each data from array

$first_name = $_POST['first_name'] != "" ? $_POST['first_name'] : $error = True;
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
else{
   $dbArray = scandir("db/users/");
   $idCount = count($dbArray);
   $userCount = ($idCount - 1);

   $userDetails = [
   'id' => $userCount,
   'first_name' => $first_name,
   'last_name' => $last_name,
   'email' => $email,
   'password' => password_hash($password, PASSWORD_DEFAULT),
   'department' => $department,
   'house_address' => $house_address,
   'gender' => $gender,
   'designation' => $designation
   ];
   for ($i = 0; $i <= $idCount ; $i++){
      $currentUser = $dbArray[$i];
      if($currentUser == $email . '.json'){
         $_SESSION["error"] = "Sorry, This email is already registered! Please, try another email.";
         header("Location: register.php");
         die();
      }
   }

   
   file_put_contents("db/users/" . $email . ".json", json_encode($userDetails));
   $_SESSION["success"] = "Congratulations, You are now registered! Please, You can now log in.";
   header("Location: login.php");
}
?>