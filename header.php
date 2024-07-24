<?php 
     include 'config.php';
     session_start();

     if(isset($_SESSION['user_id'])){
        $id=$_SESSION['user_id'];

                  
     }

 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .search-form{
            z-index: 100;
        }
        .fa-solid {
            /* position: absolute; */
            /* top: 50%; */
            /* right: 5px; */
            /* transform: translateY(-50%); */
            background-color: transparent;
            font-size: 20px;  
            cursor: pointer;
        }
    </style>
</head>
<body>
<header class="header">
        <div class="header-1">
            <img src="home-png/logo.png" height="50px" width="150px">
            <form action="product.php" class="search-form" method="POST">
            <input type="search" name="search" id="search-box" placeholder="Search Here">

                <label for="search-box"> <button type="submit" class="fa-solid fa-magnifying-glass"></button>
                <!-- <input type="submit" class="fa-solid fa-magnifying-glass" name="searchbutton"> -->
            </form></label>
               
            <div class="icons">
                <div id="search-btn" class="fa-solid fa-magnifying-glass"></div>
               <a href="cart.php" id="shopping-cart"><i class="fa-solid fa-cart-shopping"></i></a>
               <a href="wishlists.php" id="shopping-cart"><i class="fa-solid fas fa-heart"></i></a>

               <?php  
               $currentFile = basename($_SERVER['PHP_SELF']);
               if($currentFile=='home_page.php' ){
                echo' <div id="login-btn" class="fa-solid fa-user"></div>';
               }
               else{
                echo'<a href="home_page.php?login" ><i class="fa-solid fa-user"></i></a> ';
               }
               ?>
               
              
            </div>
        </div>

        <div class="header-2">
            <nav class="navbar">
                <a href="home_page.php#home">Home</a>
                <a href="home_page.php#featured">Featured</a>
                <a href="home_page.php#arrivals">Arrivals</a>
                <a href="home_page.php#reviews">Reviews</a>
                <a href="home_page.php#blogs">Blogs</a>
                <?php

if(isset($_SESSION['user_id'])){
                $choose=mysqli_query($conn,"SELECT *FROM userinfo WHERE userId='$id'");
                $row=mysqli_fetch_assoc($choose);

                $u=$row['userEmail'];
                $p= $row['userPassword'];

                $take=mysqli_query($conn,"SELECT *FROM admin_info WHERE adminMail='$u' and adminPass='$p'");
                if(mysqli_num_rows($take)>0){
                    echo '<a href="admin.php">admin panel</a>';  
            
                } 
                           
            }
                ?>
               
               
            </nav>
        </div>
    </header>

    <nav class="bottom-navbar">
        <a href="home_page.php#home" class="fa-solid fa-house"></a>
        <a href="home_page.php#featured" class="fa-solid fa-list-ul"></a>
        <a href="home_page.php#arrivals" class="fa-solid fa-tag"></a>
        <a href="home_page.php#reviews" class="fa-regular fa-comment"></a>
        <a href="home_page.php#blogs" class="fa-brands fa-blogger"></a>
        <?php

if(isset($_SESSION['user_id'])){
                $choose=mysqli_query($conn,"SELECT *FROM userinfo WHERE userId='$id'");
                $row=mysqli_fetch_assoc($choose);

                $u=$row['userEmail'];
                $p= $row['userPassword'];

                $take=mysqli_query($conn,"SELECT *FROM admin_info WHERE adminMail='$u' and adminPass='$p'");
                if(mysqli_num_rows($take)>0){
                    echo'<a href="admin.php" class="fas fa-user-shield"></a>';  
            
                } 
                           
            }
                ?>

    </nav>
    
</body>
</html>