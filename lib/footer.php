<!--- MENU --->
<p>
   <a href="index.php"> Home </a> <br/>
   <?php if (!isset($_SESSION["logged_in"])) {?>
   <a href="login.php"> Click here to login </a> |
   <a href="register.php"> New user, Register here </a> |
   <a href="forgot.php"> Forgot Password </a>
   <?php } 
   else{?>
   <a href="logout.php"> Logout </a>|
   <a href="reset.php"> Change Password </a>
   <?php } ?>
</p>
</body>
</html>