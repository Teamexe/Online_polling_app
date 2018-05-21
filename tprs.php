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
<div class=well well-sm><h2>configuration of Categories for Elections</h2></div>	
<div class=row><div class='col-md-1'></div>";
echo"<div class='col-md-11'>";?>
<?php

$catname = $rollf = $max_votes = $max_cand = $vmale = $vfemale = "";
$catnameErr = $rollfErr =  $maxErr = $maxcErr = $vmaleErr = $vfemaleErr = "";
$catnameErr1 =  $rollfErr1 = $maxErr1 = $maxcErr1 = $vmaleErr1 = $vfemaleErr1 = 0;
$len=0;

if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
  if (empty($_POST["catname"])) {
    $catnameErr = "Name is required";
	$catnameErr1=1;
  } else {
    $catname = test_input($_POST["catname"]);
  }
   if (empty($_POST["max_cand"])) {
    $maxcErr = "entry is required";
	$maxcErr1=1;
  } else {
    $max_cand= test_input($_POST["max_cand"]);
  }
   if (empty($_POST["vmale"])) {
    $vmaleErr = "entry is required";
	$vmaleErr1=1;
  } else {
    $vmale= test_input($_POST["vmale"]);
  }
   if (empty($_POST["vfemale"])) {
    $vfemaleErr = "entry is required";
	$vfemaleErr1=1;
  } else {
    $vfemale= test_input($_POST["vfemale"]);
  }
   if (empty($_POST["branch4"]) && ($_POST["year4"])) {
    $rollfErr = "Roll no. is required";
	$rollfErr1=1;
  }
	else
	{
			$branch_rec=$_POST["branch4"];
		$year_rec=$_POST["year4"];
		echo "<br>";
		$sec_key=0;
		$pri_key=0;
		if($branch_rec=="CSE")
		{
			$sec_key=5;
		}
		if($branch_rec=="Civil")
			$sec_key=1;
		if($branch_rec=="Electrical")
			$sec_key=2;
		if($branch_rec=="Mechanical")
			$sec_key=3;
		if($branch_rec=="ECE")
			$sec_key=4;
		if($branch_rec=="Chemical")
			$sec_key=7;
		if($branch_rec=="Material Science")
			$sec_key=8;
		if($year_rec=="1st")
			$pri_key=17;
		if($year_rec=="2nd")
			$pri_key=16;
		if($year_rec=="3rd")
			$pri_key=15;
		if($year_rec=="4th")
			$pri_key=14;
		$orig_key = $pri_key * 10 + $sec_key;
		echo "<br>";
		if($branch_rec=="CSE Dual")
		{
			if($year_rec=="1st")
				$orig_key="17MI5";
			if($year_rec=="2nd")
				$orig_key="16MI5";
			if($year_rec=="3rd")
				$orig_key="15MI5";
			if($year_rec=="4th")
				$orig_key="14MI5";
			if($year_rec=="5th")
				$orig_key="13MI5";
		}
		if($branch_rec=="ECE Dual")
		{
			if($year_rec=="1st")
				$orig_key="17MI4";
			if($year_rec=="2nd")
				$orig_key="16MI4";
			if($year_rec=="3rd")
				$orig_key="15MI4";
			if($year_rec=="4th")
				$orig_key="14MI4";
			if($year_rec=="5th")
				$orig_key="13MI4";
		}
		if($branch_rec=="Architecture")
		{
			if($year_rec=="1st")
				$orig_key="176";
			if($year_rec=="2nd")
				$orig_key="166";
			if($year_rec=="3rd")
				$orig_key="156";
			if($year_rec=="4th")
				$orig_key="146";
			if($year_rec=="5th")
				$orig_key="136";
		}
		//echo $orig_key;
	}    
		
	if (empty($_POST["max_votes"]))
	{
    $maxErr = "Enter no. of voters";
	$maxErr1=1;
    }
	else
	{
		$max_votes=$_POST["max_votes"];
	}	
	
		if($catnameErr1==1 || $rollfErr1==1 || $maxErr1==1 || $maxcErr1==1 || $vmaleErr1==1 || $vfemaleErr1==1)
		{
			echo"";
		}
	else
	{
		$naam1=$_POST["catname"];
		$anuk=$orig_key;
		$no_votes=$_POST["max_votes"];
		$no_cand=$_POST["max_cand"];
		$vmale=$_POST["vmale"];
		$vfemale=$_POST["vfemale"];
		$sql="INSERT INTO tprinfo(Catname,Rollf,Max_votes,Max_cand,v4male,v4female) VALUES('$naam1','$anuk','$no_votes','$no_cand','$vmale','$vfemale')";
	$quesy=mysqli_query($con,$sql);
	if($quesy)
	{
				echo "<p style='visibility:hidden'>saved</p>";?>
				<script language='javascript' type='text/javascript'> location.href='addel.php' </script><?php
				
				$sql1="create database $naam1";
	$query1=mysqli_query($con,$sql1);
	if($query1)
	{   
		mysqli_connect($server,$userid,$password,$naam);
		mysqli_select_db($con,$naam);
		$conn="create table $naam1.tpr_cand_signup (id int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,candname varchar(20),candroll varchar(10) NOT NULL,candmob varchar(10) NOT NULL,Gender varchar(2),candvote int(4) NOT NULL,UNIQUE (candroll,candmob))" ;
		$conn1="create table $naam1.tpr_voter_signup (id int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,candname varchar(20),candroll varchar(10)NOT NULL,candmob varchar(10) NOT NULL,Gender varchar(2),UNIQUE (candroll,candmob))" ;
		$conn2="create table $naam1.tpr_voter_login (id int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,candname varchar(20),candroll varchar(10)NOT NULL,candmob varchar(10) NOT NULL,UNIQUE (candroll,candmob))" ;
		if(mysqli_query($con,$conn) && mysqli_query($con,$conn1) && mysqli_query($con,$conn2))
		{
			echo"created";
		}
		else
		{
			echo "error";
		}
	}
	else
	{
		echo "<div class=row><div class='col-md-1'></div>
			<div class='col-md-11'>error<br/>$sql</div></div>";
			die(mysqli_error($con));
	}
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

  <form method='post' enctype='multipart/form-data' action=<?php $_SERVER['PHP_SELF']?>>
		<b>Category-Name</b><?php echo "<br>"?><input type="text" size="46px" id="catname" name="catname" placeholder="use '_' instead of space" value="<?php echo $catname;?>">
  <span class="error"> <?php echo $catnameErr;?></span><br><br>
  <b>Max no. of votes</b><?php echo "<br>"?><input type="text" id="max_votes" size="46px" name="max_votes" placeholder="Enter max no. of voters" value="<?php echo $max_votes?>">
  <span class="error"> <?php echo $maxErr;?></span><br><br>
  <b>Max no. of candidates:</b><?php echo "<br>"?><input type="text" size="46px" id="max_cand" name="max_cand" placeholder="Enter max no. of candidates" value="<?php echo $max_cand?>">
  <span class="error"><?php echo $maxcErr;?></span>
  <br><br>
  <b>Max no. of votes for male candidates:</b><?php echo "<br>"?><input type="text" size="46px" id="vmale" name="vmale" placeholder="Enter max no. of votes for male candidates" value="<?php echo $vmale?>">
  <span class="error"> <?php echo $vmaleErr;?></span>
  <br><br>
  <b>Max no. of votes for female candidates:</b><?php echo "<br>"?><input type="text" size="46px" id="vfemale" name="vfemale" placeholder="Enter max no. of votes for female candidates" value="<?php echo $vfemale?>">
  <span class="error"> <?php echo $vfemaleErr;?></span>
  <br><br>
  <b>Select Branch & Year</b>
 <select name="branch4">
 <option name="archi4">Architecture</option>
  <option name="chemical4">Chemical</option>
  <option name="civil4">Civil</option>
  <option name="cse4">CSE</option>
  <option name="csedual">CSE Dual</option>
  <option name="ece4">ECE</option>
  <option name="ecedual">ECE Dual</option>
  <option name="electrical4">Electrical</option>
  <option name="material4">Material Science</option>
  <option name="mechanical4">Mechanical</option>
</select>
Year:
 <select name="year4">
  <option name="ist4">1st</option>
  <option name="second4">2nd</option>
  <option name="third4">3rd</option>
  <option name="fourth4">4th</option>
  <option name="fifth4">5th</option>
  </select>
  <span class="error"> <?php echo $rollfErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
   </form>
<?php
echo"</div>
</div>
</div>
</div>
</div>
<hr>";
include("footer.php");

echo "</div>";

?>

</div>
</body>
</html>