<?php

// Include configuration and start session
@include 'database.php';
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit(); // Stop further execution
}
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
};
// Process update quantity form submission
if (isset($_POST['update_quantity'])) {
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    
    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE id = '$cart_id'");
    $cart_row = mysqli_fetch_assoc($cart_query);
    $product_price = $cart_row['price'];
    $total_price = $product_price * $cart_quantity;
    
    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity', total_price = '$total_price' WHERE id = '$cart_id'") or die('Query failed');
    $message[] = 'Cart quantity updated!';
}

// Fetch cart items for the logged-in user
$user_id = $_SESSION['user_id'];
$grand_total = 0;
$select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Query failed');

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Shopping Cart</h3>
    <p><a href="home.php">Home</a> / Cart</p>
</section>

<section class="shopping-cart">
    <h1 class="title">Products Added</h1>
    <div class="box-container">
    <?php
        // Display cart items
        if(mysqli_num_rows($select_cart) > 0) {
            while($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                $quantity = $fetch_cart['quantity'];
                $product_id = $fetch_cart['pid'];
                $product_name = $fetch_cart['name'];
                $product_price = $fetch_cart['price'];
                $product_image = $fetch_cart['image'];
                $total_price = $fetch_cart['total_price'];
    ?>
    <div class="box">
        <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Delete this from cart?');"></a>
        <a href="view_page.php?pid=<?php echo $product_id; ?>" class="fas fa-eye"></a>
        <img src="uploaded_img/<?php echo $product_image; ?>" alt="" class="image">
        <form action="" method="post">
            <input type="hidden" value="<?php echo $fetch_cart['id']; ?>" name="cart_id">
            <input type="number" min="1" value="<?php echo $quantity; ?>" name="cart_quantity" class="qty">
            <input type="submit" value="Update" class="option-btn" name="update_quantity">
        </form>
        <div class="name"><?php echo $product_name; ?></div>
        <div class="price">Rs<?php echo $product_price; ?></div>
        <div class="sub-total">Sub-total: <span>Rs<?php echo $total_price; ?>/-</span></div>
    </div>
    <?php
                $grand_total += $total_price;
            }
        } else {
            echo '<p class="empty">Your cart is empty</p>';
        }
    ?>
    </div>

    <div class="cart-total">
        <p>Grand total: <span>Rs<?php echo $grand_total; ?>/-</span></p>
        <a href="shop.php" class="option-btn">Continue Shopping</a>
        <a href="checkout.php" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
    </div>
</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
