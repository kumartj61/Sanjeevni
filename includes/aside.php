
<aside class="  ml-2 "  >




<div style="height:200px; opacity:.1" ></div>
<div class="card-header "  align="center"><b>Updates</b></div>
<?php
$query= "select *from CmsSystem";
$data = mysqli_query($conn,$query);
while($rows = mysqli_fetch_assoc($data)){
  echo '
<div class="card bg-light mt-2 ml-2 " style="display:inline-block;float:left ;width:350px;max-height:300px; min-height:300px;opacity:.8"">
    <div class="card-header p-1" align="center">'.$rows['title'].'</div>

    <div class="card-body card-text text-dark" style="overflow:auto">'.substr($rows['description'],0,200).'</div>
</div >';
}
  ?>

</aside>
