<?php
   $token = "";
   $s = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
   for($i = 0; $i < 20; $i++){
      $index = mt_rand(20, strlen($s) - 1);
      $token .= $s[$index];
   }
   echo $token . " len=>" . strlen($token);
?>