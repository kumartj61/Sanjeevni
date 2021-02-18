<?php
$target_dir = "/img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$path = $_FILES["fileToUpload"]["name"];
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  echo move_uploaded_file($_FILES["fileToUpload"]["name"],$target_file);

}
foreach($path as $f){
  echo $f;
}
?>
