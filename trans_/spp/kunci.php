<?php include("../../conn.php"); ?>
<?php

	$conn->query("update transsppup set kunci='1',tgl_kunci='".date('Y-m-d H:i:s')."' where nosppup='".trim($_GET['x'])."' ");
	echo "OK"

?>
<?php include("../../close.php"); ?>