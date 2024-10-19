<?php



@include 'database.php';

if(isset($_POST['submit'])){

   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($conn, $filter_name);
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   // $filter_age = filter_var($_POST['age'], FILTER_SANITIZE_STRING);
   // $age = mysqli_real_escape_string($conn, $filter_age);
   $filter_bdate = filter_var($_POST['bdate'], FILTER_SANITIZE_STRING);
   $bdate = mysqli_real_escape_string($conn, $filter_bdate);
   $filter_address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
   $address = mysqli_real_escape_string($conn, $filter_address);
   $filter_mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_STRING);
   $mobile = mysqli_real_escape_string($conn, $filter_mobile);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
   $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'User already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email,  bdate, address, mobile, password) VALUES('$name', '$email',  '$bdate', '$address', '$mobile', '$pass')") or die('query failed');
         $message[] = 'Registered successfully!';
         header('location: login.php');
      }
   }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      /* CSS for styling labels */
      label {
         display: block;
         margin-bottom: 10px;
         font-size: 18px; /* Adjust the font size as needed */
         text-align: left; /* Align the labels to the left */
      }
   </style>
</head>
<body>

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
   
<section class="form-container">

   <form action="" method="post">
      <h3>Register Now</h3>
      <label for="name">Enter Your Username:</label>
      <input type="text" name="name" id="name" class="box" required>
      <label for="email">Enter Your Email:</label>
      <input type="email" name="email" id="email" class="box" required>
      <!-- <label for="age">Enter Your Age:</label>
      <input type="number" name="age" id="age" class="box" required> -->
      <label for="bdate">Enter Your Birthdate:</label>
      <input type="date" name="bdate" id="bdate" class="box" required>
      <label for="address">Address:</label>
      <textarea name="address" id="address" class="box" rows="4" required></textarea>
      <label for="mobile">Mobile Number:</label>
      <input type="text" name="mobile" id="mobile" class="box" required>
      <label for="pass">Enter Your Password:</label>
      <input type="password" name="pass" id="pass" class="box" required>
      <label for="cpass">Enter Your Confirm Password:</label>
      <input type="password" name="cpass" id="cpass" class="box" required>
      <input type="submit" class="btn" name="submit" value="Register Now">
      <p>Already have an account? <a href="login.php">Login Now</a></p>
   </form>

</section>

</body>
</html>
