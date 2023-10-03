<?php 
 require('conn.php');
if (isset($_POST['submit'])){

    $id =  $_POST['id'];
    $name =  $_POST['name'];
    $email =  $_POST['email'];
    $address =  $_POST['address'];
    $website =  $_POST['website'];
    $gender =  $_POST['gender'];
   
$sql = "UPDATE user set name='$name',email ='$email',address='$address',gender='$gender' where id=$id";
$result = mysqli_query($conn, $sql);

if($result){  
   // echo "updated succesfully";
 header("Location:list.php");
 
 }else{  
 
 echo "Could not update record: ". mysqli_error($conn);  
 
}
}
?>