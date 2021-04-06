<!DOCKTYPE html>
<html lang="en">
<head >
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>MySanjeevni</title>
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
<?php include './includes/header.php'?>



<?php


use PHPMailer\PHPMailer\PHPMailer;
require_once "../PHPMailer/PHPMailer.php";
require_once "../PHPMailer/SMTP.php";
require_once "../PHPMailer/Exception.php";
include '../includes/db.php';
session_start();
$match='';
$OTP=0;
if(isset($_POST['email'])){
  #echo "received";
  $sql = "select * from user where `user_email`='".$_POST['email']."'";
  $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)==0){

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
    $mail->addAddress($_POST['email']);
    $mail->Subject = 'Email Verification Code From MySanjeevni';
    $mail->Body = $_POST['email'].'Greetings from MySanjeevni  New User your OTP for EmailVerification is '.$_SESSION['OTP'];
    //send the message, check for errors
    if (!$mail->send()) {
      echo "ERROR: " . $mail->ErrorInfo;
    } else {
      #echo "SUCCESS";

      echo'

    <div class=" form-group " align="center">
      <div class="card bg-dark  " style=" width:70%" >
        <form class=" card-body d-sm-block align-self-center" role="form" method="post" action="Email_ver.php">
          <div class="card-header p-1 bg-secondary text-light" align="center">Verification</div>
        <div class=" input-group p-2 " >
          <div class=" input-group ml-2">
            <div class="input-group-prepend">
              <span class="input-group-text ">Enter OTP</span>
            </div>
            <input type="number" name="OTP" class="form-control" placeholder="OTP here" required ></input>
            <input type="hidden" value="'.$_POST['email'].'" name="new_email"></input>
            <input type="hidden" value="'.$_POST['UserEmail'].'" name="UserEmail"></input>
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
      }
    }
    else{
      echo '
      <div class=" form-group " align="center">
        <div class="card bg-dark  " style=" width:70%" >
          <form class=" card-body d-sm-block align-self-center" role="form" method="post" action="profile.php">
            <div class="card-header p-1 bg-secondary text-light" align="center">Verification</div>
          <div class=" input-group p-2 " >
            <div class=" input-group ml-2">

                <span class="alert alert-danger ">Email Already Registered</span>

          </div>
        </div>

        <div class=" p-1" style="width:100%">
          <button class="btn btn-success ml-2 col-sm-10" >Profile</button>
        </div>

      </form>
      </div >
    </div>';
    }
  }

elseif(isset($_POST['OTP'])) {
  $test = 'nothing';
  if($_POST['OTP'] == $_SESSION['OTP']){
    echo '<div class="alert alert-success ">Email verified</div>';
      $sql="update `user` set `user_email` = '".$_POST['new_email']."' where `user_email`='".$_POST['UserEmail']."' ;";
      $sqlCms="update `CmsSystem` set `author` = '".$_POST['new_email']."' where `author`='".$_POST['UserEmail']."' ;";
        if(mysqli_query($conn,$sql)&&mysqli_query($conn,$sqlCms)){
          echo "<div class='alert alert-success'> successfull</div>";
          $_SESSION['user']=$_POST['new_email'];
        }
        else{
            echo "<div class='alert alert-success'>Unable to Change email</div>";
          }
      }
  else{
      echo $test;
      echo "<div class='alert alert-success'>OTP did not matched </div>";
    }
}
?>



</body>
</html>
