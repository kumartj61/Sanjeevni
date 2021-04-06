<?php include 'includes/db.php';
  $login_err='';
  if(isset($_GET['login_error'])){
    if($_GET['login_error'] == 'query_error'){
      $login_err = '<div class="alert alert-danger">Oops you left Username or Password empty!</div>';
    }
    elseif($_GET['login_error'] == 'wrong'){
      $login_err = '<div class="alert alert-danger">Cannot login Username or Password is wrong!</div>';
    }
    elseif($_GET['login_error'] == 'empty'){
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
<head>
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
<style>
  nav{
      opacity: .9;
  }


  .img-bg {
    position: fixed;
    align: center;
    top:2px;
    height:auto;
    width:1950px;
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

      color:#ffffff;
      font-size: 20px;

  }
  .card{
    background-color:#060613;
    opacity: 0.85;
  }



</style>



  <!--Loader-->


</style>
</head>
<body  style="background-color: #060613" >
  <div    >
    <img class="responsive img-bg" style="background-position: center;
    background-repeat: no-repeat;
    background-size: cover;" src="icon/antioxidant.jpg" ></img>
  </div>

  <div class="container p-2 content">

<!-- Nav-Section-->
<?php include 'includes/header.php'?>

<!-- card-section-->
<?php echo $login_err?>
  <div class="row" >


    <article >

    <?php
      $query= "select *from CmsSystem where status = 'published' order by id desc limit $start_from,$per_page";
      $data = mysqli_query($conn,$query);
      $flag = true;
      while($rows = mysqli_fetch_assoc($data)){
        $sql_user = "select user_name from user where user_email =(select author from CmsSystem where id=".$rows['id'].");";
        $user = mysqli_query($conn,$sql_user);
        $user = mysqli_fetch_assoc($user);

        $post_date = substr($rows['date'],0,11);

        if(empty($rows['proof']))
          $flag=false;

        echo '
        <div class="card  p-2 border border-danger" style="width:100%;top:10px;left:10px;border-width:10px; ">
            <div class="card-header ml-1 mr-1"  >
              <h3 align="center" class="">'.$rows['title'].' </h3>
            </div>
            <div class="row">
            ';
            if(!empty($rows['image'])){
              echo'
            <div class="col-sm-5 mt-1">
              <img src="'.$rows['image'].'" alt="image not available" class="card-img-top responsive" style="width:100%;height:auto;max-height:300px;opacity: 1;" alt=" Image here"></img>
            </div>
            ';
          }
          echo'
            <div class="card-body col-sm-6" >

            <div class="card-text">
              <p>'.substr($rows['description'],0,350).' ......
              </p>
              <a href="post.php?post_id='.$rows['id'].'" class="btn btn-primary">Read</a>

            </div>

            <div class="d-flex flex-sm-row-reverse" style="fontfont-family: fantasy; font-size: 12">
              <a ><i>Author-'.$user['user_name'].'</i></a>
            </div>

            <div class="d-flex flex-sm-row-reverse" style="fontfont-family: fantasy; font-size: 12">
              <a ><i>Published On-'.$post_date.'</i></a>
            </div>
            ';
            if(!$flag)
              echo '
              <div class="d-flex flex-sm-row-reverse" style="fontfont-family: fantasy; font-size: 12">
              <span class="far fa-check-circle ">Proof uploaded</span>
              </div>';

          echo '
          </div>
          </div>
        </div>
        <div style="height:50px; opacity:.1" ></div>
        ';
        }?>

        <div "">
        <?php
          include 'includes/aside.php';
        ?>
      </div>
    </article>

   </div>

	<div class="d-flex justify-content-sm-center mt-5">
      <ul class="pagination ">
    <?php
      $active='';
      $page_sql = "select *from CmsSystem where status = 'published'";
      $run_sql = mysqli_query($conn,$page_sql);
      $count = mysqli_num_rows($run_sql);
      $total_page = ceil($count/$per_page);
      for($i=1;$i<=$total_page;$i++){
        if($i==$page){
          $text = 'text-danger bg-dark';
        }
        else{
            $text = '';
        }
        echo '<li class="page-item"><a class="page-link '.$text.'" href="index.php?page='.$i.'">'.$i.'</a></li> ';
      }
    ?>
      </ul>
	  </div>
</div>
</body>
</html>
