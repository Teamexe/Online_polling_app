<?php
include("connection.php");
?>
<html>
<head>
<?php
include("script.php");
?>
 <style>
.error {color: #FF0000;}
</style>
</head>
<body>
<div class='container-fluid'>
<?php
include("nav.php");
include("head.php");
echo"<br>
<div class='row'>
<div class='col-md-12'>
<div class='panel panel-primary min_h'>";
echo 
"<div class=well well-sm><h3>Admin's Login</h3></div>";

$userErr = $passErr =  "";
$user = $pass = "";
$userErr1 = $passErr1 =  0;
		
	if(isset($_POST['login']))
	{

	if (empty($_POST["user"])) {
    $userErr = "Username is required";
	$userErr1=1;
	} else {
    $user = test_input($_POST["user"]);
    }
	
	if (empty($_POST["pass"])) {
    $passErr = "Password is required";
	$passErr1 =1;
	}
	
	if( $userErr1==1 || $passErr1==1 )
		{
			echo"";
		}
	else
	{
	
	$user=$_POST['user'];
	$passwd=$_POST['pass'];
	
	$count=0;
	$rd="select * from admin_signup where usern='$user' AND pwd='$passwd'";
	$res=mysqli_query($con,$rd);
	$count=mysqli_num_rows($res);
	if($count==1)
	{
		$_SESSION['user']=$username;
		?>
		<script language='javascript' type='text/javascript'> location.href='addel.php' </script>;
		<?php
	}
	else
	{
		?>
		<script type="text/javascript">
		alert("Enter valid enteries");
		</script>
		<?php
	}
	}
	}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}	
?>
<div class=row><div class='col-md-1'></div>
<div class='col-md-11'>
<form method='post' onsubmit='return frm_check()' action='admin_login.php' enctype='multipart/form-data'>
 <strong>Username</strong><?php echo "<br>"?><input type='text' size="40px" name='user' placeholder="Enter Your Name" value='<?php echo $user;?>'>
  <span class='error'> <?php echo $userErr;?></span>
  <br><br>
  <strong>Password</strong><?php echo "<br>"?><input type='password' size="40px" name='pass' placeholder="Enter Your Password" value='<?php echo $pass;?>'>
  <span class='error'> <?php echo $passErr;?></span>
  <br><br>
  <input type='submit' name='login' value='Login'>   
</form>
</div>
<?php

echo"</div>
</div>
<hr>";

include("footer.php");

echo "</div>";

?>

</div>
</body>
</html>
