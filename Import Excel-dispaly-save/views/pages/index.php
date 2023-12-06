

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

 
    <tr>
        <td colspan="6" align="center">NO Record</td>
    </tr>


</table>
