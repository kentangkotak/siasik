<?php include("../../../conn.php"); ?>
<?php

$nominal= str_replace(',','',$_GET['nilairupiah']);
$nilaiperubahan= str_replace(',','',$_GET['nilaiperubahan']);
$selisih= $nilaiperubahan - $nominal;
$sqlbelanjaall=$conn->query("select sum(totalkepake) as totalbelanja from(			
											select spjpanjar_rinci.jumlahbelanjapanjar as totalkepake 
											from spjpanjar_heder,spjpanjar_rinci,npdpanjar_rinci
											where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_rinci.nonpdpanjar=npdpanjar_rinci.nonpdpanjar
											and spjpanjar_heder.verif=1 and year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."' 
											and spjpanjar_heder.kodekegiatanblud='".trim($_GET['kodekegiatanblud'])."'
											group by npdpanjar_rinci.id
											union all
											select npdls_rinci.nominalpembayaran as totalkepake 
											from npdls_heder,npdls_rinci 
											where npdls_heder.nonpdls=npdls_rinci.nonpdls 
											and npdls_heder.kodekegiatanblud='".$_GET["kodekegiatanblud"]."' 
											and year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."') as wew");
$rsbelanjaall=$sqlbelanjaall->fetch_object();
$belanjaall=$rsbelanjaall->totalbelanja;


$sqlbelanja=$conn->query("select sum(totalkepake) as totalbelanja from(			
											select spjpanjar_rinci.jumlahbelanjapanjar as totalkepake 
											from spjpanjar_heder,spjpanjar_rinci,npdpanjar_rinci
											where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_rinci.nonpdpanjar=npdpanjar_rinci.nonpdpanjar
											and spjpanjar_heder.verif=1 and year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."' 
											and spjpanjar_heder.kodekegiatanblud='".trim($_GET['kodekegiatanblud'])."'
											group by npdpanjar_rinci.id
											union all
											select npdls_rinci.nominalpembayaran as totalkepake 
											from npdls_heder,npdls_rinci 
											where npdls_heder.nonpdls=npdls_rinci.nonpdls 
											and npdls_heder.kodekegiatanblud='".$_GET["kodekegiatanblud"]."' 
											and year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."') as wew");
$rsbelanja=$sqlbelanja->fetch_object();
$belanjaperpagu=$rsbelanja->totalbelanja;
$sisapaguperkegiatan=$nominal-$belanjaperpagu;

$sqlPendapatan=$conn->query("select sum(pagu) as pendapatan from t_tampung_pendapatan where tahun='".$_SESSION["anggaran_tahun"]."' ");
$rsPendapatan=$sqlPendapatan->fetch_object();
$totalpendapatan=$rsPendapatan->pendapatan;

$sisalpaguall=$totalpendapatan-$belanjaall;

$sqlPaguall=$conn->query("select sum(pagu) as paguall from t_tampung_pagu where tahun='".$_SESSION["anggaran_tahun"]."' ");
$rsPaguall=$sqlPaguall->fetch_object();
$paguall=$rsPaguall->paguall;
$paguall_x=$paguall-$nominal+$nilaiperubahan;



if($nilaiperubahan > $nominal){
	if($paguall_x > $totalpendapatan){
		echo "MAAF SALDO ANDA TIDAK MENCUKUPI....!!!SISA SALDO ANDA SEBESAR".rpzx($sisalpaguall);
	}else{
		$sql=$conn->query("call perubahanpagu(@nomor);");
		$sql=$conn->query("select @nomor as nomor;");
		$jml=$sql->num_rows;
		if($jml>0){ 
			$rs=$sql->fetch_object();
			$counter=$rs->nomor+1;
		}
		$kode=gennotran($counter,"PEGU");
		$conn->query("insert into perubahanpagu(noperubahan,notransawal,tglperubahan,kodekegiatan,kegiatanblud,kodeorganisasi1,kodeorganisasi2,kodeorganisasi3,namaorganisasi,total,perubahan,selisih,tahun,tgl_entry,user_entry,statusperubahan) values(
		'".$kode."','".trim($_GET['notrans'])."','".date('Y-m-d H:i:s')."','".trim($_GET['kodekegiatanblud'])."','".trim($_GET['kegiatanblud'])."','".trim($_GET['kode1'])."','".trim($_GET['kode2'])."','".trim($_GET['kode3'])."',
		'".trim($_GET['organisasi_nama'])."','".$nominal."','".$nilaiperubahan."','".$selisih."',
		'".$_SESSION["anggaran_tahun"]."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','1')");
		
		$conn->query("update t_tampung_pagu set pagu='".$nilaiperubahan."' where kodekegiatanblud='".trim($_GET['kodekegiatanblud'])."'");
		echo "OK|";
		//echo rpx($paguall_x)." ".rpx($totalpendapatan);
	}
}else{
	if($belanjaperpagu > $nilaiperubahan){
		echo "MAAF SALDO ANDA TIDAK MENCUKUPI, SISA SALDO ANDA SEBESAR ".rpzx($sisapaguperkegiatan);
	}else{
		
		$sql=$conn->query("call perubahanpagu(@nomor);");
		$sql=$conn->query("select @nomor as nomor;");
		$jml=$sql->num_rows;
		if($jml>0){ 
			$rs=$sql->fetch_object();
			$counter=$rs->nomor+1;
		}
		$kode=gennotran($counter,"PEGU");
		$conn->query("insert into perubahanpagu(noperubahan,notransawal,tglperubahan,kodekegiatan,kegiatanblud,kodeorganisasi1,kodeorganisasi2,kodeorganisasi3,namaorganisasi,total,perubahan,selisih,tahun,tgl_entry,user_entry,statusperubahan) values(
		'".$kode."','".trim($_GET['notrans'])."','".date('Y-m-d H:i:s')."','".trim($_GET['kodekegiatanblud'])."','".trim($_GET['kegiatanblud'])."','".trim($_GET['kode1'])."','".trim($_GET['kode2'])."','".trim($_GET['kode3'])."',
		'".trim($_GET['organisasi_nama'])."','".$nominal."','".$nilaiperubahan."','".$selisih."',
		'".$_SESSION["anggaran_tahun"]."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','1')");
		
		$conn->query("update t_tampung_pagu set pagu='".$nilaiperubahan."' where kodekegiatanblud='".trim($_GET['kodekegiatanblud'])."'");
		echo "OK|";
	}
}




?>
<?php include("../../../close.php"); ?>