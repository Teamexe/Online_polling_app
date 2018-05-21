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
<div class=well well-sm><h2>Result of the election conducted</h2></div>	
<div class=row><div class='col-md-1'></div><div class='col-md-11'>";
$c1=$_REQUEST['name'];
$sq="select * from $c1.cand_signup";
$result = mysqli_query($con,$sq);
	if($result)
	{
		 $Data= Array();
		 $Data1= Array();
		 $k=mysqli_num_rows($result);
		 while ($rop = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
		{
				$Data[] =  $rop['candname'];
				$Data1[] =  $rop['candvote'];
		}
		echo "<div class='row'>
				<div class='col-md-3'><h4><b>No. of votes of candidate</b></h4></div>				
				<div class='col-md-3'><h4><b>Name of candidate</b></h4></div></div>";
		for($i=0;$i<$k;$i++)
		{
				echo "<div class='row'>
				<div class='col-md-3'>$Data1[$i]</div>				
				<div class='col-md-3'>$Data[$i]</div>";
				$kkk=$Data[$i];
				$kk=$Data1[$i];
				echo"</div>";
		}
	}
echo "</div></div><br>
</div>
</div>
</div>
<hr>";
include("footer.php");

echo "</div>";

?>

</div>
<script>
</body>
</html>