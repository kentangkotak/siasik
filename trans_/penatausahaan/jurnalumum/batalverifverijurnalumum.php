<?php include("../../../conn.php"); ?>
<?php
	
		$conn->query("update jurnalumum_heder set verif='' where nobukti='".$_GET['nobukti']."'");
		$conn->query("update jurnalumum_rinci set verif='' where nobukti='".$_GET['nobukti']."'");
		echo "OK|";
?>
<?php include("../../../close.php"); ?>