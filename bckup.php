<?php include 'includes/db.php'?>
<!DOCKTYPE html>

<html lang="en">
<head title="cms">
  <meta name="viewport" width="device-width">
  <meta charset="utf-8">
  <script src="bootstrap/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.js"></script>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css"></link>
  <style>
    .cor{
        cursor: pointer;
    }
  </style>
</head>
<body class="bg-secondary">
<!-- Nav-Section-->
  <nav class="navbar navbar-dark navbar-expand-sm bg-dark sticky-top cor">
    <a class="navbar-brand text-primary">CmsSystem</a>
    <ul class="navbar-nav  ">
        <li class="nav-item"><a class="nav-link active">Home</a></li>
        <li class="nav-item"><a class="nav-link">Top Posts</a></li>
        <li class="nav-item"><a class="nav-link">ContactUs</a></li>
    </ul>
    <div class="navbar-nav" style="position:absolute;right:5px;bottom:7px"  >
      <a class="dropdown-toggle nav-link active" data-toggle="dropdown" >Catagories</a>
      <div class="dropdown-menu " >
        <?php
        $query = "select catagory_name from catagory ";
        $run = mysqli_query($conn,$query);
        while($row = mysqli_fetch_assoc($run)){
          echo '
        <a class="dropdown-item " href="menu.php?catagory_name='.$row['catagory_name'].'">'.$row['catagory_name'].'</a>';
      }?>
      </div>
    </div>
  </nav>

<!-- card-section-->
  <div class="row bg-secondary" style="font-family:Timesnewroman">
    <article class="col-sm-8">
    <?php
      $query= "select *from CmsSystem";
      $data = mysqli_query($conn,$query);
      while($rows = mysqli_fetch_assoc($data)){
        echo '


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
        }?>
    </article>





    <aside class="col-sm-4 ">
      <form class="form-group " style="float:right">
        <div class="row  form-inline input-group mr-2 mt-2 p-1" style="width:350px">
          <div class="input-group-prepend ">
            <span class="input-group-text">Search</span>
          </div>
          <input type="text" class="form-control" style="width:200px" placeholder="Enter your Search"></input>
          <div class="input-group-append">
            <button class="btn-success"><input type="image" src="icons/png/arrow-thick-right-4x.png"></input></button>
          </div>
        </div>
      </form>

      <div class="card bg-success mr-3" style="float:right">
        <form class="form-group card-body">
          <div class="card-header p-1" align="center">Login</div>
          <div class="row form-inline input-group p-2 " >
            <div class=" input-group">
              <div class="input-group-prepend">
                <span class="input-group-text ">UserId</span>
              </div>
              <input type="text" class="form-control" ></input>
          </div>
        </div>
        <div class="row form-inline input-group p-2" >
          <div class=" input-group">
              <div class="input-group-prepend ">
                <span class="input-group-text ">Password</span>
              </div>
              <input type="Password" class="form-control" ></input>
          </div>
        </div>
      </form>
    </div >
    <?php
    $query= "select *from CmsSystem";
    $data = mysqli_query($conn,$query);
    while($rows = mysqli_fetch_assoc($data)){
      echo '
    <div class="card bg-light mr-3 mt-2" style="float:right;width:87%;max-height:200px;">
        <div class="card-header p-1" align="center">'.$rows['title'].'</div>
        <div class="card-body card-text" style="overflow:auto">'.substr($rows['description'],0,400).'</div>
    </div >';}
      ?>

    </aside>


</div>
</body>
</html>
