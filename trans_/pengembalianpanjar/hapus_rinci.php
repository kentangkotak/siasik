<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php

$sql=$conn->query("select * from pengembalianpanjar_heder where nopengembalianpanjar='".$_GET['nopengembalianpanjar']."' and kunci=1");
$jml=$sql->num_rows;
if($jml > 0){
	echo "MAAF TRANSAKSI INI SUDAH TERKUNCI...!!!";
}else{
	loging([
		"table"=>"pengembalianpanjar_rinci",
		"col"=>"id",
		"val"=>$_GET['id']
	]);	
	$conn->query("delete from pengembalianpanjar_rinci where id='".$_GET['id']."'");
	echo "OK|".$_GET['nopengembalianpanjar'];
}
	
	
?>
<?php include("../../close.php"); ?>