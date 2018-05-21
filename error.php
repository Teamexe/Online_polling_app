<?php
$err_no=$_REQUEST['err_no'];
//echo "error_no=$err_no";
switch($err_no)
{
	case 1:echo "<h1>Server connection error</h1>";
			break;
			
	case 2:echo "<h1>Database connection error</h1>";
			break;
	
}
?>