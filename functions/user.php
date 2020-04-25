<?php require_once('alert.php');
function user_loggedIn(){
   if(isset($_SESSION["logged_in"]) && !empty($_SESSION["logged_in"])){
       return true;
   }
   return false;
}

function token_set(){
    if (!isset($_GET["token"]) || !isset($_SESSION['token'])){
        return true;
    }
    return false;
}

function search_patient($email = ""){
    if (!isset($email)) {
        set_Alert('error', 'User Email is not set');
        die;
    }
    $dbArray = scandir("db/users/patients/");
    $idCount = count($dbArray);

    for ($i = 0; $i <= $idCount ; $i++){
        $currentUser = $dbArray[$i];
        if($currentUser == $email . ".json"){
            $userDetails = json_decode(file_get_contents("db/users/patients/" . $currentUser));
            return $userDetails;
        }
     }
  return false;
}

function search_mt($email = ""){
    if (!isset($email)) {
        set_Alert('error', 'User Email is not set');
        die;
    }
    $dbArray = scandir("db/users/mt/");
    $idCount = count($dbArray);

    for ($i = 0; $i <= $idCount ; $i++){
        $currentUser = $dbArray[$i];
        if($currentUser == $email . ".json"){
            $userDetails = json_decode(file_get_contents("db/users/mt/" . $currentUser));
            return $userDetails;
        }
     }
  return false;
}

function save_patient($userDetails, $userDetail){
    file_put_contents("db/users/patients/" . $userDetails['email'] . ".json", json_encode($userDetails));
    file_put_contents("db/users/patient.json", json_encode($userDetail));
}

function save_mt($userDetails, $userDetail){
    file_put_contents("db/users/mt/" . $userDetails['email'] . ".json", json_encode($userDetails));
    file_put_contents("db/users/Medical Team (MT).json", json_encode($userDetail));
}

function get_file($designation){
    $data = file_get_contents("db/users/" . $designation . ".json");
    $update = json_decode($data, true);
    return $update;
}