<?php include("../../conn.php"); ?>
<?php
	$conn->query("
		update mapping_blud_79 set 
			kode_791='".$_GET['kode_791']."',
			kode_792='".$_GET['kode_792']."',
			kode_793='".$_GET['kode_793']."',
			uraian_79='".$_GET['uraian_79']."'
		where 
			akun='".$_GET['akun']."'
			and kelompok='".$_GET['kelompok']."'
			and jenis='".$_GET['jenis']."'
			and objectx='".$_GET['objectx']."'
			and rincian='".$_GET['rincian']."'
			and subrincian='".$_GET['subrincian']."'
	");
	echo"OK|";
?>
<?php include("../../close.php"); ?>