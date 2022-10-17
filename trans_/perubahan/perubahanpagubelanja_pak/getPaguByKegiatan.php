<?php include("../../../conn.php"); ?>
<?php

    $sqlPendapatanPerubahan=$conn->query("
        select sum(total) as subtotal from(
			select nilai as total from anggaran_pendapatan where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='' and statusperubahan_pak=''
			union all
			select nilaibaru  as total from perubahan where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1' and statusperubahan_pak=''
			union all
			select nilaibaru  as total from perubahan_pak where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1') 
		as wew
    ");
    $rsPendapatanPerubahan=$sqlPendapatanPerubahan->fetch_object();

	$sqltotalPagu=$conn->query("select kodekegiatanx,sum(subtotal) as subtotalall from(
							select kodekegiatan as kodekegiatanx,total as subtotal 
							from penetapan_pagu 
							where tahun='".$_SESSION["anggaran_tahun"]."' and perubahan='' and perubahan_pak=''
							union all
							select kodekegiatan as kodekegiatanx,perubahan as subtotal 
							from perubahanpagu 
							where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1' and statusperubahan_pak=''
							union all
							select kodekegiatan as kodekegiatanx,perubahan as subtotal 
							from perubahanpagu_pak
							where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1')
							as wew");
    $rsTotalPagu=$sqltotalPagu->fetch_object();	

    $pendapatanPerubahan=$rsPendapatanPerubahan->subtotal;
	$totalpagu=$rsTotalPagu->subtotalall;
	$sisa=$pendapatanPerubahan-$totalpagu;
    echo json_encode([
        "pendapatanPerubahanrp"=>rpzx($pendapatanPerubahan),
		"totalpagurp"=>rpzx($totalpagu),
		"sisarp"=>rpzx($sisa)
    ]);
?>
<?php include("../../../close.php"); ?>