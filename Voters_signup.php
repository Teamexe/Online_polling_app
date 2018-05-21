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
<div class='panel panel-primary min_h'>
<div class=well well-sm><h3>Sign Up Form for Candidate</h3></div>
		<div class=row><div class='col-md-1'></div>";
// define variables and set to empty values
$nameErr = $rollErr = $mobErr = $passErr = "";
$names = $roll = $mob = $pass = "";
$nameErr1 = $rollErr1 = $mobErr1 = $candErr1 = $passErr1 = 0;
$len=0;
if (isset($_POST['submit'])) {
	
  if (empty($_POST["names"])) {
    $nameErr = "Name is required";
	$nameErr1=1;
  } else {
    $name = test_input($_POST["names"]);
    if (!preg_match("/^[A-Za-z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
	  $nameErr1=1;
    }
  }
  if (empty($_POST["roll"])) {
    $rollErr = "Roll no. is required";
	$rollErr1=1;
  } else  {
    $roll = test_input($_POST["roll"]);
			$count=0;
			$rd="select * from voters_signup where vroll='$roll'";
			$res=mysqli_query($con,$rd);
			$count=mysqli_num_rows($res);
			if(strlen($roll)>5)
			{
				if($roll[2]=='M' || $roll[2]=='m')
				{
					if((int)$roll[5]>6 ||((int)$roll[5]==6 && $roll[6]!='0'))
					{
						$rollErr="Roll no. does not exist.";
						$rollErr1=1;
					}
				}
			}
			if($roll[2]!='m' && $roll[2]!='M')
			{
				if(strlen($roll)>5 ||((int)$roll[3]==9 && (int)$roll[4]>4))
				{
					$rollErr="Roll no. does not exist.";
					$rollErr1=1;
				}
			}
			if($count==1)
			{
				?>
				<script type="text/javascript">
				alert("Roll no. already registered");
				</script>
				<?php
			}			
			
			$len=strlen($roll);
			$c1=$_REQUEST['rollf'];
			$rollen=strlen($c1);
			for($i=0;$i<$rollen;$i++)
			{
				if($roll[$i]!=$c1[$i])
				{
					$rollErr="Enter a valid format no.";
					$rollErr1=1;
				}
			}
  }	
	if (empty($_POST["pass"])) {
    $passErr = "Password is required";
	$passErr1 =1;
    } else {
    $pass = test_input($_POST["pass"]);
	$len=strlen($pass);
	if($len<6)
	{
		$passErr="Password should have atleast 6 characters";
		$passErr1=1;
	}
    }
	
	if($nameErr1==1 || $rollErr1==1 || $candErr1==1 || $passErr1==1)
		{
			echo "";
		}
	else
	{
			$naam1=$_POST["names"];
			$anuk=$roll;
			$user=$_POST['user'];
			$passwd=$_POST['pass'];
			$aw="insert into voters_signup (vname,vroll,pwd) values('$naam1','$anuk','$passwd')";
			
			$query=mysqli_query($con,$aw);
			if($query)
			{
						echo "<p style='visibility:hidden'>saved</p>";?>
						<script language='javascript' type='text/javascript'>location.href='homepage.php'</script>
						<?php 
				}
				else{
					die(mysqli_error($con));
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
		
<div class='col-md-11'>
<form method='post' onsubmit='return frm_check()' enctype='multipart/form-data' action="<?php $_SERVER['PHP_SELF']?>">
		  <strong>Name</strong> <?php echo "<br>"?><input type="text" size="40px" name="names" placeholder="Enter Your Name" value="<?php echo $names;?>">
  <span class="error"> <?php echo $nameErr;?></span>
  <br><br>
  <strong>Roll No.</strong> <?php echo "<br>"?><input type="text" size="40px" name="roll" placeholder="Enter Your Roll No." value="<?php echo $roll;?>">
  <span class="error"> <?php echo $rollErr;?></span>
  <br><br>
  <strong>Password</strong> <?php echo "<br>"?><input type="password" size="40px" name="pass" placeholder="Enter Your Password" value="<?php echo $pass;?>">
  <span class="error"> <?php echo $passErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">
</form>
</div>
</div>
</div>
</div>
</div>
<hr>
<?php
include("footer.php");

echo "</div>";

?>

</div>
</body>
</html>