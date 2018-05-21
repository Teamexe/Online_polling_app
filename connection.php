<?php
ob_start();
$server="localhost";
$userid="USERNAME";
$password="PASSWORD";
$database='voting_project';
$con=mysqli_connect($server,$userid,$password,$database);
if($con)
{
	
	$mydb=mysqli_select_db($con,$database);
	
	if($mydb)
	{
	//echo "server & database connected";
	}
	else{
			die("connection error: ".mysqli_connect_error());
	header("Location:error.php?err_no=2");
		//echo "database connection error";
	}
}
else
{
	header("Location:error.php?err_no=1");
	//echo "server connection error";
}
?>
