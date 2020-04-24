<?php
include_once ('lib/header.php');
require_once("functions/alert.php");
if (isset($_SESSION["logged_in"]) && !empty($_SESSION["logged_in"])) {
   header("Location: dashboard.php");
   }
 ?>
<div class="container">
   <div class="row col-6">
      <h3>Login</h3>
   </div>
   <div class="row col-6">
         <?php print_alert(); ?>
   </div>
   <div class="row col-6">

      <form action="processlogin.php" method="POST">
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
         <p>
            <label> Password </label><br>
            <input type="password" class="form-control" name="password" placeholder="Password">
         </p>
         
         <hr/>
         <p><button class="btn btn-sm btn-primary" type="submit">Login</button></p>
         <p>
            <a href="forgot.php" >Forgot Password</a><br>
            <a href="register.php" > No account yet? Register</a>
         </p>

      </form>
   </div>
</div>
   <?php include_once ('lib/footer.php'); ?>