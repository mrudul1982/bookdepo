<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
};

if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $new_name = mysqli_real_escape_string($conn, $_POST['new_name']);
    $new_email = mysqli_real_escape_string($conn, $_POST['new_email']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);

    // Update name if provided
    if (!empty($new_name)) {
        mysqli_query($conn, "UPDATE `users` SET name = '$new_name' WHERE id = '$user_id'") or die('Update name query failed');
    }

    // Update email if provided
    if (!empty($new_email)) {
        mysqli_query($conn, "UPDATE `users` SET email = '$new_email' WHERE id = '$user_id'") or die('Update email query failed');
    }

    // Update password if provided
    if (!empty($new_password)) {
        // Hash the new password
        $hashed_password = mysqli_real_escape_string($conn, md5($new_password));
        mysqli_query($conn, "UPDATE `users` SET password = '$hashed_password' WHERE id = '$user_id'") or die('Update password query failed');
    }

    header('location:admin_users.php');
}

// Fetch user details based on the provided user ID
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('Query failed');
    $user_details = mysqli_fetch_assoc($select_user);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit User</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="edit-user">

   <h1 class="title">Edit User</h1>

   <div class="form-container">
      <form action="" method="post">
         <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
         <div class="form-group">
            <label for="new_name">New Name:</label>
            <input type="text" id="new_name" name="new_name" value="<?php echo $user_details['name']; ?>">
         </div>
         <div class="form-group">
            <label for="new_email">New Email:</label>
            <input type="email" id="new_email" name="new_email" value="<?php echo $user_details['email']; ?>">
         </div>
         <div class="form-group">
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter New Password">
         </div>
         <button type="submit" name="update" class="btn">Update</button>
      </form>
   </div>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>
