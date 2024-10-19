<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website Title</title>
    <style>
        body {
            background-color: #99FFFF;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            margin: auto; /* Center the table horizontally */
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: none; /* Remove borders from cells */
        }
        th {
            background-color: #660066;
            color: #FFFFFF;
            font-size: 24px;
        }
        .logo-cell {
            text-align: center;
        }
        .logo {
            width: 50%;
            max-width: 125px;
            height: auto;
        }
        .style10 {
            color: #FFFFFF;
            text-decoration: none; /* Remove underlines from links */
        }
        .style10:hover {
            text-decoration: underline; /* Add underline on hover */
        }
        @media screen and (max-width: 600px) {
            /* Adjust the layout for small screens */
            .logo {
                width: 100%;
            }
            th, td {
                display: block;
                width: 100%;
            }
            th {
                height: auto;
            }
        }
    </style>
</head>
<body>
<div class="flex">
    <table>
        <tr bgcolor="#660066">
            <th colspan="8">
                <div class="logo-cell">
                    <img src="uploaded_img/logo11.png" alt="logo" width="53%" height="19" class="logo" />                </div>            </th>
            <td colspan="2"><div align="center">
              <h3><a href="home.php" class="style10">Home</a></h3>
            </div></td>
            <td colspan="2"><div align="center">
              <h3><a href="registration.php" class="style10">Register</a></h3>
            </div></td>
            <td colspan="2"><div align="center">
              <h3><a href="login.php" class="style10">Login</a></h3>
            </div></td>
            <td colspan="2"><div align="center">
              <h3><a href="contact.php" class="style10">Contact Us</a></h3>
            </div></td>
            <td colspan="2"><div align="center">
              <h3><a href="about.php" class="style10">About Us</a></h3>
            </div></td>
            <td colspan="2"><div align="center">
              <h3><a href="products.php" class="style10">Hot selling Products</a></h3>
            </div></td>
            <td width="10%" colspan="2"><div align="center">
              <h3><a href="order.php" class="style10">Order</a></h3>
            </div></td>
            <td width="10%" colspan="2"><div align="center">
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            </div></td>
             <td width="10%" colspan="2">
             <div class="account-box" style="display: none;">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
        
            </div></td>
            
           
        </tr>
    </table>
  
</div>
<div class="flex">

<img src="uploaded_img/logo11.png" alt="logo" width="53%" height="19" class="logo" />
        <nav class="navbar" bgcolor="#660066">
          <ul>
                <li><a href="home.php">home</a></li>
                
                        <li><a href="about.php">about</a></li>
                        <li><a href="contact.php">contact</a></li>
                    
                <li><a href="shop.php">shop</a></li>
                <li><a href="orders.php">orders</a></li>
               
                        <li><a href="login.php">login</a></li>
                        <li><a href="register.php">register</a></li>
                   
          </ul>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
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
</body>
</html>
