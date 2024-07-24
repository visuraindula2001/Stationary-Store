<?php 
     
    
   
    include 'header.php';
   
    
    

     if(isset($_POST['logout'])){
        session_destroy();
        header('Location:home_page.php');
     }


    //  --------------------------pop sign form-----------------------------------

    if(isset($_GET['sign'])){
         
        include 'sign.php';
            }
   //  --------------------------pop sign form end -----------------------------------

   //-----------------------------pop login form--------------------------------
   if(isset($_GET['login'])){
     
    include 'login.php';
        }
    
 //-----------------------------pop login form end--------------------------------
     if(isset($_POST['submit'])){

        
        $lemail = mysqli_real_escape_string($conn, $_POST['lemail']);
        $lpass = mysqli_real_escape_string($conn, md5($_POST['lpass']));
        
     
        $choose=mysqli_query($conn,"SELECT *FROM userinfo WHERE userEmail='$lemail' and userPassword='$lpass'");
     
        if(mysqli_num_rows($choose)>0){
         $row=mysqli_fetch_assoc($choose);
         $_SESSION['user_id'] = $row['userId'];
         header('Location:home_page.php');
        }
        else{
$_SESSION['login_error']='invalid infomation ';

      
            header('Location:home_page.php?login');
        }
    }

    include 'profilEdite.php';


    //-------------------------------------add cart process-----------------------------------------------
    if(isset($_GET['cart'])){

        if(isset($_SESSION['user_id'])){
            $productId=$_GET['cart'];
            $productdivid='p'.$productId;
            $check_product_out_or_not=mysqli_query($conn,"select *from items where pQuantity>0");
            $firstCheck=mysqli_query($conn,"SELECT *FROM selectcart WHERE userId='$id' AND pId='$productId'");
    
            if(mysqli_num_rows($firstCheck)>0 and mysqli_num_rows( $check_product_out_or_not)>0){
                $selectcart=mysqli_query($conn,"UPDATE selectcart SET quantity=quantity+1 WHERE userId='$id' and pId='$productId'");
                echo '<h1 id="mm" class="Cmessage">SUCESSFULLY '.'<br>'.'ADD TO CART</h1>
            ';
            }
            else if(mysqli_num_rows($check_product_out_or_not)<1){
              echo '<h1 id="mm" class="Cmessage">OUT OF STOCK '.'<br>'.'ADD TO CART</h1>
              ';
            }
            else{
                $selectcart=mysqli_query($conn,"INSERT INTO selectcart(userId,pId,quantity) VALUES('$id','$productId','1')");
                echo '<h1 id="mm" class="Cmessage">SUCESSFULLY '.'<br>'.'ADD TO CART</h1>
            ';
    
            }
    
    
            //////////////////
    
            
            
            echo "<script>
            
            function loadAnotherPage() {
                
                window.location.href = 'home_page.php#".$productdivid."';
              }
              
            
            function show() {
              var messageDiv = document.querySelector('.Cmessage');
              messageDiv.style.display = 'block';
            
              setTimeout(function() {
                messageDiv.style.display = 'none';
                loadAnotherPage();
              }, 2000); 
            
              
            };
            
            show();
            </script>";
    
        }
        else{
header('Location:home_page.php?sign');
 

        }
        
     }

     //-------------------------------------add wish list process--------------------------------------------

     if(isset($_GET['wish'])){

        if(isset($_SESSION['user_id'])){

            $productId=$_GET['wish'];
            $productdivid='p'.$productId;
    
            $firstCheck=mysqli_query($conn,"SELECT *FROM wishlists WHERE userId='$id' AND pId='$productId'");
            if(mysqli_num_rows($firstCheck)>0){
                
            }
            else{
                $selectcart=mysqli_query($conn,"INSERT INTO wishlists(userId,pId,quantity) VALUES('$id','$productId','1')");
    
            }
    
            //////////////////////
            echo '<h1 id="mm" class="Cmessage">SUCESSFULLY '.'<br>'.'ADD TO WISHLIST</h1>
    ';
    
    echo "<script>
    
    function loadAnotherPage() {
        
        window.location.href = 'home_page.php#".$productdivid."';
      }
      
    
    function show() {
      var messageDiv = document.querySelector('.Cmessage');
      messageDiv.style.display = 'block';
    
      setTimeout(function() {
        messageDiv.style.display = 'none';
        loadAnotherPage();
      }, 2000); 
    
      
    };
    
    show();
    </script>";
        }
        else{
            header('Location:home_page.php?sign'); 
        }
       

        /////////////////////

     }

     


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.png" type="image/png">
    <title>Penpix Stationeries</title>
    <!-- linking fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- linking style sheets -->
    <link rel="stylesheet" href="css/style_home.css">
    <link rel="stylesheet" href="css/style_home_sign.css">
    <!-- linking swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
      <style>
        .Cmessage {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        /* background-color: #5cb85c;  */
         background-color: rgb(84, 185, 207);  
         padding: 20px;
         /* border: black solid; */
        border-radius: 8px;
         box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
         max-width: 300px;
         text-align: center;
        font-family: Arial, sans-serif;
        color: #fff; /* White text color */
         z-index: 1000;
    }
      </style>


