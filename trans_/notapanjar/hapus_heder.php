<?php include_once("../../conn.php"); ?>
<?php include_once("../../loging.php"); ?>
<?php

	$sql=$conn->query("select * from notapanjar_rinci where nonotapanjar='".$_GET['nonotapanjar']."'");
	$jml=$sql->num_rows;
	
	if($jml > 0){
		echo "MAAF, JIKA ANDA INGIN MENGHAPUS TRANSAKSI INI, ANDA HARUS MENGHAPUS TRANSAKSI RINCIAN TERLEBIH DAHULU...!!!";
	}else{
		loging([
			"table"=>"notapanjar_heder",
			"col"=>"nonotapanjar",
			"val"=>$_GET['nonotapanjar']
		]);
		$sqlx=$conn->query("select * from notapanjar_heder where nonotapanjar='".$_GET['nonotapanjar']."'");
		$rsx=$sqlx->fetch_object();
		$nonpd=$rsx->nonpd;
		$conn->query("update npdpanjar_heder set flagnotapanjar='' where nonpdpanjar='".$nonpd."' ");
		$conn->query("delete from notapanjar_heder where nonotapanjar='".$_GET['nonotapanjar']."'");
		echo "OK";
	}

	
?>
<?php include_once("../../close.php"); ?>