<?php
// Include the database connection file


@include 'database.php';

// Fetch data in descending order (lastest entry first)
$sql = "SELECT * FROM users ORDER BY id DESC";
 $query= $conn->query($sql)
?>

<html>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <style>
        .container {
            display: flex;
            justify-content: center; /* Centers items horizontally */
            margin-top: 20px; /* Adjust margin as needed */
        }
        table {
            width: 100%; /* Set table width to 100% */
        }
        table tr th,
        table tr td {
            padding: 10px;
            text-align: center; /* Center-align table cells */
			border-collapse: collapse; /* Collapse table borders */
            border: 1px solid black; /* Add border to the table */
        }
   </style>
</head>

<body>
<?php @include 'admin_header.php'; ?>
	<h2 style="text-align:center ;">Customer Report</h2>

	<div class="container">
		<div id="rpt">
			<table border="1">
				<tr>
					<td><strong>Sr. No.</strong></td>
					<td><strong>Name</strong></td>
                    <td><strong>Birthdate</strong></td>
					<!-- <td><strong>Age</strong></td> -->
					<td><strong>Email</strong></td>
                    <td><strong>Password</strong></td>
                    <td><strong>Address</strong></td>
					
				</tr>
				<?php
				// Fetch the next row of a result set as an associative array
				$i=0;
				while ($res = $query->fetch_assoc()) {
					echo "<tr>";
					echo" <td >".++$i."</td>";
					echo "<td>".$res['name']."</td>";
					echo "<td>".$res['bdate']."</td>";
					echo "<td>".$res['email']."</td>";
                    echo "<td>".$res['password']."</td>";
                    echo "<td>".$res['address']."</td>";
					echo "</tr>";	
				}
				?>
				
			</table>
		</div>
	</div>
<div class="container">
<button type="button" class="btn btn-dark"  onclick="myFunction()">Print Report</button>
</div>
</body>
</html>

<script type="text/javascript">
function myFunction() {
    var divToPrint = document.getElementById('rpt');
    var popupWin = window.open('', '_blank');
    popupWin.document.open();
    popupWin.document.write('<html><body onload="window.print()"><center><br><div style="color: #FFFFFF;font-family:Apple Chancery, cursive;text-shadow: #FFF 0px 0px 5px, #FFF 0px 0px 10px, #FFF 0px 0px 15px, #FF2D95 0px 0px 20px, #FF2D95 0px 0px 30px, #FF2D95 0px 0px 40px, #FF2D95 0px 0px 50px, #FF2D95 0px 0px 75px;font-style:italic;color: #FFFFFF;"><h1 align="center"><u>Customer Report</u></h1></div><h3><u>All User Report</u></h3>' + divToPrint.innerHTML + '</center></body></html>');
    popupWin.document.close();
}
</script>
