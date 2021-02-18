<?php
  session_start();
  include '../includes/db.php';

  if(isset($_SESSION['user']) && isset($_SESSION['password'])){
    $sel_sql="select *from users where user_email = '$_SESSION[user]' and user_pass = '$_SESSION[password]'";
    if($run_sql = mysqli_query($conn,$sel_sql)){
      if(mysqli_num_rows($run_sql == 1)){

      }
      else{
        header('Location: ../index.php');
      }
    }

  }
  else{
    header('Location: ../index.php');
  }
  if(isset($_POST['submit'])){
    $catagory = ucfirst(strip_tags($_POST['catagory_name']));
    $sql = "insert into `catagory`(catagory_name) values('".$catagory."')";
    $result = mysqli_query($conn,$sql);
    if($result){
    echo "<div class='alert alert-success'>New catagory added successfully</div>";
    }
    else{
    echo "<div class='alert alert-success'>Sorry! can't add new catagory</div>";
    }
  }

?>
<!DOCKTYPE html>

<html lang="en">
<head title="cms">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title >Admin</title>

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
<link href="./Editor/editor.css" type="text/css" rel="stylesheet"/>

</head>
<body>
  <?php include "includes/header.php"?>
  <div class="row">
    <?php include "includes/aside.php";
    ?>
    <div class="col-sm-10">
      <div class="card-header text-primary" align="center"><h1>New Post</h1></div>
      <div class="container-fluid">
        <form class="form-horizontal text-dark" action="new_catagory.php" method="post" >
          <div class="form-group">
            <label for="catagory_name"><h3>Catagory Name</h3></label>
            <input id="catagory_name" class="form-control" type="text" name="catagory_name" required></input>
          </div>
          <div class="form-group">
            <button id="submit" name="submit" class="btn btn-danger btn-block" type="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
