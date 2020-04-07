<?php session_start();
include_once ('lib/header.php'); ?>
<p>
   <?php
      if (isset($_SESSION["success"]) && !empty($_SESSION["success"])){
            echo "<span style='color:green'>" . $_SESSION['success'] . "</span>";
            session_unset();
         }
   ?>
</p>   
Login here
   <?php include_once ('lib/footer.php'); ?>