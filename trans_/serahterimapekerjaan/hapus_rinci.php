<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php
$sql=$conn->query("select * from serahterima_heder where noserahterimapekerjaan='".$_GET['noserahterimapekerjaan']."' and kunci=1");
$jml=$sql->num_rows;
if($jml > 0){
	echo "MAAF TRANSAKSI INI SUDAH TERKUNCI...!!!";
}else{
	loging([
		"table"=>"serahterima_rinci",
		"col"=>"id",
		"val"=>$_GET['id']
	]);
	$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");
	$conn_simrs->query("update rs81 set rs21='',rs22='' where rs1='".$_GET['nopenerimaan']."'");
	
	$conn->query("delete from serahterima_rinci where id='".$_GET['id']."'");
	$conn->query("delete from serahterima_penerimaanrinci where nopenerimaan='".$_GET['nopenerimaan']."'");
	echo "OK|".$_GET['noserahterimapekerjaan'];
}
	
	
?>
<?php include("../../close.php"); ?>