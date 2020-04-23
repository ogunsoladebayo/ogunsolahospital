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

function search_user($email = ""){
    if (!isset($email)) {
        set_Alert('error', 'User Email is not set');
        die;
    }
    $dbArray = scandir("db/users/");
    $idCount = count($dbArray);

    for ($i = 0; $i <= $idCount ; $i++){
        $currentUser = $dbArray[$i];
        if($currentUser == $email . ".json"){
            $userDetails = json_decode(file_get_contents("db/users/" . $currentUser));
            return $userDetails;
        }
     }
  return false;
}

function save_user($userDetails){
    file_put_contents("db/users/" . $userDetails['email'] . ".json", json_encode($userDetails));

}