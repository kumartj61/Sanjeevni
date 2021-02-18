<?php
session_start();
include '../includes/db.php';

$date= date_create(date('y-m-d'));
$date= date_sub($date,date_interval_create_from_date_string('12 years'));
$date= date_format($date,'Y-m-d');
$error = "";
$msg =  "";

if(isset($_SESSION['user'])&& isset($_SESSION['password'])){
if(isset($_POST['edit_name'])){

    $sql_u = "select *from user where user_email = '".$_POST['edit_name']."'";
    $run = mysqli_query($conn,$sql_u);

    while($rows=mysqli_fetch_assoc($run)){
      $name = $rows['user_name'];
      $gender = $rows['user_gender'];
      $country = $rows['country'];
      $desig = $rows['desig'];
      $marital_status = $rows['marital_status'];
      $dob = $rows['DOB'];
      $about_me = $rows['about_me'];
      $profile_pic = $rows['profile_pic'];
      $email = $rows['user_email'];

    }

}
elseif(isset($_POST['validator'])){

  if($_FILES['profile_pic']['name']!=''){
    $image_name = $_FILES['profile_pic']['name'];
    $image_tmp = $_FILES['profile_pic']['tmp_name'];
    $image_size = $_FILES['profile_pic']['size'];
    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);

    $image_path = "../img/".$image_name;

    if($image_size<1000000){
      if($image_ext == 'jpg' || $image_ext == 'png'|| $image_ext == 'jpeg'){
        if(move_uploaded_file($image_tmp,$image_path)){
          $sql="UPDATE `user` SET `user_name`='".$_POST['name']."',`user_gender`='".$_POST['gender']."',`country` = '".$_POST['country']."',`DOB`='".$_POST['dob']."',`profile_pic`='".$image_name."' ,`marital_status` = '".$_POST['marital_status']."', `desig` = '".$_POST['desig']."' WHERE `user`.`user_email` ='".$_POST['validator']."' ;";
          if($query = mysqli_query($conn,$sql)){
              $msg="<div class='alert alert-success'>Edited successfully</div>";
            }
          else{
            $msg="<div class='alert alert-danger'>Unable to edit</div>";
          }

        }
        else{
          $error == "<div class='alert alert-danger'>Image did not uploaded, try again!</div>";
        }
      }
      else{
        $error = "<div class='alert alert-warning'>Image format should be either JPG,PNG or JPEG </div>";
      }
    }
    else{
      $error = "<div class='alert alert-warning'>Image file size should be &lt; 1mb </div>";
    }
  }

  else{
    $sql_update = "UPDATE `user` SET `user_name`='".$_POST['name']."',`user_gender`='".$_POST['gender']."',`country` = '".$_POST['country']."',`DOB`='".$_POST['dob']."', `marital_status` = '".$_POST['marital_status']."', `desig` = '".$_POST['desig']."' WHERE `user`.`user_email` ='".$_POST['validator']."' ;";
    $result=mysqli_query($conn,$sql_update);
    if($result)
      $msg = "<div class='alert alert-success'><a> Edited succesfully!</a></div>";
    else $msg = "<div class='alert alert-danger'><a> Unable to edit!</a></div>";

}
}

else{

  header("Location:./index.php");
}}

?>
<!DOCKTYPE html>
<html lang="en">
<head >
  <title>Edit Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0  ">
  <meta charset="utf-8">
  <!-- CSS only -->
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
    <style>
    .cor{
        cursor: pointer;
    }
  </style>
</head>
<body >
  <?php

   include 'includes/header.php';

   ?>

  <div class="row d-flex" >
    <?php include 'includes/aside.php';?>
  <div class="col-sm-10" >
