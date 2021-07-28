<?php 
include('config.php');
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
  <h2>Register Now</h2>

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


  <form class="form-horizontal" method="POST" action="register.php">

  	<div class="form-group">
      <label class="control-label col-sm-2" for="email">Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Contact:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="contact" placeholder="Enter contact" name="mobile">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="register_now" class="btn btn-success">Submit</button>
		<a href="login.php">Login</a>
      </div>
    </div>
  </form>
</div>

</body>
</html>
