<?php session_start();
    if (file_exists("db/users/patients/firstpatient@gmail.com.json")){
        $userDetails = json_decode(file_get_contents("db/users/patients/firstpatient@gmail.com.json"));
    }
    else{
        $userDetails = json_decode(file_get_contents("db/users/mt/ogunsoladebayo@gmail.com.json"));
    }
    print_r($userDetails);
      ?>