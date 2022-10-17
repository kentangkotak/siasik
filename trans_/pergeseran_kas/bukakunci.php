<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from pergeseranTheder where notrans='".$_GET["notrans"]."' and flag=1");
	$jml=$sql->num_rows;
	if($jml > 0){
		echo "MAAF TRANSAKSI INI SUDAH DI TERVERIF....!!!";
	}else{
		$conn->query("update pergeseranTheder set kunci='',batalkunci='".date('Y-m-d H:i:s')."' where notrans='".$_GET["notrans"]."'");
		echo "OK";
	}
    
?>
<?php include("../../close.php"); ?>