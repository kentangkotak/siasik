<?php include("../../conn.php"); ?>
<?php

		$jumlahspp= str_replace('.','',$_GET['jumlahspp']);
		$tgltrans=in_tanggal("/",trim($_GET['tgltrans']));
		$tglspm=in_tanggal("/",trim($_GET['tglspm']));
	
		
		
			if($_GET['nospm']==''){
				$sql=$conn->query("call nospm(@nomor);");
				$sql=$conn->query("select @nomor as nomor;");
				$jml=$sql->num_rows;
				if($jml>0){ 
					$rs=$sql->fetch_object();
					$counter=$rs->nomor+1;
				}		
					$kode=gennotran($counter,"SPM");
					
					$conn->query("insert into transSpm(noSpm,tglSpm,npwp,uraianPekerjaan,nosppup,tgltransSpp,kdBendaharaKeluar,bendaharapengeluaran,jumlahspp,namabank,norekening,uraian,kduserentry,userentry,tglentry) values(
					'".$kode."','".$tglspm."','".trim($_GET['npwp'])."','".trim($_GET['uraianpekerjaan'])."','".trim($_GET['nosppup'])."',
					'".$tgltrans."','".trim($_GET['nip'])."','".trim($_GET['bendaharapengeluaran'])."','".$jumlahspp."','".trim($_GET['namabank'])."',
					'".trim($_GET['norekening'])."','".trim($_GET['uraianpekerjaan'])."','".$_SESSION["anggaran_kodeuser"]."','".$_SESSION["anggaran_username"]."',
					'".date('Y-m-d H:i:s')."')");
					echo "OK|".$kode;
			}


		
		



?>
<?php include("../../close.php"); ?>