<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section class="footer">

<div class="box-container">

    <div class="box">
        <h3>Our Locations</h3>
        <a href="#" ><i class="fa-solid fa-location-dot"></i>Mawanella</a>
        <a href="#"><i class="fa-solid fa-location-dot"></i>Aavase</a>
        <a href="#"><i class="fa-solid fa-location-dot"></i>Matara</a>
        <a href="#"><i class="fa-solid fa-location-dot"></i>Rock-view garden</a>
    </div>

    <div class="box">
        <h3>Quick Links</h3>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Home</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Featured</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Arrivals</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Reviews</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Blogs</a> 
    </div>

    <div class="box">
        <h3>Extra Links</h3>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Account info</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Order Items</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Payment Methods</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Privacy Policy</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Our Services</a> 
    </div>

    <div class="box">
        <h3>Contact Info</h3>
        <a href="#"><i class="fa-solid fa-phone"></i>077-0211220</a>
        <a href="#"><i class="fa-solid fa-phone"></i>077-5328271</a>
        <a href="#"><i class="fa-solid fa-envelope"></i>shiwanthafernando33879@gmail.com</a>
    </div>

</div>
<div class="share">
    <a href="#" class="fa-brands fa-facebook"></a>
    <a href="#" class="fa-brands fa-whatsapp"></a>
    <a href="#" class="fa-brands fa-linkedin"></a>
    <a href="#" class="fa-brands fa-instagram"></a>
</div>
<div class="credit">All Rights Reserved</div>
</section>
<!-- footer section ends -->

<!-- loader -->

<?php

$lcount=0;

if(isset($_SESSION['loadcount'])){
   $lcount=$_SESSION['loadcount'];
}
else{
    $_SESSION['loadcount']=1; 
}

if($lcount<1){
    echo '
    <div class="loader-container">
<img src="home-png/loader.gif" alt="">
</div> ';
}
?>





<!-- swiper linking -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
   <!-- linking the javascript -->
   <script src="js/index.js"></script>



    
</body>
</html>