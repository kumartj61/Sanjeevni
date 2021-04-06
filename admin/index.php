<?php
  session_start();
  include '../includes/db.php';
  $img_flag = false;
  if(isset($_SESSION['user']) && isset($_SESSION['password'])){
    $sel_sql="select *from user where user_email = '".$_SESSION['user']."' and user_pass = '".$_SESSION['password']."'";
    if($run_sql = mysqli_query($conn,$sel_sql)){

        if(mysqli_num_rows($run_sql) == 1){
          while($rows=mysqli_fetch_assoc($run_sql)){
            $user_name = $rows['user_name'];
            $user_email = $rows['user_email'];
            $user_gender = $rows['user_gender'];
            $user_country = $rows['country'];
            $user_dob = $rows['DOB'];
            $user_marital_status = $rows['marital_status'];
            $user_desig = $rows['desig'];
            $user_about_me = $rows['about_me'];
            $user_profile_pic = $rows['profile_pic'];
            $user_role = $rows['role'];
        }
        if(empty($user_profile_pic)){
          $user_profile_pic = "../img/no_img.png";
          $img_flag=false;
        }
        else{
          $img_flag=true;
        }
      }
        else{
          header('Location: ../index.php');
        }
      }
      }

  else{
    header('Location: ../index.php');
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

</head>
<body>
  <?php
  include "includes/header.php";


    $sql1 = "select *from user where role='subscriber'";
    $sql2 = "select *from CmsSystem where author ='".$_SESSION['user']."' and status = 'published' ";
    $sql_c = "select c_id from catagory";
    $sql_u = "select *from user where role = 'subscriber'";
    $result1 = mysqli_query($conn, $sql1);
    $result2 = mysqli_query($conn, $sql2);
    $result_c = mysqli_query($conn , $sql_c);
    $result_u = mysqli_query($conn, $sql_u);
    $count=0;
    $count_post = 0;
    $count_post = mysqli_num_rows($result2);
    $count_cat = mysqli_num_rows($result_c);
    $count_user = mysqli_num_rows($result_u);

  ?>

  <div class="row ml-3">
  <?php
    include "includes/aside.php";
  ?>

  <div class="col-sm-10">
    <div class="row mt-3">
    <div class="col-md-3">
      <div class="card bg-info text-white">
        <div class="card-header">
          <div class="row">
            <div class="col-xs-3"><i class="fas fa-signal" style="font-size:4.5em"></i></div>
            <div class="col-xs-9 text-sm-right " >
              <div  style="font-size:2.5em"><?php echo $count_post;?></div>
              <div class="ml-4"> Posts</div>
            </div>
            </div>
        </div>
        <div class="card-footer text-white" >
          <div class="float-left  ">
            <a href="post_list.php" class="text-white">View Posts</a>
          </div>
          <div class="float-right">
            <a href="post_list.php" ><i  class="fa fa-arrow-circle-left fa-2x text-white" ></i></a>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card bg-warning text-white">
        <div class="card-header">
          <div class="row">
            <div class="col-xs-3"><i class="fa fa-th-list " style="font-size:4.5em"></i></div>
            <div class="col-xs-9 text-sm-right " >
              <div  style="font-size:2.5em"><?php echo $count_cat?></div>
              <div class="ml-4"> Catagory</div>
            </div>
            </div>
        </div>
        <div class="card-footer text-white" >
          <div class="float-left  ">
            <a href="#" class="text-white">View Catagory</a>
          </div>
          <div class="float-right">
            <a href="#" ><i  class="fa fa-arrow-circle-left fa-2x text-white" ></i></a>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card bg-success text-white">
        <div class="card-header">
          <div class="row">
            <div class="col-xs-3"><i class="fa fa-user-circle" style="font-size:4.5em"></i></div>
            <div class="col-xs-9 text-sm-right " >
              <div  style="font-size:2.5em"><?php echo $count_user;?></div>
              <div class="ml-4"> Users</div>
            </div>
            </div>
        </div>
        <div class="card-footer text-white" >
          <div class="float-left  ">
            <a href="#" class="text-white">View Users</a>
          </div>
          <div class="float-right">
            <a href="#" ><i  class="fa fa-arrow-circle-left fa-2x text-white" ></i></a>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card bg-danger text-white">
        <div class="card-header">
          <div class="row">
            <div class="col-xs-3"><i class="fa fa-commenting-o" style="font-size:4.5em"></i></div>
            <div class="col-xs-9 text-sm-right " >
              <div  style="font-size:2.5em">25</div>
              <div class="ml-4"> Comments</div>
            </div>
            </div>
        </div>
        <div class="card-footer text-white" >
          <div class="float-left  ">
            <a href="#" class="text-white">View Comments</a>
          </div>
          <div class="float-right">
            <a href="#" ><i  class="fa fa-arrow-circle-left fa-2x text-white" ></i></a>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <!---Top section ends here -->

  <!--User section -->
  <div class="row mt-2">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <h4>Users list</h4>
        </div>
        <div class="card-body " style="height:300px; overflow:auto">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Sno.</th>
                <th>Name</th>
                <th>Role</th>
              </tr>
            </thead>
            <tbody>
            <?php
            while($rows=mysqli_fetch_assoc($result1)){
              $count = $count+1;
              echo'
              <tr>
                <td>'.$count.'</td>
                <td>'.$rows['user_name'].'</td>
                <td>'.$rows['role'].'</td>
              </tr>
              ';
            }
            ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>



    <div class="col-sm-6">
      <div class="card bg-info">
        <div class="card-heading  ">
        <div class="card-header  bg-primary text-white " align="left">
          <h4>Profile</h4>
        </div>
        <div class="row">
        <div class="col-sm-5 mt-2 ml-1 ">
          <?php
          if($img_flag){
            echo "<img src='../img/".$user_profile_pic."' class='rounded' width='90%' alt='image not uploaded' style='border-color:blue'></img>";
          }
          else {
            echo "<img src= '".$user_profile_pic."' class='rounded' width='90%' alt='image not available' style='border-color:blue'></img>

          ";
        }
          ?>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-5 table-responsive navbar-brand text-white">
          <h3><?php echo $user_name;?></h3>
          <table class="table  table-striped ">
            <tbody>
              <tr>
                <th class="text-dark">Role:</th>
                <td class="text-white"><?php echo $user_role ?></td>
              </tr>
              <tr>
                <th class="text-dark">Email:</th>
                <td class="text-white"><?php echo $user_email?></td>
              </tr>
              <tr>
                <th class="text-dark">Designation</th>
                <td class="text-white"><?php echo "$user_desig";?></td>
              </tr>
            </tbody>
          </table>
        </div>
        </div>

        </div>

      </div>
    </div>
  </div>

  <!---Bottom section Starts here-->
  <div class="row mt-2">
    <div class="card col-sm-12">
      <div class="card-header bg-primary text-white">Latest Posts</div>
      <div class="card-body table-responsive" >
        <table class="table table-striped" style="height=350px; overflow:auto">
          <thead>
            <th>Sno.</th>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Catagory</th>
            <th>Date</th>
            <th>Author</th>
          </thead>
          <tbody>
            <?php
              $result2 = mysqli_query($conn,$sql2);
              while($row = mysqli_fetch_assoc($result2)){
                  echo '
                  <tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['title'].'</td>
                    <td>'.substr($row['description'],0,100).'</td>
                    <td><img src="../'.$row['image'].'" width="50px"></img></td>
                    <td>'.$row['catagory'].'</td>
                    <td>'.$row['date'].'</td>
                    <td>'.$row['author'].'</td>
                  </tr>';
              }
            ?>


          </tbody>
        </table>
      </div>
    </div>
  </div>

<!-- Comment Section -->
  <div class="row mt-2">
    <div class="card col-sm-12">
      <div class="card-header bg-primary text-white">Latest Comments</div>
      <div class="card-body table-responsive" >
        <table class="table table-striped">
          <thead>
            <th>Sno.</th>
            <th>Date</th>
            <th>Author</th>
            <th>Email</th>
            <th>Posts</th>
            <th>Comment</th>

          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>21/04/2000</td>
              <td>Tushar</td>
              <td>kumartj.61@yahoo.com</td>
              <td>5</td>
              <td>Very nice post</td>

            </tr>
            <tr>
              <td>1</td>
              <td>21/04/2000</td>
              <td>Tushar</td>
              <td>kumartj.61@yahoo.com</td>
              <td>5</td>
              <td>Very nice post</td>
            </tr>
            <tr>
              <td>1</td>
              <td>21/04/2000</td>
              <td>Tushar</td>
              <td>kumartj.61@yahoo.com</td>
              <td>5</td>
              <td>Very nice post</td>
            </tr>
            <tr>
              <td>1</td>
              <td>21/04/2000</td>
              <td>Tushar</td>
              <td>kumartj.61@yahoo.com</td>
              <td>5</td>
              <td>Very nice post</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<!--Comment ends-->

  </div>
</div>
</body>
</html>';
