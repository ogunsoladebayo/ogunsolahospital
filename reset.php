<?php
   include_once ('lib/header.php');
   if (!$_SESSION['logged_in'] && !isset($_GET["token"]) && !isset($_SESSION['token'])){
      $_SESSION["error"] = "You are not authorized to view this page";
      header("Location: login.php");
   }
 ?>
<h3>Change password</h3>
<p>Change password for: [email] </p>
<form action="processreset.php" method="POST">
   <p>
      <?php if (isset($_SESSION["error"]) && !empty($_SESSION["error"])){
      echo "<span style='color:red'>" . $_SESSION['error'] . "</span>";
      session_destroy();}
      ?>
   </p>
   <?php if (!$_SESSION['logged_in']){ ?>
   <input   <?php
               if (isset($_SESSION['token'])){
                  echo "value='" . $_SESSION['token'] . "'";
               }else {
                  echo "value='" . $_GET['token'] . "'";
               }
            ?> type="hidden" name="token"/>
   <?php } ?>
   <p>
      <label> Email address </label><br>
      <input <?php if (isset($_SESSION['email'])){echo "value=" . $_SESSION['email'];} ?> type="text" name="email" placeholder="example@gmail.com">
   </p>
   <p>
   <label>Enter your new Password </label><br>
   <input type="password" name="password" placeholder="Password">
   </p>

   <p><button type="submit">Reset Password</button></p>

</form>
   <?php include_once ('lib/footer.php'); ?>