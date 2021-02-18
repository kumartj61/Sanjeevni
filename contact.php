<?php include 'includes/db.php'?>
<!DOCKTYPE html>

<html lang="en">
  <head title="cms">
    <meta name="viewport" width="device-width">
    <meta charset="utf-8">
    <script src="bootstrap/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css"></link>
  </head>

<body class="bg-success">
  <?php include 'includes/header.php'?>
  <div class="container ">
    <div class="jumbotron bg-light p-3" align="center"><h2>Contact Us</h2></div>
    <div class="form-horizontal col-sm-10 text-white ">
    <form  method="get" action="contact.php" role="form">
      <div class="row form-group">
        <div class="col-sm-1">
          <label for="name" class="">Name</label>
        </div>
        <div class="col-sm-8">
          <input class="form-control" id="name" type="text" name="name"></input>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-sm-1">
          <label for="email" class="control-label">Email</label>
        </div>
        <div class="col-sm-8">
          <input class="form-control" id="email" type="email" name="email"></input>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-sm-1">
          <label for="subject" class="control-label">Subject</label>
        </div>
        <div class="col-sm-8">
          <input class="form-control" id="subject" type="text" name="subject"></input>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-sm-1">
          <label for="comment" class="control-label">Comment</label>
        </div>
        <div class="col-sm-8">
          <textarea class="form-control" id="comment" rows=8 style="resize:none" name="comment"></textarea>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-sm-1">
          <label> </label>
        </div>
        <div class="col-sm-8">
          <input class="btn btn-block btn-primary"  type="submit"></input>
        </div>
      </div>
    </form>
  </div>
    <footer class="navbar  text-light  ">This is the footer section</footer>


  </div>


</body>
</html>
