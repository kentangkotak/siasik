<?php include("../../conn.php"); ?>
<?php
	
		$conn->query("update penyesesuaianperioritas_rinci set kunciperubahan1='' where id='".$_GET["id"]."'");
		//$conn->query("update perubahanrincianbelanja set statusperubahan='' where idpp='".$_GET["id"]."'");
		echo "OK";
?>
<?php include("../../close.php"); ?>