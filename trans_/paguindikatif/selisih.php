<?php include("../../conn.php"); ?>
<?php

    $nilaiperubahan= str_replace(',','',$_GET['nilaiperubahan']);
	$nilairupiah= str_replace('.','',$_GET['nilairupiah']);
	$selisih=$nilaiperubahan - $nilairupiah;
	
	echo "OK|".rpz(round($selisih),2);
?>
<?php include("../../close.php"); ?>