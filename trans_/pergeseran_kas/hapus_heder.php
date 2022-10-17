<?php include_once("../../conn.php"); ?>
<?php include_once("../../loging.php"); ?>
<?php
	$sql=$conn->query("select * from pergeseranTrinci where notrans='".$_GET['notrans']."'");
	$sqlx=$conn->query("select * from pergeseranTheder where notrans='".$_GET['notrans']."' and flag=1");
	$jml=$sql->num_rows;
	$jmlx=$sqlx->num_rows;
	
	if($jml > 0){
		echo "MAAF, JIKA ANDA INGIN MENGHAPUS TRANSAKSI INI, ANDA HARUS MENGHAPUS TRANSAKSI RINCIAN TERLEBIH DAHULU...!!!";
	}else if( $jmlx > 0){
		echo "MAAF, TRANSAKSI INI SUDAH DI VERIF....!!!";
	}else{
		loging([
			"table"=>"pergeseranTheder",
			"col"=>"notrans",
			"val"=>$_GET['notrans']
		]);
		$conn->query("delete from pergeseranTheder where notrans='".$_GET['notrans']."'");
		echo "OK";
	}
?>
<?php include_once("../../close.php"); ?>