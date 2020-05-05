<?php session_start();
    $appointmentfile = json_decode(file_get_contents('db/appointments/'. $_SESSION['department'] .'.json'), true);
    foreach ($appointmentfile as $key => $value) {}
        foreach($value as $key2 => $value2){
            echo $appointmentfile[$value];
        
    // $i = $value-> id;
    }
    // print_r($appointmentfile);
?>