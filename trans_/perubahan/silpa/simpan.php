<?php include("../../../conn.php"); ?>
<?php
	
	$tgl=in_tanggal("/",trim($_GET['tgl']));
	$nominal=str_replace(',','',$_GET['nominal']);

	if($_GET['notrans'] == ''){
		$notrans=time()."-SILPA";
		$conn->query("insert into silpa(notrans,tanggal,tahun,nominal,tgl_entry,user_entry) 
					values('".$notrans."','".$tgl."','".$_GET['thnsilpa']."','".$nominal."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");				
					echo "OK|";
	}else{
		$conn->query("update silpa set tanggal='".$tgl."',tahun='".$_GET['thnsilpa']."',nominal='".$nominal."' where notrans='".$_GET['notrans']."'");
					echo "OK|";
	}
		
	
	
?>
<?php include("../../../close.php"); ?>