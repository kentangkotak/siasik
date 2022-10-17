<?php include_once("../../conn.php"); ?>
<?php include_once("../../loging.php"); ?>
<?php
	$sql=$conn->query("select * from npdpanjar_rinci where nonpdpanjar='".$_GET['nonpdpanjar']."'");
	$jml=$sql->num_rows;
	
	if($jml > 0){
		echo "MAAF, JIKA ANDA INGIN MENGHAPUS TRANSAKSI INI, ANDA HARUS MENGHAPUS TRANSAKSI RINCIAN TERLEBIH DAHULU...!!!";
	}else{
		loging([
			"table"=>"npdpanjar_heder",
			"col"=>"nonpdpanjar",
			"val"=>$_GET['nonpdpanjar']
		]);
		$conn->query("delete from npdpanjar_heder where nonpdpanjar='".$_GET['nonpdpanjar']."'");
		echo "OK";
	}
?>
<?php include_once("../../close.php"); ?>