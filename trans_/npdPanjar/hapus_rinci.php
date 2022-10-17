<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php
$sql=$conn->query("select * from npdpanjar_heder where nonpdpanjar='".$_GET['nonpdpanjar']."' and kunci=1");
$jml=$sql->num_rows;
if($jml > 0){
	echo "MAAF TRANSAKSI INI SUDAH TERKUNCI...!!!";
}else{
	loging([
		"table"=>"npdpanjar_rinci",
		"col"=>"id",
		"val"=>$_GET['id']
	]);	
	//$conn->query("update penyesesuaianperioritas_rinci set kunci='' where notrans='".trim($_GET['nopp'])."' and nousulan='".trim($_GET['nousulan'])."' 
	//and koderek50='".$_GET['koderek50']."' and usulan='".$_GET['usulan']."' ");
	
	$conn->query("delete from npdpanjar_rinci where id='".$_GET['id']."'");
	echo "OK|".$_GET['nonpdpanjar'];
}
	
	
?>
<?php include("../../close.php"); ?>