<?php 
include('config.php');
if(isset($_SESSION['loggedinUserId']))
{
  header('location:dashboard.php');
}

if(isset($_REQUEST['login']))
{
	$email=$_REQUEST['email'];
	$password=$_REQUEST['pwd'];
  $remember_me=$_REQUEST['remember_me'];
	
	if((!empty($email)) && ($password!=""))
    {
	  $sql=mysqli_query($db,"SELECT * FROM `my_user` WHERE `email`='$email' and `password`='$password' and `status`='Active'");
	  $rowCount=mysqli_num_rows($sql);
	  if($rowCount!=0)
	  {
		  $row=mysqli_fetch_assoc($sql);
      $userId=$row['id'];
      if((isset($remember_me)) && ($remember_me==1))
      {
         setcookie('user_email',$email,time() + (86400 * 30));
         setcookie('user_password',$password,time() + (86400 * 30));
         setcookie('remember_me',1,time() + (86400 * 30));
      }
      else
      {
         setcookie('user_email','');
         setcookie('user_password',''); 
         setcookie('remember_me','');      
      }

      $_SESSION['loggedinUserId']=$userId;
		  $_SESSION['success_msg']="Welcome To Your Account";
		  header('location:dashboard.php');
		  exit;
	  }
	  else
	  {
		$_SESSION['error_msg']="Invalid Credentials";
		header('location:login.php');
		exit;
	  }
    }
	else
	{
		$_SESSION['error_msg']="Email and Password are required";
		header('location:login.php');
        exit;		
	}
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
  <h2>Login Now</h2>

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


  <form class="form-horizontal" method="POST" action="#">

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" value="<?php if(isset($_COOKIE['user_email'])) { echo $_COOKIE['user_email'];  } ?>" id="email" placeholder="Enter email" name="email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd"  value="<?php if(isset($_COOKIE['user_password'])) { echo $_COOKIE['user_password'];  } ?>"  placeholder="Enter password" name="pwd">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Remember Me:</label>
      <div class="col-sm-10">          
        <input type="checkbox" id="chk" value="1" placeholder="Enter password" name="remember_me" <?php if((isset($_COOKIE['remember_me'])) && ($_COOKIE['remember_me']==1)) { ?>  checked <?php } ?>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="login" class="btn btn-success">Submit</button>
		<a href="register.php">Register</a>
      </div>
    </div>
  </form>
</div>

</body>
</html>
