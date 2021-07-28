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
  <h2>Product List</h2>
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
      <th>Category</th>
      <th>Name</th>
      <th>Price</th>
      <th>Description</th>
      <th>Image</th>
      <th>Status</th>
      <th></th>
  </tr>
  </thead>
  <tbody>
    <?php
      $a=1;
     $getAllUser=mysqli_query($db,"SELECT * FROM `my_products`");
     while($row=mysqli_fetch_assoc($getAllUser))
     {
       $categoryId=$row['category_id'];
       $getCat=mysqli_query($db,"SELECT * FROM `my_category` WHERE `id`='$categoryId'");
       $catRw=mysqli_fetch_assoc($getCat);
      ?>
        <tr id="tr_<?php echo $row['id']; ?>">
          <td><?php echo $a; ?></td>
          <td><?php echo $catRw['title']; ?></td>
          <td><?php echo $row['title']; ?></td>
          <td><?php echo $row['price']; ?></td>
          <td><?php echo $row['description']; ?></td>
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
          <td  id="st_<?php echo $row['id']; ?>">
            <?php  
              $status=$row['status'];
              switch($status)
              {
                case 1:
            ?>
                    <span onclick="changeStatus(<?php echo $row['id']?>,'deactivate')" class="btn btn-success btn-sm">Active</span>
            <?php
                break;

                case 2:
            ?>
                    <span  onclick="changeStatus(<?php echo $row['id']?>,'activate')"  class="btn btn-danger btn-sm">Deactive</span>
            <?php
                break;
              }
            ?>
          </td>
          <td>
            <a href="edit.php?id=<?php echo base64_encode($row['id']); ?>&mode=edit">Edit</a> | 
            <a onclick="deleteData(<?php echo $row['id'] ?>,'product')">Delete</a>
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
             data: {row_id: rid,mode: md},
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


function changeStatus(rid,md)
{

      $.ajax({
             url: "ajax.php", 
             method : "GET",
             data: {row_id: rid,mode: md},
             dataType: "text", 
             cache:false,
             success: function(dt)
             {
                var did="st_" + rid; 
                $('#' + did).html(dt);
             }
      });
}
  </script>
  
</body>
</html>
