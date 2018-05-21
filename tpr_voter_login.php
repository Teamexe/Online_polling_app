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
"<div class=well well-sm><h3>Voter's Login</h3></div>";

$rollErr =  "";
$roll = "";
$rollErr1 =  0;
		
	if(isset($_POST['login']))
	{

	if (empty($_POST["roll"])) {
    $rollErr = "Roll no. is required";
	$rollErr1=1;
	} else {
    $roll = test_input($_POST["roll"]);
    }
	if( $rollErr1==1 )
		{
			echo"error";
		}
	else
	{
	
	$roll=$_POST['roll'];
	$count=0;
	$c1=$_REQUEST['name'];
	$rd="select * from $c1.tpr_voter_signup where candroll='$roll'";
	$res=mysqli_query($con,$rd);
	$count=mysqli_num_rows($res);
	$rd1="select * from $c1.tpr_cand_signup where candroll='$roll'";
	$res1=mysqli_query($con,$rd1);
	$count1=mysqli_num_rows($res1);
	if($count==1 || $count1==1)
	{
		$roll=$_POST['roll'];
		$_SESSION['voter']=$roll;
		$c1=$_REQUEST['name'];
		$c2=$_REQUEST['class'];
		$ss="select * from $c1.tpr_voter_login where candroll='$roll'";
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
			$t="create table $c1.vmale (id int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,mroll varchar(10))";
			$t1=mysqli_query($con,$t);
			$tt="create table $c1.vfemale (id int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,froll varchar(10))";
			$tt1=mysqli_query($con,$tt);
		header("Location: checktpr.php?act=5class=$c2&&name=$c1&&roll=$roll&&num=0&&clicked=0");}
	}
	else
	{
		?>
		<script type="text/javascript">
		alert("Roll no. is not registered");
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
<form method='post' onsubmit='return frm_check()' enctype='multipart/form-data' action='<?php $_SERVER['PHP_SELF']?>'>
 Enter Your Roll no. <input type='text' name='roll' value='<?php echo $roll;?>'>
  <span class='error'> <?php echo $rollErr;?></span>
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