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
$nameErr = $rollErr = $mobErr =  $gender = "";
$names = $roll = $mob = $genderErr = "";
$nameErr1 = $rollErr1 = $mobErr1 = $candErr1 = $genderErr1 =  0;
$len=0;
if (isset($_POST['submit'])) {
	$c1=$_REQUEST['name'];
	$can="select * from $c1.tpr_cand_signup";
	$qq=mysqli_query($con,$can);
	$num=mysqli_num_rows($qq);
	$f="select Max_cand from tprinfo where Catname='$c1'";
	$f1=mysqli_query($con,$f);
	$f2=mysqli_fetch_row($f1);
	if($num>$f2)
	{
		$candErr1=1;
		?>
				<script type="text/javascript">
				alert("Maximum candidates already registered, more than 8 can't register contact admin");
				</script>
				<?php
	}
	
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
	$c1=$_REQUEST['name'];
			$count=0;
			$rd="select * from $c1.tpr_cand_signup where candroll='$roll'";
			$res=mysqli_query($con,$rd);
			$count=mysqli_num_rows($res);
			if($count==1)
			{
				?>
				<script type="text/javascript">
				alert("Roll no. already registered");
				</script>
				<?php
			}			
			
			$len=strlen($roll);
			//echo $len;
			$c1=$_REQUEST['name'];
			$qs="select rollf from tprinfo where catname='$c1'";
			$quer=mysqli_query($con,$qs);
			$row=mysqli_fetch_row($quer);
			$rollen=strlen($row[0]);
			$rolln=(string)$row[0];
			//echo "$rollen";
			for($i=0;$i<$rollen;$i++)
			{
				if($roll[$i]!=$rolln[$i])
				{
					$rollErr="Enter a valid format no.";
					$rollErr1=1;
				}
			}
		}
		
		 if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
	$genderErr1=1;
  } else {
    $gender = test_input($_POST["gender"]);
  }
 
	if (empty($_POST["mob"])) {
    $mobErr = "Mobile no. is required";
	$mobErr1=1;
  } else  {
    $mobs = test_input($_POST["mob"]);
	if (!preg_match("/^[6-9][0-9]{9}$/",$mobs)) {
      $mobErr = "Invalid mobile format"; 
	  $mobErr1=1;
    }
	else{
		$c1=$_REQUEST['name'];
				$count=0;
			$rd="select * from $c1.tpr_cand_signup where candmob='$mobs'";
			$res=mysqli_query($con,$rd);
			$count=mysqli_num_rows($res);
			if($count==1)
			{
				?>
				<script type="text/javascript">
				alert("Phone no. already entered");
				</script>
				<?php
			}
	}
  }
	
	if($nameErr1==1 || $rollErr1==1 || $mobErr1==1 || $candErr1==1 || $genderErr1==1)
		{
			echo " ";
		}
	else
	{
			$naam1=$_POST["names"];
			$anuk=$roll;
			$c1=$_REQUEST['name'];
			$mobi=$mob;
			$aw="insert into $c1.tpr_cand_signup (candname,candroll,candmob,Gender) values('$naam1','$anuk','$mobs','$gender')";
			
			$query=mysqli_query($con,$aw);
			if($query)
			{
						echo "<p style='visibility:hidden'>saved</p>";?>
						<script language='javascript' type='text/javascript'>location.href='homepage.php'</script>
						<?php 				
				}
				else
				{
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
		  Name: <input type="text" name="names" value="<?php echo $names;?>">
  <span class="error"> <?php echo $nameErr;?></span>
  <br><br>
  Roll no.: <input type="text" name="roll" value="<?php echo $roll;?>">
  <span class="error"> <?php echo $rollErr;?></span>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="F">Female
  <input type="radio" name="gender" value="M">Male
  <span class="error"><?php echo $genderErr;?></span><br><br>
  Mob no.: <input type="tel" name="mob" value="<?php echo $mob;?>">
  <span class="error"> <?php echo $mobErr;?></span>
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