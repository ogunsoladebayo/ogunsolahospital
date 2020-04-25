<?php session_start();
   $userDetails = [
    'id' => 1,
    'first_name' => 'Medical',
    'last_name' => 'Director',
    'email' => 'admin@ogunsolahospital.com',
    'password' => password_hash('admin', PASSWORD_DEFAULT),
    'department' => 'General',
    'designation' => 'Medical Director'
    ];
    file_put_contents('db/users/admin@ogunsolahospital.com.json', json_encode($userDetails))
 ?>