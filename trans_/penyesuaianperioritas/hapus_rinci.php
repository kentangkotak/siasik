<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php
	loging([
		"table"=>"penyesesuaianperioritas_rinci",
		"col"=>"id",
		"val"=>$_GET['id']
	]);	
	$conn->query("update usulanHonor_r set flag='' where notrans='".trim($_GET['nousulan'])."' and keterangan='".trim($_GET['usulan'])."' ");
	$conn->query("delete from penyesesuaianperioritas_rinci where id='".$_GET['id']."'");
	echo "OK|".$_GET['notrans'];
?>
<?php include("../../close.php"); ?>