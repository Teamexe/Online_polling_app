<?php
include("connection.php");
?>
<html>
<head>
<?php
include("script.php");
?>
</head>
<body>
<div class='container-fluid'>
<?php
include("nav.php");
include("head.php");
echo"<br>
<div class='row'>
<div class='col-md-2'>
<div class='panel panel-primary min_h'>
<div class='panel-heading'><strong>Login and Sign up</strong></div>
	<div class='panel-body'><a href='Branch_signup.php' class='btn btn-default'><strong>Voters Signup</strong></a></div>
    <div class='panel-body'><a href='sign_up1.php' class='btn btn-default'><strong>Admin Signup</strong></a></div>
    <div class='panel-body'><a href='admin_login.php' class='btn btn-default'><strong>Admins Login</strong></a></div>
  </div>
</div>
<div class='col-md-9'>
<div class='panel panel-info min_h'>
<div class='panel-heading'><strong>Elections are open for</strong></div><br>
<div class=panel-body>";
	$result = mysqli_query($con,"SELECT Catname FROM catinfo");
	if($result)
	{
		 $Data= Array();
		 $k=mysqli_num_rows($result);
		 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
		{
				$Data[] =  $row['Catname'];  
		}
		for($i=0;$i<$k;$i++)
		{
				echo "<div class='col-md-2'><a href='votes1.php?act=1&name=$Data[$i]' class='btn btn-primary'>$Data[$i]</a></div>";
		}
	}
  echo"</div>";
  echo"<div class=panel-body>";
  $querry="SELECT Catname FROM tprinfo";
	$result2 = mysqli_query($con,$querry);
	if($result2)
	{
		 $Data2= Array();
		 $l=mysqli_num_rows($result2);
		 while ($row2= mysqli_fetch_array($result2, MYSQLI_ASSOC)) 
		{
				$Data2[] =  $row2['Catname'];  
		}
		for($i=0;$i<$l;$i++)
		{
				echo "<div class='col-md-2'><a href='votes2.php?act=1&name=$Data2[$i]' class='btn btn-primary'>$Data2[$i]</a></div>";
		}
	}
  echo"</div>";
  echo"</div>
</div>
</div>
<hr>";

include("footer.php");

echo "</div>";

?>

</div>
</body>
</html>