<?php include("../../conn.php"); ?>
<?php

	$conn->query("update transsppup set verif='1',kodeuserverif='".$_SESSION["anggaran_kodeuser"]."',userverif='".$_SESSION["anggaran_username"]."',
	tgl_verif='".date('Y-m-d H:i:s')."' where nosppup='".trim($_GET['nosppup'])."' ");
	echo "OK"

?>
<?php include("../../close.php"); ?>