<?php

@include 'database.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

// Check if the form is submitted
if(isset($_POST['buy_now'])) {
   // Get product details from the form
   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];
//    $quantity = $_POST['quantity'];

   // Calculate total price
  
} else {
   // Redirect if form is not submitted
   header('location:home.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Order Details</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style type="text/css">
      .style1 {
         font-family: Arial, Helvetica, sans-serif;
         color: #FFFF00;
      }
      .style2 {color: red}
      .style3 {color: #CC0000}
   </style>
</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="shopping-cart">

   <h1 class="title">Order Details</h1>
   <div class="box-container">
   <div  class="box">
   
      
        
         <form action="cart.php" method="POST">
          
           
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Order Details</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style type="text/css">
      .style1 {
         font-family: Arial, Helvetica, sans-serif;
         color: #FFFF00;
      }
      .style2 {color: red}
      .style3 {color: #CC0000}
   </style>
</head>
<body>
   


<section class="shopping-cart">

   <h1 class="title">Order Details</h1>
   <div class="box-container">
   <div  class="box">
   
      
         <img src="uploaded_img/<?php echo $product_image; ?>" alt="" class="image">
         <div class="name"><?php echo $product_name; ?></div>
         <form action="order.php" method="POST" id="orderForm">
            <div class="price">Rs<?php echo $product_price; ?></div>
            <!-- Quantity Selection -->
           
           
           <span class="name"> Quantity  : </span> <input type="number" id="product_quantity" name="product_quantity" min="1" value="1">
            <br>
            <br>
           
            <br>
            <!-- Hidden input fields for product details -->
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
            <input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
            <input type="hidden" name="product_image" value="<?php echo $product_image; ?>">
            <input type="hidden" name="total_price" value="<?php echo $totalPrice; ?>">
            <input type="hidden" name="product_quantity" id="quantityHidden" value="<?php echo $quantity; ?>">

            
            <?php $totalPrice=$product_price; ?>
            <!-- Total price -->
            <p id="totalPrice" class="name">Total: Rs<?php echo $totalPrice; ?></p>
            <!-- Buy Now Button -->
            <button type="submit" name="order" class="btn">Order</button>
         </form>
         
        
      
     
   
   </div>
   </div>
 
</section>



<script>
   // Get quantity select element and total price element
   const quantitySelect = document.getElementById('quantity');
   const quantityHidden = document.getElementById('quantityHidden');
   const totalPrice = document.getElementById('totalPrice');
   
   // Add event listener to quantity select element
   quantitySelect.addEventListener('change', function() {
      // Get selected quantity
      const selectedQuantity = parseInt(quantitySelect.value);
      // Update hidden input field for quantity
      quantityHidden.value = selectedQuantity;
      // Get product price
      const productPrice = <?php echo $product_price; ?>;
      // Calculate total price
      const total = selectedQuantity * productPrice;
      // Update total price element
      totalPrice.textContent = 'Total: Rs' + total;
   });
</script>


</body>
</html>

              
           
           
           
            
          
         
         
        
      
      
   
   
   <!-- Back Button -->
   <a href="javascript:history.back()" class="btn">Back</a>
</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>
</body>
</html>
