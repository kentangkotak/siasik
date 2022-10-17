<?php include("../../conn.php"); ?>
<?php
    
	$jumlahpenerimaanpanjar= str_replace(',','',$_GET['jumlahpenerimaanpanjar']);
	$jumlahbelanjapanjar= str_replace(',','',$_GET['jumlahbelanjapanjar']);
	$hasil=$jumlahpenerimaanpanjar - $jumlahbelanjapanjar;
	
	echo rpz($hasil);
?>
<?php include("../../close.php"); ?>