<?php
include_once('lib/header.php');
if (!isset($_SESSION["role"]) && $_SESSION["role"] != "Medical Director") {
    header("Location: login.php");
    }

$json = file_get_contents("db/users/Medical Team (MT).json");
$json_decoded = json_decode($json);
echo "<table style= 'width:100%'>
    <tr><th>Staff ID </th>
    <th> First name </th>
    <th>Last Name </th>
    <th>Department </th>
    <th>Email Address </th>
    <th>House Address </th>
    <th>Gender</th></tr>";
foreach($json_decoded as $result){
  echo '<tr>';
    echo '<td>'. $result-> id .'</td>';
    echo '<td>'.$result-> first_name .'</td>';
    echo '<td>'.$result-> last_name.'</td>';
    echo '<td>'.$result-> department.'</td>';
    echo '<td>'.$result-> email .'</td>';
    echo '<td>'.$result-> house_address .'</td>';
    echo '<td>'.$result-> gender.'</td>';
  echo '</tr>';
}
echo '</table>';

include_once('lib/footer.php');