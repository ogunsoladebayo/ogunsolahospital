<?php
   include_once ('lib/header.php');
   require_once('functions/alert.php');
   if (!isset($_SESSION["logged_in"]) && empty($_SESSION["logged_in"])) {
   header("Location: login.php");
   }
?>
<div class="container">
   <div class="row col-6">
      <h4>Book Appointment</h4>
   </div>
   <div class="row col-6">
      <p> Please fill the form below to book an appointment</p>
   </div>
   <div class="row col-6">
      <p>All fields are required</p>
   </div>
   <div class="row col-6">

   <form action="processappointment.php" method="POST">
      <p>
         <?php print_alert(); ?>
      </p>
      <p>
         <label> Date of Appointment</label><br>
         <input 
         <?php
         if (isset($_SESSION["appointment_date"])){
            echo "value=" . $_SESSION['appointment_date'];
         }
         ?>
         type="text" class="form-control" name="appointment_date" placeholder="Enter an appointment date">
      </p>

      <p>
         <label> Time of Appointment </label><br>
         <input 
         <?php
         if (isset($_SESSION["appointment_time"])){
            echo "value=" . $_SESSION['appointment_time'];
         }
         ?>
         type="text" class="form-control" name="appointment_time" placeholder="Enter an appointment time ">
         
      </p>
      <p>
         <label> Nature of Appointment </label><br>
         <input 
         <?php
         if (isset($_SESSION["appointment_nature"])){
            echo "value=" . $_SESSION['appointment_nature'];
         }
         ?>
         type="text" class="form-control" name="appointment_nature" placeholder="Why do you wish to book an appointment?">
         
      </p>

      <p>
         <label> Initial Complaint </label><br>
         <input 
         <?php
         if (isset($_SESSION["initial_complaint"])){
            echo "value=" . $_SESSION['initial_complaint'];
         }
         ?>
         type="text" class="form-control" name="initial_complaint" placeholder="What have you complained of before?">
         
      </p>

      
      <hr/>
      <p>
         <label for="departmnet">Department</label><br>
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
         <button class="btn btn-small btn-success" type="submit">Book Appointment</button>
      </p>

   </form>
      </div>
</div>

<?php include_once ('lib/footer.php');
?>