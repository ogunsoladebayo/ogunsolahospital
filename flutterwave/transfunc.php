<?php

function save_transaction($transactionData){
    $transaction = json_decode(file_get_contents("transactionData/" . $transactionData->custemail . ".json"));
    $transaction[] = Array(
        'TransactionID' => $transactionData-> txid,
        'TransactionRef' => $transactionData-> txref,
        'Date' => date('l, d-m-Y'),
        'Time' => date('h:i:sa'),
        'Amount' => $transactionData-> amount,
        'Currency' => $transactionData-> currency,
        'Narration' => $transactionData-> narration,
        'Status' => $transactionData-> status
    );
    file_put_contents("transactionData/" . $transactionData-> custemail . ".json", json_encode($transaction));

}