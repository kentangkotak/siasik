<?php include_once("../../conn.php"); ?>
<?php include_once("../../loging.php"); ?>
<?php
	$sql=$conn->query("select * from npkpanjar_rinci where nonpk='".$_GET['nonpk']."'");
	$jml=$sql->num_rows;
	
	if($jml > 0){
		echo "MAAF, JIKA ANDA INGIN MENGHAPUS TRANSAKSI INI, ANDA HARUS MENGHAPUS TRANSAKSI RINCIAN TERLEBIH DAHULU...!!!";
	}else{
		loging([
			"table"=>"npkpanjar_heder",
			"col"=>"nonpk",
			"val"=>$_GET['nonpk']
		]);
		$conn->query("update npdpanjar_heder set flag='' where nonpdpanjar='".trim($_GET['nonpd'])."' ");
		$conn->query("delete from npkpanjar_heder where nonpk='".$_GET['nonpk']."'");
		echo "OK";
	}
?>
<?php include_once("../../close.php"); ?>