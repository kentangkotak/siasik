<?php include("../../../conn.php"); ?>
<?php

$sqlv=$conn->query("select * from(
					select idpp,usulan,round(sum(paguterakhir),2) as paguterakhirx,round(sum(realisasi),2) as realisasix,round(sum(paguterakhir)-sum(realisasi),2) as sisaanggaran,
					round(sum(npdbelumcair),2) as npdbelumcairx,round((sum(paguterakhir)-sum(realisasi))+sum(npdbelumcair),2) as pagualokasi from(
						select idpp,usulan as usulan,sum(pagu) as paguterakhir,'' as realisasi,'' as sisaanggaran,'' as npdbelumcair,'' as pagualokasi
						from t_tampung
						where tgl='".$_SESSION["anggaran_tahun"]."' and kodekegiatanblud='".$_GET['kodekegiatanblud']."'
						union all
						select spjpanjar_rinci.iditembelanjanpd as idpp,'' as usulan,'' as paguterakhir,sum(spjpanjar_rinci.jumlahbelanjapanjar) as realisasi,'' as sisaanggaran,'' as npdbelumcair,'' as pagualokasi
						from spjpanjar_heder,spjpanjar_rinci
						where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_heder.kodekegiatanblud='".$_GET['kodekegiatanblud']."' and year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."'
						union all
						select npdls_rinci.idserahterima_rinci as idpp,'' as usulan,'' as paguterakhir,sum(npdls_rinci.nominalpembayaran) as realisasi,'' as sisaanggaran,'' as npdbelumcair,'' as pagualokasi
						from npdls_heder,npdls_rinci
						where npdls_heder.nonpdls=npdls_rinci.nonpdls and npdls_heder.kodekegiatanblud='".$_GET['kodekegiatanblud']."' and year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."' and npdls_heder.nopencairan<>''
						union all
						select npdls_rinci.idserahterima_rinci as idpp,'' as usulan,'' as paguterakhir,'' as realisasi,'' as sisaanggaran,sum(npdls_rinci.nominalpembayaran) as npdbelumcair,'' as pagualokasi
						from npdls_heder,npdls_rinci
						where npdls_heder.nonpdls=npdls_rinci.nonpdls and npdls_heder.kodekegiatanblud='".$_GET['kodekegiatanblud']."' and year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."' and npdls_heder.nopencairan=''
					) as xxx ) as wew ");
$rsv=$sqlv->fetch_object();
$realisasilalu=$rsv->realisasix;
$npdbelumcair=$rsv->npdbelumcairx;

$limitbawah=$rsv->realisasix+$rsv->npdbelumcairx;

$nominal= str_replace(',','',$_GET['nilairupiah']);
$sql_cek=$conn->query("select * from anggaran_pendapatan_pak where tahun='".$_SESSION["anggaran_tahun"]."' ");
$cek=$sql_cek->num_rows; 
$sql_cekx=$conn->query("select * from penetapan_pagu_pak where tahun='".$_SESSION["anggaran_tahun"]."' and kodekegiatan='".trim($_GET['kodekegiatanblud'])."' ");
$cekx=$sql_cekx->num_rows;

if($cek == 0){
	echo "PENDAPATAN UNTUK BIDANG ANDA BELUM TERENTRY UNTUK TAHUN DEPAN....!!";
}elseif($cekx > 0 && $_GET['x'] == ''){
	echo "MAAF KEGIATAN INI SUDAH DITETAPKAN PAGUNYA PADA TAHUN INI...!!!";
}elseif($nominal < $limitbawah){
	echo "MAAF PAGU BELANJA TIDAK BOLEH KURANG  DARI REALISASI SEBELUM PAK DAN PENGAJUAN NPD BERJALAN...!!!";
}else{
	$sql_max=$conn->query("select sum(pendapatan) as pendapatanx from(
							select sum(nilai) as pendapatan from anggaran_pendapatan_pak where tahun='".$_SESSION["anggaran_tahun"]."'
							union all
							select sum(nominal) as pendapatan from silpa where year(tanggal)='".$_SESSION["anggaran_tahun"]."'
							) as wew");
	$rs_max=$sql_max->fetch_object();
	if($rs_max->pendapatanx < $nominal){
		echo "MAAF PAGU ANDA TELAH MELEBIHI PENDAPATAN DIBIDANG....!!!PENDAPATAN PAK SEBESAR: ".rpzx($rs_max->pendapatanx);
	}else{
		if($_GET['notrans']==''){
			$sql=$conn->query("call penetapan_pagu(@nomor);");
			$sql=$conn->query("select @nomor as nomor;");
			$jml=$sql->num_rows;
			if($jml>0){ 
				$rs=$sql->fetch_object();
				$counter=$rs->nomor+1;
			}		
			$kode=gennotran($counter,"PG");
			
			$conn->query("insert into penetapan_pagu_pak(notrans,kodekegiatan,kegiatanblud,kodeorganisasi1,kodeorganisasi2,kodeorganisasi3,namaorganisasi,total,tahun,tgl_entry,user_entry) values(
			'".$kode."','".trim($_GET['kodekegiatanblud'])."','".trim($_GET['kegiatanblud'])."','".trim($_GET['kode1'])."','".trim($_GET['kode2'])."','".trim($_GET['kode3'])."',
			'".trim($_GET['organisasi_nama'])."','".$nominal."',
			'".$_SESSION["anggaran_tahun"]."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
			
			$conn->query("insert into t_tampung_pagu_pak(kodekegiatanblud,pagu,tahun) values(
			'".trim($_GET['kodekegiatanblud'])."','".$nominal."','".$_SESSION["anggaran_tahun"]."')");
			echo "OK|".$kode;
		}else{
			$conn->query("update penetapan_pagu_pak set kodekegiatan='".trim($_GET['kodekegiatanblud'])."',kegiatanblud='".trim($_GET['kegiatanblud'])."',kodeorganisasi1='".trim($_GET['kode1'])."',
			kodeorganisasi2='".trim($_GET['kode2'])."',kodeorganisasi3='".trim($_GET['kode3'])."',namaorganisasi='".trim($_GET['organisasi_nama'])."',total='".$nominal."' 
			where notrans='".$_GET['notrans']."'");
			
			$conn->query("update t_tampung_pagu_pak set pagu='".$nominal."' where kodekegiatanblud='".$_GET['kodekegiatanblud']."' and tahun='".$_SESSION["anggaran_tahun"]."'");
			
			echo "OK|".$kode;
		}
	}
}



?>
<?php include("../../../close.php"); ?>