<?php

include 'config.php';
session_start();

if(isset($_SESSION['user_id'])){
    $id=$_SESSION['user_id'];
 }

 if(isset($_SESSION['user_id'])){
    $choose=mysqli_query($conn,"SELECT *FROM userinfo WHERE userId='$id'");
    $row=mysqli_fetch_assoc($choose);

    $u=$row['userEmail'];
    $p= $row['userPassword'];

    $take=mysqli_query($conn,"SELECT *FROM superadmin_info WHERE superemail='$u' and superpassword='$p'");
    if(!mysqli_num_rows($take)>0){
        header('Location:home_page.php');

    }     
               
}
else{
    header('Location:home_page.php');
}

/////////////////---admin add process-----------------------------------------------------/

if(isset($_POST['submited'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select=mysqli_query($conn,"SELECT *FROM userinfo WHERE userEmail='$email' and userPassword='$pass'");

   if(mysqli_num_rows($select)>0){
    $_SESSION['Amessage']='Email and password already in use. Please try again';
   }
   else{
    if($pass!=$cpass){
        $_SESSION['Amessage']='confirm password not match';
    }
    else{
        $insert=mysqli_query($conn,"INSERT INTO userinfo(userName,userEmail,userPassword) VALUES('$name','$email','$pass')")or die('query failed');

        if($insert){
            $ses=mysqli_query($conn," INSERT INTO `admin_info`(`adminMail`, `adminPass`) VALUES ('$email','$pass')");
        }
        else{
            $_SESSION['Amessage']='admin add error ,process stoped';
        }
    }
   }
   header('Location:admin.php'); 
}


/////////////////////////admin remove process---------------------------------------------------
if(isset($_GET['deleteAdmin'])){
$adminEmail=$_GET['deleteAdmin'];

$deleteAdminTable=mysqli_query($conn,"DELETE FROM `admin_info` WHERE adminMail='$adminEmail'");

$deleteUserTable=mysqli_query($conn,"DELETE FROM `userinfo` WHERE userEmail='$adminEmail'");

if($deleteAdminTable and $deleteUserTable){
    header('Location:admin.php');  
}
else{
    $_SESSION['Amessage']='Admin removal error: Unable to proceed';
    header('Location:admin.php'); 
}


}


?>