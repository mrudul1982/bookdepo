<?php
// Include the database connection file
@include 'database.php';

// Fetch data in descending order (latest entry first)
$sql = "SELECT * FROM payment ORDER BY payment_id DESC";
$query = $conn->query($sql);
?>

<html>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom admin CSS file -->
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
	<h2 style="text-align:center;">Payment Report</h2>

	<div class="container">
		<div id="rpt">
			<table border="1">
				<tr>
					<td><strong>Sr. No.</strong></td>
					<td><strong>Payment Method</strong></td>
                    <td><strong>Name On Card</strong></td>
                    <td><strong>Credit/debit Card Number</strong></td>
                    <td><strong>UPI Id</strong></td>
					<td><strong>Expiration Date</strong></td>
                    <td><strong>Amount to Pay</strong></td>
				</tr>
				<?php
				// Fetch the next row of a result set as an associative array
				$i = 0;
				while ($res = $query->fetch_assoc()) {
                    
                        echo "<tr>";
                        echo "<td>".++$i."</td>";
                        echo "<td>".$res['payment_method']."</td>";
                        echo "<td>".$res['name_on_card']."</td>";
                        echo "<td>".$res['card_number']."</td>";
                        echo "<td>".$res['upi_id']."</td>";
                        echo "<td>".$res['expiration_date']."</td>";
                        echo "<td>".$res['total_amount']."</td>";
                       
                        echo "</tr>";
                    // }
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
    popupWin.document.write('<html><body onload="window.print()"><center><br><div style="color: #FFFFFF;font-family:Apple Chancery, cursive;text-shadow: #FFF 0px 0px 5px, #FFF 0px 0px 10px, #FFF 0px 0px 15px, #FF2D95 0px 0px 20px, #FF2D95 0px 0px 30px, #FF2D95 0px 0px 40px, #FF2D95 0px 0px 50px, #FF2D95 0px 0px 75px;font-style:italic;color: #FFFFFF;"><h1 align="center"><u>Payment Report</u></h1></div><h3><u>All Payment Report</u></h3>' + divToPrint.innerHTML + '</center></body></html>');
    popupWin.document.close();
}
</script>
