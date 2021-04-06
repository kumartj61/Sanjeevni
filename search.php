<?php include 'includes/db.php'?>
<!DOCKTYPE html>

<html lang="en">
<head title="cms">
  <meta name="viewport" width="device-width">
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

  	.img-bg {
      position: fixed;
      align: center;
      top:2px;
      height:800px;
      -webkit-transform: scaleX(-1);
      transform: scaleX(-1);
      z-index: -1;
  }
  </style>

  <title>Search Result</title>
</head>


<body class="bg-primary">
<!-- Nav-Section-->
  <?php include 'includes/header.php'?>
<!-- card-section-->

<?php
if(isset($_GET['search'])){
echo'
<label class="control-label bg-light ml-1" style="width=100px;font-family:Algerian"><u>You have searched:<b><i> &quot'.$_GET['search'].'&quot </i></b> </u></div>';
}
?>
  <div class="row bg-secondary" style="font-family:Timesnewroman">
    <div  >
      <img class="responsive img-bg" style="background-position: center;
      background-repeat: no-repeat;
      background-size: cover;" src="icon/antioxidant.jpg" ></img>
    </div>
    <article class="col-sm-8">
    <?php
    if(isset($_GET['search'])){
      $msg='';
      $query= "select *from CmsSystem where status = 'published' and title LIKE '%".$_GET['search']."%' or description LIKE '%".$_GET['search']."%' ";
      $data = mysqli_query($conn,$query);
      if(mysqli_num_rows($data)<1){
        echo "<div class='alert alert-warning'>No result found!</div>";
      }
      else{

      while($rows = mysqli_fetch_assoc($data)){
          echo'
        <div class="card bg-light p-2" style="width:80%;top:10px;left:10px;">
            <div class="card-header" align="center"><h3>'.$rows['title'].'</h3></div>
            <div class="row">
            <div class="col-lg-5">
              <img src="'.$rows['image'].'" class="card-img-top" style="width:100%;height:90%" ></img>
            </div>
            <div class="card-body col-lg-7" >
            <div class="card-text">
              <p>'.substr($rows['description'],0,300).' ......
              </p>
              <a href="post.php?post_id='.$rows['id'].'" class="btn btn-primary">Read</a>
            </div>
          </div>
          </div>
        </div>';
      }}
    }
      else{
        echo'
        <div class="card bg-light p-2" style="width:80%;top:10px;left:10px;">
            <div class="card-header" align="center"><h3>Nothing to search</h3></div>
            <div class="row">
            <div class="col-lg-5">
            </div>
            <div class="card-body col-lg-7" >
            <div class="card-text">
            </div>
          </div>
          </div>
        </div>'
        ;
      }
      ?>
    </article>
  <?php
    include 'includes/aside.php';
  ?>
</div>
</body>
</html>
