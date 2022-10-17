<?php include("../../../conn.php"); ?>
<?php
	
		$conn->query("update anggaran_pendapatan set kunciperubahan_pak='' where notrans='".$_GET["notrans"]."'");
		echo "OK";
	
?>
<?php include("../../../close.php"); ?>