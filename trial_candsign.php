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
$nameErr = $rollErr = $passErr =  "";
$names = $roll = $pass = "";
$nameErr1 = $rollErr1 = $passErr1 =  0;
$len=0;
if (isset($_POST['submit'])) {
  if (empty($_POST["names"])) {
    $nameErr = "Name is required";
	$nameErr1=1;
  } else {
    $name = test_input($_POST["names"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$names)) {
      $nameErr = "Only letters and white space allowed"; 
	  $nameErr1=1;
    }
  }
  if (empty($_POST["roll"])) {
    $rollErr = "Roll no. is required";
	$rollErr1=1;
  } else  {
    $roll = test_input($_POST["roll"]);
  }
 
	
	if($nameErr1==1 || $rollErr1==1 )
		{
			$cname=$_REQUEST['name'];
			echo"Error in formats";
		}
	else
	{
			$naam1=$_POST["names"];
			$anuk=$roll;
			$c1=$_REQUEST['name'];
			$aw="insert into $c1.cand_signup (candname,candroll) values('$naam1','$anuk')";
			
			$query=mysqli_query($con,$aw);
	if($query)
	{
				echo "<p style='visibility:hidden'>saved</p>";?>
				<script language='javascript' type='text/javascript'> location.href='homepage.php'</script>
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
		  Name: <input type="text" name="names" value="<?php echo $names;?>">
  <span class="error"> <?php echo $nameErr;?></span>
  <br><br>
  Roll no.: <input type="text" name="roll" value="<?php echo $roll;?>">
  <span class="error"> <?php echo $rollErr;?></span>
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