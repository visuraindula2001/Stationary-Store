 <?php
include 'config.php';
include 'header.php';



    //  if(isset($_SESSION['user_id'])){
    //     $id=$_SESSION['user_id'];
    //  }
    //  else{
    //     header('Location:home_page.php?login');
    //  }

//-------------------------------------add cart process-----------------------------------------------
     if(isset($_GET['cart'])){

      if(isset($_SESSION['user_id'])){
        $id=$_SESSION['user_id'];

        //////
        $productId=$_GET['cart'];
        // $productdivid='p'.$productId;

        
    $check_product_out_or_not=mysqli_query($conn,"select *from items where pId='$productId' ");
    $check_stock=mysqli_fetch_assoc($check_product_out_or_not);

    $firstCheck=mysqli_query($conn,"SELECT *FROM selectcart WHERE userId='$id' AND pId='$productId'");
    $firstCheck_quan=mysqli_fetch_assoc($firstCheck);

    

    if(mysqli_num_rows($firstCheck)>0 and ($check_stock['pQuantity']>$firstCheck_quan['quantity'])){
        $selectcart=mysqli_query($conn,"UPDATE selectcart SET quantity=quantity+1 WHERE userId='$id' and pId='$productId'");
        echo '<h1 id="mm" class="Cmessage">SUCESSFULLY '.'<br>'.'ADD TO CART</h1>
    ';
    }
    else if($check_stock['pQuantity']<1 || (mysqli_num_rows($firstCheck)>0 )){
      if($check_stock['pQuantity']<=$firstCheck_quan['quantity']){
        $selectcart="no items";
        echo '<h1 id="mm" class="Cmessage">OUT OF STOCK</h1>';
      }
       

    }
    else{
        $selectcart=mysqli_query($conn,"INSERT INTO selectcart(userId,pId,quantity) VALUES('$id','$productId','1')");
        echo '<h1 id="mm" class="Cmessage">SUCESSFULLY '.'<br>'.'ADD TO CART</h1>
    ';

    }

        /////
        
        
        echo "<script>
        
        function loadAnotherPage() {
            
            window.location.href = 'product.php';
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
      header('Location:home_page.php?login');
     }



     }

     //-------------------------------------add wish list process--------------------------------------------

     if(isset($_GET['wish'])){
 if(isset($_SESSION['user_id'])){
        $id=$_SESSION['user_id'];
        $productId=$_GET['wish'];

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
    
    window.location.href = 'product.php';
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
      header('Location:home_page.php?login');
     }

       
        /////////////////////

     }
?>
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product</title>
    <!-- linking fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- linking style sheets -->
    <link rel="stylesheet" href="css/style_home.css">
    <!-- linking swiper -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/> -->

    <style>

    #searched{

        margin-top: 8rem;
    }
     

    
    
    .Cmessage {
        display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  /* background-color: #5cb85c;   */
  background-color: rgb(84, 185, 207); 

  padding: 40px;
  border: black;
  border-radius: 8px;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
  max-width: 300px;
  text-align: center;
  font-family: Arial, sans-serif;
  color: #fff; /* White text color */
      z-index: 1000;
    }

    .products {
  display: flex;
   
  flex-wrap: wrap;
  justify-content:space-evenly;
  margin: 10px;
  line-height: 2em;
}

.product {
    
    flex-direction: column;
    position: relative;
  width: 300px;
  padding: 20px;
  margin: 10px;
  /* border: 1px solid #ccc; */
  border-radius: 8px;
  text-align: center; /* Center align content */
}
 

.product-name {
    height:2em;
  font-size: 2em;
  margin-bottom: 2px;
}

.product-description {
  font-size: 2em;
  color: #666;
}

.product-price {
  font-size: 2.2em;
  font-weight: bold;
  color: #009688;
  margin-top: 15px;
}

.product-image {
  max-width: 100%;
  height: auto;
  border-radius: 8px;
}

/* Media queries for responsiveness */
@media (max-width: 768px) {
  .product {
    width: 100%; /* Adjust the width for smaller screens */
  }
}

/* Additional media query for smaller screens */
@media (max-width: 480px) {
  .products {
    margin: 10px;
  }

  .product {
    padding: 10px;
    margin: 10px 0;
  }

  .product-name {
    font-size: 2.3em;
  }

  .product-description {
    font-size: 1.9em;
  }

  .product-price {
    font-size: 2em;
  }
}
/* /////////// */
/* Existing CSS */

