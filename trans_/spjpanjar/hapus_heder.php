<?php include_once("../../conn.php"); ?>
<?php include_once("../../loging.php"); ?>
<?php
	$sql=$conn->query("select * from spjpanjar_rinci where nospjpanjar='".$_GET['nospjpanjar']."'");
	$jml=$sql->num_rows;
	
	if($jml > 0){
		echo "MAAF, JIKA ANDA INGIN MENGHAPUS TRANSAKSI INI, ANDA HARUS MENGHAPUS TRANSAKSI RINCIAN TERLEBIH DAHULU...!!!";
	}else{
		loging([
			"table"=>"spjpanjar_heder",
			"col"=>"nospjpanjar",
			"val"=>$_GET['nospjpanjar']
		]);
		$conn->query("delete from spjpanjar_heder where nospjpanjar='".$_GET['nospjpanjar']."'");
		echo "OK";
	}
?>
<?php include_once("../../close.php"); ?>