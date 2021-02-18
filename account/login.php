<?php
  session_start();
  include '../includes/db.php';

  if(isset($_POST['submit_login'])){
    if(!empty($_POST['username']) && !empty($_POST['password'])){
      $get_username=mysqli_real_escape_string($conn,$_POST['username']);
      $get_password=mysqli_real_escape_string($conn,$_POST['password']);
      $sql = "select *from user where user_email='".$get_username."' AND user_pass='".$get_password."'";
      if($result = mysqli_query($conn,$sql)){
          if(mysqli_num_rows($result)==1){
            $_SESSION['user'] = $get_username;
            $_SESSION['password'] = $get_password;
            header('Location: ../admin/index.php');
          }
          else{
              header('Location:../index.php?login_error=wrong');
          }
        }
      else{
        header('Location: ../index.php?login_error=query_error');
      }
    }
    else{
      header('Location: ./index.php?login_error=empty');
    }
  }
  else{}


?>
