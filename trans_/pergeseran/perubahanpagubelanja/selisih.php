<?php include("../../../conn.php"); ?>
<?php

    $nilaiperubahan= str_replace(',','',$_GET['nilaiperubahan']);
	$sisaanggaran= str_replace(',','',$_GET['sisaanggaran']);
	$selisih=$nilaiperubahan - $sisaanggaran;
	
	echo "OK|".rpz(round($selisih),2);
?>
<?php include("../../../close.php"); ?>