<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php
$total= str_replace(',','',$_GET['total']);
$sql=$conn->query("select * from npkls_heder where nonpk='".$_GET['nonpk']."' and kunci=1");
$jml=$sql->num_rows;
if($jml > 0){
	echo "MAAF TRANSAKSI INI SUDAH TERKUNCI...!!!";
}else{
	loging([
		"table"=>"npkls_rinci",
		"col"=>"id",
		"val"=>$_GET['id']
	]);	
	
	$conn->query("update serahterima_penerimaanrinci set nonpkls='' where nonpdls='".trim($_GET['nonpdls'])."' ");
	$conn->query("update npdls_heder set flagnpk='' where nonpdls='".trim($_GET['nonpdls'])."' ");
	$conn->query("delete from npkls_rinci where id='".$_GET['id']."'");
	
	echo "OK|".$_GET['nonpk'];
}
	
	
?>
<?php include("../../close.php"); ?>