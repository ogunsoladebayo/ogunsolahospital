<?php 
   include_once ('lib/header.php');
   require_once('functions/alert.php');
   ?>
   <p>
      <?php print_alert(); ?>
   </p>


   <h3>My Dashboard</h3><hr>
   Welcome, <?php echo $_SESSION["logged_in"];?><br>
   User ID - <?php echo $_SESSION["id"];?><br>
   Role -  <?php echo $_SESSION["role"];?><br>

   <?php
   if ($_SESSION['role'] == 'Patient'){
      echo "   <a href=''>Pay Bills</a> | 
      <a href='appointment.php'>Book Appointment</a>";
   }
   elseif ($_SESSION['role'] == 'Medical Team (MT)'){
      echo "<a href='db/users/patients.php'>Check Patients' details</a> ";
      if (file_exists('db/appointments/' . $_SESSION['department'] . '.json')){
      echo "  | <a href='db/appointments/" . $_SESSION['department'] . ".json'>View Appointments </a> ";
      }
      else{
         echo " <p> You have no pending appointments </p> ";
      }
   }
   ?>
   <?php include_once ('lib/footer.php'); ?>