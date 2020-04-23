<?php session_start();
    require_once('functions/user.php');
    $currentUser = search_user($email = 'ogunsoladebayo@gmail.com');
    // $userDetails = json_decode(file_get_contents("db/users/" . $currentUser));
    echo $currentUser;
 ?>