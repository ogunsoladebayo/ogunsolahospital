<?php include_once ('lib/header.php');
require_once ("functions/alert.php")?>
   <h3>Reset password here</h3>
   <p>Please enter the email registered with your account</p>
   <form action="processforgot.php" method="POST">
      <?php print_alert(); ?>
      <p>
         <label> Email address </label><br>
         <input 
         <?php
         if (isset($_SESSION["email"])){
            echo "value=" . $_SESSION['email'];
         }
         ?>
         type="text" class="form-control" name="email" placeholder="example@gmail.com">
      </p>
      <p><button class="btn btn-sm btn-primary" type="submit">Reset Password</button></p>

   </form>
   <?php include_once ('lib/footer.php'); ?>