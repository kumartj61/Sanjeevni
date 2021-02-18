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
<title>Login To MySanjeevni</title>
</head>
<body class="bg-light" >
<!-- Nav-Section-->
<?php include 'includes/header.php'?>


  <div class=" form-group " align="center">
    <div class="card bg-dark  " style=" width:70%" >
      <form class=" card-body d-sm-block align-self-center" role="form" action="account/login.php" method="post">
        <div class="card-header p-1 bg-secondary text-light" align="center">Login</div>
      <div class=" input-group p-2 " >
        <div class=" input-group ml-2">
          <div class="input-group-prepend">
            <span class="input-group-text ">UserId</span>
          </div>
          <input type="text" name="username" class="form-control" placeholder="Email Here" ></input>
      </div>
    </div>
    <div class="input-group p-2" >
      <div class=" input-group ml-2">
          <div class="input-group-prepend ">
            <span class="input-group-text ">Password</span>
          </div>
          <input type="Password" name='password' class="form-control" placeholder="Password  " ></input>
      </div>
    </div>
    <div class=" p-1" style="width:100%">
      <button class="btn btn-success ml-2 col-sm-10" name="submit_login">submit</button>
    </div>
    <div class="ml-2"><a href="./register.php"> Not yet registered?</a></div>
  </form>
  </div >
</div>
</body>
</html>
