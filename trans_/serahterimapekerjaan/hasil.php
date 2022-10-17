<?php include("../../conn.php"); ?>
<?php
    
	$volume= str_replace(',','',$_GET['volumepermintaanpanjar']);
	$harga= str_replace(',','',$_GET['hargapermintaanpanjar']);
	$hasil=$volume * $harga;
	
	echo rpz($hasil);
?>
<?php include("../../close.php"); ?>