<?php include_once("../../conn.php"); ?>
<?php include_once("../../loging.php"); ?>
<?php
	$sql=$conn->query("select * from pengembalianpanjar_rinci where nopengembalianpanjar='".$_GET['nopengembalianpanjar']."'");
	$jml=$sql->num_rows;
	
	if($jml > 0){
		echo "MAAF, JIKA ANDA INGIN MENGHAPUS TRANSAKSI INI, ANDA HARUS MENGHAPUS TRANSAKSI RINCIAN TERLEBIH DAHULU...!!!";
	}else{
		loging([
			"table"=>"pengembalianpanjar_heder",
			"col"=>"nopengembalianpanjar",
			"val"=>$_GET['nopengembalianpanjar']
		]);
		$conn->query("delete from pengembalianpanjar_heder where nopengembalianpanjar='".$_GET['nopengembalianpanjar']."'");
		echo "OK";
	}
	
?>
<?php include_once("../../close.php"); ?>