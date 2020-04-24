<?php
   include_once ('lib/header.php');
   require_once('functions/alert.php');
   if (isset($_SESSION["logged_in"]) && !empty($_SESSION["logged_in"])) {
   header("Location: dashboard.php");
   }
?>
<div class="container">
   <div class="row col-6">
      <h3>Registration</h3>
   </div>
   <div class="row col-6">
      <p><strong> Please fill the form below to complete your registration</strong></p>
   </div>
   <div class="row col-6">
      <p>All fields are required</p>
   </div>
   <div class="row col-6">

   <form action="processreg.php" method="POST">
      <p>
         <?php print_alert(); ?>
      </p>
      <p>
         <label> First Name </label><br>
         <input 
         <?php
         if (isset($_SESSION["first_name"])){
            echo "value=" . $_SESSION['first_name'];
         }
         ?>
         type="text" class="form-control" name="first_name" placeholder="First Name">
         <?php 
         if (isset($_SESSION["first_name_error"]) && !empty($_SESSION["first_name_error"])){
               echo "<span style='color:red'>" . $_SESSION['first_name_error'] . "</span>";}
         ?>
      </p>
      <p>
         <label> Last Name </label><br>
         <input 
         <?php
         if (isset($_SESSION["last_name"])){
            echo "value=" . $_SESSION['last_name'];
         }
         ?>
         type="text" class="form-control" name="last_name" placeholder="Last Name">
      </p>
      <p>
         <label>Gender</label><br>
         <select class="form-control" name="gender">
            <option value="">Select One</option>
            <option 
               <?php
                  if (isset($_SESSION["gender"]) && $_SESSION["gender"] == "Female"){
                  echo "selected";
                  }
               ?>
            >Female</option>
            <option
               <?php
                  if (isset($_SESSION["gender"]) && $_SESSION["gender"] == "Male"){
                  echo "selected";
                  }
               ?>
            >Male</option>
         </select>
      </p>
      <p>
         <label> House Address</label><br>
         <input 
         <?php
         if (isset($_SESSION["house_address"])){
            echo "value=" . $_SESSION['house_address'];
         }
         ?>
         type="text" class="form-control" name="house_address" placeholder="Enter address">
      </p>

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
      <p>
         <label for="designation">Designation</label><br>
         <select class="form-control" name="designation">
            <option value="">Select One</option>
            <option
               <?php
                  if (isset($_SESSION["designation"]) && $_SESSION["designation"] == "Medical Team (MT)"){
                  echo "selected";
                  }
               ?>
            >Medical Team (MT)</option>
            <option
               <?php
                  if (isset($_SESSION["designation"]) && $_SESSION["designation"] == "Patient"){
                  echo "selected";
                  }
               ?>
            >Patient</option>
         </select>
      </p>
      <p>
         <label for="department">Department</label><br>
         <select class="form-control" name="department">
            <option value="">Select One</option>
            <option
               <?php
                  if (isset($_SESSION["department"]) && $_SESSION["department"] == "Laboratory"){
                  echo "selected";
                  }
               ?>
            >Laboratory</option>
            <option
               <?php
                  if (isset($_SESSION["department"]) && $_SESSION["department"] == "X-ray"){
                  echo "selected";
                  }
               ?>
            >X-ray</option>
            <option
               <?php
                  if (isset($_SESSION["department"]) && $_SESSION["department"] == "Maternity"){
                  echo "selected";
                  }
               ?>
            >Maternity</option>

         </select>
      </p>

      <p>
         <button class="btn btn-small btn-success" type="submit">Submit Details</button>
      </p>
      <p>
         <a href="forgot.php" >Forgot Password</a><br>
         <a href="login.php" >Already have an account? Login</a>
      </p>

   </form>
      </div>
</div>

<?php include_once ('lib/footer.php'); 
// session_unset()
?>