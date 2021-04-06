<?php
  session_start();
  include '../includes/db.php';
  $flag = false;
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
  $per_page=5;
  if(isset($_GET['page'])){
    $page=$_GET['page'];
  }
  else{
    $page = 1;
  }
  $start_from = ($page-1) * $per_page;

  $msg="";
  if(isset($_GET['new_status'])){
    $new_status = $_GET['new_status'];
    $id = $_GET['id'];
    $new_sql = "update `CmsSystem` set `status` = '".$new_status."' where `CmsSystem`.`id`=$id ";
    $result = mysqli_query($conn,$new_sql);
    if($result){
      $msg = "<div class='alert alert-success'>Status changed successfully</div>";
    }
  }
  elseif(isset($_GET['del_id'])){
    $id = $_GET['del_id'];
    $new_sql = "delete from `CmsSystem` where `CmsSystem`.`id` = $id";
    $result = mysqli_query($conn,$new_sql);
    if($result){
      $msg = "<div class='alert alert-info'>Post Deleted</div>";
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
    <?php include "includes/aside.php"


    ?>

    <div class="col-sm-10">
      <?php echo $msg;?>
      <div class="card-header text-primary" align="center"><h1>View Post</h1></div>
      <div class="container-fluid">
        <div class="row mt-2">
          <div class="card col-sm-12">
            <div class="card-header bg-primary text-white">Your Posts</div>
            <div class="card-body" >
              <table class="table table-responsive table-striped">
                <thead>
                  <th>Sno.</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Catagory</th>
                  <th>Date</th>
                  <th>Author</th>
                  <th>Status</th>
                  <th>Action</th>
                  <th>Edit Post</th>
                  <th>View Post</th>
                  <th>Delete Post</th>
                </thead>
                <tbody>
                  <?php
                  $sql = "select *from CmsSystem c join user u on c.author = u.user_email order by id desc limit $start_from,$per_page";
                  $result = mysqli_query($conn,$sql);
                  $str = '';
                  while($rows=mysqli_fetch_assoc($result)){
                    $str = substr($rows['description'],0,180);
                    echo'

                    <tr>

                      <td>'.$rows['id'].'</td>
                      <td>'.$rows['title'].'</td>
                      <td>'.$str.'</td>
                      <td>'.($rows['image'] == "" ? 'No Image' : '<img src="../'.$rows['image'].'" width="50px"></img>').'</td>
                      <td>'.$rows['catagory'].'</td>
                      <td>'.$rows['date'].'</td>
                      <td>'.$rows['user_name'].'</td>
                      <td>'.$rows['status'].'</td>
                      <td>'.($rows['status'] == "draft"?'<a href="post_list.php?new_status=published&id='.$rows['id'].'" class="btn btn-success btn-sm">Publish</a>':'<a href="post_list.php?new_status=draft&id='.$rows['id'].'" class="btn btn-info btn-sm">Draft</a>').'</td>
                      <td><a href="edit_post.php?edit_id='.$rows['id'].'" class="btn btn-warning btn-sm">Edit</a></td>
                      <td><a href="../post.php?post_id='.$rows['id'].'" class="btn btn-primary btn-sm">View</a></td>
                      <td><a href="post_list.php?del_id='.$rows['id'].'" class="btn btn-danger btn-sm">Delete</a></td>

                    </tr>';
                  }
                  ?>


                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>

        <div class="ml-auto mr-auto mt-3">
          <ul class="pagination pagination">
        <?php

          $page_sql = "select *from CmsSystem where status = 'published'";
          $run_sql = mysqli_query($conn,$page_sql);
          $count = mysqli_num_rows($run_sql);
          $total_page = ceil($count/$per_page);
          for($i=1;$i<=$total_page;$i++){
            echo '<li class="page-item"><a class="page-link" href="post_list.php?page='.$i.'">'.$i.'</a></li> ';
          }
        ?>

          </ul>
        </div>
    </div>
  </div>
</body>
