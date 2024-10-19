<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
<style type="text/css">
<!--
.style2 {color: #CC9900}
-->
</style>

<header class="header" style="height: 80px;">

    <div class="flex">

        <a href="home.php" class="logo"><span class="style2"><img src="uploaded_img/logobook.png" alt="img" width="101" height="100" style="max-height: 60px;" /></span></a>
        <nav class="navbar">
          <ul>
                <li><a href="home.php">home</a></li>
                
                <li><a href="about.php">about</a></li>
                <li><a href="contact.php">contact</a></li>
                    
                <li><a href="shop.php">shop</a></li>
                <li><a href="orders.php">orders</a></li>
               
                <li><a href="login.php">login</a></li>
                <li><a href="registration.php">register</a></li>
                <li><a href="review.php">review</a></li>
                   
          </ul>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <!-- <a href="search_page.php" class="fas fa-search"></a> -->
            <div id="user-btn" class="fas fa-user"></div>
            <?php
                $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            ?>
           
            <?php
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
           
        </div>

        <div class="account-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
        </div>

    </div>

</header>
