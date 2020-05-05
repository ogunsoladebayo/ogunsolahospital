<?php
session_start();
require_once('functions/alert.php');
require_once('functions/redirect.php');
require_once('functions/token.php');
require_once('functions/user.php');

$currentPatient = search_patient($_COOKIE['email']);

if(!isset($_GET['txref'])){
    redirect_to('login.php');
}else{
    if(file_exists("db/users/patients/" . $currentPatient-> email . ".json") && file_exists("flutterwave/transactionData/thistransaction.json")){
        $userDetails = json_decode(file_get_contents("db/users/patients/" . $currentPatient-> email . ".json"));
        $thistransaction = json_decode(file_get_contents("flutterwave/transactionData/thistransaction.json"));
        $user_file = json_decode(file_get_contents('flutterwave/transactionData/'. $currentPatient-> email .'.json'));
        $data = file_get_contents('db/appointments/' . $userDetails -> department . '.json');
        $admin_record = json_decode(file_get_contents('flutterwave/transactionData/paymentrecord.json'));

    }
    
    if ($thistransaction-> TransactionRef == $_GET['txref']){
        $_SESSION["logged_in"] = $userDetails -> id;
        $_SESSION["email"] = $userDetails -> email;
        $_SESSION["role"] = $userDetails -> designation;
        $_SESSION["first_name"] = $userDetails -> first_name;
        $_SESSION["last_name"] = $userDetails -> last_name;
        $_SESSION["department"] = $userDetails -> department;

        if($thistransaction-> Status == 'successful'){
            set_Alert('success', 'Your payment was successful, your appointment is now acknowledged');

            $json_arr = json_decode($data, true);
            
            foreach ($json_arr as $key => $value) {
                if ($value['id'] == $userDetails -> id) {
                    $json_arr[$key]['bills'] = "Paid";
                }
            }

            $admin_record[] = Array(
                'PatiientID' => $userDetails -> id,
                'PatientName' => ($userDetails -> first_name.' '.$userDetails -> last_name),
                'TransactionID' => $thistransaction-> TransactionID,
                'TransactionRef' => $thistransaction-> TransactionRef,
                'Date' => $thistransaction-> Date,
                'Time' => $thistransaction-> Time,
                'Amount' => $thistransaction-> Amount
            );
            
            file_put_contents('db/appointments/' . $userDetails -> department . '.json', json_encode($json_arr));
            file_put_contents('flutterwave/transactionData/paymentrecord.json', json_encode($admin_record));
        }
        elseif($thistransaction-> Status == 'failed'){
            set_Alert('error', 'The payment failed, please try again');
        }
        elseif ($_GET['cancelled'] == 'true'){
            set_Alert('error', 'Transaction cancelled by user.');
        }
        else{
            set_Alert('error', 'An error occured, please try again');
        }
        // unlink('flutterwave/transactionData/thistransaction.json');
        redirect_to("dashboard.php");
        die();  
    }else{
        redirect_to('index.php');
    }



}