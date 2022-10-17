<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php
$sqlcek=$conn->query("select * from notapanjar_heder where nonotapanjar='".$_GET['nonotapanjar']."' and kunci=1");
$jmlcek=$sqlcek->num_rows;
if($jmlcek > 0){
	echo "MAAF DATA INI SUDAH DIKUNCI...!!!";
}else{
	loging([
		"table"=>"notapanjar_rinci",
		"col"=>"id",
		"val"=>$_GET['id']
	]);
	//$conn->query("update npdpanjar_heder set flagnotapanjar='' where nonotapanjar='".trim($_GET['nonotapanjar'])."' and keterangan='".trim($_GET['usulan'])."' ");
	$conn->query("delete from notapanjar_rinci where id='".$_GET['id']."'");
	echo "OK|".$nonpd;
}
	
?>
<?php include("../../close.php"); ?>