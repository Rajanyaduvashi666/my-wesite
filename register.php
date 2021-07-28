<?php 
include('config.php');

if(isset($_REQUEST['register_now']))
{
  $name=$_REQUEST['name'];
  $email=$_REQUEST['email'];
  $contact=$_REQUEST['mobile'];
  $password=$_REQUEST['pwd'];

  $date=date('Y-m-d H:i:s');

  if((!empty($name)) && (!empty($email)) && (!empty($contact)) && ($password!=""))
  {
	  $len=strlen($contact);
	  if((!filter_var($contact,FILTER_SANITIZE_NUMBER_INT)) && (($len<10) || ($len>11)))
	  {
		$_SESSION['error_msg']="Invalid Contact Number";
  	    header('location:index.php');
	  }
	  else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
	  {
		$_SESSION['error_msg']="Invalid Email";
  	    header('location:index.php');
	  }
  	  else
	  {
		  $getData=mysqli_query($db,"SELECT * FROM `my_user` WHERE `email`='$email'");
		  $rowCount=mysqli_num_rows($getData);

		  if($rowCount>0)
		  {
			  $_SESSION['error_msg']="Email id already registered";
		  }
		  else
		  {
			$newName=filter_var($name,FILTER_SANITIZE_STRING);
			$sql="INSERT INTO `my_user` (`name`,`email`,`contact`,`password`,`date`) VALUES ('$name','$email','$contact','$password','$date')";
			mysqli_query($db,$sql);
			$_SESSION['success_msg']="User registered successfully";
		  }
		  header('location:index.php');
	  }
  }
  else
  {
  	  $_SESSION['error_msg']="All fields are required";
  	  header('location:index.php');
  }
}
else
{
  $_SESSION['error_msg']="Please click on the submit button";
  header('location:index.php');
}

?>