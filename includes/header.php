<?php
  include 'includes/db.php';
  $uri = $_SERVER['REQUEST_URI'];
	$home='';
	$contact = '';
	$register = '';
  if($uri == "/project/contact.php"){
      $home = '';
      $register = '';
      $contact = 'active';
  }
  elseif($uri == "/project/index.php"){
      $home = 'active';
      $register = '';
      $contact = '';
  }
  elseif($uri == "/project/signup.php"){
      $home = '';
      $register = 'active';
      $contact = '';

  }
?>
<div class=" responsive ">
<div class="bg-white row" style="margin-left:1px ">
  <div class="col-sm-3">
    <img src="icon/icon_main.png" width="150px" style="height:100px"></img>
  </div>
  <div class="col-sm-5 mt-3">
    <img src="icon/banner.png" style="width:300px"></img>
  </div>
</div>
<nav class="navbar sticky-top navbar-light navbar-expand-sm bg-light  mr-0 "   >

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#btn_target">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse col-sm-5" id="btn_target">
  <ul class="navbar-nav nav-tabs ">
      <li class="nav-item"><a class="nav-link <?php echo $home?>" href="index.php">Home</a></li>
      <div class="dropdown">
      <li class="dropdown-toggle nav-link " data-toggle="dropdown" >Catagories</li>
      <div class="dropdown-menu " >
        <?php
        $query = "select *from catagory ";
        $run = mysqli_query($conn,$query);
        while($row=mysqli_fetch_assoc($run)){
          echo '
          <a class="dropdown-item" href="menu.php?c_id='.$row['c_id'].'">'.$row['catagory_name'].'</a>';
        }?>
      </div>
    </div>

    <li class="nav-item"><a class="nav-link <?php echo $contact?>" href="./contact.php">ContactUs</a></li>
    <li class="nav-item"><a class="nav-link <?php echo $register?>" href="./signup.php"> Login</a></li>

    <a  style="float:right;right:10px;top:-12;position:absolute" href="#">

    </a>
  </ul>


</div>
	<div class="col-sm-2"></div>
	<div class="  col-sm-5 align-right" style="border-radius:10px"  >
      <form class="form input-group form-inline" action="search.php">
		<div class="input-group-prepend ">
			<span class="input-group-text">Search</span>
		</div>
		<input type="text" class="form-control align-content-sm-center " name="search" placeholder="Enter your Search"></input>
		<div class="input-group-append">
			<button class="btn-secondary  text-light rounded" href="search.php?search_key?" type="submit"><i class="fas fa-search "></i></button>
		</div>
	  </form>
    </div>
</nav>
</div>
