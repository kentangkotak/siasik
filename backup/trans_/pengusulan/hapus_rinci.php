<?php include("../../conn.php"); ?>
<?php
		
	$conn->query("delete from usulanHonor_r where id='".$_GET['id']."'");
	echo "OK|".$_GET['notrans'];

?>
<?php include("../../close.php"); ?>