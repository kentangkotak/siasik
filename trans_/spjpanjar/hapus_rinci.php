<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php
$jumlahbelanjapanjar= str_replace(',','',$_GET['jumlahbelanjapanjar']);

$sql=$conn->query("select * from spjpanjar_heder where nospjpanjar='".$_GET['nospjpanjar']."' and kunci=1");
$jml=$sql->num_rows;
if($jml > 0){
	echo "MAAF TRANSAKSI INI SUDAH TERKUNCI...!!!";
}else{
	loging([
		"table"=>"spjpanjar_rinci",
		"col"=>"id",
		"val"=>$_GET['id']
	]);	
									
	$conn->query("update npdpanjar_rinci set flag='',tglkunci='".date('Y-m-d H:i:s')."',userkunci='".$_SESSION["anggaran_kodeuser"]."' 
				where nonpdpanjar='".trim($_GET['nonpdpanjar'])."' and id='".trim($_GET['iditembelanjanpd'])."' ");
	
	$conn->query("delete from spjpanjar_rinci where id='".$_GET['id']."'");
	echo "OK|".$jumlahbelanjapanjar.'|'.$saldo_pagu.'|'.$saldo_paguall;
}
	
	
?>
<?php include("../../close.php"); ?>