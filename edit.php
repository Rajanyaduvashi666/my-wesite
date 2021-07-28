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

if(isset($_REQUEST['register_now']))
{
  $name=$_REQUEST['name'];
  $email=$_REQUEST['email'];
  $contact=$_REQUEST['mobile'];

  if((!empty($name)) && (!empty($email)) && (!empty($contact)))
  {
    $len=strlen($contact);
    if((!filter_var($contact,FILTER_SANITIZE_NUMBER_INT)) && (($len<10) || ($len>11)))
    {
      $_SESSION['error_msg']="Invalid Contact Number";
      header('location:edit.php');
      exit;
    }
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
      $_SESSION['error_msg']="Invalid Email";
      header('location:edit.php');
      exit;
    }
    else
    {
      $id=$_SESSION['loggedinUserId'];

      $getData=mysqli_query($db,"SELECT * FROM `my_user` WHERE `email`='$email' and `id`!='$id'");
      $rowCount=mysqli_num_rows($getData);

      if($rowCount>0)
      {
        $_SESSION['error_msg']="Email already registered";
        header('location:edit.php');
      }
      else
      {
         mysqli_query($db,"UPDATE `my_user` SET `name`='$name' , `email`='$email' ,`contact`='$contact' WHERE `id`='$id'");

        $image=$_FILES['profile_pic']['name'];

        if(!empty($image))
        {
          //***** IMage Renaming ****//
            $exImg=explode('.',$image);
            $ext=end($exImg);
            $imgName=time();
            $newImg=$imgName.'.'.$ext;
          //***** IMage Renaming ends ****//

          $sqlOld=mysqli_query($db,"SELECT * FROM `my_user` WHERE `id`='$id'");
          $oldRw=mysqli_fetch_assoc($sqlOld);
          $oldImage=$oldRw['image'];

          $tmpImage=$_FILES['profile_pic']['tmp_name'];
          $destination="images/".$newImg;
          move_uploaded_file($tmpImage, $destination);
          mysqli_query($db,"UPDATE `my_user` SET `image`='$newImg'  WHERE `id`='$id'");

          if(!empty($oldImage))
          {
            unlink('images/'.$oldImage);
          }
        }


        $_SESSION['success_msg']="Details updated successfully";
        header('location:dashboard.php');
      }
      exit;
    }

  }
  else
  {
      $_SESSION['error_msg']="All fields are required";
      header('location:edit.php');
      exit;
  }
}

$id=$_SESSION['loggedinUserId'];
$sql=mysqli_query($db,"SELECT * FROM `my_user` WHERE `id`='$id'");
$rt=mysqli_fetch_assoc($sql);

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
  <h2>Edit Now</h2>

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
      <label class="control-label col-sm-2" for="email">Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" value="<?php echo $rt['name']; ?>" placeholder="Enter name" name="name">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Contact:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="contact" value="<?php echo $rt['contact']; ?>"  placeholder="Enter contact" name="mobile">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" value="<?php echo $rt['email']; ?>"  placeholder="Enter email" name="email">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-2" for="email">Profile:</label>
      <div class="col-sm-10">
        <input type="file" name="profile_pic">
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="register_now" class="btn btn-success">Submit</button>
    <a href="dashboard.php">Dashboard</a>
      </div>
    </div>
  </form>
</div>

</body>
</html>
