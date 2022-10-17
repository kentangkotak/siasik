<?php include("../../../conn.php"); ?>
<?php

	$tanggaltrans=in_tanggal("/",trim($_GET['tgltrans']));
	$harga= str_replace(',','',$_GET['harga']);
	$volume= str_replace('.','',$_GET['volume']);
	$nilai=$harga * $volume;
	$data=explode( '|', $_GET['bidangPengusul'] );
	$unit=$data[0];
	$kdUnit=$data[1];
	
	$paguterakhir= str_replace(',','',$_GET['paguterakhir']);
	$realisasi= str_replace(',','',$_GET['realisasi']);
	$sisaanggaran= str_replace(',','',$_GET['sisaanggaran']);
	$npdbelumcair= str_replace(',','',$_GET['npdbelumcair']);
	$pagualokasi= str_replace(',','',$_GET['pagualokasi']);
	
	if($_GET['idpp'] == ''){
		$idpp=time()."-RPAK";
		
		if($nilai < $realisasi){
			echo "LAKUKAN PERGESERAN (TAMBAH ANGGARAN LAMA) atau TURUNKAN PAGU BARU...!!!";
		}else{
			if($_GET['notrans']==''){
				$sql=$conn->query("call usulan_honor(@nomor);");
				$sql=$conn->query("select @nomor as nomor;");
				$jml=$sql->num_rows;
				if($jml>0){ 
					$rs=$sql->fetch_object();
					$counter=$rs->nomor+1;
				}		
				$kode=gennotran($counter,"UL-PAK");
				
				$sql_cek=$conn->query("select * from usulanHonor_h_pak where kodeKegiatan='".trim($_GET['kodekegiatan'])."' and year(tglTransaksi)='".$_SESSION["anggaran_tahun"]."'");
				$jml=$sql_cek->num_rows;
				if($jml >0){
					echo "MAAF KEGIATAN INI SUDAH PERNAH DI INPUT, JIKA ANDA INGIN MENAMBAH RINCIAN KEGIATAN INPUT DI NOTA KEGIATAN YANG SUDAH DIINPUT...!!!";
				}else{
					$conn->query("insert into usulanHonor_h_pak(notrans,kodeRuangan,ruangan,tglTransaksi,kodeKegiatan,kegiatan,kodebagian,organisasi_nama,kode50,uraian,userEntry,tglEntry) 
					values('".$kode."','".trim($_GET['koderuang'])."','".trim($_GET['ruangan'])."','".$tanggaltrans."','".trim($_GET['kodekegiatan'])."',
					'".trim($_GET['kegiatan'])."','".trim($_GET['kodebagian'])."','".trim($_GET['organisasi_nama'])."','".trim($_GET['kode50'])."',
					'".trim($_GET['uraian'])."','".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."')");
					
					$conn->query("insert into usulanHonor_r_pak(notrans,keterangan,volume,harga,nilai,tglEntry,userEntry,satuan,kodebidangpengusul,bidangPengusul,
					idpp,paguterakhir,realisasi,sisaanggaran,npdbelumcair,pagualokasi,koderek50,uraian50,koderek108,uraian108) values('".$kode."','".trim($_GET['keterangan'])."','".trim($volume)."',
					'".$harga."','".$nilai."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['satuan'])."','".$unit."','".$kdUnit."',
					'".trim($idpp)."','".$paguterakhir."','".$realisasi."','".$sisaanggaran."','".$npdbelumcair."','".$pagualokasi."','".trim($_GET['koderek50'])."',
					'".trim($_GET['uraian50'])."','".trim($_GET['koderek108'])."','".trim($_GET['uraian108'])."')");
					
					echo "OK|".$kode;
				}
			}else{
				$kode=$_GET['notrans'];
				
				$sql_cek=$conn->query("select * from usulanHonor_r_pak where notrans='".$kode."' and idpp='".trim($idpp)."'");
				$jml=$sql_cek->num_rows;
				if($jml > 0){
					echo "MAAF RINCIAN KEGIATAN INI SUDAH PERNAH DI INPUT...!!!";
				}else{
					$conn->query("insert into usulanHonor_r_pak(notrans,keterangan,volume,harga,nilai,tglEntry,userEntry,satuan,kodebidangpengusul,bidangPengusul,
					idpp,paguterakhir,realisasi,sisaanggaran,npdbelumcair,pagualokasi,koderek50,uraian50,koderek108,uraian108) values('".$kode."','".trim($_GET['keterangan'])."','".trim($volume)."',
					'".$harga."','".$nilai."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['satuan'])."','".$unit."','".$kdUnit."',
					'".trim($idpp)."','".$paguterakhir."','".$realisasi."','".$sisaanggaran."','".$npdbelumcair."','".$pagualokasi."','".trim($_GET['koderek50'])."',
					'".trim($_GET['uraian50'])."','".trim($_GET['koderek108'])."','".trim($_GET['uraian108'])."')");
					echo "OK|".$kode;
				}
				
			}
		}
	}else{
		if($nilai < $realisasi){
		echo "LAKUKAN PERGESERAN (TAMBAH ANGGARAN LAMA) atau TURUNKAN PAGU BARU...!!!";
	}else{
		if($_GET['notrans']==''){
				$sql=$conn->query("call usulan_honor(@nomor);");
				$sql=$conn->query("select @nomor as nomor;");
				$jml=$sql->num_rows;
				if($jml>0){ 
					$rs=$sql->fetch_object();
					$counter=$rs->nomor+1;
				}		
				$kode=gennotran($counter,"UL-PAK");
				
				$conn->query("insert into usulanHonor_h_pak(notrans,kodeRuangan,ruangan,tglTransaksi,kodeKegiatan,kegiatan,kodebagian,organisasi_nama,kode50,uraian,userEntry,tglEntry) 
				values('".$kode."','".trim($_GET['koderuang'])."','".trim($_GET['ruangan'])."','".$tanggaltrans."','".trim($_GET['kodekegiatan'])."',
				'".trim($_GET['kegiatan'])."','".trim($_GET['kodebagian'])."','".trim($_GET['organisasi_nama'])."','".trim($_GET['kode50'])."',
				'".trim($_GET['uraian'])."','".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."')");
				
				$conn->query("insert into usulanHonor_r_pak(notrans,keterangan,volume,harga,nilai,tglEntry,userEntry,satuan,kodebidangpengusul,bidangPengusul,
				idpp,paguterakhir,realisasi,sisaanggaran,npdbelumcair,pagualokasi,koderek50,uraian50,koderek108,uraian108) values('".$kode."','".trim($_GET['keterangan'])."','".trim($volume)."',
				'".$harga."','".$nilai."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['satuan'])."','".$unit."','".$kdUnit."',
				'".trim($_GET['idpp'])."','".$paguterakhir."','".$realisasi."','".$sisaanggaran."','".$npdbelumcair."','".$pagualokasi."','".trim($_GET['koderek50'])."',
				'".trim($_GET['uraian50'])."','".trim($_GET['koderek108'])."','".trim($_GET['uraian108'])."')");
				
				echo "OK|".$kode;
			}else{
				$kode=$_GET['notrans'];
				
				$sql_cek=$conn->query("select * from usulanHonor_r_pak where notrans='".$kode."' and idpp='".trim($_GET['idpp'])."'");
				$jml=$sql_cek->num_rows;
				if($jml > 0){
					echo "MAAF RINCIAN KEGIATAN INI SUDAH PERNAH DI INPUT...!!!";
				}else{
					$conn->query("insert into usulanHonor_r_pak(notrans,keterangan,volume,harga,nilai,tglEntry,userEntry,satuan,kodebidangpengusul,bidangPengusul,
					idpp,paguterakhir,realisasi,sisaanggaran,npdbelumcair,pagualokasi,koderek50,uraian50,koderek108,uraian108) values('".$kode."','".trim($_GET['keterangan'])."','".trim($volume)."',
					'".$harga."','".$nilai."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['satuan'])."','".$unit."','".$kdUnit."',
					'".trim($_GET['idpp'])."','".$paguterakhir."','".$realisasi."','".$sisaanggaran."','".$npdbelumcair."','".$pagualokasi."','".trim($_GET['koderek50'])."',
					'".trim($_GET['uraian50'])."','".trim($_GET['koderek108'])."','".trim($_GET['uraian108'])."')");
					echo "OK|".$kode;
				}
				
			}
		}
	}
		
		
		
	

?>
<?php include("../../../close.php"); ?>