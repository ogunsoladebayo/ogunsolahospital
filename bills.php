<?php
   include_once ('lib/header.php');
   require_once('functions/alert.php');
   require_once('functions/user.php');
   require_once('functions/redirect.php');

   if (!user_loggedIn() &&  !token_set()){
    $_SESSION["error"] = "You are not authorized to view this page";
    header("Location: login.php");
    }

    $booked_appointment = false;
    $appointmentfile = json_decode(file_get_contents('db/appointments/'. $_SESSION['department'] .'.json'));
    foreach ($appointmentfile as $key => $value) {
        foreach($value as $checker){
            if ( $checker == $_SESSION['logged_in']) {
            $booked_appointment = true;
        }
    }
    }
    if($booked_appointment == false){
            set_Alert('error', 'You have not booked an appointment, you have no bills');
            redirect_to('bookappointment.php');
    }

        $txref = "ogunsola_";
        for ($i = 0; $i < 7; $i++) {
            $txref .= mt_rand(0, 6);
        }
?>
<div class="container">
        <a class="navbar-brand" href="dashboard.php">Welcome to Ogunsola Hospital Payment Page </a>
</div>

<div class="container">   		
    <div class="row">
        <div class="text">
            <p class="lead">Pay your hospital bills</p>
        </div>
        <div>
        <br>
        <tr>
            <td> <b> INVOICE: Patient Medical bills</b>  </td>
        </tr>
        <br>

        <tr>
            <td> Name: <?php echo $_SESSION["first_name"] . ' ' . $_SESSION["last_name"];?> </td>
        </tr>
        <br>
        <tr>
            <td> Patient ID: <?php echo $_SESSION['logged_in'] ?> </td>
        </tr>
        <br>
        <tr>
            <td> E-Mail: <?php echo $_SESSION['email'] ?> </td>
        </tr>
        <br>

        <tr>
            <td> INVOICE - Transaction ID: <?php echo $txref ?> </td>
        </tr>
        <br>
        <tr>
            <td> Total Amount Due: </td>
            <td> <b> NGN 11,750.00 </b> </td>
        </tr>
        <br>

        </form>
        </div>
    </div>


<form method="POST" action="flutterwave/processPayment.php" id="paymentForm">
            <input type="hidden" name="amount" value="11750" /> <!-- Replace the value with your transaction amount -->
            <!-- <input type="hidden" name="payment_options" value="card" /> Can be card, account, ussd, qr, mpesa, mobilemoneyghana  (optional) -->
            <input type="hidden" name="description" value="Pay Hospital bills" /> <!-- Replace the value with your transaction description -->
            <input type="hidden" name="title" value="Ogunsola Hospital" /> <!-- Replace the value with your transaction title (optional) -->
            <input type="hidden" name="country" value="NG" /> <!-- Replace the value with your transaction country -->
            <input type="hidden" name="currency" value="NGN" /> <!-- Replace the value with your transaction currency -->
            <input type="hidden" name="email" value="<?php echo $_SESSION['email'] ?>" /> <!-- Replace the value with your customer email -->
            <input type="hidden" name="firstname" value="<?php echo $_SESSION["first_name"] ?>" /> <!-- Replace the value with your customer firstname (optional) -->
            <input type="hidden" name="lastname"value="<?php echo $_SESSION["last_name"] ?>" /> <!-- Replace the value with your customer lastname (optional) -->
            <!-- <input type="hidden" name="phonenumber" value="08098787676" /> Replace the value with your customer phonenumber (optional if email is passes) -->
            <input type="hidden" name="pay_button_text" value="Complete Payment" /> <!-- Replace the value with the payment button text you prefer (optional) -->
            <input type="hidden" name="ref" value="<?php echo $txref ?>" /> <!-- Replace the value with your transaction reference. It must be unique per transaction. You can delete this line if you want one to be generated for you. -->
            <input type="hidden" name="env" value="staging">
            <input type="hidden" name="publicKey" value="FLWPUBK_TEST-79f753c4ee38ae7ebd256c31526d7af7-X"> <!-- Put your public key here -->
            <input type="hidden" name="secretKey" value="FLWSECK_TEST-569ae29f3f3d6c0074d1aeb44207ccdb-X"> <!-- Put your secret key here -->
            <input type="hidden" name="successurl" value="ogunsolahospital-sng-v3/processtransaction.php"> <!-- Put your success url here -->
            <input type="hidden" name="failureurl" value="ogunsolahospital-sng-v3/processtransaction.php"> <!-- Put your failure url here -->
            <input type="submit" class="btn btn-sm btn-primary" value="Pay Now" />
        </form>
</div>



<?php include_once ('lib/footer.php'); ?>