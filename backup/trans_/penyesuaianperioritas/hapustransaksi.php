<?php include("../../conn.php"); ?>
<?php
	$conn->query("delete from penyesesuaianperioritas_heder where notrans='".$_GET['notrans']."'");
	$conn->query("delete from penyesesuaianperioritas_rinci where notrans='".$_GET['notrans']."'");
	echo "OK|";
?>
<?php include("../../close.php"); ?>