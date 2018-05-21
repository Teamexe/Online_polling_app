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
$nameErr = $phoneErr = $rollErr = $passErr =  "";
$name = $phone  = $roll = $pass = "";
$nameErr1 = $phoneErr1 = $rollErr1 = $passErr1 =  0;
$len=0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
	$nameErr1=1;
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
	  $nameErr1=1;
    }
  }
  if (empty($_POST["roll"])) {
    $rollErr = "Roll no. is required";
	$rollErr1=1;
  } 
  else {
    $roll = test_input($_POST["roll"]);
	$cname=$_REQUEST['name'];
	$count=0;
	$rd="select * from $cname.cand_signup where candroll=$roll";
	$res=mysqli_query($con,$rd);
	$count=mysqli_num_rows($res);
	if($count==1)
	{
		$rollErr="invalid roll no.";
			$rollErr1=1;		
		?>
		<script type="text/javascript">
		alert("this roll no. already registered");
		</script>
		<?php
	}
	$roll1=(string)$roll;
	$cname1=$_REQUEST['name'];
	$cname="$cname";
	$mks1="select rollf from voting_project.catinfo where Catname='$cname'";
	$mks2=mysqli_query($con,$mks1);
	$mks="$mks2";
	$k=strlen($mks);
	$kk=strlen($roll1);
	echo "$k";
	echo "$kk";
	for($i=0;$i<$k;$i++)
	{
		if($mks2[$i]!=$roll1[$i])
		{
			$rollErr="invalid roll no. present";
			$rollErr1=1;
			break;
		}
	}
   
  }
  
  if (empty($_POST["phone"])) {
    $phoneErr = "Phone no. is required";
	$phoneErr1=1;
	} else {
    $phone = test_input($_POST["phone"]);
	if(!preg_match('/^([+][9][1]|[9][1]|[0]){0,1}([7-9]{1})([0-9]{9})$/', $phone))
    {
	  $phoneErr = "Phone no. is invalid";
      $phoneErr1=1;
    }
    }
	
		if($nameErr1==1 || $rollErr1==1 || $phoneErr1==1 )
		{
			$cname=$_REQUEST['name'];
			echo"Error in formats";
		}
		else
		{
			$naam1=$_POST["name"];
			$anuk=$roll;
			$phone1=$_POST["phone"];
			$cname=$_REQUEST['name'];
			$aw="insert into $cname.cand_signup (candname,candroll,candmob) values('$naam1','$anuk','$phone1')";
			
			$aww=mysqli_query($con,$aw);
	if($aww)
	{
				$cname=$_REQUEST['name'];
				echo "<p style='visibility:hidden'>saved</p>";?>
				<script language='javascript' type='text/javascript'> location.href='homepage.php' </script><?php
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
		  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error"> <?php echo $nameErr;?></span>
  <br><br>
  Roll no.: <input type="text" name="roll" value="<?php echo $roll;?>">
  <span class="error"> <?php echo $rollErr;?></span>
  <br><br>
 Phone no.<input type="text" name="phone" value="<?php echo $phone;?>">
  <span class="error"> <?php echo $phoneErr;?></span>
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