<?php

@include '../config.php';

session_start();

if(isset($_POST['submit'])){
    
   $email = mysqli_real_escape_string($conn, $_POST['usermail']);
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $role = mysqli_real_escape_string($conn, $_POST['Role']);


   $select = " SELECT * FROM users WHERE email = '$email' && password = '$pass'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'user already exist';
   }else{
      if($pass != $cpass){
         $error[] = 'password not mathched!';
      }else{
         $insert = "INSERT INTO users(Name, email, password, Role) VALUES('$name','$email','$pass','$role')";
         mysqli_query($conn, $insert);
         header('location:cashierAdminLogin.php');
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
   <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    
<div class="form-container">

   <form action="" method="post">
      <h3 class="title">register now</h3>
      <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
      ?>
  <select  id="Role" name="Role" class="box" >
     <option value="Waiter" class="box" >Waiter</option>
    <option value="Admin" class="box" >Admin</option>
    <option value="Customer" class="box" >Customer</option>
  </select>
      <input type="name" name="name" placeholder="enter your name" class="box" required>
      <input type="email" name="usermail" placeholder="enter your email" class="box" required>
      <input type="password" name="password" placeholder="enter your password" class="box" required>
      <input type="password" name="cpassword" placeholder="confirm your password" class="box" required>
      <input type="submit" value="register now" class="form-btn" name="submit">
      <!-- <p>already have an account? <a href="login_form.php">login now!</a></p> -->
      <p>already have an account? <a href="index.php">login now!</a></p>
      
   </form>

</div>

</body>
</html>