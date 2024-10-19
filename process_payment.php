<?php
// process_payment.php

@include 'database.php';
$payment_success = false;
$payment_failure = false;

if(isset($_POST['submit_payment'])){
    // Retrieve form data
    $order_id = $_POST['order_id'];
    $payment_method = $_POST['payment_method'];
    $total_amount = $_POST['total_amount'];
    $payment_date = $_POST['payment_date'];

    // Initialize variables for card details and UPI ID
    $card_number = '';
    $expiration_date = '';
    $cvc = '';
    $upi_id = '';

    // Check payment method and set relevant variables
    if ($payment_method === 'credit_debit_card') {
        $card_number = $_POST['card_number'];
        $name_on_card = $_POST['name_on_card'];
        $expiration_date = $_POST['expiration_date'];
        $cvc = $_POST['cvc'];
    } elseif ($payment_method === 'upi') {
        $upi_id = $_POST['upi_id'];
        $name_on_card = '';
    }

    // Insert payment data into the payment table
    $insert_payment_query = mysqli_query($conn, "INSERT INTO payment (order_id, payment_method, total_amount, payment_date, card_number,name_on_card, expiration_date, cvc, upi_id) VALUES ('$order_id', '$payment_method', '$total_amount', '$payment_date', '$card_number','$name_on_card', '$expiration_date', '$cvc', '$upi_id')");
   
    if ($insert_payment_query) {
        // Payment successful
        $payment_success = true;
    } else {
        // Payment failed
        $payment_failure = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Payment</title>

   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/admin_style.css">
   <!-- JavaScript -->
   <script src="js/script.js" defer></script>

   <style>
       .hidden {
           display: none;
       }
       .container {
           display: flex;
           justify-content: center; /* Centers items horizontally */
           margin-top: 20px; /* Adjust margin as needed */
       }
       body {
           font-size: 18px; /* Change to desired font size */
       }
   </style>
</head>
<body>
   
<?php 
@include 'header.php'; 
?>

<section class="heading">
    <h3>Payment</h3>
    
</section>
<div class="container">
<section class="payment-form">
    <!-- Display payment success or failure message -->
    <?php if ($payment_success): ?>
        <p class="success-message">Payment successful!</p>
    <?php elseif ($payment_failure): ?>
        <p class="failure-message">Payment failed. Please try again.</p>
    <?php endif; ?>

    <!-- Form for making payment -->
    <form action="process_payment.php" method="POST">
        <!-- Rest of the form content -->
        <!-- ... -->
    </form>
</section>
</div>

<?php @include 'footer.php'; ?>

</body>
</html>
