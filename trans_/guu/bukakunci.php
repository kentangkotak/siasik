<?php include("../../conn.php"); ?>
<?php
	//$sqlcek=$conn->query("select * from npdls_heder where nonpdls='".$_GET['nonpdls']."' and verif=1");
	//$jmlcek=$sqlcek->num_rows;
	//if($jmlcek > 0){
	//	echo "MAAF TRANSAKSI INI SUDAH TERVERIF, JADI ANDA TIDAK BISA MENGHAPUS....!!!";
	//}else{
		$conn->query("update sppgu_heder set kunci='',tglkunci='".date('Y-m-d H:i:s')."',userkunci='".$_SESSION["anggaran_kodeuser"]."' where nosppgu='".$_GET["nosppgu"]."'");
		echo "OK";
	//}
    
?>
<?php include("../../close.php"); ?>