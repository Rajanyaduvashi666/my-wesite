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
<?php  
$getPro=mysqli_query($db,"SELECT * FROM `my_products` WHERE status='1'");
while($row=mysqli_fetch_assoc($getPro))
{
?>
 <div class="card" style="width:30%;float:left;border:1px solid #ddd">
  <img class="card-img-top" src="../images/<?php echo $row['image']; ?>" style="width:100%"alt="Card image">
  <div class="card-body">
    <h4 class="card-title"><?php echo $row['title']; ?></h4>
    <p class="card-text"><?php echo $row['description']; ?></p>
    <a href="#" class="btn btn-primary">Rs. <?php echo $row['price']; ?></a>
  </div>
</div>

<?php
}
?>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>
