<?php

@include 'database.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
   exit(); // Stop further execution
}
 
// Check if the category_id is provided in the URL
if(isset($_GET['category_id'])) {
   $category_id = $_GET['category_id'];
    $query = "SELECT catname FROM `category` WHERE id = '$category_id'";

   // Print the query for debugging purposes
   // echo "Select Category Query: $query<br>";

   // Execute the query
   $select_category = mysqli_query($conn, $query) or die('Category query failed');

   // Fetch category name from the database based on category_id
   // $select_category = mysqli_query($conn, "SELECT catname FROM `category` WHERE id = '$category_id'") or die('Category query failed');

   if(mysqli_num_rows($select_category) > 0){
      $category_data = mysqli_fetch_assoc($select_category);
      $category_name = $category_data['catname'];
   } else {
      // If category not found, set a default name
      $category_name = "Unknown Category";
   }
} else {
   // Redirect if category_id is not provided
   // header('location:home.php'); // Redirect to home page for example
   // exit(); // Stop further execution
}

// Handle form submission when "Buy Now" button is clicked
// Handle form submission when "Buy Now" button is clicked
// if(isset($_POST['add_to_cart'])) {
  
//    $product_id = $_POST['product_id'];
//    $product_name = $_POST['product_name'];
//    $product_price = $_POST['product_price'] ;
//    $product_image = $_POST['product_image'];
//    $product_quantity = $_POST['product_quantity'];
   

//    // Fetch category_id and category_name based on the product_id
//    // $select_product_category = mysqli_query($conn, "SELECT cate_id, cat.catname as category_name FROM `products` p left join category cat on p.cate_id=cat.id WHERE id = '$product_id'") or die('Fetch product category query failed');
//    // $product_id = $_POST['product_id'];

//    // Build the query string
//    $query = "SELECT p.cate_id, cat.catname AS category_name 
//           FROM products p 
//           LEFT JOIN category cat ON p.cate_id = cat.id 
//           WHERE p.id = '$product_id'";

//    // Print the query for debugging
//    // echo "Query: $query";

//    // Execute the query
//    $select_product_category = mysqli_query($conn, $query) or die('Fetch product category query failed');

   
//    if(mysqli_num_rows($select_product_category) > 0) {
//       $product_category_data = mysqli_fetch_assoc($select_product_category);
//       $category_id = $product_category_data['cate_id'];
    
//       $category_name = $product_category_data['category_name'];
//    } else {
//       // If product category not found, set default values
//       $category_id = 0;
//       $category_name = "Uncategorized";
//    }

//    // Check if the product already exists in the cart for the user
//    $check_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id' AND pid = '$product_id'") or die('Check cart query failed');
//    if(mysqli_num_rows($check_cart) > 0) {
//       // Update the quantity if the product is already in the cart
//       $update_quantity = mysqli_query($conn, "UPDATE `cart` SET quantity = quantity + '$product_quantity' WHERE user_id = '$user_id' AND pid = '$product_id'") or die('Update quantity query failed');
//    } else {
//       // Insert the product into the cart table if it's not already in the cart
//       $totalPrice = $product_price * $product_quantity;
//       // $insert_product = mysqli_query($conn, "INSERT INTO `cart` (user_id, pid, name, price, quantity,total_price, image, category_id, category_name) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity','$total_price', '$product_image', '$category_id', '$category_name')") or die('Insert product query failed');
//       $insert_product = mysqli_query($conn, "INSERT INTO `cart` (user_id, pid, name, price, quantity, total_price, image, category_id, category_name) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$totalPrice', '$product_image', '$category_id', '$category_name')") or die('Insert product query failed');

//    }

//    $_SESSION['cart'][] = array(
//       'product_id' => $product_id,
//       'product_name' => $product_name,
//       'product_price' => $product_price,
//       'product_quantity' => $product_quantity,
//       'product_image' => $product_image
//    );
//    // Redirect to cart page after adding the product to cart
//    header('location: cart.php');
//    exit(); // Stop further execution
// }
if(isset($_POST['add_to_cart'])) {
   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   // Calculate total price
   $total_price = $product_price * $product_quantity;
   echo "Product ID: $product_id<br>";
   echo "Product Name: $product_name<br>";
   echo "Product Price: $product_price<br>";
   echo "Product Quantity: $product_quantity<br>";
   echo "Total Price (Price * Quantity): $total_price<br>";
   // die;
   // Fetch category_id and category_name based on the product_id
   $query = "SELECT p.cate_id, cat.catname AS category_name 
             FROM products p 
             LEFT JOIN category cat ON p.cate_id = cat.id 
             WHERE p.id = '$product_id'";
   
   $select_product_category = mysqli_query($conn, $query) or die('Fetch product category query failed');

   if(mysqli_num_rows($select_product_category) > 0) {
       $product_category_data = mysqli_fetch_assoc($select_product_category);
       $category_id = $product_category_data['cate_id'];
       $category_name = $product_category_data['category_name'];
   } else {
       // If product category not found, set default values
       $category_id = 0;
       $category_name = "Uncategorized";
   }

   // Check if the product already exists in the cart for the user
   $check_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id' AND pid = '$product_id'") or die('Check cart query failed');
   if(mysqli_num_rows($check_cart) > 0) {
       // Update the quantity if the product is already in the cart
       $update_quantity = mysqli_query($conn, "UPDATE `cart` SET quantity = quantity + '$product_quantity', total_price = total_price + '$total_price' WHERE user_id = '$user_id' AND pid = '$product_id'") or die('Update quantity query failed');
   } else {
       // Insert the product into the cart table if it's not already in the cart
       $insert_product = mysqli_query($conn, "INSERT INTO `cart` (user_id, pid, name, price, quantity, total_price, image, category_id, category_name) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$total_price', '$product_image', '$category_id', '$category_name')") or die('Insert product query failed');
   }
   
   $_SESSION['cart'][] = array(
       'product_id' => $product_id,
       'product_name' => $product_name,
       'product_price' => $product_price,
       'product_quantity' => $product_quantity,
       'product_image' => $product_image
   );
   // Redirect to cart page after adding the product to cart
   header('location: cart.php');
   exit(); // Stop further execution
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View <?php echo $category_name; ?> Products</title>

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

<section class="products">

   <h1 class="title"><?php echo $category_name; ?> Products</h1>

   <div class="box-container">
      <?php
      @include 'database.php';
      // Fetch products for the selected category
      $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE cate_id = '$category_id'") or die('Fetch products query failed');
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="price">Rs<?php echo $fetch_products['price']; ?></div>
         
         <!-- Form to add product to cart -->
         <form action="" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
            <!-- Quantity input -->
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="product_quantity" min="1" value="1">
            <!-- Submit button -->
            <button type="submit" name="add_to_cart" class="btn">Buy Now</button>
         </form>
      </div>
      <?php
         }
      } else {
         echo '<p class="empty">No products found for this category!</p>';
      }
      ?>
   </div>

   <!-- Back Button -->
   <a href="javascript:history.back()" class="btn">Back</a>
</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>
</body>
</html>
