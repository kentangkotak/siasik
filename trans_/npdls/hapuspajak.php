<?php include_once("../../conn.php"); ?>
<?php include_once("../../loging.php"); ?>
<?php
$sqlcek=$conn->query("select * from npdls_heder where nonpdls='".$_GET['nonpdls']."' and verif=1");
$jmlcek=$sqlcek->num_rows;
if($jmlcek > 0){
	echo "MAAF TRANSAKSI INI SUDAH TERKUNCI, JADI ANDA TIDAK BISA MENGHAPUS....!!!";
}else{
		loging([
			"table"=>"npdls_pajak",
			"col"=>"nonpdls",
			"val"=>$_GET['nonpdls']
		]);
					
		$conn->query("delete from npdls_pajak where nonpdls='".$_GET['nonpdls']."' ");
		echo "OK";
}
	
?>
<?php include_once("../../close.php"); ?>