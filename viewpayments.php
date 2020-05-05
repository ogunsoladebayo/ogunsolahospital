<?php
include_once('lib/header.php');
if (!isset($_SESSION["role"])) {
    header("Location: login.php");
    }

$json = file_get_contents("flutterwave/transactionData/paymentrecord.json");
$json_decoded = json_decode($json);
echo '<table>';
echo "<tr><th>Patient ID | </th>";
echo "<th>Transaction ID | </th>";
echo "<th>Transaction Ref | </th>";
echo "<th>Date | </th>";
echo "<th>Time | </th>";
echo "<th>Amount</th></tr>";
foreach($json_decoded as $result){
  echo '<tr>';
    echo '<td>'. $result-> TransactionID .'</td>';
    echo '<td>'.$result-> TransactionRef .'</td>';
    echo '<td>'.$result-> Date.'</td>';
    echo '<td>'.$result-> Time .'</td>';
    echo '<td>'.$result-> Amount .'</td>';
    echo '<td>'.$result-> Narration.'</td>';
    echo '<td>'.$result-> Status.'</td>';
  echo '</tr>';
}
echo '</table>';

include_once('lib/footer.php');