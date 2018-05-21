<?php
$branch_rec1=$_POST["branch5"];
$year_rec1=$_POST["year5"];
$orig_key1="";

if($branch_rec1=="Architecture")
{
	$sec_key1=6;
	if($year_rec1=="1st")
		$orig_key1="176";
	else if($year_rec1=="2nd")
		$orig_key1="166";
	else if($year_rec1=="3rd")
		$orig_key1="156";
	else if($year_rec1=="4th")
		$orig_key1="146";
	else
		$orig_key1="136";
}
else
{
	if($branch_rec1=="CSE Dual")
	{
		if($year_rec1=="1st")
		$orig_key1="17MI5";
	else if($year_rec1=="2nd")
		$orig_key1="16MI5";
	else if($year_rec1=="3rd")
		$orig_key1="15MI5";
	else if($year_rec1=="4th")
		$orig_key1="14MI5";
	else
		$orig_key1="13MI5";
	}
	else
	{
		if($year_rec1=="1st")
		$orig_key1="17MI4";
	else if($year_rec1=="2nd")
		$orig_key1="16MI4";
	else if($year_rec1=="3rd")
		$orig_key1="15MI4";
	else if($year_rec1=="4th")
		$orig_key1="14MI4";
	else
		$orig_key1="13MI4";
	}
	echo $orig_key1;
}
?>
