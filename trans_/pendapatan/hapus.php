<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php
	loging([
		"table"=>"anggaran_pendapatan",
		"col"=>"notrans",
		"val"=>$_GET['notrans']
	]);
    $conn->query("delete from anggaran_pendapatan where notrans='".$_GET["notrans"]."'");
	$conn->query("delete from t_tampung_pendapatan where notrans='".$_GET["notrans"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>