<?php 
   include_once ('lib/header.php');
   ?>

   <h3>My Dashboard</h3><hr>
   Welcome, <?php echo $_SESSION["full_name"];?><br>
   User ID - <?php echo $_SESSION["id"];?><br>
   Role -  <?php echo $_SESSION["role"];?>
   
   <?php include_once ('lib/footer.php'); ?>