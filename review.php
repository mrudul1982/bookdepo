<?php
// Include your database connection file
include 'database.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    // Insert the review into the database
    $sql = "INSERT INTO reviews (name, rating, review) VALUES ('$name', '$rating', '$review')";
    if (mysqli_query($conn, $sql)) {
        // Redirect to prevent duplicate submissions
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Fetch reviews from the database
$sql = "SELECT * FROM reviews";
$result = mysqli_query($conn, $sql);
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

   <style>
      /* Add your custom CSS styles here */
      .box-container {
         display: flex;
         flex-wrap: wrap;
         justify-content: space-around;
         align-items: flex-start;
         margin-top: 20px;
      }

      .box {
         width: 300px;
         padding: 20px;
         margin-bottom: 20px;
         border: 1px solid #ccc;
         border-radius: 8px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         background-color: #f9f9f9;
      }

      .box p {
         margin-bottom: 10px;
         font-size: 16px;
      }

      .stars {
         margin-bottom: 10px;
      }

      .stars i {
         color: gold;
      }

      .stars i.fa-star-half-alt {
         color: #ffd7008f; /* Adjust opacity for half star */
      }

      .box h3 {
         font-size: 18px;
         font-weight: bold;
         color: #333;
      }

      form {
         margin-bottom: 20px;
      }

      form label {
         display: block;
         margin-bottom: 5px;
         font-weight: bold;
         color: #333;
      }

      form input[type="text"],
      form select,
      form textarea {
         width: 100%;
         padding: 10px;
         margin-bottom: 10px;
         border: 1px solid #ccc;
         border-radius: 5px;
         box-sizing: border-box;
         font-size: 16px;
      }

      form button[type="submit"] {
         padding: 10px 20px;
         background-color: #007bff;
         color: #fff;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         font-size: 16px;
      }

      form button[type="submit"]:hover {
         background-color: #0056b3;
      }
   </style>
</head>
<body>
<?php @include 'header.php'; ?> 
<section class="reviews" id="reviews">

    <h1 class="title">Client's Reviews</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="rating">Rating:</label>
        <select id="rating" name="rating" required>
            <option value="1">1 Star</option>
            <option value="2">2 Stars</option>
            <option value="3">3 Stars</option>
            <option value="4">4 Stars</option>
            <option value="5">5 Stars</option>
        </select>
        
        <label for="review">Your Review:</label>
        <textarea id="review" name="review" required></textarea>
        
        <button type="submit">Submit Review</button>
    </form>

    <div class="box-container">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="box">';
                echo '<p>' . $row['review'] . '</p>';
                // Display stars based on the rating
                echo '<div class="stars">';
                for ($i = 0; $i < $row['rating']; $i++) {
                    echo '<i class="fas fa-star"></i>';
                }
                echo '</div>';
                echo '<h3>' . $row['name'] . '</h3>';
                echo '</div>';
            }
        } else {
            echo '<p>No reviews yet.</p>';
        }
        ?>
    </div>
</section>
<?php @include 'footer.php'; ?>
<script src="js/admin_script.js"></script>

</body>
</html>
