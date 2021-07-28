<?php 
include('config.php');
if(!isset($_SESSION['loggedinUserId']))
{
  $_SESSION['error_msg']="Please login first";
  header('location:login.php');
}

if(isset($_SESSION['success_msg']))
{
  echo $_SESSION['success_msg'];
}

$id=$_SESSION['loggedinUserId'];
$sql=mysqli_query($db,"SELECT * FROM `my_user` WHERE `id`='$id'");
$rt=mysqli_fetch_assoc($sql);
$rid=$rt['id'];
$image=$rt['image'];
?>
<?php 
if(!empty($image))
{
  ?>
    <p><img src="images/<?php echo $image; ?>"style="width:100px"></p>
  <?php
}
?>
<p><b>Name : </b> <?php echo $rt['name']; ?></p>
<p><b>Email : </b> <?php echo $rt['email']; ?></p>
<p><b>Contact : </b> <?php echo $rt['contact']; ?></p>
<a href="edit.php">Edit</a> | 
<a href="logout.php">Logout</a>