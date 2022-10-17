<?php include("../../conn.php"); ?>
<?php
	if($_GET['koderuanganusulan']=='R054'){
		$conn->query("update usulanHonor_r set flag='' where notrans='".trim($_GET['notransmusrenbang'])."' and kodeKegiatan='".trim($_GET['kodeusulan'])."' ");
		$conn->query("delete from penyesesuaianperioritas_rinci where id='".$_GET['id']."'");
		echo "OK|".$_GET['notrans'];
	}else{
	
		$conn_musrenbang = new mysqli("localhost","admin","alam02018sa","musrenbang");
		$conn_musrenbang->query("update rs5 set rs10='' where rs1='".trim($_GET['notransmusrenbang'])."' and rs2='".trim($_GET['kodeusulan'])."' and rs5='".trim($_GET['koderuanganusulan'])."' ");
		$conn->query("delete from penyesesuaianperioritas_rinci where id='".$_GET['id']."'");
		echo "OK|".$_GET['notrans'];
	}

?>
<?php include("../../close.php"); ?>