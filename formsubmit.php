<?php 
 require('conn.php');
 include('fileupload.php');
$name =  $_POST['name'];
$email =  $_POST['email'];
$address =  $_POST['comment'];
$website =  $_POST['website'];
$gender =  $_POST['gender'];
$password = 12345;
$image= " ";
//files upload code
$image =" ";
if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
  $image=$_FILES['image']['name'];
  $target_directory = "assets/images/user/";
  $target_file = $target_directory . basename($_FILES['image']['name']);
  if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
      $image_path = $target_file;
      echo "image uploaded";
  } else {
      echo "Error uploading the image.";
  }
}
  
/*$target_path = $target_path.basename( $_FILES['image']['name']);   
  
if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path)) {  
    echo "File uploaded successfully!";  
} else{  
    echo "Sorry, file not uploaded, please try again!";  
}  */
//Query for insertion.

$sql = "INSERT into user(name,email,address,gender,password,image) values('$name','$email','$address','$gender','$password','$image')";
//echo $sql;
if(mysqli_query($conn, $sql)){  

  header("Location:list.php"); 
 
 }else{  
 
 echo "Could not insert record: ". mysqli_error($conn);  
 
 }




?>