<?php 
session_start();
$serverName="localhost";
$userName="root";
$dbPass="";
$dbName="mayd_classes";

$db=mysqli_connect($serverName,$userName,$dbPass,$dbName);

if(!$db)
{
	die("Connection Failed ".mysqli_connect_error());
}

?>