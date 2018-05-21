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
		$cname=$_REQUEST['name'];
		$roll=$_REQUEST['roll'];
		echo"<h4><b>Male Cnadidates are:</b></h4>";
	$result1 = mysqli_query($con,"Select candname,id,candroll from $cname.tpr_cand_signup where Gender='M'");
if($result1)
	{
		 $Data= Array();
		 $k=mysqli_num_rows($result1);
		 while ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) 
		{
				$Data[] =  $row['candname'];
				$Data1[] = $row['id'];
				$Data2[] = $row['candroll']; 
		}
		for($i=0;$i<$k;$i++)
		{
				echo "<div class='row'>			
				<div class='col-md-4'><h4><b>$Data[$i]<h4><b></div>";
				$nk=$Data[$i];
				$mk=$Data1[$i];
				$sk=$Data2[$i];
				echo"<div class='col-md-1'>";
				?>
				<form method='post' enctype='multipart/form-data' action="<?php $_SERVER['PHP_SELF']?>">
				<?php
				echo"<a  class='btn btn-success' href='checktpr.php?actn=2&&name=$cname&&roll=$roll&&num=$mk&&clicked=$sk' name='vote' value='vote'>Vote</a></form>";
				echo"</div></div><br>";
		}
	}
	echo"<br><br><h4><b>Female Cnadidates are:</b></h4>";
	$result5 = mysqli_query($con,"Select candname,id,candroll from $cname.tpr_cand_signup where Gender='F'");
if($result5)
	{
		 $Data5= Array();
		 $Data6=Array();
		 $k5=mysqli_num_rows($result5);
		 while ($row5 = mysqli_fetch_array($result5, MYSQLI_ASSOC)) 
		{
				$Data5[] =  $row5['candname'];
				$Data6[] =  $row5['id'];
				$Data7[] =  $row5['candroll'];
		}
		for($i=0;$i<$k5;$i++)
		{
				echo "<div class='row'>			
				<div class='col-md-4'><h4><b>$Data5[$i]</b></h4></div>";
				$nk5=$Data5[$i];
				$mk5=$Data6[$i];
				$sk5=$Data7[$i];
				echo"<div class='col-md-1'>";
				?>
				<form method='post' enctype='multipart/form-data' action="<?php $_SERVER['PHP_SELF']?>">
				<?php
				echo"<a  class='btn btn-success' href='checktpr.php?actn=3&&name=$cname&&roll=$roll&&num=$mk5&&clicked=$sk5' name='vote' value='vote'>Vote</a></form>";
				echo"</div></div><br>";
		}
	}
	if(isset($_POST['submit']))
	{
		$gm=mysqli_query($con,"select v4female from tprinfo where Catname='$cname'");
		$sqm1=mysqli_fetch_row($gm);
		$gmm=mysqli_query($con,"select v4male from tprinfo where Catname='$cname'");
		$sqmm1=mysqli_fetch_row($gmm);
		
		$gsm=mysqli_query($con,"select * from $cname.vmale");
		$sqsm1=mysqli_num_rows($gsm);
		$gmsm=mysqli_query($con,"select * from $cname.vfemale");
		$sqmsm1=mysqli_num_rows($gmsm);
		echo $sqsm1;
		echo $sqmsm1;
		if(($sqsm1!=$sqmm1[0])||($sqmsm1!=$sqm1[0]))
		{
			?>
			<script type="text/javascript">
			alert("votes less than required ''See below the female candidates list''")
			</script>
			<?php
			echo "<b><h4>You have to exactly vote '$sqmm1[0]' male and '$sqm1[0]' female candidates</h4></b>";
		}
		else{
			$Roll=$_REQUEST['roll'];
			$N=$_REQUEST['name'];
			$dd="insert into $cname.tpr_voter_login (candroll) value ('$Roll')";
			$aff=mysqli_query($con,$dd);
			$c=mysqli_query($con,"drop table $N.vmale");
			$cc=mysqli_query($con,"drop table $N.vfemale");
			header("Location: homepage.php");
		}
	}

	if(isset($_REQUEST['actn']))
	{
			$cname=$_REQUEST['name'];
			$roll=$_REQUEST['roll'];
			$act=$_REQUEST['actn'];
			$reg=$_REQUEST['clicked'];
			$no=$_REQUEST['num'];
			switch($act)
			{
				case 2:
				{
					$g=mysqli_query($con,"select v4male from voting_project.tprinfo where Catname='$cname'");
					$sq1=mysqli_fetch_row($g);
					$numb=0;
					$g1=mysqli_query($con,"select * from $cname.vmale");
					$numb=mysqli_num_rows($g1);
					if($numb<$sq1[0])
					{
						$count=0;
						$res=mysqli_query($con,"select * from $cname.vmale where mroll='$reg'");
						$count=mysqli_num_rows($res);
						if($count==1)
						{
							?>
							<script type="text/javascript">
							alert("You already elected this roll no. elect another one");
							</script>
							<?php
						}
						else{			
								$r=mysqli_query($con,"INSERT INTO $cname.vmale (mroll)VALUES ($reg)");
								$vo=mysqli_query($con,"select candvote from $cname.tpr_cand_signup where id=$no");
								$dta=mysqli_fetch_row($vo);
								$dta1=$dta[0]+1;
								$ams="update $cname.tpr_cand_signup set candvote='$dta1' where id=$no";
								$aquery=mysqli_query($con,$ams);
						}
					}
					else{
						?>
							<script type="text/javascript">
							alert("You already elected as much male candidates you can elect for more details see below the list of female candidates");
							</script>
							<?php
						echo "<b>**You can elect only $sq1[0] male candidates<br>So your 1st $sq1[0] enteries are taken**</b><br><br>";
					}
					break;
				}
				case 3:
				{
					$gh=mysqli_query($con,"select v4female from voting_project.tprinfo where Catname='$cname'");
					$sqh1=mysqli_fetch_row($gh);
					$numb=0;
					$gh1=mysqli_query($con,"select * from $cname.vfemale");
					$numb=mysqli_num_rows($gh1);
					if($numb<$sqh1[0])
					{
						$count=0;
						$res=mysqli_query($con,"select * from $cname.vfemale where froll='$reg'");
						$count=mysqli_num_rows($res);
						if($count==1)
						{
							?>
							<script type="text/javascript">
							alert("You already elected this roll no. elect another one");
							</script>
							<?php
						}
						else{			
								$r=mysqli_query($con,"INSERT INTO $cname.vfemale (froll)VALUES ($reg)");
								$vo=mysqli_query($con,"select candvote from $cname.tpr_cand_signup where id=$no");
								$dta=mysqli_fetch_row($vo);
								$dta1=$dta[0]+1;
								$ams="update $cname.tpr_cand_signup set candvote='$dta1' where id=$no";
								$aquery=mysqli_query($con,$ams);
						}
					}
					else{
						?>
							<script type="text/javascript">
							alert("You already elected as much female candidates you can elect for more details see below the list of female candidates");
							</script>
							<?php
						echo "<b>**You can elect only $sqh1[0] female candidates<br>So your 1st $sqh1[0] enteries are taken**</b><br><br>";
					}
					
				}
			}
	}
echo"</div></div><br><br>
<div class='row'><div class='col-md-1'></div><div class='col-md-7'>";?>
<form method='post' onsubmit='return frm_check()' enctype='multipart/form-data' action="<?php $_SERVER['PHP_SELF']?>">
  <input type='submit' name='submit' value='Submit'>
</form></div></div>
<?php
echo"<div class='row'><div class='col-md-1'></div><div class='col-md-7'></div></div>
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
