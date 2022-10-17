<?php include("../../conn.php"); ?>
<?php
    
	$volumepermintaanpanjar= str_replace(',','',$_GET['volumepermintaanpanjar']);
	$hargapermintaanpanjar= str_replace(',','',$_GET['hargapermintaanpanjar']);
	$xxx=$volumepermintaanpanjar*$hargapermintaanpanjar;
	echo rpz($xxx);
?>
<?php include("../../close.php"); ?>