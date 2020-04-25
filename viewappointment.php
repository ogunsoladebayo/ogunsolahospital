<?php
include_once('lib/header.php');
if (!isset($_SESSION["role"]) && $_SESSION["role"] != "Medical Team (MT)") {
    header("Location: login.php");
    }
$department = $_SESSION['department'];
 

$json = file_get_contents("db/appointments/" . $department . ".json");
$json_decoded = json_decode($json);
echo '<table>';
echo "<tr><th>Patient ID</th>";
echo "<th>Full Name</th>";
echo "<th>Appointment Date</th>";
echo "<th>Appointment Time</th>";
echo "<th>Appointment Nature</th>";
echo "<th>Initial Complaint</th></tr>";
foreach($json_decoded as $result){
  echo '<tr>';
    echo '<td>'. $result-> id .'</td>';
    echo '<td>'. $result-> full_name .'</td>';
    echo '<td>'.$result-> appointment_date .'</td>';
    echo '<td>'.$result-> appointment_time.'</td>';
    echo '<td>'.$result-> appointment_nature .'</td>';
    echo '<td>'.$result-> initial_complaint .'</td>';
  echo '</tr>';
}
echo '</table>';

include_once('lib/footer.php');