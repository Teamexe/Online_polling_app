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
<div class='col-md-12'>
<div class='panel panel-primary min_h'>
<div class=well well-sm><h2>configuration of Categories for Elections</h2></div>	
<div class=row><div class='col-md-1'></div>";
echo"<div class='col-md-1'>";?>
  <a href='tprs.php' class='btn btn-primary'>TPR</a></div>
  <div class='col-md-1'><a href='cat_config.php' class='btn btn-primary'>CR</a></div>

<?php
echo"</div><br>
</div>
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