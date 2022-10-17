<?php include("../../conn.php"); ?>
<?php

	$sql=$conn->query("select * from organisasi where nama='".$_GET['nama']."' ");
	$jml=$sql->num_rows;
		if($jml>0){ 
			echo "Organisasi ini telah ada.";
		}else{
			$conn->query("insert into organisasi(kode1,kode2,kode3,kode4,nama) 
			values(
				'".$_GET['kode1']."',
				'".$_GET['kode2']."',
				'".$_GET['kode3']."',
				'".$_GET['kode4']."',
				'".$_GET['nama']."'
			)");				
			echo "OK|";
		}
?>
<?php include("../../close.php"); ?>