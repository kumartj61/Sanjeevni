<?php
  include 'includes/db.php';
?>
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
    .cor{
        cursor: pointer;
    }
    nav{
        opacity: .9;
    }
    #loading{
      width: 100%;
      height: 100vh;
      background: "icon/95.gif"
    }

    .img-bg {
      position: fixed;
      align: center;
      top:2px;
      height:800px;
      -webkit-transform: scaleX(-1);
      transform: scaleX(-1);
      z-index: -1;

    }
    .head_font{
      font-family: 'Bubblegum Sans';font-size: 22px;
    }
    .card-header{
      font-family: 'Bubblegum Sans';font-size: 22px;
      color: #606060;
      background-color: #E8E8E8;

    }
    .card-body{

        color:#585858;
        font-size: 20px;
    }
    .card{
      background-color:#F5F5F5;
    }
    .card_body{
      opacity: .7;
    }
  </style>
</head>
<body class="bg-white">
  <div class="container">
  <?php
   include 'includes/header.php';?>



    <article class="container">
      <?php
        if(isset($_GET['post_id'])){
        $query= 'select *from CmsSystem where id='.$_GET['post_id'].'';
        $data = mysqli_query($conn,$query);
        while($rows=mysqli_fetch_assoc($data)){
          echo '
      <div class="card bg-light p-2" style="width:100%;min-width:300px;top:10px;left:10px">
        <div class="card-header" align="center"><h3>'.$rows['title'].'</h3></div>
        ';
        if(!empty($rows['image']))
          echo '<img src="'.$rows['image'].'" class="card-img-top img-thumbnail img-fluid" style="width:100%;min-width:50px;min-height:70px;" ></img>';
        echo'
        <div class="card-body">

          <div class="card-text">
            <p>'.$rows['description'].'</p>
          </div>
        </div>
      </div>';
      }
    }
    else{
      echo '<div class="alert alert-info">No posts to show! For main page <a href="index.php">click here</a></div>';
    }
    ?>
    </article>

  <?php
    include 'includes/aside.php';
  ?>


</div>
</body>
</html>
