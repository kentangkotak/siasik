<?php include("../../conn.php"); ?>
<?php

	$sql=$conn->query("select * from satuan_barang where satuanBarang='".$_GET['satuan']."' ");
	$jml=$sql->num_rows;
		if($jml>0){ 
			echo "MASTER SATUAN INI SUDAH PERNAH DI ENTRY....!!!!";
		}else{
				$conn->query("insert into satuan_barang(satuanBarang) values('".trim($_GET['satuan'])."')");				
				echo "OK|";
		}

?>
<?php include("../../close.php"); ?>