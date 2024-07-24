<?php  
include 'config.php';
session_start();

if(isset($_SESSION['user_id'])){
    $id=$_SESSION['user_id'];
 }
 else{
    header('Location:home_page.php?login');
 }

//-------------------------------change quantity-------------------------------------
 if(isset($_POST['changeUp'])){
    
   $newquantity= mysqli_real_escape_string($conn, $_POST['newquan']);
   $productIdget= mysqli_real_escape_string($conn, $_POST['productId']);


    
    $current_quan_user=mysqli_query($conn,"SELECT *FROM selectcart WHERE userId='$id' and pId='$productIdget'");
    $user_have=mysqli_fetch_assoc($current_quan_user);

    $current_quan_stock=mysqli_query($conn,"SELECT *FROM items WHERE  pId='$productIdget'");
    $stock_have=mysqli_fetch_assoc($current_quan_stock);

  //  $select=mysqli_query($conn,"UPDATE selectcart SET quantity='$newquantity' WHERE userId='$id' and pId='$productIdget'");

  if($stock_have['pQuantity']> $user_have['quantity']){

    $select=mysqli_query($conn,"UPDATE selectcart SET quantity=quantity+1 WHERE userId='$id' and pId='$productIdget'");
    if($select){
       header('Location:cart.php');
    }
  }
  else{
    echo '<h1 id="mm" class="Cmessage">out of stock</h1>
    ';
    
    echo "<script>
    
    function loadAnotherPage() {
        
        window.location.href = 'cart.php';
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

 if(isset($_POST['changeDown'])){
    
  $newquantity= mysqli_real_escape_string($conn, $_POST['newquan']);
  $productIdget= mysqli_real_escape_string($conn, $_POST['productId']);
   
  

 //  $select=mysqli_query($conn,"UPDATE selectcart SET quantity='$newquantity' WHERE userId='$id' and pId='$productIdget'");
 $current=mysqli_query($conn,"SELECT *FROM selectcart WHERE userId='$id' and pId='$productIdget'");
 if(mysqli_num_rows($current)>0){
  $drow=mysqli_fetch_assoc($current);
  $currentquan=$drow['quantity'];
 }
 if($currentquan>1){

  $select=mysqli_query($conn,"UPDATE selectcart SET quantity=quantity-1 WHERE userId='$id' and pId='$productIdget'");
  if($select){
     header('Location:cart.php');
  }

 }
 



}
//----------------------------remove items----------------------------------------
 if(isset($_GET['remove'])){
    $productIdgetremove=$_GET['remove']; 

    $deleted=mysqli_query($conn,"DELETE FROM selectcart WHERE userId='$id' and pId='$productIdgetremove' ");
    if($deleted){
        
      echo '<h1 id="mm" class="Cmessage">SUCESSFULLY '.'<br>'.'REMOVE</h1>
      ';
      
      echo "<script>
      
      function loadAnotherPage() {
          
          window.location.href = 'cart.php';
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

//----------------------arrived---------------------------------------
if(isset($_GET['edit'])){
  $orderId=$_GET['edit'];
  $currentDate = date("Y-m-d");
  $editDetails=mysqli_query($conn,"UPDATE `payorders` SET  `arrivedDate`='$currentDate',`order`='arrived' WHERE orderId='$orderId'");
 
  
}



?>

<!-- /////////////////////////// -->
</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
    $orderId=$_GET['edit'];
  $currentDate = date("Y-m-d");
  $editDetails=mysqli_query($conn,"UPDATE `payorders` SET  `arrivedDate`='$currentDate',`order`='arrived' WHERE orderId='$orderId'");

      
            
   ?>

   <form action="review.php" method="post" enctype="multipart/form-data">
       
       
       
      
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
          <a href="cart.php?reset='reset'" class="btn">later</a>
                                   
   </form>

   <?php
            
         
      
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>


<!-- ///////////////////////////// -->

<!DOCTYPE html>
<html>
<head>
  <title>Cart Page</title>
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
      font-size: 1.3em;
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
    font-size: 1.3em;
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
      background-color:var(--green);
      color: white;
      text-align: center;
      padding: 10px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
    
    button a{
      padding-left: 4em;
      padding-right: 4em;
      border:2px solid;
      font-size: 1.5em;
      /* background-color:rgb(148, 169, 219); */
       
    }

    button a:hover{
      padding-left: 4em;
      padding-right: 4em;
       
      font-size: 1.7em;
      background-color:rgb(148, 169, 219);
    }
    .price{
      font-size: 2em;
    }

    .Cmessage {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color:red; /* Green background */
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
  max-width: 300px;
  text-align: center;
  font-family: Arial, sans-serif;
  color: #fff; /* White text color */
}

.value{
  margin-left: 2em;
  width: 3em;
}
 .orderdiv{
 
  width: 100%;
  background-color: #28aa5e;
 }
 
 #pay-order{
  margin-left: 2em;
  padding: 10px;
  font-style: oblique;
  margin: auto;
  color: white;
  
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
    
  <h1>Your Cart</h1>
</header>

<?php  
$selectmycart=mysqli_query($conn,"SELECT selectcart.*, items.* FROM selectcart INNER JOIN items ON selectcart.pId = items.pId WHERE selectcart.userId = '$id'");
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
      <h1>'.$row['pName'].'</h1>
      <p style="font-size:1.5em">'.$row['pDesc'].' </p>
       
      <p>Price:Rs.'.$row['pPrice'].'</p>';
if($row['quantity']>$row['pQuantity']){
  
  $newQuan=$row['pQuantity'];
  $productId=$row['pId'];
  //update cart table
  $selectcart=mysqli_query($conn,"UPDATE selectcart SET quantity='$newQuan' WHERE userId='$id' and pId='$productId'");
  echo'<p>Quantity: '.$newQuan.'</p>';
}
else{
  echo'<p>Quantity: '.$row['quantity'].'</p>';
}

      
   echo' </div>

    <div class="item-details">
       
  <form action="" method="post" >
    <input type="hidden" name="productId" value="'.$row['pId'].'"> 
    <input type="submit" name="changeDown" value="-" class="btn" >
    <input  type="number" min="1" class="value" name="newquan" placeholder="'.$row['quantity'].'" readonly>
     
    <input type="submit" name="changeUp" value="+" class="btn" >
</form>
<a href="cart.php?remove='.$row['pId'].'" class="btn" style=" border:10px solid">remove</a>
  </div>
  </div>';
   }
}
?>

<div class="cart-item" style="margin-top: 3rem;"  >
 
</div>
<div class="orderdiv">
<h1 id="pay-order">pay orders</h1>
</div>


<!-- ////////////////////////////// -->

 <!-- order table -->
 <section class="display-product-table" style="margin-bottom: 40px;">

<table id="ptable">

   <thead>
      <th>image</th>
      <th>product</th>
      <th>quantity</th>
      <th>price</th>
      <th>orderDate</th>
      <th>order</th>
      <th>action</th>
   </thead>

   <tbody>
      <?php
      
         $select_products = mysqli_query($conn, "SELECT * FROM `payorders` INNER JOIN items on payorders.pId=items.pId where payorders.userId='$id' ");
         if(mysqli_num_rows($select_products) > 0){
            while($row = mysqli_fetch_assoc($select_products)){
      ?>

      <tr>


      <?php
       if($row['pOption']=='Featured Stationery Items'){
       echo '<td><img src="featured/'.$row['pImg'].'" height="100" alt=""></td>';
       }
 
       if($row['pOption']=='New Arrivals'){
        echo '<td><img src="arrivals/'.$row['pImg'].'" height="100" alt=""></td>'; 
       }
 
       if($row['pOption']=='Old stuff'){
        echo '<td><img src="uploaded_img/'.$row['pImg'].'" height="100" alt=""></td>'; 
       } 
      
      ?>
         <td><?php echo $row['pName']; ?></td>
          
         <td><?php echo $row['quantity']; ?></td>
         
         <td>Rs.<?php echo $row['price']; ?>/-</td>
         <td><?php echo $row['orderDate']; ?></td>
         <td><?php echo $row['order']; ?></td>
         <td>
          <?php  
          if( $row['order']=='shipping'){
      echo'<a href="cart.php?edit='. $row['orderId'].'" class="option-btn"> <i class="fas fa-edit"></i>product arrived</a>';
          }
          else{
            echo 'arrived-date:'.$row['arrivedDate'];
          }
          ?>
             
         </td>
      </tr>

      <?php
         };    
         }
         else{
            echo "<div class='empty'>no product added</div>";
         };
      ?>
   </tbody>
</table>

</section>


<!-- ///////////////////////////////// -->

<div class="cart-item" style="margin-top: 3rem;"  >

 
</div>
<footer   >

  <?php 
  
  $priceGet=mysqli_query($conn,"SELECT SUM(items.pPrice*selectcart.quantity) as total FROM selectcart INNER JOIN items ON selectcart.pId = items.pId WHERE selectcart.userId = '$id'");
  if(mysqli_num_rows($priceGet)){
    $drow=mysqli_fetch_assoc($priceGet);
    $_SESSION['totalPrice']=$drow['total'];
    echo '<p class="price">Total:Rs.'.$drow['total'].'.00</p>';
  }
  else{
    $_SESSION['totalPrice']=0;
  }
 if($_SESSION['totalPrice']>0){

    echo  ' <button ><a style="text-decoration: none;" href="checkout.php">Checkout</a></button>';

  
 }
//  else{
//   echo' <button ><a style="text-decoration: none;" href="checkout.php">Checkout</a></button>';
//  }
  ?>
  
  
 
</footer>

</body>
</html>
