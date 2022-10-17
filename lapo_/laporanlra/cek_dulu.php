<?php include("../../conn.php"); ?>
<?php
$tgl=in_tanggal("/",trim($_GET['tgl']));
$tglx=in_tanggal("/",trim($_GET['tglx']));
	$tgl_1=explode( '-', $tgl );
	$tahun_1=$tgl_1[0];
	$tgl_2=explode( '-', $tglx );
	$tahun_2=$tgl_2[0];
	
	if($tahun_1 != $tahun_2){
		echo "MAAF PARAMETER TAHUN YANG ANDA MASUKKAN ANTARA TANGGAL AWAL DAN TANGGAL AKHIR BERBEDA...!!!";
	}else if($tgl > $tglx){
		echo "MAAF TANGGAL AKHIR LEBIH BESAR DARIPADA TANGGAL AWAL...!!!";
	}else{
		echo "OK";
	}
?>
<?php include("../../close.php"); ?>