<style>
    .card {
  /* Add shadows to create the "card" effect */
  /* display: block; */
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  height:200px;
  width: 200px;
}

/* On mouse-over, add a deeper shadow */
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

/* Add some padding inside the card container */
.container {
  padding: 2px 16px;
  
}

.cG{
   color:green;
}
.cR{
    color:red;
}
    </style>

<?php

$dataSet = [
    array("name" => "P 1","image"=>"https://www.w3schools.com/howto/img_avatar.png",
   "color"=>array("C","R","G")
),
    array("name" => "P 2","image"=>"https://www.w3schools.com/howto/img_avatar.png",
    "color"=>array("C","R")
),
    array("name" => "P 3","image"=>"https://www.w3schools.com/howto/img_avatar2.png",
    "color"=>array("C","R","G")),
    array("name" => "P 4","image"=>"https://www.w3schools.com/howto/img_avatar.png",
    "color"=>array("C","R","G")
),
    array("name" => "P 5","image"=>"https://www.w3schools.com/howto/img_avatar.png",
    "color"=>array("C3","R4","G")),
    array("name" => "P 6","image"=>"https://www.w3schools.com/howto/img_avatar2.png",
    "color"=>array("C2","R2","G1")),

];


 foreach ($dataSet as $key => $value) {

?>

<div class="card">
  <img src="<?php echo $value['image'] ;?>" alt="Avatar" style="width:100%">
  <div class="container">
   
  
  </div>

</div>
<?php foreach ($value['color'] as  $value1) { ?>
    <span><?php echo $value1; ?></span>
<?php } ?>


<h4  id="<?php echo $key; ?>" class="<?php echo ($key%2==0)?'cG':'cR' ?> button"><?php echo $value['name'];?></h4>


<span href="#" style="display:none" id="showDiv_<?php echo $key; ?>">
    efefjfewfwefjew we fwe fwe fw ef ewf we fwe few few fwe f ewf wef wef wef ew fwef
    wef wef wef wef ew f
</span>


    <br>
<?php }
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
   
  $(".button").hover(function(){
   
    $divid="#showDiv_"+ $(this).attr("id");
    $($divid).toggle();
   
    
  });
  
});
</script>
