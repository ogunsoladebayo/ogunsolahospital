<?php
   include_once ('lib/header.php');
   if (isset($_SESSION["logged_in"]) && !empty($_SESSION["logged_in"])) {
   header("Location: dashboard.php");
   }
?>
<h3>Registration</h3>
<p><strong> Please fill the form below to complete your registration</strong></p>
<p>All fields are required</p>

<form action="processreg.php" method="POST">
   <p>
      <?php
         if (isset($_SESSION["error"]) && !empty($_SESSION["error"])){
            echo "<span style='color:red'>" . $_SESSION['error'] . "</span>";
         }
      ?>
      <?php 
      if (isset($_SESSION["$emailError"]) && !empty($_SESSION["$emailError"])){
            echo "<span style='color:red'>" . $_SESSION['$emailError'] . "</span>";}
      ?>

   </p>
   <p>
      <label> First Name </label><br>
      <input 
      <?php
      if (isset($_SESSION["first_name"])){
         echo "value=" . $_SESSION['first_name'];
      }
      ?>
      type="text" name="first_name" placeholder="First Name">
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
      type="text" name="last_name" placeholder="Last Name">
   </p>
   <p>
      <label>Gender</label><br>
      <select name="gender">
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
      type="text" name="house_address" placeholder="Enter address">
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
   <p>
      <label for="">Designation</label><br>
      <select name="designation">
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
      <label> Department </label><br>
      <input 
      <?php
      if (isset($_SESSION["department"])){
         echo "value=" . $_SESSION['department'];
      }
      ?>
      type="text" name="department" placeholder="Department">
   </p>
   <p><button type="submit">Submit Details</button></p>
</form>

<?php include_once ('lib/footer.php'); 
// session_unset()
?>