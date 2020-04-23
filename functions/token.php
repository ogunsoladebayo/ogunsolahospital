<?php

function set_token(){
    $token = "";
    $s = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    for($i = 0; $i < 20; $i++){
      $index = mt_rand(20, strlen($s) - 1);
      $token .= $s[$index];
    }
    return $token;
}

function find_token($email = "", $tokencount){
    $tokendata = scandir("db/token/");
    $$tokencount = count($tokendata);

    for ($i = 0; $i < $tokencount ; $i++){
       $$currentTokenFile = $tokendata[$i];
       if($currentTokenFile == $email . ".json"){
          $tokenContent = json_decode(file_get_contents("db/token/" . $currentTokenFile));

        return $tokenContent;
        }
    }
    return false;
}