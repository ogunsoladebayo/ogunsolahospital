<?php include ('/lib/header.php'); ?>
<p><strong> Please fill the form below to complete your registration</strong></p>
<p>Note that all fields are required</p>

<form action="processreg.php" method="POST">
   <p>
      <label> First Name </label><br>
      <input type="text" name="first_name" placeholder="First Name" required>
   </p>
   <p>
      <label> Last Name </label><br>
      <input type="text" name="last_name" placeholder="Last Name" required>
   </p>
   <p>
      <label for="">Gender</label><br>
      <select name="gender" required>
         <option value="">Select One</option>
         <option>Male</option>
         <option>Female</option>
      </select>
   </p>
   <p>
      <label> House Address</label><br>
      <input type="text" name="house_address" placeholder="Enter address" required>
   </p>

   <p>
      <label> Email address </label><br>
      <input type="text" name="email" placeholder="example@gmail.com" required>
   </p>
   <p>
      <label> Password </label><br>
      <input type="password" name="password" placeholder="Password" required>
   </p>
   
   <hr/>
   <p>
      <label for="">Designation</label><br>
      <select name="designation" required>
         <option value="">Select One</option>
         <option>Medical Team (MT)</option>
         <option>Patient</option>
      </select>
   </p>
   <p>
      <label> Department </label><br>
      <input type="text" name="department" placeholder="Department" required>
   </p>
   <p><button type="submit">Submit Details</button></p>
</form>

<?php include ('/lib/footer.php'); ?>