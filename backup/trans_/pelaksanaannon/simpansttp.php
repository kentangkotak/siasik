<?php include("../../conn.php"); ?>
<?php
		
	$conn->query("update rs33 set rs10='".trim($_GET['nosttp'])."' where rs1='".trim($_GET['notrans'])."' and rs4='".trim($_GET['nip'])."' ");
	echo "OK|";

?>
<?php include("../../close.php"); ?>