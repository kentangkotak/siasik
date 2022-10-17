<?php include("../../conn.php"); ?>
<?php
	//$conn->query("delete from organisasi where id='".$_GET['id']."'");
	$conn->query("update organisasi
		set hidden='1'
	where
		id='".$_GET['id']."'");
	echo "OK";
?>
<?php include("../../close.php"); ?>