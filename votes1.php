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
<div class=well well-sm><h2>Configuration of Categories for Elections</h2></div>	";
if(isset($_REQUEST['act']))
{
	$act=$_REQUEST['act'];
	$cname=$_REQUEST['name'];
    $sql = "SHOW TABLES FROM $cname";
    $result = mysqli_query($con,$sql);

if (!$result) {
    echo "DB Error, could not list tables\n\n";
    echo 'MySQL Error: ' . mysqli_error($con);
    exit;
}

while ($row = mysqli_fetch_row($result)) 
{
    echo "<div class='row'><div class='col-md-1'></div><div class='col-md-4'><a href='$row[0].php?class=$row[0]&&name=$cname' class='btn btn-primary'>$row[0]</a></div></div><br>";
}
$ss="SELECT * FROM $cname.voter_login";
$ar=mysqli_query($con,$ss);
$numm=mysqli_num_rows($ar);
$qw="select max_votes from catinfo where catname='$cname'"; 
$qww=mysqli_query($con,$qw);
$arow=mysqli_fetch_row($qww);
if($numm>(10))
{
	echo "<div  class='row'><div class='col-md-1'></div><div class='col-md-5'><a href='result.php?class=results&&name=$cname' class='btn btn-primary'>Results</a></div></div><br>";
}
}
echo"</div><br>
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