<?php include("../../conn.php"); ?>
<?php
	$sqlcek=$conn->query("select * from npdls_heder where nonpdls='".$_GET['nonpdls']."' and verif=1");
	$jmlcek=$sqlcek->num_rows;
	if($jmlcek > 0){
		echo "MAAF TRANSAKSI INI SUDAH TERVERIF, JADI ANDA TIDAK BISA MEMBUKA KUNCI....!!!";
	}else{
		$conn->query("update npdls_heder set kunci='' where nonpdls='".$_GET["nonpdls"]."'");
		echo "OK";
	}
    
?>
<?php include("../../close.php"); ?>