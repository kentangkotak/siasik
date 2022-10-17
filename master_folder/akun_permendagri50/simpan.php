<?php include("../../conn.php"); ?>
<?php

	$sql=$conn->query("select * from kegiatan_blud where nomenklatur='".$_GET['nomenklatur']."' ");
	$jml=$sql->num_rows;
		if($jml>0){ 
			echo "kegiatan_blud ini telah ada.";
		}else{
			$conn->query("insert into kegiatan_blud(
				no,
				nomenklatur,
				prioritas,
				organisasi_kode1,
				organisasi_kode2,
				organisasi_kode3,
				organisasi_nama
			) 
			values(
				'".$_GET['no']."',
				'".$_GET['nomenklatur']."',
				'".$_GET['prioritas']."',
				'".$_GET['organisasi_kode1']."',
				'".$_GET['organisasi_kode2']."',
				'".$_GET['organisasi_kode3']."',
				'".$_GET['organisasi_nama']."'
			)");				
			echo "OK|";
		}
?>
<?php include("../../close.php"); ?>