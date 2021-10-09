<?php
$target_dir = "uploads/";

// check folder and create folder if not folder uupload 
if (!file_exists($target_dir)) {
  mkdir($target_dir, 0777, true);
}

if(isset($_FILES['image'])){
  $errors= array();
  $file_name = $_FILES['image']['name'];
  $file_size =$_FILES['image']['size'];
  $file_tmp =$_FILES['image']['tmp_name'];
  $file_type=$_FILES['image']['type'];
  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
  
  $extensions= array("jpeg","jpg","png");
  
  if(in_array($file_ext,$extensions)=== false){
     $errors[]="extension not allowed, please choose a JPEG or PNG file.";
  }
  
  if($file_size > 2097152){
     $errors[]='File size must be excately 2 MB';
  }
  
  if(empty($errors)==true){
     move_uploaded_file($file_tmp,$target_dir.$file_name);
     echo "Success";
  }else{
     print_r($errors);
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload</title>
</head>
<body>
  <h3>PHP upload file</h3>
  <form action="/upload.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="image">
    <button type="submit" name="submit">upload</button>
</form>
</body>
</html>
