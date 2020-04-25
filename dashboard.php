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
      echo "   <a href='bills.php'>Pay Bills</a> | 
      <a href='appointment.php'>Book Appointment</a>";
   }
   elseif ($_SESSION['role'] == 'Medical Team (MT)'){
      echo "<a href='patients.php'>Check Patients' details</a> ";
      if (file_exists('db/appointments/' . $_SESSION['department'] . '.json')){
      echo "  | <a href='viewappointment.php'>View Appointments </a> ";
      }
      else{
         echo " <p> You have no pending appointments </p> ";
      }
   }
   elseif ($_SESSION['role'] == 'Medical Director'){
      echo "<a href='patients.php'>View all patients</a> | ";
      echo "<a href='mt.php'>View all Staff</a> ";
   }

   ?>
   <?php include_once ('lib/footer.php'); ?>