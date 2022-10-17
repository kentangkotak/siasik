<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php

$sqlcek=$conn->query("select * from penyesesuaianperioritas_rinci where id='".trim($_GET['idpp'])."' and kunciperubahan1='1'");
$jml=$sqlcek->num_rows;
if($jml > 0){
	echo "MAAF TRANSAKSI INI SUDAH TERKUNCI...!!!";
}else{
	loging([
		"table"=>"perubahanrincianbelanja",
		"col"=>"id",
		"val"=>$_GET['id']
	]);	
	
	$conn->query("update penyesesuaianperioritas_rinci set statusperubahan='' where id='".trim($_GET['idpp'])."'");
	$conn->query("delete from perubahanrincianbelanja where id='".$_GET['id']."'");
	echo "OK|".$_GET['noperubahan'];
}
	
	
?>
<?php include("../../close.php"); ?>