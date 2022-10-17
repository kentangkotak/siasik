<?php include("../../../conn.php"); ?>
<?php
	$sql=$conn->query("select sum(debet) as debet,sum(kredit) as kredit from jurnalumum_rinci where nobukti='".$_GET['nobukti']."'");
	$rs=$sql->fetch_object();
	$debet=$rs->debet;
	$kredit=$rs->kredit;
	
	if($debet != $kredit){
		echo "MAAF NILAI DEBET DAN KREDIT HARUS SAMA....!!!";
	}else{
		$conn->query("update jurnalumum_heder set verif=1 where nobukti='".$_GET['nobukti']."'");
		$conn->query("update jurnalumum_rinci set verif=1 where nobukti='".$_GET['nobukti']."'");
		echo "OK|";
	}
?>
<?php include("../../../close.php"); ?>