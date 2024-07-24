<style>
label{
    font-size: 2em;
}

</style>

<?php 

if(isset($_SESSION['user_id'])){
        $uid=$_SESSION['user_id'];
     }
if(isset($_POST['update'])){
    $newName=mysqli_real_escape_string($conn, $_POST['update_name']);
    $newEmail=mysqli_real_escape_string($conn, $_POST['update_email']);
    $pass=mysqli_real_escape_string($conn,md5($_POST['pass']));
    $conpass=mysqli_real_escape_string($conn, md5($_POST['update_pass']));

    if($pass != $conpass){
        $_SESSION['message']='The confirm password does not match';
    }
    else{
$checkadmin=mysqli_query($conn,"select *from userinfo where userId='$uid'");
$addmin=mysqli_fetch_assoc($checkadmin);
$addemail=$addmin['userEmail'];
$addpass=$addmin['userPassword'];


// ----------------------------------- admin check--------------------------------------------------
$checkadminthere=mysqli_query($conn,"select *from admin_info where adminMail='$addemail'  and adminPass='$addpass'");
        if(mysqli_num_rows($checkadminthere)>0){
   $addupdate=mysqli_query($conn,"UPDATE `admin_info` SET `adminMail`='$newEmail',`adminPass`='$pass' WHERE adminMail='$addemail' and adminPass='$addpass'");
        }

// -----------------------------------super admin check--------------------------------------------------
$checkSuperadminthere = mysqli_query($conn, "SELECT * FROM superadmin_info WHERE superemail='$addemail' AND superpassword='$addpass'");

if (mysqli_num_rows($checkSuperadminthere) > 0) {
    $addupdatesuper = mysqli_query($conn, "UPDATE `superadmin_info` SET `superemail`='$newEmail', `superpassword`='$pass' WHERE superemail='$addemail' AND superpassword='$addpass'");
}

  // -----------------------------------user update--------------------------------------------------      

$updateuserInfo=mysqli_query($conn,"UPDATE `userinfo` SET  `userName`=' $newName',`userEmail`='$newEmail',`userPassword`='$pass' WHERE userId='$uid'");
if($updateuserInfo){
  header('Location:home_page.php?login.php');
}

    }
}



?>


<section class="edit-form-container">

   <?php
   
   if(isset($_GET['profileEdite'])){
      $edit_id = $_GET['profileEdite'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `userinfo` WHERE userId = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
        while( $fetch_edit = mysqli_fetch_assoc($edit_query)){

            
            
   ?>


   <form action="" method="post" enctype="multipart/form-data">

   <?php 
   if(isset($_SESSION['message'])){
    echo'<label for="" style="color:red">'.$_SESSION['message'].'</label><br>';
    unset($_SESSION['message']);
}
   ?>
      <label for="">new user name</label>
      <input type="text" class="box" required name="update_name" value="<?php echo $fetch_edit['userName']; ?>">
      <label for="">new user email</label>
      <input type="mail"  class="box" required name="update_email" value="<?php echo $fetch_edit['userEmail']; ?>">
      <label for="">new password</label>
      <input type="text"  maxlength="12" minlength="4" class="box" required name="pass" >
      <label for="">confirm password</label>
      <input type="text"  maxlength="12" minlength="4" class="box" required name="update_pass" >

       
      
      
      <input type="submit" value="update profile" name="update" class="btn">
       
      <a href="home_page.php?reset='reset'" class="btn">cancel</a>
   </form>

   <?php
            
         };
        };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>
