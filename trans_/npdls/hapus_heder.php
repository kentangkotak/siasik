<?php include_once("../../conn.php"); ?>
<?php include_once("../../loging.php"); ?>
<?php
$sqlcek=$conn->query("select * from npdls_heder where nonpdls='".$_GET['nonpdls']."' and verif=1");
$jmlcek=$sqlcek->num_rows;
if($jmlcek > 0){
	echo "MAAF TRANSAKSI INI SUDAH TERVERIF, JADI ANDA TIDAK BISA MENGHAPUS....!!!";
}else{
	$sql=$conn->query("select * from npdls_rinci where nonpdls='".$_GET['nonpdls']."'");
	$jml=$sql->num_rows;
	
	if($jml > 0){
		echo "MAAF, JIKA ANDA INGIN MENGHAPUS TRANSAKSI INI, ANDA HARUS MENGHAPUS TRANSAKSI RINCIAN TERLEBIH DAHULU...!!!";
	}else{
		loging([
			"table"=>"npdls_heder",
			"col"=>"nonpdls",
			"val"=>$_GET['nonpdls']
		]);
		$conn->query("update serahterima_heder set flag='' where nokontrak='".trim($_GET['nokontrak'])."' ");
					
		$conn->query("delete from npdls_heder where nonpdls='".$_GET['nonpdls']."'");
		echo "OK";
	}
}
	
?>
<?php include_once("../../close.php"); ?>