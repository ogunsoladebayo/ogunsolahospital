<?php include_once ('lib/header.php'); ?>
   <h3>Reset password here</h3>
   <p>Please enter the email registered with your account</p>
   <form action="processforgot.php" method="POST">
      <?php if (isset($_SESSION["error"]) && !empty($_SESSION["error"])){
         echo "<span style='color:red'>" . $_SESSION['error'] . "</span>";
            }
      ?>
      <p>
         <label> Email address </label><br>
         <input 
         <?php
         if (isset($_SESSION["email"])){
            echo "value=" . $_SESSION['email'];
         }
         ?>
         type="text" name="email" placeholder="example@gmail.com">
      </p>
      <p><button type="submit">Reset Password</button></p>

   </form>
   <?php include_once ('lib/footer.php'); ?>