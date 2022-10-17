<?php include("../../../conn.php"); ?>
<?php
    $sqlPaguawal=$conn->query("
        select 
            total
        from 
            penetapan_pagu 
        where 
            kodekegiatan='".$_GET["kodekegiatan"]."'
            and tahun='".$_SESSION["anggaran_tahun"]."'
    ");
    $rsPaguawal=$sqlPaguawal->fetch_object();
	
	$sqlPagu=$conn->query("select kodekegiatanx,sum(subtotal) as subtotalall from(
							select kodekegiatan as kodekegiatanx,sum(total) as subtotal from penetapan_pagu where tahun='".$_SESSION["anggaran_tahun"]."' 
							and perubahan='' and kodekegiatan='".$_GET["kodekegiatan"]."'
							union all
							select kodekegiatan as kodekegiatanx,perubahan as subtotal from perubahanpagu where tahun='".$_SESSION["anggaran_tahun"]."' 
							and statusperubahan='1' and kodekegiatan='".$_GET["kodekegiatan"]."') as xxx ");
    $rsPagu=$sqlPagu->fetch_object();
	
	$sqlPaguPak=$conn->query("select kodekegiatanx,sum(subtotal) as subtotalall from(
							select kodekegiatan as kodekegiatanx,sum(total) as subtotal from penetapan_pagu where tahun='".$_SESSION["anggaran_tahun"]."' 
							and perubahan='' and perubahan_pak='' and kodekegiatan='".$_GET["kodekegiatan"]."'
							union all
							select kodekegiatan as kodekegiatanx,perubahan as subtotal from perubahanpagu where tahun='".$_SESSION["anggaran_tahun"]."' 
							and statusperubahan='1' and statusperubahan_pak='' and kodekegiatan='".$_GET["kodekegiatan"]."'
							union all
							select kodekegiatan as kodekegiatanx,perubahan as subtotal from perubahanpagu_pak where tahun='".$_SESSION["anggaran_tahun"]."' 
							and statusperubahan='1' and kodekegiatan='".$_GET["kodekegiatan"]."') as xxx ");
    $rsPaguPak=$sqlPaguPak->fetch_object();

    $sqlPrioritas=$conn->query("select sum(total) as subtotal from(
			select penyesesuaianperioritas_rinci.nilai as total from penyesesuaianperioritas_rinci,penyesesuaianperioritas_heder 
			where penyesesuaianperioritas_rinci.notrans=penyesesuaianperioritas_heder.notrans and 
			penyesesuaianperioritas_rinci.statusperubahan='' and penyesesuaianperioritas_rinci.statusperubahan_pak='' and penyesesuaianperioritas_rinci.statusperubahan_pak_x='' 
			and penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' 
			and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
			union all
			select perubahanrincianbelanja.totalbaru as total from perubahanrincianbelanja,penyesesuaianperioritas_heder 
            where perubahanrincianbelanja.notrans=penyesesuaianperioritas_heder.notrans and 
            penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
			year(perubahanrincianbelanja.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
			and perubahanrincianbelanja.statusperubahan='1' and perubahanrincianbelanja.statusperubahan_pak='' and perubahanrincianbelanja.statusperubahan_pak_x=''
			UNION all
			select perubahanrincianbelanja_pak.totalbaru as total from perubahanrincianbelanja_pak,penyesesuaianperioritas_heder 
            where perubahanrincianbelanja_pak.notrans=penyesesuaianperioritas_heder.notrans and 
            penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
			year(perubahanrincianbelanja_pak.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
			and perubahanrincianbelanja_pak.statusperubahan='1' and perubahanrincianbelanja_pak.statusperubahan_pak_x=''
			UNION all
			select perubahanrincianbelanja_pak_x.totalbaru as total from perubahanrincianbelanja_pak_x,penyesesuaianperioritas_heder 
            where perubahanrincianbelanja_pak_x.notrans=penyesesuaianperioritas_heder.notrans and 
            penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
			year(perubahanrincianbelanja_pak_x.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
			and perubahanrincianbelanja_pak_x.statusperubahan='1'
			 ) 
		as xxx
    ");
    $rsPrioritas=$sqlPrioritas->fetch_object();

    $paguawal=$rsPaguawal->total;
	$pagu=$rsPagu->subtotalall;
	$pagupak=$rsPaguPak->subtotalall;
    $totalPrioritas=$rsPrioritas->subtotal;
    $sisaPagu = $pagupak - $totalPrioritas;

    echo json_encode([
        "paguawalRp"=>rp($paguawal),
		"paguRp"=>rp($pagu),
		"pagupakRp"=>rp($pagupak),
        "totalPrioritasrp"=>rp($totalPrioritas),
		"sisaPagurp"=>rp($sisaPagu)
    ]);
?>
<?php include("../../../close.php"); ?>