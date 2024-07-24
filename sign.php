<?php

// include 'config.php';
// session_start();

if(isset($_POST['signed'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select=mysqli_query($conn,"SELECT *FROM userinfo WHERE userEmail='$email' and userPassword='$pass'");

   if(mysqli_num_rows($select)>0){
    $message[]='user already exists';
   }
   else{
    if($pass!=$cpass){
        $message[]='The confirm password does not match';
    }
    else{
        $insert=mysqli_query($conn,"INSERT INTO userinfo(userName,userEmail,userPassword) VALUES('$name','$email','$pass')")or die('query failed');

        if($insert){
            $ses=mysqli_query($conn,"SELECT *FROM userinfo WHERE userEmail='$email' and userPassword='$pass'");
            if(mysqli_num_rows($ses)>0){
                $row=mysqli_fetch_assoc($ses);
                $_SESSION['user_id'] = $row['userId'];
                
                header('Location:home_page.php');
               }
               
           

        }
        else{
            $message[]='error';
        }
    }
   }
   
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign</title>
      <!-- linking fontawsome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- linking style sheets -->
    <link rel="stylesheet" href="css/style_home_sign.css">
    <!-- linking swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
</head>
<body>
      
    <!-- sign form -->
    <div class="usersign-form-container" id="login-btn">
        <div id="" class="signdiv"></div>
        <form action="" method="POST" enctype="multipart/form-data">

            <h3>Sign in</h3>

            <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
            <span>User Name</span>
            <input type="text" name="name" class="box" placeholder="User name" id="" required>
            <span>User Email</span>
            <input type="email" name="email" class="box" placeholder="Enter your email" id="" required>
            <span>Password</span>
            <input type="password" name="password" class="box" maxlength="12" minlength="4" placeholder="Enter your password" id="" required>
            <span>Confirm Password</span>
            <input type="password" name="cpassword" class="box" maxlength="12" minlength="4" placeholder="Enter your password" id="" required>
             
            <input type="submit" name="signed" value="sign in" class="btn" >
            <p>home page?<a href="home_page.php">Click here</a></p>
             
        </form>
    </div>

   
    
</body>
</html>