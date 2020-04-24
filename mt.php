<?php
include_once('lib/header.php');

$str_data = file_get_contents("db/appointments/Laboratory.json");
$data = json_decode($str_data, true);
 
/*Initializing temp variable to design table dynamically*/
$temp = "<table>";
 
/*Defining table Column headers depending upon JSON records*/
$temp .= "<tr><th>Full Name</th>";
$temp .= "<th>Appointment Date</th>";
$temp .= "<th>Appointment Time</th>";
$temp .= "<th>Appointment Nature</th>";
$temp .= "<th>Initial Complaint</th></tr>";
 
/*Dynamically generating rows & columns*/
for($i = 0; $i < sizeof($data["Laboratory"]); $i++)
{
$temp .= "<tr>";
$temp .= "<td>" . $data["Laboratory"][$i]["full_name"] . "</td>";
$temp .= "<td>" . $data["Laboratory"][$i]["appointment_date"] . "</td>";
$temp .= "<td>" . $data["Laboratory"][$i]["appointment_time"] . "</td>";
$temp .= "<td>" . $data["Laboratory"][$i]["appointment_nature"] . "</td>";
$temp .= "<td>" . $data["Laboratory"][$i]["initial_complaint"] . "</td>";
$temp .= "</tr>";
}
 
/*End tag of table*/
$temp .= "</table>";
 
/*Printing temp variable which holds table*/
echo $temp;

include_once('lib/footer.php');