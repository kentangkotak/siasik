<?php include("../../conn.php"); ?>
<?php
	
		$conn->query("update kegiatan_blud set flag='1' where no='".$_GET['id']."' ");
		echo "OK";



?>
<?php include("../../close.php"); ?>