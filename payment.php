<?php 
@include 'database.php'; ?>
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
<?php @include 'header.php'; ?>  
<?php 


$payment_success = false;
$payment_failure = false;
$total_amount = isset($_GET['total_amount']) ? $_GET['total_amount'] : '';
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';
?>

<section class="heading">
    <h3>Payment</h3>
   
</section>
<div class="container">
<section class="payment-form">
    <form action="process_payment.php" method="POST">
        <h3>Choose Payment Method</h3>
        <!-- Payment Details -->
        <div class="inputBox">
            <span>Total Amount:</span>
            <input type="text" name="total_amount" value="<?php echo $total_amount; ?>" readonly>
        </div>
        <!-- Hidden input field for order_id -->
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        <!-- Select Payment Method -->
        <div class="inputBox">
            <span>Select Method:</span>
            <select name="payment_method" id="payment-method">
                <option value="credit_debit_card">Credit/Debit Card</option>
                <option value="upi">UPI</option>
            </select>
        </div>

        <!-- Credit/Debit Card Details -->
        <div id="card-details" class="hidden">
            <h3>Credit/Debit Card Details</h3>
            <!-- Input fields for card details -->
            <div class="inputBox">
                <span>Card Number:</span>
                <input type="text" name="card_number" placeholder="Enter card number">
            </div>
            <div class="inputBox">
                <span>Name On Card :</span>
                <input type="text" name="name_on_card" placeholder="Enter name on card">
            </div>
            <div class="inputBox">
                <span>Expiration Date:</span>
                <input type="text" name="expiration_date" placeholder="MM/YY">
            </div>
            <div class="inputBox">
                <span>CVC:</span>
                <input type="text" name="cvc" placeholder="Enter CVC">
            </div>
        </div>

        <!-- UPI Details -->
        <div id="upi-details" class="hidden">
            <h3>UPI Details</h3>
            <!-- Input field for UPI ID -->
            <div class="inputBox">
                <span>UPI ID:</span>
                <input type="text" name="upi_id" placeholder="Enter UPI ID">
            </div>
        </div>

        <!-- Payment Details -->
        <div class="payment-details">
            <div class="inputBox">
                <span>Payment Date:</span>
                <input type="date" name="payment_date">
            </div>
        </div>
        <!-- Payment message section -->
        <section class="payment-message">
            <?php if ($payment_success): ?>
                <p class="success-message">Payment successful!</p>
            <?php elseif ($payment_failure): ?>
                <p class="failure-message">Payment failed. Please try again.</p>
            <?php endif; ?>
        </section>

        <!-- Submit button -->
        <input type="submit" name="submit_payment" value="Make Payment" class="btn">
    </form>
</section>
</div>

<?php @include 'footer.php'; ?>

<script>
    document.getElementById("payment-method").addEventListener("change", function() {
        var selectedOption = this.value;
        var cardDetails = document.getElementById("card-details");
        var upiDetails = document.getElementById("upi-details");

        if (selectedOption === "credit_debit_card") {
            cardDetails.classList.remove("hidden");
            upiDetails.classList.add("hidden");
        } else if (selectedOption === "upi") {
            upiDetails.classList.remove("hidden");
            cardDetails.classList.add("hidden");
        } else {
            cardDetails.classList.add("hidden");
            upiDetails.classList.add("hidden");
        }
    });
</script>

</body>
</html>
