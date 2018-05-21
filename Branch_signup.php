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

$rollf ="";
$rollfErr = "";
$rollfErr1 = 0;
$len=0;

if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
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
		}  	
		if($rollfErr1==1)
		{
			echo"Error in formats";
		}
		else
		{
			$anuk=$orig_key;
			header("Location: Voters_signup.php?rollf=$anuk");
		}
}
  
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
  <form method='post' enctype='multipart/form-data' action='<?php $_SERVER['PHP_SELF']?>'>
  <b>Valid Roll no. format: </b>
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
  <input type="submit" name="submit" value="next">  
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
