<?php 
     include 'config.php';
     session_start();

     if(isset($_SESSION['user_id'])){
        $id=$_SESSION['user_id'];

                  
     }
     else{
header('Location:login.php');
     }


     if(isset($_POST['Subscribe'])){
        $getName=mysqli_query($conn,"select *from userinfo where userId='$id'");

        if(mysqli_num_rows($getName)>0){
            $row=mysqli_fetch_assoc($getName);
            $name=$row['userName'];
            $Star= mysqli_real_escape_string($conn,$_POST['star']);
            $review= mysqli_real_escape_string($conn,$_POST['review']);

            $addReview=mysqli_query($conn,"INSERT INTO `user_reviews`(`userId`, `userName`, `review`, `star`) VALUES ('$id','$name','$review','$Star')");

            if($addReview){
                header('Location:home_page.php#reviews');
            }
        }
       
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>