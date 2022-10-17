<?php include("../../../conn.php"); ?>
<?php

    $sqlPendapatanPerubahan=$conn->query("select sum(t_tampung_pendapatan.pagu) as subtotal 
											from anggaran_pendapatan,t_tampung_pendapatan where anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."' 
											and t_tampung_pendapatan.notrans=anggaran_pendapatan.notrans");
    $rsPendapatanPerubahan=$sqlPendapatanPerubahan->fetch_object();
	
	$sqlpaguawal=$conn->query("select sum(total) as subtotalall
						from penetapan_pagu where penetapan_pagu.tahun='".$_SESSION["anggaran_tahun"]."'");
    $rspaguawal=$sqlpaguawal->fetch_object();
	
	$sqlsisapagusetelahbelanja=$conn->query("select sum(pagu) as subtotalall
						from t_tampung_pagu where tahun='".$_SESSION["anggaran_tahun"]."'");
    $rssisapagusetelahbelanja=$sqlsisapagusetelahbelanja->fetch_object();

	$sqlbelanja=$conn->query("select sum(totalkepake) as totalbelanja from(			
											select spjpanjar_rinci.jumlahbelanjapanjar as totalkepake 
											from spjpanjar_heder,spjpanjar_rinci,npdpanjar_rinci
											where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_rinci.nonpdpanjar=npdpanjar_rinci.nonpdpanjar
											and spjpanjar_heder.verif=1 and year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."' group by npdpanjar_rinci.id
											union all											
											select sum(npkls_rinci.total) as totalkepake 
											from npkls_heder,npkls_rinci,npdls_rinci,npdls_heder 
											where npkls_heder.nopencairan=npkls_rinci.nopencairan and 
											npdls_rinci.nonpdls=npdls_heder.nonpdls and npdls_heder.nonpdls=npkls_heder.nonpdls 
											and
											npkls_rinci.nopencairan<>'' and year(npkls_heder.tglpencairan)='".$_SESSION["anggaran_tahun"]."'
											group by npkls_heder.nopencairan,npdls_rinci.itembelanja) as wew");
    $rsbelanja=$sqlbelanja->fetch_object();

    $pendapatanPerubahan=$rsPendapatanPerubahan->subtotal;
	$paguawal=$rspaguawal->subtotalall;
	$totalbelanja=$rsbelanja->totalbelanja;
	$totalpagusaatini=$rssisapagusetelahbelanja->subtotalall;
	$selisih=$pendapatanPerubahan-$totalpagusaatini;
    echo json_encode([
		"pendapatansaatini"=>rpzx($pendapatanPerubahan),
		"paguawal"=>rpzx($paguawal),
        "totalpagusaatini"=>rpzx($rssisapagusetelahbelanja->subtotalall),
		"totalbelanja"=>rpzx($totalbelanja),
		"selisih"=>rpzx($selisih)
    ]);
?>
<?php include("../../../close.php"); ?>