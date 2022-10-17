<?php include("../../../conn.php"); ?>
<?php

    $nilai= str_replace(',','',$_GET['nilai']);
	$volume= str_replace(',','',$_GET['volumebaru']);
	$harga= str_replace(',','',$_GET['hargabaru']);
	$hasilbaru=$volume * $harga;
	$selisih=$hasilbaru - $nilai;
	
	echo rpz($hasilbaru)."|".rpz($selisih);
?>
<?php include("../../../close.php"); ?>