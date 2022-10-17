<?php include("../../../conn.php"); ?>
<?php include("../../../loging.php"); ?>
<?php

$sql=$conn->query("select * from anggaran_pendapatan where notrans='".$_GET['notrans']."' and kunciperubahan_pak=1");
$jml=$sql->num_rows;
if($jml > 0){
	echo "MAAF TRANSAKSI INI SUDAH TERKUNCI...!!!";
}else{
	loging([
		"table"=>"perubahan_pak",
		"col"=>"notransawal",
		"val"=>$_GET['notrans']
	]);	
	
	$conn->query("update anggaran_pendapatan set statusperubahan_pak='' where notrans='".trim($_GET['notrans'])."'");
	$conn->query("delete from perubahan_pak where notransawal='".$_GET['notrans']."'");
	echo "OK|".$_GET['notrans'];
}
	
	
?>
<?php include("../../../close.php"); ?>