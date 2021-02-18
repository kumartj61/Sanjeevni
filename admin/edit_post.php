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
  $error = "";


  if(isset($_POST['submit'])){
    $title = strip_tags($_POST['title']);

    $date = date('Y-m-d h:i:s');
    if($_FILES['image']['name']!=''){
      $image_name = $_FILES['image']['name'];
      $image_tmp = $_FILES['image']['tmp_name'];
      $image_size = $_FILES['image']['size'];
      $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
      $image_path = "../img/".$image_name;
      $image_db_path = "img/".$image_name;
      if($image_size<1000000){
        if($image_ext == 'jpg' || $image_ext == 'png'|| $image_ext == 'jpeg'){
          if(move_uploaded_file($image_tmp,$image_path)){
            $sql = "update `CmsSystem` SET `title` = '".$_POST['title']."',`description` = '".$_POST['description']."',`image` = '".$_POST['image']."',`catagory` = '".$_POST['catagory']."',`author` = '".$_POST['author']."' WHERE `CmsSystem`.`id` = ".$_GET['edit_id'].";";
            if(mysqli_query($conn,$sql)){
              header('Location: post_list.php');
            }
            else{
              $error = "<div class='alert alert-danger'>Post not updated</div>";
            }
          }
          else{
            $error == "<div class='alert alert-danger'>Image did not uploaded, try again!</div>";
          }
        }
        else{
          $error = "<div class='alert alert-danger'>Image format should be either JPG,PNG or JPEG </div>";
        }
      }
      else{
        $error = "<div class='alert alert-danger'>Image file size should be &lt; 1mb </div>";
      }
    }
    else{
      $sql = " update `CmsSystem` SET `title` = '".$_POST['title']."',`description` = '".$_POST['description']."',`catagory` = '".$_POST['catagory']."',`author` = '".$_POST['author']."' WHERE `CmsSystem`.`id` = ".$_GET['edit_id'].";";
      if(mysqli_query($conn,$sql)){
        header('location:post_list.php');
      }
      else{
        $error = "<div class='alert alert-danger'>Post not uploaded! try again or contact support</div>";
      }
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
<script src="https://cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>


</head>
<body>
  <?php include "includes/header.php"?>
  <?php echo $error;?>
  <div class="row">
    <?php  include "includes/aside.php";
    ?>
    <div class="col-sm-10">
      <?php
        $title = 'Title Here';
        if(isset($_GET['edit_id'])){
          $edit_sql = "select *from CmsSystem where id =".$_GET['edit_id']." ;";
          $run = mysqli_query($conn,$edit_sql);

          while($row = mysqli_fetch_assoc($run)){
              $title = $row['title'];
              $catagory = $row['catagory'];
              $description = $row['description'];
              $image = $row['image'];
              $status = $row['status'];

            ?>
            <div class="card-header text-primary" align="center"><h1><?php echo  $title ?></h1></div>
            <div class="container-fluid">
              <form class="form-horizontal text-dark" action="new_post.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="title"><h3>Title</h3></label>
                  <input id="title" class="form-control" type="text" name = "title"  <?php echo "value= '$title'" ?> required></input>
                </div>

                <div class="form-group">
                  <label for="catagory"><h3>Catagory</h3></label>
                  <select id="catagory" class="form-control" name="catagory" required>
                  <?php
                  $sql = 'select catagory_name from catagory where c_id='.$_GET['edit_id'].'';
                  $run = mysqli_query($conn,$sql);
                  while($rows=mysqli_fetch_assoc($run)){
                  echo"<option value= '".$rows['catagory_name']."'>".$rows['catagory_name']." </option>";
                }?>
                  <?php
                    $sql = 'select *from catagory';
                    $run = mysqli_query($conn,$sql);
                    while($rows=mysqli_fetch_assoc($run)){
                      echo '<option value="'.$rows["catagory_name"].'">'.$rows['catagory_name'].'</option>';
                    }
                  ?>

                </select>
              </div>
              <div class="form-group">
                <label for="tiny"><h3>*Description</h3></label>
                <?php
                echo '<textarea id="description" class="form-control" name="description"?>
                  </textarea>';
                ?>
                <script>
                        CKEDITOR.replace( 'description' );
                </script>
              </div>


              <div class="form-group mt-3">

                <label for="Image"><h3>Upload Image</h3></label>
                <p><img <?php echo 'src=" ../'.$image.'"' ?> style="width:100px"></img></p>
                <input id="Image" class="form-control btn btn-primary " accept="image/*" type="file" name="image" <?php echo "value= '$image'" ?>></input>
              </div>

              <div class="form-group mt-3">
                <label for="Proof"><h3>Upload Proof</h3></label>
                <input id="Proof" class="form-control btn btn-primary btn-block" type="file" name="proof"></input>
              </div>
              <a class="text-danger">*Note: Make sure that given Document or Reference is taken from a genuine source </a>
              <h3>Or</h3>
              <hr>
              <div class="form-group mt-3">
                <label for="reference"><h3>Enter Reference</h3></label>
                <textarea id="reference" class="form-control " rows="5" name="reference"></textarea>
              </div>
              <div class="form-group">
                <label for="status"><h3>Status</h3></label>
                <select id="status" class="form-control" name="status" required>
                  <option value="">Select Option</option>
                  <option value="published">Publish</option>
                  <option value="draft">Draft</option>
                </select>
              </div>
              <div class="form-group">
                <button id="submit" name="submit" class="btn btn-danger btn-block" type="submit">Submit</button>
              </div>
            </form>
          </div>
        <?php }}
        else {
          echo "<div class='alert alert-danger'> Please select A post to edit!</div>";
        }
      ?>



      </div>
    </div>
  </div>
</body>
