<?php session_start();
    $appointmentfile = json_decode(file_get_contents('db/appointments/'. $_SESSION['department'] .'.json'));
    foreach ($appointmentfile as $key => $value) {
    echo $value-> id;
    }
?>