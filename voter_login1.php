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
include("head.php");
echo"<br>
<div class='row'>
<div class='col-md-12'>
<div class='panel panel-primary min_h'>";
$otpErr = "";
$otp = "";
$otpErr1 =  0;
$len=0;
if (isset($_POST['submit']))
{
	if (empty($_POST["otp"])) {
    $otpErr = "Name is required";
	$otpErr1=1;
  } else {
  $otp = test_input($_POST["otp"]);}
  if($otpErr1==1)
		{
			echo"Error in formats";
		}
}
echo 
"<div class=well well-sm><h3>Admin's Login</h3></div>";?>
<div class=row><div class='col-md-1'></div>
<div class='col-md-11'>
<form method='post' onsubmit='return frm_check()' enctype='multipart/form-data' action=<?php $_SERVER['PHP_SELF']?>>
<br><b>Enter your OTP</b>
 <input type="text" name="otp" value="<?php echo $otp;?>"><br>
  <span class='error'> <?php echo $otpErr;?></span>
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