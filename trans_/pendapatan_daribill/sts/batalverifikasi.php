<?php include("../../../conn.php"); ?>
<?php

	$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");
	$conn_simrs->query("update keu_trans_bk set tglVerifPpk='0000-00-00 00:00:00',flagverif='' where idTrans='".$_GET['notrans']."'");
	$conn->query("delete from t_terima_ppk where idtrans='".$_GET['notrans']."' ");
	//$conn_simrs->query("update keu_trans_bk set tglVerifPpk='0000-00-00 00:00:00' where idTrans='".$_GET['notrans']."'");
				
    echo "OK|";

?>
<?php include("../../../close.php"); ?>