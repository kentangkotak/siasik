<?php include_once("../../conn.php"); ?>
<?php include_once("../../loging.php"); ?>
<?php
	$sql=$conn->query("select * from serahterima_rinci where noserahterimapekerjaan='".$_GET['noserahterimapekerjaan']."'");
	$jml=$sql->num_rows;
	
	if($jml > 0){
		echo "MAAF, JIKA ANDA INGIN MENGHAPUS TRANSAKSI INI, ANDA HARUS MENGHAPUS TRANSAKSI RINCIAN TERLEBIH DAHULU...!!!";
	}else{
		loging([
			"table"=>"serahterima_heder",
			"col"=>"nokontrak",
			"val"=>$_GET['noserahterimapekerjaan']
		]);
		$conn->query("delete from serahterima_heder where noserahterimapekerjaan='".$_GET['noserahterimapekerjaan']."'");
		$conn->query("update kontrakPengerjaan_header set flag='' where nokontrak='".$_GET['nokontrak']."'");
		echo "OK";
	}
?>
<?php include_once("../../close.php"); ?>