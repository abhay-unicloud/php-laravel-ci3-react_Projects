<!DOCTYPE html>
<html>
<head>
<?php
include("header.php");
?>
<style>
    .error {
        color : red;
    }
    #sub1{
        cursor: pointer;
        background-color: blue;
        color : white;
        }
</style>
</head>
<body>
<?php 

require('conn.php');
$id = $_GET['id'];
$sql="SELECT * from user where id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$name=$row['name'];
$email=$row['email'];
$address=$row['address'];
$website="";
$gender=$row['gender'];



   
    $nameerr=$gendererr=$emailerr=$commenterr=$websiteerr="";

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST["name"])){
            $nameerr="NAME IS REQUIRED";
        }
        else{
            $name=demo($_POST["name"]);
            if(!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                $nameerr= "ONYL WHITE SPACES AND LETTERS ARE ALLOWED";
            }
        }
        if(empty($_POST["website"])){
            $websiteerr="WEBSITE IS REQUIRED";
        }    
        else{
            $website=demo($_POST["website"]);
            if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)){
                $websiteerr="INVALID URL";
            }
        }
        if(empty($_POST["email"])){
            $emailerr="EMAIL IS REQUIRED";
        }
        else{
            $email=demo($_POST['email']);
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $emailerr="INVALID EMAIL";
            }
        }
        if(empty($_POST["address"])){
            $commenterr="address IS REQUIRED";
        }
        else{
            $address=demo($_POST["address"]);
        }
        if(empty($_POST["gender"])){
            $gendererr="GENDER IS REQUIRED";
        }
        else{
            $gender=demo($_POST["gender"]);
        }
    }
function demo($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;

} 
?>   
<div class="conatiner-fluid">
    <div class="form-floating ml-4 text-bg-secondary text-center">
        <h2>PHP Form</h2>
        <p><span class=" text-bg-danger">* required field</span></p>
        <form method="post" action="formupdate.php">  
        <input type="hidden" name="id" value="<?php echo $id;?>">
            Name: <input type="text" name="name" value="<?php echo $name;?>">
                  <span class=" text-bg-danger">* <?php echo $nameerr;?></span>
            <br><br>
            E-mail: <input type="text" name="email" value="<?php echo $email;?>">
                    <span class=" text-bg-danger">* <?php echo $emailerr;?></span>
            <br><br>
            Website: <input type="text" name="website" value="<?php echo $website;?>">
                     <span class=" text-bg-danger">*<?php echo $websiteerr;?></span>
            <br><br>
            Comment: <textarea name="address" rows="5" cols="40"><?php echo $address;?></textarea>
                     <span class=" text-bg-danger">*<?php echo $commenterr;?></span>
            <br><br>
            Gender:
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">male
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">female
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
                    <span class=" text-bg-danger">* <?php echo $gendererr;?></span>
            <br><br>
                    <input type="submit" class="btn btn-primary" name="submit" value="Update" id="sub1">  
        </form>
    </div>
</div>

<script src=https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css></script>
<?php
include("footer.php")
?>
</body>
</html>