<?php include("../../conn.php"); ?>
<?php

	$sql=$conn->query("select * from maping_blud_pemda where rekapkode='".$_GET['rekapkode']."' ");
	$jml=$sql->num_rows;
		if($jml>0){ 
			echo "kegiatan_blud ini telah ada.";
		}else{
			$conn->query("insert into maping_blud_pemda(
				level1,
				level2,
				level3,
				level4,
				level5,
				rekapkode,
				uraian50,
				uraianblud,
				namaorganisasi,
				bidang
			) 
			values(
				'".$_GET['level1']."',
				'".$_GET['level2']."',
				'".$_GET['level3']."',
				'".$_GET['level4']."',
				'".$_GET['level5']."',
				'".$_GET['rekapkode']."',	
				'".$_GET['nomenklaturlevel5']."',
				'".$_GET['nomenklaturblud']."',
				'".$_GET['organisasilama']."',
				'".$_GET['bidang']."'
			)");				
			echo "OK|";
		}
?>
<?php include("../../close.php"); ?>