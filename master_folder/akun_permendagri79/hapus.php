<?php include("../../conn.php"); ?>
<?php
	$conn->query("delete from akun_permendagri50 where id='".$_GET['id']."'");
	echo "OK";
?>
<?php include("../../close.php"); ?>