<?php 
include('../config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>User List</h2>
<?php 
  if(isset($_SESSION['success_msg']))
  {
  ?>
    <div class="alert alert-success">
    <?php echo $_SESSION['success_msg']; ?>
  </div>
  <?php
    unset($_SESSION['success_msg']);
  }
  ?>

  <?php 
  if(isset($_SESSION['error_msg']))
  {
  ?>
    <div class="alert alert-danger">
    <?php echo $_SESSION['error_msg']; ?>
  </div>
  <?php
     unset($_SESSION['error_msg']);
  }
  ?>

  <a class="btn btn-primary" href="add-product.php">
    Add Product
  </a>

<table class="table table-bordered" >
  <thead>
    <tr>
      <th>SL</th>
      <th>Name</th>
      <th>Contact</th>
      <th>Email</th>
      <th>Image</th>
      <th></th>
  </tr>
  </thead>
  <tbody>
    <?php
      $a=1;
     $getAllUser=mysqli_query($db,"SELECT * FROM `my_user`");
     while($row=mysqli_fetch_assoc($getAllUser))
     {
      ?>
        <tr id="tr_<?php echo $row['id']; ?>">
          <td><?php echo $a; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['contact']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td>
            <?php
                       $image=$row['image'];
                       if(!empty($image))
                       {
                        ?>
                           <img src="../images/<?php echo $image; ?>" style="width:100px">
                        <?php
                       }
                       else
                       {
                        echo "---";
                       }
            ?>
          </td>
          <td>
            <a href="edit.php?id=<?php echo base64_encode($row['id']); ?>&mode=edit">Edit</a> | 
            <a onclick="deleteData(<?php echo $row['id'] ?>,'user')">Delete</a>
          </td>
        </tr>
      <?php
      $a++;
     }

    ?>
  </tbody>

</table>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

function deleteData(rid,md)
{
 if (confirm('Are you sure you want to delete this?')) {
      $.ajax({
             url: "ajax.php", 
             method : "GET",
             data: {row_id: rid.mode : md},
             dataType: "text", 
             cache:false,
             success: function(dt)
             {
               var did="tr_" + rid; 
               $('#' + did).remove();
               alert(dt);
             }
      });
  }
}
  </script>
  
</body>
</html>
