<?php include_once("../../conn.php"); ?>
<?php include_once("../../loging.php"); ?>
<?php
	$sql=$conn->query("select id from penyesesuaianperioritas_rinci where notrans='".$_GET['notrans']."'");
	if($sql->num_rows>0){
		echo "Maaf, jika ingin menghapus transaksi ini maka harus menghapus rincian terlebih dahulu.";
	}
	else{
		loging([
			"table"=>"penyesesuaianperioritas_heder",
			"col"=>"notrans",
			"val"=>$_GET['notrans']
		]);
		$conn->query("delete from penyesesuaianperioritas_heder where notrans='".$_GET['notrans']."'");
		echo "OK";
	}
?>
<?php include_once("../../close.php"); ?>