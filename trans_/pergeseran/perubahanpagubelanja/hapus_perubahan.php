<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php

$sql=$conn->query("select * from penetapan_pagu where notrans='".$_GET['notrans']."' and kunciperubahan=1");
$jml=$sql->num_rows;
if($jml > 0){
	echo "MAAF TRANSAKSI INI SUDAH TERKUNCI...!!!";
}else{
	loging([
		"table"=>"perubahanpagu",
		"col"=>"id",
		"val"=>$_GET['noperubahan']
	]);	
	
	$conn->query("update penetapan_pagu set perubahan='' where notrans='".$_GET['notrans']."'");
	$conn->query("delete from perubahanpagu where noperubahan='".$_GET['noperubahan']."'");
	echo "OK|".$_GET['noperubahan'];
}
	
	
?>
<?php include("../../close.php"); ?>