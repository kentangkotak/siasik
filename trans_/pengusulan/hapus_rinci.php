<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php
    loging([
		"table"=>"usulanHonor_r",
		"col"=>"id",
		"val"=>$_GET['id']
	]);		
	$conn->query("delete from usulanHonor_r where id='".$_GET['id']."'");
	echo "OK|".$_GET['notrans'];

?>
<?php include("../../close.php"); ?>