<?php include("../../../conn.php"); ?>
<?php
	
	$sqlpaguawal=$conn->query("
        select 
            total
        from 
            penetapan_pagu 
        where 
            kodekegiatan='".$_GET["kodekegiatan"]."'
            and tahun='".$_SESSION["anggaran_tahun"]."'
    ");
    $rspaguawal=$sqlpaguawal->fetch_object();
	$paguawal=$rspaguawal->total;
	
	$sqlperubahanpagu=$conn->query("
        select pagu from t_tampung_pagu
        where 
            kodekegiatanblud='".$_GET["kodekegiatan"]."'
            and tahun='".$_SESSION["anggaran_tahun"]."'
    ");
    $rsperubahanpagu=$sqlperubahanpagu->fetch_object();
	$perubahanpagu=$rsperubahanpagu->saldo;
	
	$sqlpagurinci=$conn->query("
        select sum(pagu) as saldo from t_tampung
        where 
            kodekegiatanblud='".$_GET["kodekegiatan"]."'
            and tgl='".$_SESSION["anggaran_tahun"]."'
    ");
    $rspagurinci=$sqlpagurinci->fetch_object();
	$pagurinci=$rspagurinci->saldo;
	
	$sqlbelanja=$conn->query("select sum(totalkepake) as totalbelanja from(			
											select sum(spjpanjar_rinci.jumlahbelanjapanjar) as totalkepake 
											from spjpanjar_heder,spjpanjar_rinci 
											where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_heder.kodekegiatanblud='".$_GET["kodekegiatan"]."'
											and year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."'
											union all
											select sum(npdls_rinci.totalls) as totalkepake 
											from npdls_heder,npdls_rinci 
											where npdls_heder.nonpdls=npdls_rinci.nonpdls and npdls_heder.kodekegiatanblud='".$_GET["kodekegiatan"]."'
											and year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."') as wew");
    $rsbelanja=$sqlbelanja->fetch_object();
	$totalbelanja=$rsbelanja->totalbelanja;
	
	$perubahanpagux=$perubahanpagu+$totalbelanja;
	$sisa=$paguawal-$pagurinci;
    echo json_encode([
		"paguawal"=>rp($paguawal),
		"perubahanpagu"=>rp($perubahanpagu),
		"pagurinci"=>rp($pagurinci),
		"sisa"=>rp($sisa)
		
    ]);
?>
<?php include("../../../close.php"); ?>