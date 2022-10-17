<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php
$sql=$conn->query("select * from pergeseranTheder where notrans='".$_GET['notrans']."' and kunci=1");
$jml=$sql->num_rows;
if($jml > 0){
	echo "MAAF TRANSAKSI INI SUDAH TERKUNCI...!!!";
}else{
	loging([
		"table"=>"pergeseranTrinci",
		"col"=>"id",
		"val"=>$_GET['id']
	]);	
	//$conn->query("update npdpanjar_rinci set flag=1 where nonpk='".trim($_GET['nonpk'])."'");
	$conn->query("update npkpanjar_rinci set flag='' where nonpd='".trim($_GET['nonpdpanjar'])."'");
	$conn->query("update npdpanjar_rinci set flaggeser='' where nonpdpanjar='".trim($_GET['nonpdpanjar'])."'");
	
	$conn->query("delete from pergeseranTrinci where id='".$_GET['id']."'");
	echo "OK|";
}
	
	
?>
<?php include("../../close.php"); ?>