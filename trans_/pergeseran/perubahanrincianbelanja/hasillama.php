<?php include("../../../conn.php"); ?>
<?php

	$volume= str_replace(',','',$_GET['volume']);
	$harga= str_replace(',','',$_GET['harga']);
	$hasillama=$volume * $harga;
	
	echo rpz($hasillama);
?>
<?php include("../../../close.php"); ?>