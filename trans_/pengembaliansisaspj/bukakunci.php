<?php include("../../conn.php"); ?>
<?php
	$sqlcek=$conn->query("select * from npdls_heder where nonpdls='".$_GET['nonpdls']."' and verif=1");
	$jmlcek=$sqlcek->num_rows;
	if($jmlcek > 0){
		echo "MAAF TRANSAKSI INI SUDAH TERVERIF, JADI ANDA TIDAK BISA MENGHAPUS....!!!";
	}else{
		$conn->query("update pengembaliansisapanjar_heder set kunci='' where nospjpanjar='".$_GET["nospjpanjar"]."'");
		echo "OK";
	}
    
?>
<?php include("../../close.php"); ?>