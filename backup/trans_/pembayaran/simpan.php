<?php include("../../conn.php"); ?>
<?php
	
		$sql=$conn->query("call transpembayaran(@nomor);");
		$sql=$conn->query("select @nomor as nomor;");
		$jml=$sql->num_rows;
		if($jml>0){ 
			$rs=$sql->fetch_object();
			$counter=$rs->nomor+1;
		}
			$kodex="TR00".$counter;
			$conn->query("insert into rs6(rs1,rs2,rs3,rs4,rs5,rs6,rs7) values('".$kodex."','".trim($_GET['koderekening'])."','".trim($_GET['untukpembayaran'])."','".trim($_GET['nominal'])."','".trim($_GET['untuk'])."','".date('y-m-d H:i:s')."','".$_SESSION["silat_kodeuser"]."')");
			
			echo "OK|".$kodex;
	

?>
<?php include("../../close.php"); ?>