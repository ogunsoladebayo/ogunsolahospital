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
<h3>Login Page</h3>
<form action="processlogin.php" method="POST">
   <p>
      <?php
         if (isset($_SESSION["error"]) && !empty($_SESSION["error"])){
            echo "<span style='color:red'>" . $_SESSION['error'] . "</span>";
         }
      ?>
   </p>
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
   <p>
      <label> Password </label><br>
      <input type="password" name="password" placeholder="Password">
   </p>
   
   <hr/>
   <p><button type="submit">Login</button></p>
   <?php
      session_unset();
   ?>
</form>
Login here
   <?php include_once ('lib/footer.php'); ?>