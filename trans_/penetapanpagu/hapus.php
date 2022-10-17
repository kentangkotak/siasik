<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php
	loging([
		"table"=>"penetapan_pagu",
		"col"=>"notrans",
		"val"=>$_GET['notrans']
	]);
    $conn->query("delete from penetapan_pagu where notrans='".$_GET["notrans"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>