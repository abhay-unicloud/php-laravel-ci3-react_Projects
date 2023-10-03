<?php
require('conn.php');

$email = $_POST['email'];
$sql = "SELECT * FROM user WHERE email = '$email'";

    $result= mysqli_query($conn, $sql);
    $row= mysqli_fetch_assoc($result);
    if($result->num_rows>0){
        $res = array("status"=>"1",
        "message" => "Mail Already exist"
    );
        echo json_encode($res);
    } else{
        $res = array("status"=>"0",
        "message" => "Mail does not exist"
    );
        echo json_encode($res);
    }
   
  
?>