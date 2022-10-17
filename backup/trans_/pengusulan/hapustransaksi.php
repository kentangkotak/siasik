<?php include("../../conn.php"); ?>
<?php
	
	$conn->query("delete from usulanHonor_h where notrans='".$_GET['notrans']."'");
	$conn->query("delete from usulanHonor_r where notrans='".$_GET['notrans']."'");
	echo "OK|";
?>
<?php include("../../close.php"); ?>