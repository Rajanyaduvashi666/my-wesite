<?php 
include('../config.php');

if(isset($_REQUEST['submit']))
{
  $category_id=$_REQUEST['category_id'];
  $title=$_REQUEST['title'];
  $price=$_REQUEST['price'];
  $description=$_REQUEST['description'];
  $cover_img=$_FILES['cover_image']['name'];

  move_uploaded_file($_FILES['cover_image']['tmp_name'], '../images/'.$cover_img);

  mysqli_query($db,"INSERT INTO `my_products` (`category_id`,`title`,`description`,`price`,`image`,`status`) VALUES ('$category_id','$title','$description','$price','$cover_img','1')");

   $_SESSION['success_msg']="Product Added Successfully";
   header('location:products.php');
   exit;
}
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
  <h2>Add Product</h2>

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


  <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="#">

   <div class="form-group">
      <label class="control-label col-sm-2" for="email">Category:</label>
      <div class="col-sm-10">
        <select class="form-control" name="category_id">
          <option >Select Category</option>
          <?php  
            $getCat=mysqli_query($db,"SELECT * FROM `my_category`");
            while($rt=mysqli_fetch_assoc($getCat))
            {
              ?>
                 <option value="<?php echo $rt['id']?>"><?php echo $rt['title']?></option>
              <?php
            }
          ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Title:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" placeholder="Enter product title" name="title">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Price:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="price" placeholder="Enter price" name="price">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Description:</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="description"></textarea>
      </div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Cover Image:</label>
      <div class="col-sm-10">
        <input type="file" name="cover_image">
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" class="btn btn-success">Submit</button>
    <a href="login.php">Login</a>
      </div>
    </div>
  </form>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  
</body>
</html>
