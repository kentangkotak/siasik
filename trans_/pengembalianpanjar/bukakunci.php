<?php include("../../conn.php"); ?>
<?php
		$conn->query("update pengembalianpanjar_heder set kunci='' where nopengembalianpanjar='".$_GET["nopengembalianpanjar"]."'");
		echo "OK";
    
?>
<?php include("../../close.php"); ?>