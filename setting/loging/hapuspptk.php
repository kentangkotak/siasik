<?php include("../../conn.php"); ?>
<?php
	$conn->query("update pptk set flag='1' where id='".$_GET['id']."' ");
	echo "OK|";
?>