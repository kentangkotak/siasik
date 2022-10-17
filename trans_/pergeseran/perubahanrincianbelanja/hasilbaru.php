<?php include("../../../conn.php"); ?>
<?php

	$volume= str_replace(',','',$_GET['volumebaru']);
	$harga= str_replace(',','',$_GET['hargabaru']);
	$hasilbaru=$volume * $harga;

	
	echo rpz($hasilbaru);
?>
<?php include("../../../close.php"); ?>