</head>
<body>
    <!-- header section starts -->

     
   
    <!-- header section ends -->

    <!-- bottom navbar starts -->
   
    <!-- login form -->
    <div class="login-form-container">
        <div id="close-login-btn" class="fa-solid fa-xmark"></div>
        <form action=""  method="POST" enctype="multipart/form-data">
           
            <?php
                  if(isset($_SESSION['user_id'])){
                    $ses=mysqli_query($conn,"SELECT *FROM userinfo WHERE userId='$id'");
                    $fetch=mysqli_fetch_assoc($ses);

                    echo'<div class="profcard" style="text-align: center; ">
                    <label for="">'.$fetch['userName'].'</label><br>
                    <label for="">'.$fetch['userEmail'].'</label>
                    
                    <p>Don &#39t miss out on updates! Keep an eye on notifications for the latest news and interactions.</p>
                    
                                        </div>';

                    echo '
                    <a href="home_page.php?profileEdite='.$fetch['userId'].'" class="btn" > edit profile</a>
                    <input type="submit" class="btn" name="logout" value="logout">
                    <p>Don&caron;t have an account? <a href="home_page.php?sign">Create an account</a></p>
                    ';
                  }
                  else{
                  echo' 
                   <h3>Login</h3>';
                   if(isset($message)){
                    foreach($message as $message){
                       echo '<div class="message">'.$message.'</div>';
                    }
                 }

                   echo '
                    <span>User Email</span>
                    <input type="email" name="lemail" class="box" placeholder="Enter your email"  required>
                    <span>Password</span>
                    <input type="password" name="lpass"  maxlength="12" minlength="4" class="box" placeholder="Enter your password" required>
                     
                    <input type="submit" name="submit" value="login" class="btn" >
                    <p>Don&caron;t have an account? <a href="home_page.php?sign">Create an account</a></p>
                     ';

                  }
               
                ?>
             
        </form>
    </div>


     <?php 
    
     ?>
   
    <!-- Home section starts -->
    <section class="home" id="home">

        <div class="row">

            <div class="content">
                <h3>Upto 20% off</h3>
                <p>
                    We are excited to offer you an exclusive opportunity to embark on your education journey with our special discount offer.
                    Visit us today and experience the joy of discovering new worlds within the pages of our discounted stationeries.
                </p>
                <a href="product.php" class="btn">Shop Now</a>
            </div>
            <div class="swiper stationery-slider">
                <div class="swiper-wrapper">

                <!-- <a href="product.php" class="swiper-slide"><img src="images/book1.png" alt=""></a> -->
                 <?php 
                  $gal=mysqli_query($conn,"SELECT *FROM items WHERE pOption='Old stuff'");
                  if(mysqli_num_rows($gal)>0){
                      while($set=mysqli_fetch_assoc($gal)){
                        $productId = $set['pId'];
                        $plocation = 'product.php#p'.$productId;
                          echo ' <a  href="'.$plocation.'" class="swiper-slide"><img src="uploaded_img/'.$set['pImg'].'" alt=""></a> ';  
                      }
                  }
                 ?> 

                 

                </div>
            </div>
        </div>

    </section>
    <!-- Home section ends -->
   

    <!-- icons section starts -->

    <section class="icons-container">

        <div class="icons">
            
            <i class="fa-solid fa-motorcycle"></i>
            <div class="content">
                <h3> Free dilivery</h3>
                <p> Free dilivery for purchases over RS.2000</p>
            </div>
            
        </div>

        
        <div class="icons">

            <i class="fa-solid fa-lock"></i>
            <div class="content">
                <h3>Secure Payments</h3>
                <p>100% secure payment methods</p>
            </div>
            
        </div>

        <div class="icons">
            
            <i class="fa-solid fa-rotate-right"></i>
            <div class="content">
                <h3>Easy Returns</h3>
                <p>Returns within 7 days</p>
            </div>
            
        </div>

        <div class="icons">
            
            <i class="fa-solid fa-phone"></i>
            <div class="content">
                <h3>24/7 hours service</h3>
                <p>Call us anytime</p>
            </div>
            
        </div>

    </section>

    <!-- icons section ends -->

    <!-- featured items scetion stars -->
    

    <section class="featured" id="featured">

        <h1 class="heading"><span>Featured Stationery Items</span></h1>

        <div class="swiper featured-slider">
            <div class="swiper-wrapper">
