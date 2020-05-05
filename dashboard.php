<?php 
   include_once ('lib/header.php');
   require_once('functions/alert.php');
   if (!isset($_SESSION["logged_in"])) {
      header("Location: login.php");
      }
   
   ?>
   <p>
      <?php print_alert(); ?>
   </p>

   <h3>My Dashboard</h3><hr>
   Welcome, <?php echo $_SESSION["first_name"] . ' ' . $_SESSION["last_name"];?><br>
   User ID - <?php echo $_SESSION["logged_in"];?><br>
   Role -  <?php echo $_SESSION["role"];?><br>
   Department -  <?php echo $_SESSION["department"];?><br>


   <?php
   if ($_SESSION['role'] == 'Patient'){
      echo "<a href='bookappointment.php'>Book Appointment</a> | 
               <a href='bills.php'>Pay Bills</a> | 
               <a href='transactionhis.php'>Transaction History</a>";
   }
   elseif ($_SESSION['role'] == 'Medical Team (MT)'){
      echo "<a href='viewpatients.php'>Check Patients' details</a> ";
      if (file_exists('db/appointments/' . $_SESSION['department'] . '.json')){
      echo "  | <a href='viewappointment.php'>View Appointments </a> ";
      }
      else{
         echo " <p> You have no pending appointments </p> ";
      }
   }
   elseif ($_SESSION['role'] == 'Medical Director'){
      echo "<a href='viewpatients.php'>View all patients</a> | 
               <a href='viewmt.php'>View all Staff</a> | 
               <a href='viewpayments.php'>Payments</a> ";
   }

   ?>
   <?php include_once ('lib/footer.php'); ?>