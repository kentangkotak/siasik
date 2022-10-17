<?php include("../../../conn.php"); ?>
<?php
$tglperubahan=in_tanggal("/",trim($_GET['tglperubahan']));
$harga= str_replace(',','',$_GET['harga']);
$volume= str_replace(',','',$_GET['volume']);
$totallama=$volume*$harga;
$hargabaru= str_replace(',','',$_GET['hargabaru']);
$volumebaru= str_replace(',','',$_GET['volumebaru']);
$totalbaru=$hargabaru*$volumebaru;
$totalanggaran= str_replace(',','',$_GET['totalanggaran']);

$sqlsisa=$conn->query("select notrans,idpp,usulan,kodeblud,volume,harga,pagu,round(sum(totalkepake),2) as kepake,round(pagu-sum(totalkepake),2) as sisa from(
        select t_tampung.notrans as notrans,t_tampung.idpp as idpp,t_tampung.usulan as usulan,t_tampung.kodekegiatanblud as kodeblud,
        t_tampung.volume as volume,t_tampung.harga as harga,t_tampung.pagu as pagu,'' as totalkepake
        from t_tampung
        where tgl='".$_SESSION["anggaran_tahun"]."'
        union all
		select '' as notrans,npdpanjar_rinci.idpp as idpp,'' as usulan,'' as kodeblud,'' as volume,'' as harga,'' as pagu,
		sum(npdpanjar_rinci.totalpermintaanpanjar) as totalkepake 
		from spjpanjar_heder,spjpanjar_rinci,npdpanjar_rinci
		where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_rinci.nonpdpanjar=npdpanjar_rinci.nonpdpanjar
		and spjpanjar_heder.verif=1 and year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."' group by npdpanjar_rinci.id
		union all
		select '' as notrans,npdls_rinci.idserahterima_rinci as idpp,'' as usulan,
		'' as kodeblud,'' as volume,
		'' as harga,'' as pagu,
		sum(npdls_rinci.totalls) as totalkepake
		from npdls_rinci,npdls_heder,npkls_rinci,npkls_heder
		where npdls_rinci.nonpdls=npdls_heder.nonpdls and npdls_heder.nonpdls=npkls_rinci.nonpdls 
		and npkls_heder.nonpk=npkls_rinci.nonpk
		and year(npkls_heder.tglnpk)='".$_SESSION["anggaran_tahun"]."' group by npdls_rinci.idserahterima_rinci) as wew where notrans='".trim($_GET['notrans'])."' and idpp='".$_GET['idpp']."' group by idpp");
$rssisa=$sqlsisa->fetch_object();
$sisapagu=$rssisa->sisa;

$sqlpagu=$conn->query("select  sum(pagu) as pagu from t_tampung where tgl='".$_SESSION["anggaran_tahun"]."' and kodekegiatanblud='".trim($_GET['kodekegiatan'])."'");
$rspagu=$sqlpagu->fetch_object();
$pagu=$rspagu->pagu;

$sqlpaguawal=$conn->query("select  sum(pagu) as pagu from t_tampung_pagu where tahun='".$_SESSION["anggaran_tahun"]."' and kodekegiatanblud='".trim($_GET['kodekegiatan'])."'");
$rspaguawal=$sqlpaguawal->fetch_object();
$paguawal=$rspaguawal->pagu;

$yangbisadigeser=$paguawal-$pagu;
// $sqlbelanja=$conn->query("select sum(totalkepake) as totalbelanja from(			
										// select sum(spjpanjar_rinci.jumlahbelanjapanjar) as totalkepake 
										// from spjpanjar_heder,spjpanjar_rinci 
										// where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_heder.kodekegiatanblud='".$_GET["kodekegiatan"]."'
										// and year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."'
										// union all
										// select sum(npdls_rinci.totalls) as totalkepake 
										// from npdls_heder,npdls_rinci 
										// where npdls_heder.nonpdls=npdls_rinci.nonpdls and npdls_heder.kodekegiatanblud='".$_GET["kodekegiatan"]."'
										// and year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."') as wew");
// $rsbelanja=$sqlbelanja->fetch_object();
// $totalbelanja=$rsbelanja->totalbelanja;

