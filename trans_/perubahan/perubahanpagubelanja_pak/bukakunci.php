<?php include("../../../conn.php"); ?>
<?php
	
		$conn->query("update penetapan_pagu set kunciperubahan_pak='' where notrans='".$_GET["notrans"]."'");
		echo "OK";
	
?>
<?php include("../../../close.php"); ?>