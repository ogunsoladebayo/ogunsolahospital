<?php
include_once('lib/header.php');
if (!isset($_SESSION["role"])) {
    header("Location: login.php");
    }

    if(file_exists("flutterwave/transactionData/paymentrecord.json")){
    $json = file_get_contents('flutterwave/transactionData/paymentrecord.json');
    $json_decoded = json_decode($json);
    echo "<table style= 'width:100%'>";
    echo "<tr><th>Patient ID </th>";
    echo "<th> Patient Name </th>";
    echo "<th>Transaction ID </th>";
    echo "<th>Transaction Ref </th>";
    echo "<th>Date </th>";
    echo "<th>Time </th>";
    echo "<th>Amount</th></tr>";
    foreach($json_decoded as $result){
    echo '<tr>';
        echo '<td>'. $result-> PatiientID .'</td>';
        echo '<td>'.$result-> PatientName .'</td>';
        echo '<td>'.$result-> TransactionID .'</td>';
        echo '<td>'.$result-> TransactionRef.'</td>';
        echo '<td>'.$result-> Date.'</td>';
        echo '<td>'.$result-> Time .'</td>';
        echo '<td>'.$result-> Amount .'</td>';
    echo '</tr>';
    }
    echo '</table>';
    }else{
        echo "<div class='row col-6'>
                    <h3>No Payments Found</h3>
                </div>";
    }


include_once('lib/footer.php');