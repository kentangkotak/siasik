<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php

$sql=$conn->query("select * from sppgu_heder where nosppgu='".$_GET['nosppgu']."' and kunci=1");
$jml=$sql->num_rows;
if($jml > 0){
	echo "MAAF TRANSAKSI INI SUDAH TERKUNCI...!!!";
}else{
	loging([
		"table"=>"sppgu_rinci",
		"col"=>"id",
		"val"=>$_GET['id']
	]);	
	
	$conn->query("update spjpanjar_heder set flag='',tglflag='".date('Y-m-d H:i:s')."',userflag='".$_SESSION["anggaran_kodeuser"]."' where nospjpanjar='".trim($_GET['nospj'])."' ");
	$conn->query("delete from sppgu_rinci where id='".$_GET['id']."'");
	echo "OK|".$_GET['nonpdls'];
}
	
	
?>
<?php include("../../close.php"); ?>