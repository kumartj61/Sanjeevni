<!DOCKTYPE html>
<html lang="en">
<head title="cms">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a3d26f126d.js" crossorigin="anonymous"></script>
<style>
  nav{
      opacity: .9;
  }
</style>
<title>Verify Code Sent to your Email </title>
</head>
<body class="bg-light" >
<!-- Nav-Section-->
<?php include 'includes/header.php'?>



<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";
include 'includes/db.php';
session_start();
$match='';
$OTP=0;
if(isset($_GET['email'])){
  #echo "received";

  $image_path = "img/".$_SESSION['image_name'];
  $_SESSION['OTP'] = mt_rand(1000,9999);
  $mail = new PHPMailer;
  $mail->isSMTP();
  $mail->SMTPSecure = 'tls';
  $mail->SMTPAuth = true;
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->Username = 'tushargope.cse2019@ritroorkee.com';
  $mail->Password = 'Mail.sis66';
  $mail->setFrom('tushargope.cse2019@ritroorkee.com');
  $mail->addAddress($_GET['email']);
  $mail->Subject = 'Email Verification Code From MySanjeevni';
  $mail->Body = $_GET['user'].'Greetings from MySanjeevni  New User your OTP for EmailVerification is '.$_SESSION['OTP'];
  //send the message, check for errors
  if (!$mail->send()) {
  echo "ERROR: " . $mail->ErrorInfo;
  } else {
  #echo "SUCCESS";

  echo'

  <div class=" form-group " align="center">
    <div class="card bg-dark  " style=" width:70%" >
      <form class=" card-body d-sm-block align-self-center" role="form" method="get" action="mail_ver.php?otp='.$OTP.'">
        <div class="card-header p-1 bg-secondary text-light" align="center">Verification</div>
      <div class=" input-group p-2 " >
        <div class=" input-group ml-2">
          <div class="input-group-prepend">
            <span class="input-group-text ">Enter OTP</span>
          </div>
          <input type="number" name="OTP" class="form-control" placeholder="OTP here" required ></input>
      </div>
    </div>

    <div class=" p-1" style="width:100%">
      <button class="btn btn-success ml-2 col-sm-10" >submit</button>
    </div>
    <div class="ml-2"><a href="./register.php"> Didnot recieved code?</a></div>
  </form>
  </div >
</div>
  ';
}}

elseif(isset($_GET['OTP'])) {
  $test = 'nothing';
  if($_GET['OTP'] == $_SESSION['OTP']){
    echo '<div class="alert alert-success ">Email verified</div>';
    if($_SESSION['img_flag']=='true'){
      if($test = move_uploaded_file($_SESSION['image_tmp'],$_SESSION['image_path'])){

        $sql="insert into `user` (`role`, `user_name`, `user_email`, `user_pass`, `user_gender`, `country`, `DOB`, `marital_status`, `desig`, `about_me`, `profile_pic`) VALUES ('subscriber', '".$_SESSION['name']."', '".$_SESSION['email']."', '".$_SESSION['password']."', '".$_SESSION['gender']."', '".$_SESSION['country']."', '".$_SESSION['dob']."', '".$_SESSION['marital_status']."', '".$_SESSION['desig']."', '".$_SESSION['about_me']."', '".$_SESSION['image_path']."');";
        if($query = mysqli_query($conn,$sql)){
          echo "<div class='alert alert-success'>Account created successfully</div>";
        }
        else{
            echo "<div class='alert alert-success'>Unable to upload image</div>";
          }
      }
  else{
      echo $test;
      echo "<div class='alert alert-success'>Unable to save image</div>";
    }
}
  else if($_SESSION['img_flag']=='false'){
    $sql="insert into `user` (`role`, `user_name`, `user_email`, `user_pass`, `user_gender`, `country`, `DOB`, `marital_status`, `desig`, `about_me`) VALUES ('subscriber', '".$_SESSION['name']."', '".$_SESSION['email']."', '".$_SESSION['password']."', '".$_SESSION['gender']."', '".$_SESSION['country']."', '".$_SESSION['dob']."', '".$_SESSION['marital_status']."', '".$_SESSION['desig']."', '".$_SESSION['about_me']."');";
    if($query = mysqli_query($conn,$sql)){

        echo "<div class='alert alert-success'>Account created successfully</div>";
    }
    else{
      echo "<div class='alert alert-danger'>Unable to create account</div>";
    }
  }

  }
  else{
    echo '<div class="card ">Email Not verified</div>';
  }


}
else{
  #echo "Error";
  header("Location:signup.php");
}
?>



</body>
</html>
