<?php include_once("../../conn.php"); ?>
<?php include_once("../../loging.php"); ?>
<?php

		loging([
			"table"=>"contrapost",
			"col"=>"id",
			"val"=>$_GET['id']
		]);
					
		$conn->query("delete from contrapost where id='".$_GET['id']."'");
		echo "OK";
	
?>
<?php include_once("../../close.php"); ?>