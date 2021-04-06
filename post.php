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
   include 'includes/header.php';


   ?>


    <article class="container">
      <?php
      $post_id = "";
      if(isset($_POST['comment_submit'])){
        $sql = "insert into comments(`post_id`,`comment`) values($_POST[comment_submit],'$_POST[comment]')";
        $sql_result = mysqli_query($conn,$sql);
        if($sql_result)
          echo '<script>
            alert("Comment Submitted");
            </script>';

        else {
          echo "<div class='alert-danger'>Comment Not Submitted</div>";
        }
      }

        if(isset($_GET['post_id'])){
          $post_id = $_GET['post_id'];

        $query_comment = "select * from `comments` where `post_id` = $_GET[post_id]";
        $comment_detail = mysqli_query($conn,$query_comment);

        $queryDt = "select * from `user` where `user_email` =(select `author` from CmsSystem where `id` = $_GET[post_id]) ";
        $user_detail = mysqli_query($conn,$queryDt);
        $User_data  = mysqli_fetch_assoc($user_detail);

        $query = 'select *from CmsSystem where id='.$_GET['post_id'].'';
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
          <div class="d-flex flex-sm-row-reverse" style=" font-size: 12">
            <a ><i>Author-'.$User_data['user_name'].'</i></a>
          </div>

          <div class="d-flex flex-sm-row-reverse" style=" font-size: 12">
            <a ><i>Published On-'.substr($rows['date'],0,11).'</i></a>
          </div>
        </div>
        <div class="card-footer bg-dark">
        <div class="container ">
        <div class="card-header text-sm-center">Comment</div>

        <form method="post">
          <div class="form-group mt-3 ">
            <label class="text-white">Your Comment Here</label>
            <textarea class="form-control" required name="comment"></textarea>
            <button class="btn btn-info mt-2" name="comment_submit" value="'.$post_id.'">Submit</button>

          </form>

          <div>
          <div class="mt-2">

          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          Read Comments
          </button>
          </div>
          </div>
          <div class="collapse " id="collapseExample">

          ';
          while($rows_comment = mysqli_fetch_assoc($comment_detail)){
            echo'
            <div class="card mt-2">
              <div class="card-header font-weight-light" style="font-size:18px "> '.$rows_comment['name'].'</div>
              <div class="card-body" style="font-size:15px "> '.$rows_comment['comment'].'</div>
            </div>


            ';
          }
          echo'
              </div>

            <div>
          </div>
        </div>

      ';
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
