<?php include 'includes/db.php'?>
<!DOCKTYPE html>

<html lang="en">
<head title="cms">
  <meta name="viewport" content="width=device-width, initial-scale=1.0>
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
  </style>
</head>
<body >
<!-- Nav-Section-->
  <?php include 'includes/header.php'?>

<!-- card-section-->
  <div  class="container " style="font-family:Timesnewroman">

    <?php
      $query= "select * FROM `CmsSystem` WHERE catagory = (select catagory_name from catagory where c_id= ".$_GET['c_id'].")";
      $data = mysqli_query($conn,$query);
      while($rows = mysqli_fetch_assoc($data)){
        echo '
			<div class="card responsive ml-5 mt-2" align="center" style="height:90%px;width:100%;opacity:0.9">
				<div class="card-header" align="center"><h3>'.$rows['title'].'</h3></div>
				<div class="row card-body">
					<div class="col-sm-5 ">
						<img src="'.$rows['image'].'" class="card-image-bottom rounded" style="height:100%;width:100%;max-height:300px" ></img>
					</div>

					<div class="card-text col-sm-7">
						<p>'.substr($rows['description'],0,300).' ......
						</p>
						<a href="post.php?post_id='.$rows['id'].'" class="btn btn-primary">Read</a>

					</div>
				</div>

			</div>

        ';
        }

		?>
		<div style="display:inline-block " >
		<?php
		include 'includes/aside.php';
		?>
	</div>

<!--
<div class="card bg-light justify-content-sm-center p-2" >


            <div class="card-header" align="center"><h3>'.$rows['title'].'</h3></div>
            <div class="row card-body">
            <div class="clearfix col-lg-5">
              <img src="'.$rows['image'].'" class="card-img-top" style="width:100%;height:50%;min-width:200px;min-height:200px" ></img>
            </div>


            <div class="card-text col-sm-7">
              <p>'.substr($rows['description'],0,300).' ......
              </p>
              <a href="post.php?post_id='.$rows['id'].'" class="btn btn-primary">Read</a>

            </div>

          </div>
        </div>

-->



</div>
</body>
</html>
