<?php include_once("../../conn.php"); ?>
<?php include_once("../../loging.php"); ?>
<?php
	$sql=$conn->query("select * from npkls_rinci where nonpk='".$_GET['nonpk']."'");
	$jml=$sql->num_rows;
	
	if($jml > 0){
		echo "MAAF, JIKA ANDA INGIN MENGHAPUS TRANSAKSI INI, ANDA HARUS MENGHAPUS TRANSAKSI RINCIAN TERLEBIH DAHULU...!!!";
	}else{
		loging([
			"table"=>"npkls_heder",
			"col"=>"nonpk",
			"val"=>$_GET['nonpk']
		]);
		$conn->query("delete from npkls_heder where nonpk='".$_GET['nonpk']."'");
		echo "OK";
	}
?>
<?php include_once("../../close.php"); ?>