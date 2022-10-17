<?php include("../../../conn.php"); ?>
<?php include("../../../loging.php"); ?>
<?php
$sqlcek_kunci=$conn->query("select * from penyesesuaianperioritas_heder where notrans='".trim($_GET['notrans'])."' and kunci=1");
$jmlcek_kunci=$sqlcek_kunci->num_rows;
if($jmlcek_kunci > 0){
		echo "MAAF DATA INI SUDAH TERKUNCI, HARAP HUBUNGI ADMINISTRATOR....!!!";
}else{
	loging([
		"table"=>"penyesesuaianperioritas_rinci",
		"col"=>"id",
		"val"=>$_GET['id']
	]);	
	$conn->query("update usulanHonor_r set flag='' where notrans='".trim($_GET['nousulan'])."' and keterangan='".trim($_GET['usulan'])."' ");
	$conn->query("delete from penyesesuaianperioritas_rinci where id='".$_GET['id']."'");
	$conn->query("delete from t_tampung where idpp='".$_GET['id']."'");
	echo "OK|".$_GET['notrans'];
}
?>
<?php include("../../../close.php"); ?>