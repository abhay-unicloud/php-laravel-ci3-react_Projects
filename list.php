<?php
 require('conn.php');

 $sql = "SELECT * FROM user";

 $result = $conn->query($sql);
 include('header.php');
 if(!isset($_SESSION['name'])){
     header("location:login.php");
  } 

?>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>


<h2>User Table</h2>

<table>
  <tr>
    <th>S R</th>
    <th>Profile</th>
    <th>Namer</th>
    <th>Email</th>
    <th>Gender</th>
    <th>address</th>
    <th>Action</th>
  </tr>
  <?php
   if ($result->num_rows > 0) {
    // output data of each row
    $i=1;
    while($row = $result->fetch_assoc()) {

      $image ="";
      if ($row['image']){ 
$image= $row['image'];
      } else{
        $image= "download.jpg";
      }
       
        ?>
     
    
  <tr>
    <td><?php echo $i++ ?></td>
    <td>

      <img src="assets/images/user/<?php echo $image; ?>" id="#logo" height="50px" width="50px">
  

     </td>

    <td><?php echo $row['name'] ?></td>
    <td><?php echo $row['email'] ?></td>
    <td><?php echo $row['gender'] ?></td>
    <td><?php echo $row['address'] ?></td>
    <td><a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
    <a href="update.php?id=<?php echo $row['id']; ?>">Update</a></td>
    
  </tr>
<?php } 
} else{
   
    ?>
    <tr>
        <td colspan="6" align="center">NO Record</td>
    </tr>

<?php }?>
</table>
<?php
include('footer.php');
?>