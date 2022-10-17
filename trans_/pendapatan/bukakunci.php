<?php include("../../conn.php"); ?>
<?php
	
	$conn->query("update anggaran_pendapatan set kunci='' where notrans='".trim($_GET['notrans'])."' ");
	echo "OK"
?>
<?php include("../../close.php"); ?>