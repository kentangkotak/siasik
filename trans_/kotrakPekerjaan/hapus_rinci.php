<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php
	$sql=$conn->query("select * from kontrakPengerjaan_header where nokontrak='".$_GET["nokontrak"]."' and kunci=1");
	$jml=$sql->num_rows;
	if($jml >0){
		echo "MAAF DATA INI SUDAH DI KUNCI....!!!";
	}else{
		 loging([
			"table"=>"kontrakPengerjaan_rinci",
			"col"=>"id",
			"val"=>$_GET['id']
		]);		
		$conn->query("delete from kontrakPengerjaan_rinci where id='".$_GET['id']."'");
		echo "OK|".$_GET['nokontrak'];
	}
   

?>
<?php include("../../close.php"); ?>