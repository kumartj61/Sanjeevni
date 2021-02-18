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
  $msg = '';
  if(isset($_GET['del_id'])){
    $del_sql="delete from catagory where c_id=".$_GET['del_id']."";
    if(mysqli_query($conn,$del_sql)){
      $msg= "<div class='alert alert-danger'> You have deleted a catagory</div>";
    }

  }
  if(isset($_GET['info'])){
    if($_GET['info']=='1'){
      $msg="<div class='alert alert-danger'> Catagory updated successfully</div>";
    }
    elseif($_GET['info']=='2'){
      $msg="<div class='alert alert-danger'> Sorry can not updated catagory</div>";
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
      <?php
        echo $msg;
      ?>
      <div class="card-header text-primary" align="center"><h1>Catagories</h1></div>
      <div class="container-fluid">
        <div class="row mt-2">
          <div class="card col-sm-12">
            <div class="card-header bg-primary text-white">Post Catagories</div>
            <div class="card-body" >
              <table class="table table-striped">
                <thead>
                  <th>Sno.</th>
                  <th>Catagory Name</th>
                  <th>Edit </th>
                  <th>Delete</th>
                </thead>
                <tbody>
                  <?php
                    $c_sql = "select *from catagory ; ";
                    $c_result = mysqli_query($conn,$c_sql);
                    while($row=mysqli_fetch_assoc($c_result)){
                      echo '
                        <tr>
                        <td>'.$row['c_id'].'</td>
                        <td>'.$row['catagory_name'].'</td>
                        <td><a href="edit_catagory.php?edit_id='.$row['c_id'].'" class="btn btn-primary btn-sm">Edit</a></td>
                        <td><a href="catagory_list.php?del_id='.$row['c_id'].'" class="btn btn-danger btn-sm">Delete</a></td>
                      </tr>';
                    }
                  ?>


                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>


      </div>
    </div>
</body>
