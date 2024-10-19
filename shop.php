<?php

@include 'database.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_wishlist'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    // if(mysqli_num_rows($check_wishlist_numbers) > 0){
    //     $message[] = 'already added to wishlist';
    // }elseif(mysqli_num_rows($check_cart_numbers) > 0){
    //     $message[] = 'already added to cart';
    // }else{
    //     mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
    //     $message[] = 'product added to wishlist';
    // }

}

if(isset($_POST['add_to_cart'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
    $total_price = $product_price * $product_quantity;

    
    $query = "SELECT p.cate_id, cat.catname AS category_name 
          FROM products p 
          LEFT JOIN category cat ON p.cate_id = cat.id 
          WHERE p.id = '$product_id'";

// Print the query for debugging
// echo "Query: $query";

// Execute the query
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

    // $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    // if(mysqli_num_rows($check_cart_numbers) > 0){
    //     $message[] = 'already added to cart';
    // }else{

    //     $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    //     if(mysqli_num_rows($check_wishlist_numbers) > 0){
    //         mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
    //     }

    //     mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
    //     $message[] = 'product added to cart';
    // }
    $check_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id' AND pid = '$product_id'") or die('Check cart query failed');
  if(mysqli_num_rows($check_cart) > 0) {
        // Update the quantity if the product is already in the cart
        $update_quantity = "UPDATE `cart` SET quantity = quantity + '$product_quantity' WHERE user_id = '$user_id' AND pid = '$product_id'";
        echo "Update Query: $update_quantity"; // Print the update query
        mysqli_query($conn, $update_quantity) or die('Update quantity query failed');
    } else {
        // Insert the product into the cart table if it's not already in the cart
        $insert_product = "INSERT INTO `cart` (user_id, pid, name, price, quantity, total_price, image, category_id, category_name) 
                           VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$total_price', '$product_image', '$category_id', '$category_name')";
        // echo "Insert Query: $insert_product"; // Print the insert query
        mysqli_query($conn, $insert_product) or die('Insert product query failed');
    }

    header('location: cart.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>our shop</h3>
  
</section>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="POST" class="box">
         <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <div class="price">Rs<?php echo $fetch_products['price']; ?>/-</div>
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <input type="number" name="product_quantity" value="1" min="0" class="qty">
         <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
         <input type="hidden" name="category_id" value="<?php echo $fetch_products['cate_id']; ?>">
         <button type="submit" name="add_to_cart" class="btn">Buy Now</button>
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>

   </div>

</section>






<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>