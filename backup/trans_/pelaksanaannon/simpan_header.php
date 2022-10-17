<?php include("../../conn.php"); ?>
<?php
	$tglmulai=in_tanggal("/",trim($_GET['tglmulai']));
	$tglselesai=in_tanggal("/",trim($_GET['tglselesai']));
	$tglsurat=in_tanggal("/",trim($_GET['tglsurat']));
	$kode=trim($_GET['notrans']);

	$sql=$conn->query("select * from rs32 where rs1='".$kode."'");
	$jml=$sql->num_rows;
		if($jml>0){ 
			echo "OK|".$kode;
		}else{
			$conn->query("insert into rs32(rs1,rs2,rs3,rs4,rs5,rs6,rs7,rs8,rs9,rs10,rs11,rs12,rs13,rs14,rs15,rs16,rs17) values(
				'".$kode."','','','','".trim($_GET['jenispelatihan'])."',
				'".trim($_GET['tempat'])."','".trim($_GET['kategori'])."','".trim($_GET['penyelenggara'])."','".$tglmulai."','".$tglselesai."','".$tglsurat."',
				'','".trim($_GET['jam'])."','".date('Y-m-d H:i:s')."',
				'".$_SESSION["silat_kodeuser"]."','".trim($_GET['nosurat'])."','".trim($_GET['namax'])."')");
					
			echo "OK|".$kode;
		}

?>
<?php include("../../close.php"); ?>