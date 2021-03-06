<?php
   include_once ('lib/header.php');
   require_once('functions/alert.php');
   require_once('functions/user.php');
   ?>
   <p>
   <?php 
   if (!user_loggedIn() &&  !token_set()){
      $_SESSION["error"] = "You are not authorized to view this page";
      header("Location: login.php");
   }
 ?>
 </p>
 <div class="container">
    <div class="row col-6">
   <h3>Change password</h3>
   </div>
   <!-- <p>Change password for: <?php echo $_SESSION['full_name']; ?> </p> -->
   <div class="row col-6">
      <form action="processreset.php" method="POST">
      <p>
         <?php print_alert(); ?>
      </p>
      <?php if (!user_loggedIn() ){ ?>
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
         <input class="form-control" <?php if (isset($_SESSION['email'])){echo "value=" . $_SESSION['email'];} ?> type="text" name="email" placeholder="example@gmail.com">
      </p>
      <p>
      <label>Enter your new Password </label><br>
      <input type="password" class="form-control" name="password" placeholder="Password">
      </p>

      <p><button class="btn btn-sm btn-primary" type="submit">Change Password</button></p>

      </form>
   </div>
</div>
   <?php include_once ('lib/footer.php'); ?>