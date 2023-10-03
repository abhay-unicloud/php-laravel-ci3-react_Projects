<?php
 require('conn.php');

$id = $_GET['id'];
$sql = "DELETE from user where id=$id";

if(mysqli_query($conn, $sql)){  

 header("Location:list.php");
 
exit; 
 
 }else{  
 
 echo "Could not insert record: ". mysqli_error($conn);  
 
 }
?>