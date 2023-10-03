<?php 
include("header.php");
    $name=$email=$gender=$comment=$website="";
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
        if(empty($_POST["comment"])){
            $commenterr="COMMENT IS REQUIRED";
        }
        else{
            $comment=demo($_POST["comment"]);
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
<div class="conatiner-fluid ">
    <div class="form-floating ml-4 text-bg-secondary text-center">
        <h2>PHP Form</h2>
        <p><span class="error text-bg-danger">* required field</span></p>
        <form method="post" action="formsubmit.php" enctype="multipart/form-data">
              
            Name: <input type="text" name="name" value="<?php echo $name;?>">
                  <span class="error text-bg-danger">* <?php echo $nameerr;?></span>
            <br><br>
            E-mail: <input type="text" name="email" id="email" value="<?php echo $email;?>">
                    <span class="error text-bg-danger">* <?php echo $emailerr;?></span>
            <br><br>
            Website: <input type="text" name="website" value="<?php echo $website;?>">
                     <span class="error text-bg-danger">*<?php echo $websiteerr;?></span>
            <br><br>
            Address: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
                     <span class="error text-bg-danger">*<?php echo $commenterr;?></span>
            <br><br>
            Gender:
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">male
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">female
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
                    <span class="error text-bg-danger">* <?php echo $gendererr;?></span>
                    <br><input type="file" name="image"/> 
            <br><br>
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit" id="sub1">  
        </form>
    </div>
</div>
<script>
  $(document).ready(function(){
        $("#email").blur(function(){ 
            var email = $(this).val();

            $.ajax({
                    url: "mailchecker.php",
                    method:"POST",
                    data:{
                        email:email
                       
                    },
                    success: function (result) {
                       var obj= JSON.parse(result);
                       if(obj.status==1){
                            alert("mail exist");
                            $("#email").val(''); 
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
          
        });
    });
</script>
<?php 
include("footer.php");
?>