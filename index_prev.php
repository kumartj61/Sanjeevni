<?php include 'includes/db.php';
  $login_err='';
  if(isset($_GET['login_error'])){
    if($_GET['login_error']=='query_error'){
      $login_err = '<div class="alert alert-danger">Oops you left Username or Password empty!</div>';
    }
    elseif($_GET['login_error']=='wrong'){
      $login_err = '<div class="alert alert-danger">Cannot login Username or Password is wrong!</div>';
    }
    elseif($_GET['login_error']=='empty'){
      $login_err = '<div class="alert alert-danger">Some field is empty</div>';
    }
  }
  $per_page=5;
  if(isset($_GET['page'])){
    $page=$_GET['page'];
  }
  else{
    $page = 1;
  }
  $start_from = ($page-1) * $per_page;

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
  nav{
      opacity: .9;
  }
</style>
</head>
<body class="bg-light" >
<!-- Nav-Section-->
<?php include 'includes/header.php'?>

<!-- card-section-->
<?php echo $login_err?>
  <div class="row " style="font-family:Timesnewroman">

    <article class="col-sm-8 ">
    <?php
      $query= "select *from CmsSystem where status = 'published' order by id desc limit $start_from,$per_page";
      $data = mysqli_query($conn,$query);
      while($rows = mysqli_fetch_assoc($data)){
        echo '
        <div class="card bg-light p-2 border border-primary " style="width:100%;top:10px;left:10px;border-width:"10px"">
            <div class="card-header bg-success " align="center"><h3>'.$rows['title'].'</h3></div>
            <div class="row">
            <div class="col-lg-5 mt-1">
              <img src="'.$rows['image'].'" class="card-img-top responsive" style="width:100%;height:auto;max-height:300px" alt=" Image here"></img>
            </div>
            <div class="card-body col-lg-7" >

            <div class="card-text">
              <p>'.substr($rows['description'],0,350).' ......
              </p>
              <a href="post.php?post_id='.$rows['id'].'" class="btn btn-primary">Read</a>

            </div>
          </div>
          </div>
        </div>';
        }?>

    </article>
    <?php
      include 'includes/aside.php';
    ?>
    <div class="ml-auto mr-auto mt-3">
      <ul class="pagination pagination">
    <?php

      $page_sql = "select *from CmsSystem where status = 'published'";
      $run_sql = mysqli_query($conn,$page_sql);
      $count = mysqli_num_rows($run_sql);
      $total_page = ceil($count/$per_page);
      for($i=1;$i<=$total_page;$i++){
        echo '<li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li> ';
      }
    ?>



      </ul>
    </div>

</div>
</body>
</html>
