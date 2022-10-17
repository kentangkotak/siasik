<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php
$sql=$conn->query("select * from pengembaliansisapanjar_heder where nopengembaliansisapanjar='".$_GET['nopengembaliansisapanjar']."' and kunci=1");
$jml=$sql->num_rows;
if($jml > 0){
	echo "MAAF TRANSAKSI INI SUDAH TERKUNCI...!!!";
}else{
	loging([
		"table"=>"pengembaliansisapanjar_rinci",
		"col"=>"id",
		"val"=>$_GET['id']
	]);	
	$conn->query("update spjpanjar_rinci set flag='',tglkunci='".date('Y-m-d H:i:s')."',userkunci='".$_SESSION["anggaran_kodeuser"]."' 
				where id='".trim($_GET['idspj'])."' ");
	
	$conn->query("delete from pengembaliansisapanjar_rinci where id='".$_GET['id']."'");
	echo "OK|".$_GET['nopengembaliansisapanjar'];
}
	
	
?>
<?php include("../../close.php"); ?>