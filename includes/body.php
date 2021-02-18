
    <article class="col-sm-8">
    <?php
      $query= "SELECT * FROM `CmsSystem` WHERE catagory='".$_GET['catagory_name']."'";
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