<?php
  if(isset($_POST['validator'])){
      echo $msg;
      echo $error;
    }
  else
      echo'
    <article >
      <div class="card">
        <div class="card-header text-primary" style="font-family:Algerian" align="center">
          <h3> Edit Profile</h3>
        </div>
        <form class="form-group form-horizontal ml-5 mt-3" method="post" enctype="multipart/form-data">

          <div class="row form-group">

            <div class="col-sm-2">
              <label for="name" class="">Name*</label>
            </div>
            <div class="col-sm-7">
              <input class="form-control" id="name" type="text" name="name" value="'.$name.'" required></input>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-sm-2">
              <label for="gender">Gender </label>
            </div>
            <div class="col-sm-5">
              <select class="custom-select" id="gender" name="gender"    required>
                <option value="'.$gender.'">'.$gender.'</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-sm-2">
              <label for="country">Country </label>
            </div>
            <div class="col-sm-5">
              <select class="custom-select" id="country" name="country" required>
                <option value="'.$country.'"  >'.$country.'</option>
              	<option value="Afghanistan">Afghanistan</option>
              	<option value="Albania">Albania</option>
              	<option value="Algeria">Algeria</option>
              	<option value="American Samoa">American Samoa</option>
              	<option value="Andorra">Andorra</option>
              	<option value="Angola">Angola</option>
              	<option value="Anguilla">Anguilla</option>
              	<option value="Antarctica">Antarctica</option>
              	<option value="Antigua and Barbuda">Antigua and Barbuda</option>
              	<option value="Argentina">Argentina</option>
              	<option value="Armenia">Armenia</option>
              	<option value="Aruba">Aruba</option>
              	<option value="Australia">Australia</option>
              	<option value="Austria">Austria</option>
              	<option value="Azerbaijan">Azerbaijan</option>
              	<option value="Bahamas">Bahamas</option>
              	<option value="Bahrain">Bahrain</option>
              	<option value="Bangladesh">Bangladesh</option>
              	<option value="Barbados">Barbados</option>
              	<option value="Belarus">Belarus</option>
              	<option value="Belgium">Belgium</option>
              	<option value="Belize">Belize</option>
              	<option value="Benin">Benin</option>
              	<option value="Bermuda">Bermuda</option>
              	<option value="Bhutan">Bhutan</option>
              	<option value="Bolivia">Bolivia</option>
              	<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
              	<option value="Botswana">Botswana</option>
              	<option value="Bouvet Island">Bouvet Island</option>
              	<option value="Brazil">Brazil</option>
              	<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
              	<option value="Brunei Darussalam">Brunei Darussalam</option>
              	<option value="Bulgaria">Bulgaria</option>
              	<option value="Burkina Faso">Burkina Faso</option>
              	<option value="Burundi">Burundi</option>
              	<option value="Cambodia">Cambodia</option>
              	<option value="Cameroon">Cameroon</option>
              	<option value="Canada">Canada</option>
              	<option value="Cape Verde">Cape Verde</option>
              	<option value="Cayman Islands">Cayman Islands</option>
              	<option value="Central African Republic">Central African Republic</option>
              	<option value="Chad">Chad</option>
              	<option value="Chile">Chile</option>
              	<option value="China">China</option>
              	<option value="Christmas Island">Christmas Island</option>
              	<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
              	<option value="Colombia">Colombia</option>
              	<option value="Comoros">Comoros</option>
              	<option value="Congo">Congo</option>
              	<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
              	<option value="Cook Islands">Cook Islands</option>
              	<option value="Costa Rica">Costa Rica</option>

              	<option value="Croatia">Croatia</option>
              	<option value="Cuba">Cuba</option>
              	<option value="Cyprus">Cyprus</option>
              	<option value="Czech Republic">Czech Republic</option>
              	<option value="Denmark">Denmark</option>
              	<option value="Djibouti">Djibouti</option>
              	<option value="Dominica">Dominica</option>
              	<option value="Dominican Republic">Dominican Republic</option>
              	<option value="Ecuador">Ecuador</option>
              	<option value="Egypt">Egypt</option>
              	<option value="El Salvador">El Salvador</option>
              	<option value="Equatorial Guinea">Equatorial Guinea</option>
              	<option value="Eritrea">Eritrea</option>
              	<option value="Estonia">Estonia</option>
              	<option value="Ethiopia">Ethiopia</option>
              	<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
              	<option value="Faroe Islands">Faroe Islands</option>
              	<option value="Fiji">Fiji</option>
              	<option value="Finland">Finland</option>
              	<option value="France">France</option>
              	<option value="French Guiana">French Guiana</option>
              	<option value="French Polynesia">French Polynesia</option>
              	<option value="French Southern Territories">French Southern Territories</option>
              	<option value="Gabon">Gabon</option>
              	<option value="Gambia">Gambia</option>
              	<option value="Georgia">Georgia</option>
              	<option value="Germany">Germany</option>
              	<option value="Ghana">Ghana</option>
              	<option value="Gibraltar">Gibraltar</option>
              	<option value="Greece">Greece</option>
              	<option value="Greenland">Greenland</option>
              	<option value="Grenada">Grenada</option>
              	<option value="Guadeloupe">Guadeloupe</option>
              	<option value="Guam">Guam</option>
              	<option value="Guatemala">Guatemala</option>
              	<option value="Guinea">Guinea</option>
              	<option value="Guinea-bissau">Guinea-bissau</option>
              	<option value="Guyana">Guyana</option>
              	<option value="Haiti">Haiti</option>
              	<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
              	<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
              	<option value="Honduras">Honduras</option>
              	<option value="Hong Kong">Hong Kong</option>
              	<option value="Hungary">Hungary</option>
              	<option value="Iceland">Iceland</option>
              	<option value="India">India</option>
              	<option value="Indonesia">Indonesia</option>
              	<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
              	<option value="Iraq">Iraq</option>
              	<option value="Ireland">Ireland</option>
              	<option value="Israel">Israel</option>
              	<option value="Italy">Italy</option>
              	<option value="Jamaica">Jamaica</option>
              	<option value="Japan">Japan</option>
              	<option value="Jordan">Jordan</option>
              	<option value="Kazakhstan">Kazakhstan</option>
              	<option value="Kenya">Kenya</option>
              	<option value="Kiribati">Kiribati</option>

              	<option value="Korea, Republic of">Korea, Republic of</option>
              	<option value="Kuwait">Kuwait</option>
              	<option value="Kyrgyzstan">Kyrgyzstan</option>

              	<option value="Latvia">Latvia</option>
              	<option value="Lebanon">Lebanon</option>
              	<option value="Lesotho">Lesotho</option>
              	<option value="Liberia">Liberia</option>
              	<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
              	<option value="Liechtenstein">Liechtenstein</option>
              	<option value="Lithuania">Lithuania</option>
              	<option value="Luxembourg">Luxembourg</option>
              	<option value="Macao">Macao</option>
              	<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
              	<option value="Madagascar">Madagascar</option>
              	<option value="Malawi">Malawi</option>
              	<option value="Malaysia">Malaysia</option>
              	<option value="Maldives">Maldives</option>
              	<option value="Mali">Mali</option>
              	<option value="Malta">Malta</option>
              	<option value="Marshall Islands">Marshall Islands</option>
              	<option value="Martinique">Martinique</option>
              	<option value="Mauritania">Mauritania</option>
              	<option value="Mauritius">Mauritius</option>
              	<option value="Mayotte">Mayotte</option>
              	<option value="Mexico">Mexico</option>
              	<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
              	<option value="Moldova, Republic of">Moldova, Republic of</option>
              	<option value="Monaco">Monaco</option>
              	<option value="Mongolia">Mongolia</option>
              	<option value="Montserrat">Montserrat</option>
              	<option value="Morocco">Morocco</option>
              	<option value="Mozambique">Mozambique</option>
              	<option value="Myanmar">Myanmar</option>
              	<option value="Namibia">Namibia</option>
              	<option value="Nauru">Nauru</option>
              	<option value="Nepal">Nepal</option>
              	<option value="Netherlands">Netherlands</option>
              	<option value="Netherlands Antilles">Netherlands Antilles</option>
              	<option value="New Caledonia">New Caledonia</option>
              	<option value="New Zealand">New Zealand</option>
              	<option value="Nicaragua">Nicaragua</option>
              	<option value="Niger">Niger</option>
              	<option value="Nigeria">Nigeria</option>
              	<option value="Niue">Niue</option>
              	<option value="Norfolk Island">Norfolk Island</option>
              	<option value="Northern Mariana Islands">Northern Mariana Islands</option>
              	<option value="Norway">Norway</option>
              	<option value="Oman">Oman</option>
              	<option value="Pakistan">Pakistan</option>
              	<option value="Palau">Palau</option>
              	<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
              	<option value="Panama">Panama</option>
              	<option value="Papua New Guinea">Papua New Guinea</option>
              	<option value="Paraguay">Paraguay</option>
              	<option value="Peru">Peru</option>
              	<option value="Philippines">Philippines</option>
              	<option value="Pitcairn">Pitcairn</option>
              	<option value="Poland">Poland</option>
              	<option value="Portugal">Portugal</option>
              	<option value="Puerto Rico">Puerto Rico</option>
              	<option value="Qatar">Qatar</option>
              	<option value="Reunion">Reunion</option>
              	<option value="Romania">Romania</option>
              	<option value="Russian Federation">Russian Federation</option>
              	<option value="Rwanda">Rwanda</option>
              	<option value="Saint Helena">Saint Helena</option>
              	<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
              	<option value="Saint Lucia">Saint Lucia</option>
              	<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
              	<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
              	<option value="Samoa">Samoa</option>
              	<option value="San Marino">San Marino</option>
              	<option value="Sao Tome and Principe">Sao Tome and Principe</option>
              	<option value="Saudi Arabia">Saudi Arabia</option>
              	<option value="Senegal">Senegal</option>
              	<option value="Serbia and Montenegro">Serbia and Montenegro</option>
              	<option value="Seychelles">Seychelles</option>
              	<option value="Sierra Leone">Sierra Leone</option>
              	<option value="Singapore">Singapore</option>
              	<option value="Slovakia">Slovakia</option>
              	<option value="Slovenia">Slovenia</option>
              	<option value="Solomon Islands">Solomon Islands</option>
              	<option value="Somalia">Somalia</option>
              	<option value="South Africa">South Africa</option>
              	<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
              	<option value="Spain">Spain</option>
              	<option value="Sri Lanka">Sri Lanka</option>
              	<option value="Sudan">Sudan</option>
              	<option value="Suriname">Suriname</option>
              	<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
              	<option value="Swaziland">Swaziland</option>
              	<option value="Sweden">Sweden</option>
              	<option value="Switzerland">Switzerland</option>
              	<option value="Syrian Arab Republic">Syrian Arab Republic</option>
              	<option value="Taiwan, Province of China">Taiwan, Province of China</option>
              	<option value="Tajikistan">Tajikistan</option>
              	<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
              	<option value="Thailand">Thailand</option>
              	<option value="Timor-leste">Timor-leste</option>
              	<option value="Togo">Togo</option>
              	<option value="Tokelau">Tokelau</option>
              	<option value="Tonga">Tonga</option>
              	<option value="Trinidad and Tobago">Trinidad and Tobago</option>
              	<option value="Tunisia">Tunisia</option>
              	<option value="Turkey">Turkey</option>
              	<option value="Turkmenistan">Turkmenistan</option>
              	<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
              	<option value="Tuvalu">Tuvalu</option>
              	<option value="Uganda">Uganda</option>
              	<option value="Ukraine">Ukraine</option>
              	<option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United States">United States</option>
              	<option value="United Kingdom">United Kingdom</option>
              	<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
              	<option value="Uruguay">Uruguay</option>
              	<option value="Uzbekistan">Uzbekistan</option>
              	<option value="Vanuatu">Vanuatu</option>
              	<option value="Venezuela">Venezuela</option>
              	<option value="Viet Nam">Viet Nam</option>
              	<option value="Virgin Islands, British">Virgin Islands, British</option>
              	<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
              	<option value="Wallis and Futuna">Wallis and Futuna</option>
              	<option value="Western Sahara">Western Sahara</option>
              	<option value="Yemen">Yemen</option>
              	<option value="Zambia">Zambia</option>
              	<option value="Zimbabwe">Zimbabwe</option>
              </select>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-sm-2">
              <label>Date Of Birth* </label>
            </div>
            <div class="col-sm-7">
              <input class="form-control"  type="date" name="dob" value="'.$dob.'" min="1985-01-01" max="'.$date.'" required></input>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-sm-2">
              <label>Marital status</label>
            </div>
            <div class="col-sm-7">
              <select class="custom-select " name="marital_status" required>
                <option value="'.$marital_status.'">'.$marital_status.'</option>
                <option value="Married">Married</option>
                <option value="Unmarried">Unmarried</option>
              </select>
            </div>
          </div>


          <div class="row form-group">
            <div class="col-sm-2">
              <label>Designation</label>
            </div>
            <div class="col-sm-7">
              <input class="form-control"  type="text" name="desig" value="'.$desig.'"></input>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-sm-2">
              <label >Profile Picture </label>
            </div>
            <div class="col-sm-7 custom-file  ">
              <input class="custom-file-input"  type="file" accept="image/*" id="profile_pic" name="profile_pic" class="custom-file-input" >
              <label class="custom-file-label" for="profile_pic">Choose Image</label>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-sm-2">
              <label>About You </label>
            </div>
            <div class="col-sm-7">
              <textarea class="form-control"  name="about_me" value="'.$about_me.'" placeholder="'.$about_me.'" rows=4></textarea>
            </div>
          </div>


          <div class="row form-group">
            <div class="col-sm-2">
              <label> </label>
            </div>
            <div class="col-sm-7">
              <input class="btn btn-block btn-primary"  type="submit"></input>
            </div>
          </div>
          <input  type="hidden" name="validator" value="'.$email.'"></input>
        </form>
      </div>
    </article>';
?>



</div>
</div>
</body>
</html>