<!-- ////////////////////////// -->
            <?php 
            $gal=mysqli_query($conn,"SELECT *FROM items WHERE pOption='Featured Stationery Items'");

            if(mysqli_num_rows($gal)>0){
                while($set=mysqli_fetch_assoc($gal)){
                  $pdivId='p'.$set['pId'];
                    echo '
                    <div class="swiper-slide box" id="'.$pdivId.'">
                    <div class="icons">
                         
                        <a href="home_page.php?wish='.$set['pId'].'" class="fa-regular fa-heart"></a>
                        <a href="product.php#'.$pdivId.'" class="fa-regular fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="featured/'.$set['pImg'].'" alt="">
                    </div>
                    <div class="content">
                        <h3>'.$set['pName'].'</h3>
                        <div class="price">'.$set['pDesc'].'</div>
                        <div class="price">Rs.'.$set['pPrice'].'<span>Rs.'.$set['pPrice']*(110/100).'</span></div>
                        <a href="home_page.php?cart='.$set['pId'].'" class="btn">Add to Cart</a>
                    </div>
                </div>
                    ';
                }}
            
            ?>
<!-- ///////////////////////////////// -->
                 
<!-- ///////////////////////////////// -->
                <!-- <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fa-solid fa-magnifying-glass"></a>
                        <a href="#" class="fa-regular fa-heart"></a>
                        <a href="#" class="fa-regular fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="featured/pencilcase.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>Pencil Cases</h3>
                        <div class="price">Rs.350 <span>Rs.400</span></div>
                        <a href="#" class="btn">Add to Cart</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fa-solid fa-magnifying-glass"></a>
                        <a href="#" class="fa-regular fa-heart"></a>
                        <a href="#" class="fa-regular fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="featured/file.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>File Cases</h3>
                        <div class="price">Rs.230 <span>Rs.260</span></div>
                        <a href="#" class="btn">Add to Cart</a>
                    </div>
                </div>  -->

            </div>

             <div class="swiper-button-next"></div>
             <div class="swiper-button-prev"></div>

        </div>

    </section>

    <!-- featured section ends -->



     

    <!-- newsletter section starts -->

    <section class="newsletter">

        <form action="review.php" method="POST">
            <h3>Give us to review</h3>
              
            <textarea name="review" placeholder="give us to rewiew" id="" cols="10"  class="box" rows="4"></textarea>
            <h3>give us to star</h3>
        <select name="star" class="box">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
            </select>
            <br>
        <input type="submit" name="Subscribe" value="Subscribe" class="btn">
                             
        </form>
    </section>
    <!-- newsletter section ends -->




    <!-- Arrivals section starts -->

    <section class="arrivals" id="arrivals">

        <h1 class="heading"><span>New Arrivals</span></h1>

        <div class="swiper arrivals-slider">
            <div class="swiper-wrapper">
<!-- /////////////////////////// -->
     <?php

        $getCount=mysqli_query($conn,"SELECT COUNT(pId) as count_product FROM items WHERE pOption='New Arrivals' ");
        $limtrow=mysqli_fetch_assoc( $getCount);
        $start=floor($limtrow['count_product']/2);

        $gal=mysqli_query($conn,"SELECT *FROM items WHERE pOption='New Arrivals' LIMIT $start");

     if(mysqli_num_rows($gal)>0){
         while($set=mysqli_fetch_assoc($gal)){
             $productIDarv='p'.$set['pId'];
            echo '
            <a href="product.php#'.$productIDarv.'" class=" swiper-slide box" id="'.$productIDarv.'">
                <div class="image">
                    <img src="arrivals/'.$set['pImg'].'" alt="">
                </div>
                <div class="content">
                    <h3>'.$set['pName'].'</h3>
                    <div class="price">RS.'.$set['pPrice'].'<span>RS.'.$set['pPrice']*(120/100).'</span></div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                </a>
                ';
            
            }}
     
     
     ?>


               
            </div>
        </div>
        
        <div class="swiper arrivals-slider">
            <div class="swiper-wrapper">

