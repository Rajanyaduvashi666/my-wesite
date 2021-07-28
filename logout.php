<?php 
include('config.php');
$_SESSION['success_msg']="Logged Out Successfully";
session_destroy();
header('location:login.php');
?>