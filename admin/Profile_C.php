$flag = false;
if(isset($_SESSION['user']) && isset($_SESSION['password'])){
  $flag = true;

  $sel_sql="select *from user where user_email = '".$_SESSION['user']."' and user_pass = '".$_SESSION['password']."';";






  if($run_sql = mysqli_query($conn,$sel_sql)){
    while($rows=mysqli_fetch_assoc($run_sql)){
      $user_name = $rows['user_name'];
      $user_email = $rows['user_email'];
      $user_gender = $rows['user_gender'];
      $user_country = $rows['country'];
      $user_dob = $rows['DOB'];
      $user_marital_status = $rows['marital_status'];
      $designation = $rows['desig'];
      $user_about_me = $rows['about_me'];
      $status = $rows['email_status'];
      if(isset($_POST['Status'])){

          if($status==1){
            $status_sql ="update user set `email_status` = 0 where user_email='".$_SESSION['user']."' and user_pass = '".$_SESSION['password']."';";
          }
          else{
            $status_sql ="update user set `email_status` = 1 where user_email='".$_SESSION['user']."' and user_pass = '".$_SESSION['password']."';";
          }
          $res = mysqli_query($conn,$status_sql);
        }


      if($rows['profile_pic']==''){
        $user_profile_pic = "./img/no_img.png";

      }
      else{
        $user_profile_pic = $rows['profile_pic'];
      }
      $user_role = $rows['role'];
      if(mysqli_num_rows($run_sql) != 1){
        header('Location: ../index.php');
      }

    }
    }
}
else{
  $flag=false;
  header('Location: ../index.php');
}
