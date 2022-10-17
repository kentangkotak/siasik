<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php
	loging([
		"table"=>"anggaran_pendapatan_pak",
		"col"=>"notrans",
		"val"=>$_GET['notrans']
	]);
    $conn->query("delete from anggaran_pendapatan_pak where notrans='".$_GET["notrans"]."'");
	//$conn->query("delete from t_tampung_pendapatan where notrans='".$_GET["notrans"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>