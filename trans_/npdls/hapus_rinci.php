<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php

$sql=$conn->query("select * from npdls_heder where nonpdls='".$_GET['nonpdls']."' and kunci=1");
$jml=$sql->num_rows;
if($jml > 0){
	echo "MAAF TRANSAKSI INI SUDAH TERKUNCI...!!!";
}else{
	loging([
		"table"=>"npdls_rinci",
		"col"=>"id",
		"val"=>$_GET['id']
	]);	
	$sqla=$conn->query("select * from npdls_heder where nonpdls='".$_GET['nonpdls']."'");
	$rsa=$sqla->fetch_object();
	
		if($rsa->serahterimapekerjaan == 1){
			if($_GET['kodekegiatanblud'] == 45){
				//$conn->query("update serahterima_heder set flag='' where nokontrak='".trim($rsa->nokontrak)."' ");
				$conn->query("update serahterima_rinci set flag='' where nokontrak='".trim($rsa->nokontrak)."' and id='".trim($_GET['idserahterima_rinci'])."' ");
				$conn->query("update serahterima_penerimaanrinci set flag='',nonpdls='' where nokontrak='".trim($rsa->nokontrak)."' and kode108='".trim($_GET['koderek108'])."' ");
			}else{
				//$conn->query("update serahterima_heder set flag='' where nokontrak='".trim($rsa->nokontrak)."' ");
				$conn->query("update serahterima_rinci set flag='' where nokontrak='".trim($rsa->nokontrak)."' and id='".trim($_GET['idserahterima_rinci'])."' ");
			}
		}else{
			if($_GET['kodekegiatanblud'] == 45){
				$conn->query("update serahterima_penerimaanrinci set flag='',nonpdls='' where nokontrak='".trim($rsa->nokontrak)."' and kode108='".trim($_GET['koderek108'])."' ");
				$conn->query("update penyesesuaianperioritas_rinci set kunci='' where id='".trim($_GET['idserahterima_rinci'])."' ");
			}else{
				$conn->query("update penyesesuaianperioritas_rinci set kunci='' where id='".trim($_GET['idserahterima_rinci'])."' ");
			}
		}
	$conn->query("delete from npdls_rinci where id='".$_GET['id']."'");
	echo "OK|".$_GET['nonpdls'];
}
	
	
?>
<?php include("../../close.php"); ?>