<?php include("../../../conn.php"); ?>
<?php include("../../../loging.php"); ?>
<?php

$sql=$conn->query("select * from penetapan_pagu where notrans='".$_GET['notrans']."' and kunciperubahan_pak=1");
$jml=$sql->num_rows;
if($jml > 0){
	echo "MAAF TRANSAKSI INI SUDAH TERKUNCI...!!!";
}else{
	loging([
		"table"=>"perubahanpagu_pak",
		"col"=>"noperubahan",
		"val"=>$_GET['noperubahan']
	]);	
	
	$conn->query("update penetapan_pagu set perubahan_pak='' where notrans='".$_GET['notrans']."'");
	$conn->query("delete from perubahanpagu_pak where noperubahan='".$_GET['noperubahan']."'");
	echo "OK|".$_GET['noperubahan'];
}
	
	
?>
<?php include("../../../close.php"); ?>