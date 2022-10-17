<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php
	loging([
		"table"=>"usulanHonor_h",
		"col"=>"notrans",
		"val"=>$_GET['notrans']
	]);
    loging([
		"table"=>"usulanHonor_r",
		"col"=>"notrans",
		"val"=>$_GET['notrans']
	]);	
	$conn->query("delete from usulanHonor_h where notrans='".$_GET['notrans']."'");
	$conn->query("delete from usulanHonor_r where notrans='".$_GET['notrans']."'");
	echo "OK|";
?>
<?php include("../../close.php"); ?>