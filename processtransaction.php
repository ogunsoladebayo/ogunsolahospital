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
        $transactionDetails = json_decode(file_get_contents("flutterwave/transactionData/thistransaction.json"));
    }
    
    if ($transactionDetails-> TransactionRef == $_GET['txref']){
        $_SESSION["logged_in"] = $userDetails -> id;
        $_SESSION["email"] = $userDetails -> email;
        $_SESSION["role"] = $userDetails -> designation;
        $_SESSION["first_name"] = $userDetails -> first_name;
        $_SESSION["last_name"] = $userDetails -> last_name;
        $_SESSION["department"] = $userDetails -> department;
        if($transactionDetails-> Status == 'successful'){
            set_Alert('success', 'Your payment was successful, your appointment is now acknowledged');
            $data = file_get_contents('db/appointments/' . $userDetails -> department . '.json');

            // decode json to array
            $json_arr = json_decode($data, true);
            
            foreach ($json_arr as $key => $value) {
                if ($value['id'] == $userDetails -> id) {
                    $json_arr[$key]['bills'] = "Paid";
                }
            }
            
            // encode array to json and save to file
            file_put_contents('db/appointments/' . $userDetails -> department . '.json', json_encode($json_arr));
        }
        elseif($transactionDetails-> Status == 'failed'){
            set_Alert('error', 'The payment failed, please try again');
        }
        elseif ($_GET['cancelled'] == 'true'){
            set_Alert('error', 'Transaction cancelled by user.');
        }
        else{
            set_Alert('error', 'An error occured, please try again');
        }
        unlink('flutterwave/transactionData/thistransaction.json');
        redirect_to("dashboard.php");
        die();  
    }else{
        redirect_to('index.php');
    }



}