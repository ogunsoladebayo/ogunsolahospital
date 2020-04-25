<?php session_start();

$json = file_get_contents("db/appointments/Laboratory.json");
$json_decoded = json_decode($json);
echo '<table>';
foreach($json_decoded as $result){
  echo '<tr>';
    echo '<td>'.$result-> full_name.'</td>';
    echo '<td>'.$result-> appointment_date.'</td>';
    echo '<td>'.$result-> appointment_time.'</td>';
  echo '</tr>';
}
echo '</table>';
?>