/* Hover effect for product divs */
/* .product:hover {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transform: translateY(-5px);
}

.product:hover .textdiv {
  background-color: #444;
}

.product:hover .product-name {
  color: #fff;
}

.product:hover .product-description {
  color: #ccc;
} */

/* Existing CSS */

/* Hover effect for product divs */
.product {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product:hover {
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  transform: translateY(-8px);
}

 

/* ///////////////haert */
.icon-heart {
        color: red; /* Change the color to red */
        font-size: 24px; /* Change the font size to 24 pixels */
        padding-bottom: 5px;
        padding-right: 20px;
    }
    .icon-eye {
        color: red; /* Change the color to red */
        font-size: 24px; /* Change the font size to 24 pixels */
        padding-bottom: 5px;
        padding-right: 20px;
    }
.product .product-icons {
  position: absolute;
  top: 10px;
  right: 10px;
  
  /* Adjust as needed */
}

.product .product-icons a {
  display: inline-block;
  margin-right: 5px;
  color: #333; /* Change color as needed */
  color: #219150;
  text-decoration: none;
}

.product .product-icons a:hover {
  color: #ff0000; /* Change color on hover */
  transform: scale(1.2); /* Scale the size on hover (adjust as needed) */
}
:root{
   --green:#30b266;
   --dark-color: #219150;
}

/* //button */
.cbtn{
/* position: absolute; */
 
  border: none;
  outline: 0;
  left: 0;
  padding: 12px;
  color: white;
  background-color:var(--green);

  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.cbtn:hover {
  /* opacity: 0.7; */
  background-color:var(--dark-color);
  background-color: #000;
}
/* ////////////tbox */

.tbox{
    margin-bottom: 2em;
    /* height: 5em; */
    height:10em;
}

.pbox{
    height:5em; 
}
.bbox{
    margin-bottom: 1em;
}
     

  </style>
</style>
 </head>
 <body>


 


        <!-- ---------------------start------------------ -->

 <!-- ---------------------SEARCH SECSSION------------------ -->
  <?php
 ////////////////////////////////////////////////////////////////////////////////////
 if (isset($_POST['search']) && !empty($_POST['search']) ){
   echo' <br> <h1 class="heading"><span>search</span></h1>';


    $searchTerm = $_POST['search'];

    $gal=mysqli_query($conn,"SELECT *FROM items where pName like '%$searchTerm%'");
    if(mysqli_num_rows($gal)>0){
        echo'
         <section class="products">';
         while($set=mysqli_fetch_assoc($gal)){
            $productIDold='p'.$set['pId'];
              
  
              

              echo'<div class="product" id="'.$productIDold.'">';

              echo ' <div class="product-icons">';
               
                if(isset($id)){
                  echo '<a href="product.php?wish='.$set['pId'].'" class="icon-heart far fa-heart"></a>';
                } else {
                  echo '<a href="home_page.php?sign" class="icon-heart far fa-heart"></a>';
                }
                echo'  <a href="product.php?view='.$set['pId'].'" class="icon-eye far fa-eye"></a>';

                echo '</div><br>';

              
            
                  if($set['pOption']=='Old stuff'){
                   echo '<img src="uploaded_img/'.$set['pImg'].'" height="200"  alt="">'; 
                  } 
                  if($set['pOption']=='Featured Stationery Items'){
                    echo '<img src="featured/'.$set['pImg'].'" height="200"  alt="">'; 
                   } 
                   if($set['pOption']=='New Arrivals'){
                    echo '<img src="arrivals/'.$set['pImg'].'" height="200"  alt="">'; 
                   } 
               

              
              echo'<div class="tbox"><h2 class="product-name">'.$set['pName'].'</h2>
              <p class="product-description">'.$set['pDesc'].'</p>
              </div>
              <div class="pbox"><p class="product-price">$'.$set['pPrice'].'</p></div>
              ';
              if(isset($id)){
                  echo '<div class="bbox"><a href="product.php?cart='.$set['pId'].'" class="cbtn">add a cart</a></div>';
              }
              else{
                  echo '<div class="bbox"><a href="home_page.php?sign" class="cbtn">add a cart</a></div>';
              }
             
              
            echo'  
            </div>
        ';
          }
         
         
         
         echo'</section>';

    }  
    else{
        echo' <h1 class="heading"><span>search there no  result for:'. $searchTerm.'</span></h1>';
        unset($_SESSION['plh']);

        $currentFileName = basename($_SERVER['PHP_SELF']);
        
        
        
    }   
} 
 ?>
 <!-- ---------------------SEARCH SECSSION------------------ -->
<!-- ///////////////////////////////////////////////////////////// -->
 





<!-- ---------------------old stuff------------------ -------->
        
 <!-- ///////////////////////////////////////////////////////////        -->
 <br>
 <h1 class="heading"><span>old stuff</span></h1>
 <section class="products" id="oldstuff">
 
<?php  
           $gal=mysqli_query($conn,"SELECT *FROM items WHERE pOption='Old stuff'");
               
           if(mysqli_num_rows($gal)>0){
              while($set=mysqli_fetch_assoc($gal)){
                $productIDold='p'.$set['pId'];
                  
      
                  

                  echo'<div class="product" id="'.$productIDold.'">';

                  echo ' <div class="product-icons">';
                   
                    if(isset($id)){
                      echo '<a href="product.php?wish='.$set['pId'].'" class="icon-heart far fa-heart"></a>';
                    } else {
                      echo '<a href="home_page.php?login" class="icon-heart far fa-heart"></a>';
                    }
                    echo'  <a href="product.php?view='.$set['pId'].'" class="icon-eye far fa-eye"></a>';

                    echo '</div><br>';

                  
                
                      if($set['pOption']=='Old stuff'){
                       echo '<img src="uploaded_img/'.$set['pImg'].'" height="200"  alt="">'; 
                      } 
                   

                  
                  echo'<div class="tbox"><h2 class="product-name">'.$set['pName'].'</h2>
                  <p class="product-description">'.$set['pDesc'].'</p>
                  </div>
                  <div class="pbox"><p class="product-price">Rs.'.$set['pPrice'].' '.'.00<span style="font-size: 1.7rem;color: var(--light-color);text-decoration: line-through;">Rs.'.$set['pPrice']*(120/100).'</span></p></div>
                  ';
                  if(isset($id)){
                      echo '<div class="bbox"><a href="product.php?cart='.$set['pId'].'" class="cbtn">add a cart</a></div>';
                  }
                  else{
                      echo '<div class="bbox"><a href="home_page.php?login" class="cbtn">add a cart</a></div>';
                  }
                 
                  
                echo'  
                </div>
            ';
              }}
  ?>
  <div class="tbox"></div>

  <!-- Add more product divs as needed -->
</section>









 <!-- ------------------------///////////////////////////////////////////////////////////////////////-------- -->

   

<!-- ----------------------------------------ARRIVALS -------------------------------->
 

 
<h1 class="heading"><span>new arrivals</span></h1>
<section class="products" id="arrival">

<?php  
           $gal=mysqli_query($conn,"SELECT *FROM items WHERE pOption='New Arrivals'");
               
           if(mysqli_num_rows($gal)>0){
              while($set=mysqli_fetch_assoc($gal)){
                $productIDold='p'.$set['pId'];
                  
      
                  

                  echo'<div class="product" id="'.$productIDold.'">';

                  echo ' <div class="product-icons">';
                   
                    if(isset($id)){
                      echo '<a href="product.php?wish='.$set['pId'].'" class="icon-heart far fa-heart"></a>';
                    } else {
                      echo '<a href="home_page.php?login" class="icon-heart far fa-heart"></a>';
                    }
                    echo'  <a href="product.php?view='.$set['pId'].'" class="icon-eye far fa-eye"></a>';

                    echo '</div><br>';

                  
                
                      if($set['pOption']=='New Arrivals'){
                       echo '<img src="arrivals/'.$set['pImg'].'" height="200"  alt="">'; 
                      } 
                   

                  
                  echo'<div class="tbox"><h2 class="product-name">'.$set['pName'].'</h2>
                  <p class="product-description">'.$set['pDesc'].' </p>
                  </div>
                  <div class="pbox"><p class="product-price">Rs.'.$set['pPrice'].'.00</p></div>
                  ';
                  if(isset($id)){
                      echo '<div class="bbox"><a href="product.php?cart='.$set['pId'].'" class="cbtn">add a cart</a></div>';
                  }
                  else{
                      echo '<div class="bbox"><a href="home_page.php?login" class="cbtn">add a cart</a></div>';
                  }
                 
                  
                echo'  
                </div>
            ';
              }}
  ?>
  <div class="tbox"></div>

  <!-- Add more product divs as needed -->
</section>





<!------------------------------------------- FEATURED ------------------------------------->
 

<!-- ///////////////////////////////////////////////////////////////////////////////////        -->
<h1 class="heading"><span>Featured Stationery Items</span></h1>
<section class="products" id="featured">

<?php  
           $gal=mysqli_query($conn,"SELECT *FROM items WHERE pOption='Featured Stationery Items'");
               
           if(mysqli_num_rows($gal)>0){
              while($set=mysqli_fetch_assoc($gal)){
                $productIDold='p'.$set['pId'];
                  
      
                  

                  echo'<div class="product" id="'.$productIDold.'">';

                  echo ' <div class="product-icons">';
                   
                    if(isset($id)){
                      echo '<a href="product.php?wish='.$set['pId'].'" class="icon-heart far fa-heart"></a>';
                    } else {
                      echo '<a href="home_page.php?sign" class="icon-heart far fa-heart"></a>';
                    }
                    echo'  <a href="product.php?view='.$set['pId'].'" class="icon-eye far fa-eye"></a>';

                    echo '</div><br>';

                  
                
                      if($set['pOption']=='Featured Stationery Items'){
                       echo '<img src="featured/'.$set['pImg'].'" height="200"  alt="">'; 
                      } 
                   

                  
                  echo'<div class="tbox"><h2 class="product-name">'.$set['pName'].'</h2>
                  <p class="product-description">'.$set['pDesc'].'</p>
                  </div>
                  <div class="pbox"><p class="product-price">Rs.'.$set['pPrice'].''.'.00<span style="font-size: 1.7rem;color: var(--light-color);text-decoration: line-through;">Rs.'.$set['pPrice']*(110/100).'</span></p></div>
                  ';
                  if(isset($id)){
                      echo '<div class="bbox"><a href="product.php?cart='.$set['pId'].'" class="cbtn">add a cart</a></div>';
                  }
                  else{
                      echo '<div class="bbox"><a href="home_page.php?sign" class="cbtn">add a cart</a></div>';
                  }
                 
                  
                echo'  
                </div>
            ';
              }}
  ?>
  <div class="tbox"></div>

  <!-- Add more product divs as needed -->
</section>



 

<!-- -----------////////////////////////////////////////////////////////////////////////----------------- -->





<!------------------------ view popup------------------------------------------------------ -->

<section class="viewbox">

  <div class="infobox">

  <?php 
if(isset($_GET['view'])){
    $viewId=$_GET['view'];

    $info= mysqli_query($conn, "SELECT * FROM `items` WHERE pId = $viewId");
    if(mysqli_num_rows($info) > 0){
      while( $dis = mysqli_fetch_assoc($info)){

         
         
        echo '<a href="product.php?close='.$dis['pId'].'" class="icon-eye fas fa-times"></a>'."<br>";
         
        if($dis['pOption']=='Featured Stationery Items'){
            echo '<img src="featured/'.$dis['pImg'].'" height="450vh" alt="">';
            }
      
            if($dis['pOption']=='New Arrivals'){
             echo '<img src="arrivals/'.$dis['pImg'].'" height="450vh" alt="">'; 
            }
      
            if($dis['pOption']=='Old stuff'){
             echo '<img src="uploaded_img/'.$dis['pImg'].'" height="450vh" alt="">'; 
            }

           echo' </div>';

            
            
            echo "<script>document.querySelector('.viewbox').style.display = 'flex';</script>";

      }}
          
    
    
}

?>
 


  </div>


</section>

<!------------------------ view popup end ------------------------------------------------------ -->
<!-- script -->

<script src="js/index.js"></script>

<!------------ ----------------------footer------------------------------------------ -->
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
        <a href="#oldstuff"><i class="fa-solid fa-arrow-right"></i>old stuff</a>
        <a href="#featured"><i class="fa-solid fa-arrow-right"></i>Featured</a>
        <a href="#arrival"><i class="fa-solid fa-arrow-right"></i>Arrivals</a>
        <a href="home_page.php#reviews"><i class="fa-solid fa-arrow-right"></i>Reviews</a>
        <a href="home_page.php#blogs"><i class="fa-solid fa-arrow-right"></i>Blogs</a> 
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



 
 
    
 </body>
 </html>