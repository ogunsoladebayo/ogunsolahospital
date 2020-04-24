<?php
session_start();
require_once('functions/user.php');
require_once('functions/redirect.php');
$error = False;
// collecting each data from array

$appointment_date = $_POST['appointment_date'] != "" ? $_POST['appointment_date'] : $error = True;
$appointment_time = $_POST['appointment_time'] != "" ? $_POST['appointment_time'] : $error = True;
$designation = $_POST['appointment_nature'] != "" ? $_POST['appointment_nature'] : $error = True;
$department = $_POST['department'] != "" ? $_POST['department'] : $error = True;
$initial_complaint = $_POST['initial_complaint'] != "" ? $_POST['initial_complaint'] : $error = True;


$_SESSION["appointment_date"] = $appointment_date;
$_SESSION["appointment_time"] = $appointment_time;
$_SESSION["appointment_nature"] = $appointment_nature;
$_SESSION["department"] = $department;
$_SESSION["initial_complaint"] = $initial_complaint;


if ($error == True) {
   // print a more advanced error message with accurate feedback
   redirect_to('register.php');
   $_SESSION["error"] = "Please fill the form completely";
}
else{

    $Appointment_details = [
    'full_name' => $_SESSION['full_name'],
    'appointment_date' => $appointment_date,
    'appointment_time' => $appointment_time,
    'appointment_nature' => $appointment_nature,
    'initial_complaint' => $initial_complaint,
    'department' => $department
    ];
    if (!file_exists("db/appointments/" . $department)){
        mkdir("db/appointments/" . $department, 0777, true);
    }
    file_put_contents("db/appointments/" . $department . "/" . $_SESSION['email'] . ".json", json_encode($Appointment_details));
    redirect_to('dashboard.php');
}