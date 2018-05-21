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
		echo"<h4><b>Male Cnadidates are:</b></h4>";
	$result1 = mysqli_query($con,"Select candname,id from $cname.tpr_cand_signup where Gender='M'");
if($result1)
	{
		 $Data= Array();
		 $k=mysqli_num_rows($result1);
		 while ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) 
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
				echo"<div class='col-md-2'><a  class='btn btn-success' href='tpr_voter_login2.php?acts=1&&num=$mk&&ans=$cname&&roll=$roll' name='vote'>Vote</a>
				</div></div><br>";
		}
	}
	echo"<br><br><h4><b>Female Cnadidates are:</b></h4>";
	$result5 = mysqli_query($con,"Select candname,id from $cname.tpr_cand_signup where Gender='F'");
if($result5)
	{
		 $Data5= Array();
		 $Data6=Array();
		 $k5=mysqli_num_rows($result5);
		 while ($row5 = mysqli_fetch_array($result5, MYSQLI_ASSOC)) 
		{
				$Data5[] =  $row5['candname'];
				$Data6[] =  $row5['id'];
		}
		for($i=0;$i<$k5;$i++)
		{
				echo "<div class='row'>			
				<div class='col-md-3'>$Data5[$i]</div>";
				$nk5=$Data5[$i];
				$mk5=$Data6[$i];
				echo"<div class='col-md-2'><a  class='btn btn-success' href='tpr_voter_login2.php?acts=1&&num=$mk5&&ans=$cname&&roll=$roll' name='vote'>Vote</a>
				</div></div><br>";
		}
	}
	else 
	{
		die(mysqli_errno($con));
	}
	}
	if(isset($_REQUEST['acts']))
				{
					$acto=$_REQUEST['acts'];
					$ik=$_REQUEST['num'];
					$am=$_REQUEST['ans'];
					$Roll=$_REQUEST['roll'];
					$dd="insert into $am.tpr_voter_login(candroll) value ('$Roll')";
					$asf=mysqli_query($con,$dd);
					$sql="select candvote from $am.tpr_cand_signup where id=$ik";
					$query=mysqli_query($con,$sql);
					$data=mysqli_fetch_row($query);
					$data1=$data[0]+1;
					$sql="update $am.tpr_cand_signup set candvote='$data1' where id=$ik";
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