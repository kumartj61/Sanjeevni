<?php include 'includes/db.php'?>
<!DOCKTYPE html>

<html lang="en">
  <head title="cms">
    <meta name="viewport" content="width=device-width, initial-scale=1.2">
    <meta charset="utf-8">
    <title>MySanjeevni</title>
    <link rel="icon" href="icon/icon_main.png" type="image/x-icon"></link>
    <!-- CSS only -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=Bubblegum Sans' rel='stylesheet'>
  <!-- JS, Popper.js, and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/a3d26f126d.js" crossorigin="anonymous"></script>
  </head>

<body class="bg-success">
  <?php include 'includes/header.php'?>
  <div class="container ">
    <div class="jumbotron bg-light p-3 mt-3" align="center"><h2>Contact Us</h2></div>
    <div class="form-horizontal col-sm-10 text-white ">
    <form  method="get" action="contact.php" role="form">
      <div class="row form-group">
        <div class="col-sm-1">
          <label for="name" class="">Name</label>
        </div>
        <div class="col-sm-8">
          <input class="form-control" id="name" type="text" name="name" placeholder="Your Name "></input>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-sm-1">
          <label for="email" class="control-label" >Email</label>
        </div>
        <div class="col-sm-8">
          <input class="form-control" id="email" type="email" name="email" placeholder="Your Email Here"></input>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-sm-1">
          <label for="subject" class="control-label">Subject</label>
        </div>
        <div class="col-sm-8">
          <input class="form-control" id="subject" type="text" name="subject" placeholder="Subject Of Email"></input>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-sm-1">
          <label for="comment" class="control-label">Comment</label>
        </div>
        <div class="col-sm-8">
          <textarea class="form-control" id="comment" rows=8 style="resize:none" name="comment" placeholder="Drop your query here"></textarea>
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
    <footer class="jumbotron  p-2 flex-sm-row">
      <div class="label text-danger">Email Address:- contact@mysanjeevni.com</div>
      
    </footer>


  </div>


</body>
</html>
