<?php
// Include the database connection file


@include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

// Fetch data in descending order (lastest entry first)
$sql = "SELECT * FROM user_order ORDER BY id DESC";
 $query= $con->query($sql)
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <style>
        .main_table{
            display: block;
            margin-left: 5%;
        }
    </style>
</head>

<div class="mainbar">
        <div class="logo">
            <img src="../image/logo2.png"/>
        </div>
        <div class="menu">
            <a href="../admin/adminhomepage.php">Home</a>
            <a href="../admin/manage_product.php">Manage-Product</a>
            <a href="../admin/dashboard.php">Dashboard</a>
            <a href="../admin/report.php">Reports</a>
        </div>
        <div class="icons">
       <a href="../admin/adminlogin.php" >    <div class="box" id="login-btn"> <i class="fa fa-user" ></i></div>  
        </div></a>
    
        <div class="icons1">
            <div class="box1" id="cart-btn"><i class="fa fa-shopping-cart"></i> </div>
        </div>

    </div>

    <!-- manage product -->
    <div class="manageorder">
        <center><h1>Manage Order</h1></center>
        <div class="main_table">
            <table border="1px" class="table" >
                <tr>
                    <th >Prod_ID</th>
                   
                    <th >Prod_Name</th>
                    <th>Prod_Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th> Action</th>
                </tr>
            
    <?php
		// Fetch the next row of a result set as an associative array
		$i=0;
		while ($res = $query->fetch_assoc()) {
			echo "<tr>";
			echo" <td >".++$i."</td>";
			echo "<td>".$res['ord_pname']."</td>";
			echo "<td>".$res['ord_price']."</td>";
			echo "<td>".$res['ord_quantity']."</td>";	
            echo "<td>".$res['ord_finalamt']."</td>";

			echo "<td><a href=\"delete_order.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"> Delete </a></td>";
		}
	?>
            </table>
        </div>
     </div>
<!-- <div class=" manage1">
    <img src="." alt="Delete_product"/>
    <p>Delete Product</p>
</div> -->
   </div>


<!-- Footer -->
<footer>
    <div class="foot">
       <center>
       <p class="foot-info">
       Developed by: Vaishnavi Garudkar and Sakshi Salke!
       </p>
       </center>
    </div>
   </footer>
</body>
    </html>