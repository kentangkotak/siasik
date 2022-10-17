<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php
$sql=$conn->query("select * from npkpanjar_heder where nonpk='".$_GET['nonpk']."' and kunci=1");
$jml=$sql->num_rows;
if($jml > 0){
	echo "MAAF TRANSAKSI INI SUDAH TERKUNCI...!!!";
}else{
	loging([
		"table"=>"npkpanjar_rinci",
		"col"=>"id",
		"val"=>$_GET['id']
	]);	
	
	$conn->query("update npdpanjar_heder set flag='' where nonpdpanjar='".trim($_GET['nonpd'])."' ");
	$conn->query("delete from npkpanjar_rinci where id='".$_GET['id']."'");
	echo "OK|".$_GET['nonpk'];
}
	
	
?>
<?php include("../../close.php"); ?>