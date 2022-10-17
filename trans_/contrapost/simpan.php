<?php include "../../conn.php";?>
<?php
	if($_GET['jenis'] == 'LS'){
		$sql=$conn->query("select npdls_heder.nonpdls as nonpd,npdls_heder.tglnpdls as tglnpd,npdls_heder.kodepptk as kodepptk,npdls_heder.pptk as pptk,
						npdls_heder.program as program,npdls_heder.kegiatan as kegiatan,npdls_heder.kodekegiatanblud as kodekegiatanblud,
						npdls_heder.kegiatanblud as kegiatanblud,npdls_rinci.koderek50 as koderek50,npdls_rinci.rincianbelanja as rincianbelanja,npdls_rinci.itembelanja as itembelanja,
						npdls_rinci.volume as volume,npdls_rinci.satuan as satuan,npdls_rinci.harga as harga,npdls_rinci.total as total,npdls_rinci.nominalpembayaran as nominalygdibayarkan,
						npdls_rinci.idserahterima_rinci as idpp,npdls_rinci.koderek108 as koderek108,npdls_rinci.uraian108 as uraian108
						from npdls_heder,npdls_rinci
						where npdls_heder.nonpdls=npdls_rinci.nonpdls and npdls_heder.nonpdls='".$_GET['nonpd']."' and npdls_rinci.koderek50='".$_GET['koderek50']."' 
						and npdls_rinci.idserahterima_rinci='".$_GET['idpp']."' group by npdls_heder.nonpdls,npdls_rinci.idserahterima_rinci");
	}else{
		$sql=$conn->query("select npdpanjar_heder.nonpdpanjar as nonpd,npdpanjar_heder.tglnpdpanjar as tglnpd,npdpanjar_heder.kodepptk as kodepptk,npdpanjar_heder.pptk as pptk,
						npdpanjar_heder.program as program,npdpanjar_heder.kegiatan as kegiatan,npdpanjar_heder.kodekegiatanblud as kodekegiatanblud,
						npdpanjar_heder.kegiatanblud as kegiatanblud,npdpanjar_rinci.koderek50 as koderek50,npdpanjar_rinci.rincianbelanja50 as rincianbelanja,npdpanjar_rinci.itembelanja as itembelanja,
						npdpanjar_rinci.volume as volume,npdpanjar_rinci.satuan as satuan,npdpanjar_rinci.harga as harga,npdpanjar_rinci.total as total,npdpanjar_rinci.total as nominalpembayaran,
						npdpanjar_rinci.idpp as idpp
						from npdpanjar_heder,npdpanjar_rinci
						where npdpanjar_heder.nonpdpanjar=npdpanjar_rinci.nonpdpanjar and npdpanjar_heder.nonpdpanjar='".$_GET['nonpd']."' and npdpanjar_rinci.koderek50='".$_GET['koderek50']."' 
						and npdpanjar_rinci.idpp='".$_GET['idpp']."' group by npdpanjar_heder.nonpdpanjar,npdpanjar_rinci.idpp");
	}
	$rs=$sql->fetch_object();
	$nocontrapost=time().'CONTRA-POST';
	$tglcontrapost=in_tanggal("/",trim($_GET['tglcontrapost']));
	$nonpd=$rs->nonpd;
	$tglnpd=$rs->tglnpd;
	$kodepptk=$rs->kodepptk;
	$pptk=$rs->pptk;
	$program=$rs->program;
	$kegiatan=$rs->kegiatan;
	$kodekegiatanblud=$rs->kodekegiatanblud;
	$kegiatanblud=$rs->kegiatanblud;
	$koderek50=$rs->koderek50;
	$rincianbelanja=$rs->rincianbelanja;
	$itembelanja=$rs->itembelanja;
	$volume=$rs->volume;
	$satuan=$rs->satuan;
	$harga=$rs->harga;
	$total=$rs->total;
	$nominalpembayaran=$rs->nominalygdibayarkan;
	$idpp=$rs->idpp;
	$nominalcontrapost=str_replace(',','',$_GET['nominal']);
	//$tglentry='".date('Y-m-d H:i:s')."';
	//$userentry=$_SESSION["anggaran_kodeuser"];
	$jenisbelanja=$_GET['jenis'];
	
	$sqlcek=$conn->query("select * from contrapost where nonpd='".$nonpd."' and idpp='".$idpp."'");
	$jml=$sql->num_rows;
	if($jml == 0){ 
		echo "MAAF UNTUK RINCIAN BELANJA ".$rincianbelanja." DENGAN NO NPD ".$nonpd." SUDAH PERNAH DI CONTRAPOST KAN....!!!";
	}else{
		$conn->query("insert into contrapost(nocontrapost,tglcontrapost,nonpd,tglnpd,kodepptk,pptk,program,kegiatan,
					kodekegiatanblud,kegiatanblud,jenisbelanja,koderek50,rincianbelanja,itembelanja,volume,satuan,harga,total,nominalygdibayarkan,
					idpp,nominalcontrapost,tglenrty,userentry) 
					values('".trim($nocontrapost)."','".trim($tglcontrapost)."','".trim($nonpd)."','".trim($tglnpd)."','".trim($kodepptk)."',
					'".trim($pptk)."','".trim($program)."',
					'".trim($kegiatan)."','".trim($kodekegiatanblud)."','".trim($kegiatanblud)."','".trim($jenisbelanja)."','".trim($koderek50)."','".trim($rincianbelanja)."','".trim($itembelanja)."',
					'".trim($volume)."','".trim($satuan)."','".trim($harga)."','".trim($total)."',
					'".trim($nominalpembayaran)."','".trim($idpp)."','".trim($nominalcontrapost)."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
					
					echo "OK|".trim($nocontrapost);
	}	
		
		
	
	
?>
<?php include "../../close.php";?>