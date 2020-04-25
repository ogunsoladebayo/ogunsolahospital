<?php
session_start();
require_once('functions/user.php');
require_once('functions/redirect.php');
require_once('functions/appointment.php');
$error = False;
// collecting each data from array

$appointment_date = $_POST['appointment_date'] != "" ? $_POST['appointment_date'] : $error = True;
$appointment_time = $_POST['appointment_time'] != "" ? $_POST['appointment_time'] : $error = True;
$appointment_nature = $_POST['appointment_nature'] != "" ? $_POST['appointment_nature'] : $error = True;
$department = $_POST['department'] != "" ? $_POST['department'] : $error = True;
$initial_complaint = $_POST['initial_complaint'] != "" ? $_POST['initial_complaint'] : $error = True;


$_SESSION["appointment_date"] = $appointment_date;
$_SESSION["appointment_time"] = $appointment_time;
$_SESSION["appointment_nature"] = $appointment_nature;
$_SESSION["department"] = $department;
$_SESSION["initial_complaint"] = $initial_complaint;


if ($error == True) {
    set_Alert('error', 'Please fill all fields');
   redirect_to('appointment.php');
}
else{
    $update = save_appointment($department);
    $update[] = Array(
    'id' => $_SESSION['id'],
    'full_name' => $_SESSION['logged_in'],
    'appointment_date' => $appointment_date,
    'appointment_time' => $appointment_time,
    'appointment_nature' => $appointment_nature,
    'initial_complaint' => $initial_complaint,
    'department' => $department
    );

    file_put_contents("db/appointments/" . $department . ".json", json_encode($update));
    
    set_Alert('success', 'You have successfully booked an appointment with ' . $department . ' department');
    redirect_to('dashboard.php');
}