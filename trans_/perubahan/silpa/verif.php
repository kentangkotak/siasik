<?php include("../../../conn.php"); ?>
<?php
	

		$conn->query("update silpa set verif=1 where notrans='".$_GET['notrans']."'");
					
		echo "OK|";	
		
		
	
	
?>
<?php include("../../../close.php"); ?>