$xxx=$yangbisadigeser+$totalbaru-$totallama;

	if($totalbaru < $totalanggaran){
		if($totalbaru > $sisapagu){
			echo "MAAF PAGU ANDA TIDAK MENCUKUPI, SISA PAGU ANDA SEBESAR ".rpzx($sisapagu);
		}else{
		
			$kode=time()."/P-RINCIANBELANJA";
			if($_GET['idpp'] == ''){
				$idpp=time()."X";
				
				$conn->query("insert into t_tampung(notrans,idpp,usulan,pagu,koderek108,koderek50,kodekegiatanblud,tgl,volume,harga,satuan) values('".trim($_GET['notrans'])."','".$idpp."',
								'".trim($_GET['usulan'])."','".$totalbaru."',
								'".trim($_GET['koderek108'])."','".trim($_GET['koderek50'])."','".trim($_GET['kodekegiatan'])."','".$_SESSION["anggaran_tahun"]."',
								'".trim($volumebaru)."','".trim($hargabaru)."','".trim($_GET['satuan'])."')");
								
				$conn->query("insert into perubahanrincianbelanja(noperubahan,notrans,tglperubahan,usulan,volume,harga,nilai,volumebaru,hargabaru,totalbaru,selisih,
				koderek108,uraian108,koderek50,uraian50,jumlahacc,tgl_entry,user_entry,satuan,nousulan,kodepptk,pptk,kodekegiatanblud,uraianblud,kodebidang,bidang,idpp,statusperubahan) 
				values('".$kode."','".trim($_GET['notrans'])."','".trim($tglperubahan)."','".trim($_GET['usulan'])."','".trim($volume)."','".trim($harga)."','".$saldo."',
				'".trim($volumebaru)."','".trim($hargabaru)."','".trim($totalbaru)."','".trim($selisih)."',
				'".trim($_GET['koderek108'])."',
				'".trim($_GET['uraianrek108'])."','".trim($_GET['koderek50'])."','".trim($_GET['uraianrek50'])."','','".date('Y-m-d H:i:s')."',
				'".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['satuan'])."','".trim($_GET['nousulan'])."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."',
				'".trim($_GET['kodekegiatan'])."','".trim($_GET['kegiatan'])."','".trim($_GET['kodebidang'])."','".trim($_GET['namabidang'])."','".trim($idpp)."','1')");
				
				echo "OK|";
			}else{
				$conn->query("update t_tampung set pagu='".trim($totalbaru)."',volume='".trim($volumebaru)."',harga='".trim($hargabaru)."',koderek108='".trim($_GET['koderek108'])."',
							  koderek50='".trim($_GET['koderek50'])."',satuan='".trim($_GET['satuan'])."' where notrans='".trim($_GET['notrans'])."' and kodekegiatanblud='".trim($_GET['kodekegiatan'])."'
								and idpp='".trim($_GET['idpp'])."'");
								
				$conn->query("insert into perubahanrincianbelanja(noperubahan,notrans,tglperubahan,usulan,volume,harga,nilai,volumebaru,hargabaru,totalbaru,selisih,
				koderek108,uraian108,koderek50,uraian50,jumlahacc,tgl_entry,user_entry,satuan,nousulan,kodepptk,pptk,kodekegiatanblud,uraianblud,kodebidang,bidang,idpp,statusperubahan) 
				values('".$kode."','".trim($_GET['notrans'])."','".trim($tglperubahan)."','".trim($_GET['usulan'])."','".trim($volume)."','".trim($harga)."','".$saldo."',
				'".trim($volumebaru)."','".trim($hargabaru)."','".trim($totalbaru)."','".trim($selisih)."',
				'".trim($_GET['koderek108'])."',
				'".trim($_GET['uraianrek108'])."','".trim($_GET['koderek50'])."','".trim($_GET['uraianrek50'])."','','".date('Y-m-d H:i:s')."',
				'".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['satuan'])."','".trim($_GET['nousulan'])."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."',
				'".trim($_GET['kodekegiatan'])."','".trim($_GET['kegiatan'])."','".trim($_GET['kodebidang'])."','".trim($_GET['namabidang'])."','".trim($_GET['idpp'])."','1')");
				
				echo "OK|";
			}
		}
	}else{ //echo "(paggu awal- totalrincianpagu) ".rp($yangbisadigeser)." (nilai yang di input) ".rp($totalbaru)." (kumpulan rrincianbelanja) ".rp($paguawal);
		if($totalbaru > $xxx){
			echo "MAAF SALDO ANDA TIDAK MENCUKUPI, SISA SALDO ANDA SEBESAR ".rpzx($yangbisadigeser);
		}else{

			$kode=time()."/P-RINCIANBELANJA";
			
			if($_GET['idpp'] == ''){
				$idpp=time()."X";
				$conn->query("insert into t_tampung(notrans,idpp,usulan,pagu,koderek108,koderek50,kodekegiatanblud,tgl,volume,harga,satuan) values('".trim($_GET['notrans'])."','".$idpp."','".trim($_GET['usulan'])."','".$totalbaru."',
								'".trim($_GET['koderek108'])."','".trim($_GET['koderek50'])."','".trim($_GET['kodekegiatan'])."','".$_SESSION["anggaran_tahun"]."',
								'".trim($volumebaru)."','".trim($hargabaru)."','".trim($_GET['satuan'])."')");
				$conn->query("insert into perubahanrincianbelanja(noperubahan,notrans,tglperubahan,usulan,volume,harga,nilai,volumebaru,hargabaru,totalbaru,selisih,
				koderek108,uraian108,koderek50,uraian50,jumlahacc,tgl_entry,user_entry,satuan,nousulan,kodepptk,pptk,kodekegiatanblud,uraianblud,kodebidang,bidang,idpp,statusperubahan) 
				values('".$kode."','".trim($_GET['notrans'])."','".trim($tglperubahan)."','".trim($_GET['usulan'])."','".trim($volume)."','".trim($harga)."','".$saldo."',
				'".trim($volumebaru)."','".trim($hargabaru)."','".trim($totalbaru)."','".trim($selisih)."',
				'".trim($_GET['koderek108'])."',
				'".trim($_GET['uraianrek108'])."','".trim($_GET['koderek50'])."','".trim($_GET['uraianrek50'])."','','".date('Y-m-d H:i:s')."',
				'".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['satuan'])."','".trim($_GET['nousulan'])."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."',
				'".trim($_GET['kodekegiatan'])."','".trim($_GET['kegiatan'])."','".trim($_GET['kodebidang'])."','".trim($_GET['namabidang'])."','".trim($idpp)."','1')");
				
				echo "OK|";
			}else{
				$conn->query("update t_tampung set pagu='".$totalbaru."',volume='".trim($volumebaru)."',harga='".trim($hargabaru)."',koderek108='".trim($_GET['koderek108'])."',
							  koderek50='".trim($_GET['koderek50'])."',satuan='".trim($_GET['satuan'])."'
								where notrans='".trim($_GET['notrans'])."' and 
								kodekegiatanblud='".trim($_GET['kodekegiatan'])."'
								and idpp='".trim($_GET['idpp'])."' ");
								
				$conn->query("insert into perubahanrincianbelanja(noperubahan,notrans,tglperubahan,usulan,volume,harga,nilai,volumebaru,hargabaru,totalbaru,selisih,
				koderek108,uraian108,koderek50,uraian50,jumlahacc,tgl_entry,user_entry,satuan,nousulan,kodepptk,pptk,kodekegiatanblud,uraianblud,kodebidang,bidang,idpp,statusperubahan) 
				values('".$kode."','".trim($_GET['notrans'])."','".trim($tglperubahan)."','".trim($_GET['usulan'])."','".trim($volume)."','".trim($harga)."','".$saldo."',
				'".trim($volumebaru)."','".trim($hargabaru)."','".trim($totalbaru)."','".trim($selisih)."',
				'".trim($_GET['koderek108'])."',
				'".trim($_GET['uraianrek108'])."','".trim($_GET['koderek50'])."','".trim($_GET['uraianrek50'])."','','".date('Y-m-d H:i:s')."',
				'".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['satuan'])."','".trim($_GET['nousulan'])."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."',
				'".trim($_GET['kodekegiatan'])."','".trim($_GET['kegiatan'])."','".trim($_GET['kodebidang'])."','".trim($_GET['namabidang'])."','".trim($_GET['idpp'])."','1')");
				
				echo "OK|";
			}	
		}
	}

	
?>
<?php include("../../../close.php"); ?>