<?php
include("connection.php");
?>
<html>
<head>
<?php
include("nav.php");
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
echo 
"<div class=well well-sm><h3>Voter's Login</h3></div>";

$rollErr = $passErr = "";
$roll = $pass = "";
$rollErr1 =  $passErr1 = 0;
		
	if(isset($_POST['login']))
	{

	if (empty($_POST["roll"])) {
    $rollErr = "Roll no. is required";
	$rollErr1=1;
	} else {
		$roll = test_input($_POST["roll"]);
		$count=0;
		$cat=$_REQUEST['name'];
		$dd=mysqli_query($con,"select rollf from catinfo where Catname='$cat'");
		$row=mysqli_fetch_row($dd);
		$len=strlen($row[0]);
		$rolln=(string)$row[0];
		for($i=0;$i<$len;$i++)
		{
			if($roll[$i]!=$rolln[$i])
			{
				$rollErr="Enter a valid format roll no.";
				$rollErr1=1;
			}
		}
		
    }
	if (empty($_POST["pass"])) {
    $passErr = "Password is required";
	$passErr1 =1;
    } else {
    $pass = test_input($_POST["pass"]);
    }
	if( $rollErr1==1 || $passErr1==1 )
		{
			echo"";
		}
	else
	{
	
	$roll=$_POST['roll'];
	$pwd=$_POST['pass'];
	$count=0;
	$c1=$_REQUEST['name'];
	$rd="select * from voters_signup where vroll='$roll'&&pwd='$pwd'";
	$res=mysqli_query($con,$rd);
	$count=mysqli_num_rows($res);
	if($count==1)
	{
		$roll=$_POST['roll'];
		$_SESSION['voter']=$roll;
		$c1=$_REQUEST['name'];
		$c2=$_REQUEST['class'];
		$ss="select * from $c1.voter_login where candroll='$roll'";
		$ss1=mysqli_query($con,$ss);
		$ll=mysqli_num_rows($ss1);
		if($ll==1)
		{
			?><script type="text/javascript">
				alert("This Roll no. has already casted his vote");
				</script>
			<script language='javascript' type='text/javascript'>location.href='homepage.php'</script>
			<?php 
		}
		else{
			$dd1=mysqli_query($con,$dd);
		header("Location: voter_login2.php?act=5&&class=$c2&&name=$c1&&Zroll=$roll");}
	}
	else
	{
		?>
		<script type="text/javascript">
		alert("either Roll no. is not registered or Password is wrong... to register go to voters signup in homepage");
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
<form method='post' onsubmit='return frm_check()' enctype='multipart/form-data' action=<?php $_SERVER['PHP_SELF']?>>
  <strong>Roll No.</strong><?php echo "<br>"?> <input type='text' size="40px" name='roll' placeholder="Enter Your Roll No." value='<?php echo $roll;?>'>
  <span class='error'> <?php echo $rollErr;?></span>
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