<!-- //////////////////////////////// -->
     <?php 

        $getCount=mysqli_query($conn,"SELECT COUNT(pId) as cc FROM items WHERE pOption='New Arrivals' ");
        $limtrow=mysqli_fetch_assoc( $getCount);
        $end=floor($limtrow['cc']);
        $start=floor($limtrow['cc']/2);
      
     $gal=mysqli_query($conn,"SELECT *FROM items WHERE pOption='New Arrivals' LIMIT $start,$end");

     if(mysqli_num_rows($gal)>0){
         while($set=mysqli_fetch_assoc($gal)){
             $productIDarv='p'.$set['pId'];
            echo '
            <a href="product.php#'.$productIDarv.'" class=" swiper-slide box" id="'.$productIDarv.'">
                <div class="image">
                    <img src="arrivals/'.$set['pImg'].'" alt="">
                </div>
                <div class="content">
                    <h3>'.$set['pName'].'</h3>
                    <div class="price">RS.'.$set['pPrice'].'<span>RS.'.$set['pPrice']*(120/100).'</span></div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                </a>
                ';
            
            }}
     
     
     ?>

 
            </div>
        </div>
    </section>

    <!-- Arrivals section ends -->






    <!-- deal section starts -->

    <section class="deal">

        <div class="content">
            <h3>Deal of the Day</h3>
            <h1>Upto 10% Off</h1>
            <p>Discover unbeatable deals on high-quality stationery essentials in our Deal Section!
                unleash your productivity and creativity without stretching your budget. Hurry, these deals won't last forever.
                 Elevate your stationery collection today while saving big!
            </p>
            <a href="product.php#featured" class="btn">Shop Now</a>
        </div>

        <div class="image">
            <img src="arrivals/deals.jpg" alt="">

        </div>
    </section>
    <!-- deal section ends -->





    <!-- ------------------------------------Reviews section starts-------------------- -->
    <!-- ////////////////// -->
    <section class="reviews" id="reviews">

<h1 class="heading"><span>Customers Reviews</span></h1>

        <div class="swiper reviews-slider">
        <div class="swiper-wrapper">

                
                <?php 

              

                $q=mysqli_query($conn,"SELECT*FROM user_reviews");
                if(mysqli_num_rows($q)>0){
                    while($rev=mysqli_fetch_assoc($q)){
                        
                         

                       echo '<div   class="swiper-slide box">';
                       echo' <h3>'.$rev['userName'].' </h3>';
                       echo "<p>".$rev['review']."</p>";

                      if( $rev['star']==5){
                      echo '  <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>';
                      }
                      else if( $rev['star']==4){
                        echo '  <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                         
                    </div>';
                      }
                      else if( $rev['star']==3){
                        echo '  <div class="stars">
                         
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>';
                      }
                      else if( $rev['star']==2){
                        echo '  <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                         
                    </div>';
                      }
                      else if( $rev['star']==1){
                        echo '  <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        
                    </div>';
                      }
                      else{

                      }
                      echo '<br> </div>';   
                    }
                }
               
                ?>  
               
                </div>
    </div>
</div>
</section>
<!----------------------------------- Reviews section ends ------------------------------------------------------->

 

    <!-- blogs section starts -->

    <section class="blogs" id="blogs">

        <h1 class="heading"><span>Our Blogs</span></h1>

        <div class="swiper blogs-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide box">
                    <div class="image">
                        <img src="blogs/blog5.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>The Future of Social Security</h3>
                        <p>A forward-looking blog post discussing potential future changes to the social security system, 
                            including demographic shifts, funding challenges, and potential policy reforms.
                        </p>
                        <a href="#" class="btn">Read More</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="image">
                        <img src="blogs/blog1.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>The Power of Connection</h3>
                        <p>Social media's early days were primarily about connecting friends and family across distances. 
                            People shared personal updates, photos.
                        </p>
                        <a href="#" class="btn">Read More</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="image">
                        <img src="blogs/blog2.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3> Nurturing a Lifelong Love for Books</h3>
                        <p>Provide tips for parents and caregivers on instilling a love of reading in children.
                             Suggest age-appropriate books, reading strategies, and interactive activities to engage young readers.
                        </p>
                        <a href="#" class="btn">Read More</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="image">
                        <img src="blogs/blog3.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>A Sanctuary for the Mind</h3>
                        <p>Libraries are more than just repositories of books; they are sanctuaries for the mind. 
                            Walking through their hushed corridors, we find respite from the chaos of everyday life.
                        </p>
                        <a href="#" class="btn">Read More</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="image">
                        <img src="blogs/blog4.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>Time as a Canvas</h3>
                        <p>Just as an artist wields a brush, time offers us a canvas upon which we paint the masterpiece of our lives. 
                            Each day is a brushstroke, contributing to the unique story we craft.</p>
                        <a href="#" class="btn">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blogs section ends -->

    <!-- footer section starts -->
  <?php 
   include 'footer.php';
  
  ?>


   
  

</body>
</html>