<?php include("../../conn.php"); ?>
<?php
	$tglmulai=in_tanggal("/",trim($_GET['tglmulai']));
	$tglselesai=in_tanggal("/",trim($_GET['tglselesai']));
	$tglsurat=in_tanggal("/",trim($_GET['tglsurat']));
	
	if($_GET['notrans']==''){
		$sql=$conn->query("call trans_diklat(@nomor);");
		$sql=$conn->query("select @nomor as nomor;");
		$jml=$sql->num_rows;
		if($jml>0){ 
			$rs=$sql->fetch_object();
			$counter=$rs->nomor+1;
		}		
		$kode=gennotran($counter,"DK");
		$conn->query("insert into rs32(rs1,rs2,rs3,rs4,rs5,rs6,rs7,rs8,rs9,rs10,rs11,rs12,rs13,rs14,rs15,rs16,rs17) values(
		'".$kode."','','','','".trim($_GET['jenispelatihan'])."',
		'".trim($_GET['tempat'])."','".trim($_GET['kategori'])."','".trim($_GET['penyelenggara'])."','".$tglmulai."','".$tglselesai."','".$tglsurat."',
		'','".trim($_GET['jam'])."','".date('Y-m-d H:i:s')."',
		'".$_SESSION["silat_kodeuser"]."','".trim($_GET['nosurat'])."','".trim($_GET['namax'])."')");
		
		
		$sql_cek=$conn->query("select * from rs33 where rs4='".trim($_GET['nip'])."' and rs1='".$kode."'");
		$ceknip=$sql_cek->num_rows;
		if($ceknip>0){
			echo "MAAF NAMA PEGAWAI TERSEBUT SUDAH DI ENTRY DALAM PELATIHAN INI....!!!!";
		}else{
			$conn->query("insert into rs33(rs1,rs2,rs3,rs4,rs5,rs6,rs7,rs8,rs9,rs10,rs11,rs12,rs13,rs14,rs15,rs16,rs17,rs18,rs19,rs20,rs21,rs22) values('".$kode."','','','".trim($_GET['nip'])."',
					'".date('Y-m-d H:i:s')."','".$_SESSION['silat_kodeuser']."','','','','','".trim($_GET['koderuangan'])."','".trim($_GET['ruangan'])."','".trim($_GET['kategoripegawai'])."','".trim($_GET['kategoripeg'])."',
					'".trim($_GET['kodejabatan'])."','".trim($_GET['jabatan'])."','".trim($_GET['kodependidikan'])."','".trim($_GET['pendidikan'])."','".trim($_GET['kodegolruang'])."','".trim($_GET['golruang'])."','".trim($_GET['kodestatpegawai'])."','".trim($_GET['statpeg'])."') ");
		
			echo "OK|".$kode;
		}
	}else{
	
		$kode=trim($_GET['notrans']);
		
		$sql_cek=$conn->query("select * from rs33 where rs4='".trim($_GET['nip'])."' and rs1='".$kode."'");
		$ceknip=$sql_cek->num_rows;
		if($ceknip>0){
			echo "MAAF NAMA PEGAWAI TERSEBUT SUDAH DI ENTRY DALAM PELATIHAN INI....!!!!";
		}else{
			$conn->query("insert into rs33(rs1,rs2,rs3,rs4,rs5,rs6,rs7,rs8,rs9,rs10,rs11,rs12,rs13,rs14,rs15,rs16,rs17,rs18,rs19,rs20,rs21,rs22) values('".$kode."','','','".trim($_GET['nip'])."',
					'".date('Y-m-d H:i:s')."','".$_SESSION['silat_kodeuser']."','','','','','".trim($_GET['koderuangan'])."','".trim($_GET['ruangan'])."','".trim($_GET['kategoripegawai'])."','".trim($_GET['kategoripeg'])."',
					'".trim($_GET['kodejabatan'])."','".trim($_GET['jabatan'])."','".trim($_GET['kodependidikan'])."','".trim($_GET['pendidikan'])."','".trim($_GET['kodegolruang'])."','".trim($_GET['golruang'])."','".trim($_GET['kodestatpegawai'])."','".trim($_GET['statpeg'])."') ");
				
			echo "OK|".$kode;
		}
	}

?>
<?php include("../../close.php"); ?>