<?php include("conn.php"); ?>
<?php
	$sql=$conn->query("select rs12 as gantipass from login where rs2='".$_GET["tusername"]."'");
	$rs=$sql->fetch_object();
	if($rs->gantipass==1){
		echo "OC";
	}

?>
<?php include("close.php"); ?>