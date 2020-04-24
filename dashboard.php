<?php 
   include_once ('lib/header.php');
   ?>

   <h3>My Dashboard</h3><hr>
   Welcome, <?php echo $_SESSION["full_name"];?><br>
   User ID - <?php echo $_SESSION["id"];?><br>
   Role -  <?php echo $_SESSION["role"];?><br>

   <?php
   if ($_SESSION['role'] == 'Patient'){
      echo "   <a href=''>Pay Bills</a> | 
      <a href='appointment.php'>Book Appointment</a>";
   }
   elseif ($_SESSION['role'] == 'Medical Team (MT)'){
      echo "   <a href='db/appointments/sheet.php'>View Appointments </a> | 
      <a href='db/users/patients.php'>Check Patients' details</a>";
   }
   ?>
   <?php include_once ('lib/footer.php'); ?>