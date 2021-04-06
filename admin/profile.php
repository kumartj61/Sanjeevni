<?php
  session_start();
  include '../includes/db.php';
  $flag = false;
  if(isset($_SESSION['user']) && isset($_SESSION['password'])){
    $flag = true;

    $sel_sql="select *from user where user_email = '".$_SESSION['user']."' and user_pass = '".$_SESSION['password']."';";

    if($run_sql = mysqli_query($conn,$sel_sql)){
      while($rows=mysqli_fetch_assoc($run_sql)){
        $user_name = $rows['user_name'];
        $user_email = $rows['user_email'];
        $user_gender = $rows['user_gender'];
        $user_country = $rows['country'];
        $user_dob = $rows['DOB'];
        $user_marital_status = $rows['marital_status'];
        $designation = $rows['desig'];
        $user_about_me = $rows['about_me'];
        $status = $rows['email_status'];
        if(isset($_POST['Status'])){

            if($status==1){
              $status_sql ="update user set `email_status` = 0 where user_email='".$_SESSION['user']."' and user_pass = '".$_SESSION['password']."';";
            }
            else{
              $status_sql ="update user set `email_status` = 1 where user_email='".$_SESSION['user']."' and user_pass = '".$_SESSION['password']."';";
            }
            $res = mysqli_query($conn,$status_sql);
          }


        if($rows['profile_pic']==''){
          $user_profile_pic = "./img/no_img.png";

        }
        else{
          $user_profile_pic = $rows['profile_pic'];
        }
        $user_role = $rows['role'];
        if(mysqli_num_rows($run_sql) != 1){
          header('Location: ../index.php');
        }

      }
    }
  }
  else{
    $flag=false;
    header('Location: ../index.php');
  }

?>
<!DOCKTYPE html>

<html lang="en">
<head >
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title >Profile</title>
  <link rel="icon" href="../icon/icon_main.png" type="image/x-icon"></link>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a3d26f126d.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="./Editor/editor.js"></script>
<script>
  $(document).ready(function() {
    $("#txtEditor").Editor();
  });
</script>
<link href="../Editor/editor.css" type="text/css" rel="stylesheet"/>

</head>
<body>

  <?php include "includes/header.php"?>
  <div class="row">
    <?php include "includes/aside.php";
    echo '
    <div class="col-sm-10">
      <div class="container-fluid " style="width=100%;height=100%;">
        <div class="row">

          <div class="col-12 ml-0" >
            <div class="card bg-info" >

              <div class="card-header  bg-primary text-white " align="center">
                <h4>Profile</h4>
              </div>
              <div class="row card-body">
              <div class="col-sm-3 mt-2 ml-1 card-image  rounded">
                <img src="../img/'.$user_profile_pic.'"  width="100%" height="100%" style="max-width: 200px;max-height:200px;" class="card-image border-rounded " ></img>
              </div>

              <div class="col-sm-4  card-text navbar-brand " style="width=100%;height=100%;">
                <h3>'.$user_name.'</h3>
                <table class="table table-responsive table-striped  ">
                  <tbody>
                    <tr>
                      <th class="text-dark">Role:</th>
                      <td class="text-white">'.$user_role.'</td>
                    </tr>
                    <tr>
                      <th class="text-dark">Email:</th>
                      <td class="text-white">'.$user_email.'</td>
                    </tr>

                  </tbody>
                </table>
                <form method="post" action="edit_profile.php">
                  <input type="hidden" name="edit_name" id="edit_name" value="'.$user_email.'"></input>
                  <button class="btn-warning btn-warning btn-outline-info" name="submit" style="border-radius: 6px ">
                    <i class="fas fa-user-edit">
                    </i>
                      Edit
                  </button>
                </form>
              </div>
              </div>
              </div>
            </div>
          </div>
        </div>
        <div class=" responsive mt-2 ml-2 row" >
          <div class="card  bg-secondary text-white col-sm-4">
            <div class="card-header card-title bg-dark" style="font-family:Algerian" ><i class="fas fa-info-circle">  Public Info</i></div>
            <div class="card-body text-warning">
              <p class="card-text">Name- '.$user_name.' </p>
              <p class="card-text">Country- '.$user_country.' </p>
              <p class="card-text">Gender- '.$user_gender.' </p>
              <p class="card-text">Marital Status- '.$user_marital_status.' </p>
              <p class="card-text">Designation- '.$designation.' </p>
            </div>
          </div>

          <div class="card  bg-secondary text-white col-sm-4">
            <div class="card-header  bg-dark" style="font-family:Algerian"><i class="fas fa-asterisk">  More Info</i></div>
            <div class="card-body text-warning">
              <p class="card-text">User Email- '.$user_email.'</p>
              <p class="card-text">D.O.B:- '.$user_dob.' </p>
              <p class="card-text">About Me-'.$user_about_me.'</p>
            </div>
          </div>
          <div class="card  bg-secondary text-white col-sm-4">
            <div class="card-header card-title bg-dark" style="font-family:Algerian"><i class="fas fa-wrench">  Setup</i></div>
            <div class="card-body text-warning">
            <form method="post" action="profile.php">
              <div class="card-text ">
                <label class=" " for="Status">Email <label>
                ';

                if($status==1)
                  echo '<button name="Status" class="btn btn-danger " style="margin-left:80px; ">Private</button>';
                elseif($status==0)
                  echo '<button name="Status" class="btn btn-info  " style="margin-left:80px;" >Public</button>';

                echo'
              </div>
            </form>

            <form action="./edit_mail.php" method="post">
            <div class="card-text ">
                <label  for="UserEmail">Change Email <label>
                <button name="UserEmail" class="btn btn-info " style="margin-left:20px " value="'.$user_email.'">Change</button>
            </div>
            </form>
            <form method="post" action="edit_pass.php">
                <div class="card-text ">
                <label  for="Change-pass"> Password <label>
                <button name="Email" class="btn btn-warning" style="margin-left:50px " value="'.$user_email.'">Change</button>
              </div>
              </form>

            </div>
          </div>
        </div>
        </div>

      </div>
    </div>
</body>';
?>
