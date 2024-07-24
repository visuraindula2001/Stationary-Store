<?php  
include 'config.php';
session_start();

if(isset($_SESSION['user_id'])){
    $id=$_SESSION['user_id'];
 }
 else{
    header('Location:home_page.php');
 }
 
// -------------------------pay----------------------------

if(isset($_POST['pay'])){

  $address=mysqli_real_escape_string($conn, $_POST['address']).' '.mysqli_real_escape_string($conn, $_POST['city']).' '.mysqli_real_escape_string($conn, $_POST['state']).' '.mysqli_real_escape_string($conn, $_POST['zip']);

  $selecttable=mysqli_query($conn,"  SELECT items.*, selectcart.quantity, (selectcart.quantity * items.pPrice) as amount FROM items INNER JOIN selectcart ON items.pId = selectcart.pId WHERE selectcart.userId = '$id'");
if(mysqli_num_rows($selecttable)>0){
  while($row=mysqli_fetch_assoc($selecttable)){

    $pId=$row['pId'];
    $pName=$row['pName'];
    $quan=$row['quantity'];
    $price=$row['amount'];
    $newquantity=$row['pQuantity']-$row['quantity'];
    $reducecontProduct=mysqli_query($conn,"UPDATE items SET pQuantity ='$newquantity' WHERE pId='$pId'");
    $push=mysqli_query($conn,"INSERT INTO `payorders`( `userId`, `pId`, `pName`, `quantity`, `price`, `order`,`address`) VALUES ('$id','$pId','$pName','$quan','$price','Processing','$address')");

    if($push){

      $deleteCart=mysqli_query($conn,"DELETE FROM `selectcart` WHERE userId='$id'");
       
      echo '<h1 id="mm" class="Cmessage"> PAYMENT'.'<br>'.'SUCESSFULLY</h1>
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
        }, 4000); 
      
        
      };
      
      show();
      </script>";
    }
  }
}

}


?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
  text-decoration: none;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
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

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>

 <div class="row">
  <div class="col-75">
    <div class="container">
      <form action="" method="POST">
      
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe" required>
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com" required>
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street" required>
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="ambalangoda" required>

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="galle" required>
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001" required>
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe" required>
            <label for="ccnum">Credit card number</label>
            <input type="number" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September" required>
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018" required>
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352" required>
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" name="pay" value="Continue to checkout" class="btn">
      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">

    <?php  
    $countOfItem=mysqli_query($conn,"SELECT COUNT(items.pId) as countt FROM selectcart INNER JOIN items ON selectcart.pId = items.pId WHERE selectcart.userId = '$id'");
    if(mysqli_num_rows($countOfItem)){
        $Crow=mysqli_fetch_assoc($countOfItem);
        echo '<h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>'.$Crow['countt'].'</b></span></h4>';
    }

    $listProduct=mysqli_query($conn,"SELECT items.pPrice*selectcart.quantity as priceOne ,items.pName FROM selectcart INNER JOIN items ON selectcart.pId = items.pId WHERE selectcart.userId = '$id'");
    if(mysqli_num_rows($listProduct)){
        while($prow=mysqli_fetch_assoc($listProduct)){
            echo ' <p><a href="cart.php">'.$prow['pName'].'</a> <span class="price">Rs.'.$prow['priceOne'].'</span></p>';
        }
        
        
    }
    
      
      $lastTotal=$_SESSION['totalPrice'];
     echo ' 
      <hr>
      <p>Total <span class="price" style="color:black"><b>Rs.'.$lastTotal.'</b></span></p>';
      ?>
    </div>
  </div>
</div>

</body>
</html>
