<?php  
include 'config.php';
session_start();

if(isset($_SESSION['user_id'])){
    $id=$_SESSION['user_id'];
 }
 else{
    header('Location:home_page.php?login');
 }

 //-----------------------------add to cart-------------------------------------------
 if(isset($_GET['add'])){
    $productId=$_GET['add'];

    $check_product_out_or_not=mysqli_query($conn,"select *from items where pId='$productId' ");
    $check_stock=mysqli_fetch_assoc($check_product_out_or_not);

    $firstCheck=mysqli_query($conn,"SELECT *FROM selectcart WHERE userId='$id' AND pId='$productId'");
    $firstCheck_quan=mysqli_fetch_assoc($firstCheck);

    if(mysqli_num_rows($firstCheck)>0 and ($check_stock['pQuantity']>$firstCheck_quan['quantity'])){
        $selectcart=mysqli_query($conn,"UPDATE selectcart SET quantity=quantity+1 WHERE userId='$id' and pId='$productId'");
        echo '<h1 id="mm" class="Cmessage">SUCESSFULLY '.'<br>'.'ADD TO CART</h1>
    ';
    }
    else if($check_stock['pQuantity']<1 || ($check_stock['pQuantity']<=$firstCheck_quan['quantity'])){
      $selectcart="no items";
      echo '<h1 id="mm" class="Cmessage">OUT OF STOCK</h1>
      ';
    }
    else{
        $selectcart=mysqli_query($conn,"INSERT INTO selectcart(userId,pId,quantity) VALUES('$id','$productId','1')");
        echo '<h1 id="mm" class="Cmessage">SUCESSFULLY '.'<br>'.'ADD TO CART</h1>
    ';

    }

    if($selectcart!="no items"){
   $deleted=mysqli_query($conn,"DELETE FROM wishlists WHERE userId='$id' and pId='$productId' ");
    }

  
    if($selectcart){
         
       
      
      echo "<script>
      
      function loadAnotherPage() {
          
          window.location.href = 'wishlists.php';
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
 }

 
//----------------------------remove items----------------------------------------
 if(isset($_GET['remove'])){
    $productIdgetremove=$_GET['remove']; 

    $deleted=mysqli_query($conn,"DELETE FROM wishlists WHERE userId='$id' and pId='$productIdgetremove' ");
    if($deleted){
        
      echo '<h1 id="mm" class="Cmessage">SUCESSFULLY '.'<br>'.'REMOVE</h1>
      ';
      
      echo "<script>
      
      function loadAnotherPage() {
          
          window.location.href = '  wishlists.php';
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
 }



?>

<!DOCTYPE html>
<html>
<head>
  <title>wish list</title>
  
     <!-- linking fontawsome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- linking style sheets -->
    <link rel="stylesheet" href="css/style_home_sign.css">
    <!-- linking style sheets -->
    <link rel="stylesheet" href="css/style_home.css">
  <style>

    :root{
       
   --green:#30b266;
    --dark-color: #219150;
    --black: #444;
    --light-color: #666;
    --border: .1rem solid rgba(0,0,0,0.2);
    --border-hover: .1rem var(var(--black));
    --box-shadow: .5rem .1rem rgba(0,0,0,0.1);
    --dark-bg:rgba(0,0,0,.7);
 }
    

    body {
        text-decoration: none;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    header {
      background-color:var(--green);
      color: white;
      text-align: center;
      padding: 10px;
    }

    .cart-item {
      border: 1px solid #ccc;
      margin: 10px;
      padding: 20px;
      display: flex;
      align-items: center;
      font-size: 1.5rem;
    }

    .cart-item img {
      max-width: 100px;
      margin-right: 20px;
    }

    .cart-item .item-details {
      flex: 1;
    }
    .btn{
    text-decoration: none;
    margin-top:0.5rem;
    display: inline-block;
    padding: .4rem 1rem;
    border-radius: .5rem;
    color: #fff;
    background: var(--green);
    font-size: 1.2rem;
    font-weight: 500;
    cursor: pointer;
}
.btn:hover{
    background: var(--dark-color);
}

header .header-2{
    background: var(--green);
}
header .header-2 .navbar{
    text-align: center;
}
header .header-2 .navbar a{
    color: #fff;
    display: inline-block;
    padding: 1.2rem;
    font-size: 1.7rem;
}
header .header-2 .navbar a:hover{
   background: var(--dark-color);
}
header .header-2.active{
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 1000;
}

    footer {
      height:6em;
      background-color:var(--green);
      color: white;
      text-align: center;
      padding: 10px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    footer button a{
      padding-left: 4em;
      padding-right: 4em;
      border:2px solid;
      font-size: 1.5em;
      /* background-color:rgb(148, 169, 219); */
       
    }

    footer button a:hover{
      padding-left: 4em;
      padding-right: 4em;
       
      font-size: 1.7em;
      background-color:rgb(148, 169, 219);
    }

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

<header>
<div class="header-2">
            <nav class="navbar">
                <a href="home_page.php#home">Home</a>
                 
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
    
  <h1>Your wish list</h1>
</header>

<?php  
$selectmycart=mysqli_query($conn,"SELECT wishlists.*, items.* FROM wishlists INNER JOIN items ON wishlists.pId = items.pId WHERE wishlists.userId = '$id'");
if(mysqli_num_rows($selectmycart)>0){
   while($row=mysqli_fetch_assoc($selectmycart)){
    echo '<div class="cart-item">';
     
    if($row['pOption']=='Featured Stationery Items'){
        echo '<img src="featured/'.$row['pImg'].'" height="100" alt="">';
        }
  
        if($row['pOption']=='New Arrivals'){
         echo '<img src="arrivals/'.$row['pImg'].'" height="100" alt="">'; 
        }
  
        if($row['pOption']=='Old stuff'){
         echo '<img src="uploaded_img/'.$row['pImg'].'" height="100" alt="">'; 
        } 


    echo'<div class="item-details">
      <h2>'.$row['pName'].'</h2>
      <p>'.$row['pDesc'].' </p>
       
      <p>Price:Rs.'.$row['pPrice'].'</p>
      <p>Quantity: '.$row['quantity'].'</p>
    </div>

    <div class="item-details">
       
   
<a href="wishlists.php?remove='.$row['pId'].'" class="btn">remove item</a>
<a href="wishlists.php?add='.$row['pId'].'" class="btn">add to cart</a>
  </div>
  </div>';
   }
}
?>

<div class="cart-item" style="margin-top: 3rem;"  >
 
</div>


<footer   >

   
  
  
  <button ><a style="text-decoration: none;" href="cart.php">Cart</a></button>
</footer>

</body>
</html>
