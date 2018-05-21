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
<div class=row><div class='col-md-1'></div><div class='col-md-11'>";
	echo"<div class='col-md-3'>";
	if(isset($_REQUEST['act']))
	{
		$cname=$_REQUEST['name'];
		$roll=$_REQUEST['roll'];
	$result = mysqli_query($con,"Select candname,id from $cname.cand_signup");

if($result)
	{
		 $Data= Array();
		 $k=mysqli_num_rows($result);
		 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
		{
				$Data[] =  $row['candname'];	
				$Data1[] =  $row['id'];
		}
		for($i=0;$i<$k;$i++)
		{
				echo "<div class='row'>			
				<div class='col-md-3'>$Data[$i]</div>";
				$nk=$Data[$i];
				$mk=$Data1[$i];
				echo"<div class='col-md-2'><a  class='btn btn-success' href='voter_login2.php?acts=1&&num=$mk&&ans=$cname&&roll=$roll' name='vote'>Vote</a>
				</div></div><br>";
		}
	}
	}
	if(isset($_REQUEST['acts']) && $num_rows==0)
				{
					$acto=$_REQUEST['acts'];
					$ik=$_REQUEST['num'];
					$am=$_REQUEST['ans'];
					$Roll=$_REQUEST['roll'];
					$dd="insert into $am.voter_login (candroll) value ('$Roll')";
					$aff=mysqli_query($con,$dd);
					$sql="select candvote from $am.cand_signup where id=$ik";
					$query=mysqli_query($con,$sql);
					$data=mysqli_fetch_row($query);
					$data1=$data[0]+1;
					$sql="update $am.cand_signup set candvote='$data1' where id=$ik";
					$aquery=mysqli_query($con,$sql);
					if($query && $aquery)
					{
					  	?><script type='text/javascript'> 
					    alert("Your vote casted successfully press ok"); 
						</script>
						<script language='javascript' type='text/javascript'> location.href='homepage.php' </script>
						<?php
					}
					else
					{
						echo "error<br/>$sql";
						die(mysqli_error($con));
					}
				}
echo"</div></div><br><br><div class='row'><div class='col-md-2'></div><div class='col-md-7'><a href='logout.php' class='btn btn-default'>Log out</a></div></div>
</div><br>
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