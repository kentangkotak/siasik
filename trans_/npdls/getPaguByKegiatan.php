<?php include("../../conn.php"); ?>
<?php
	
	$sqlPagu=$conn->query("select kodekegiatanx,sum(subtotal) as subtotalall from(
							select kodekegiatan as kodekegiatanx,sum(total) as subtotal 
							from penetapan_pagu 
							where tahun='".$_SESSION["anggaran_tahun"]."' and perubahan=''  and perubahan_pak='' 
							and kodekegiatan='".$_GET["kodekegiatanblud"]."'
							union all
							select kodekegiatan as kodekegiatanx,perubahan as subtotal 
							from perubahanpagu where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1' and statusperubahan_pak=''
							and kodekegiatan='".$_GET["kodekegiatanblud"]."'
							union all
							select kodekegiatan as kodekegiatanx,perubahan as subtotal 
							from perubahanpagu_pak where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1'
							and kodekegiatan='".$_GET["kodekegiatanblud"]."'
							) as xxx ");
    $rsPagu=$sqlPagu->fetch_object();

    $sqlPrioritas=$conn->query("select sum(total) as subtotal from(
			select penyesesuaianperioritas_rinci.nilai as total 
			from penyesesuaianperioritas_rinci,penyesesuaianperioritas_heder 
			where penyesesuaianperioritas_rinci.notrans=penyesesuaianperioritas_heder.notrans and 
			penyesesuaianperioritas_rinci.statusperubahan='' and penyesesuaianperioritas_rinci.statusperubahan_pak='' 
			and penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatanblud"]."' 
			and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
			union all
			select perubahanrincianbelanja.totalbaru as total 
			from perubahanrincianbelanja,penyesesuaianperioritas_heder 
            where perubahanrincianbelanja.notrans=penyesesuaianperioritas_heder.notrans and 
            penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatanblud"]."' 
			and year(perubahanrincianbelanja.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
			and perubahanrincianbelanja.statusperubahan='1' and perubahanrincianbelanja.statusperubahan_pak=''
			union all
			select perubahanrincianbelanja_pak.totalbaru as total 
			from perubahanrincianbelanja_pak,penyesesuaianperioritas_heder 
            where perubahanrincianbelanja_pak.notrans=penyesesuaianperioritas_heder.notrans and 
            penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatanblud"]."' 
			and year(perubahanrincianbelanja_pak.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
			and perubahanrincianbelanja_pak.statusperubahan='1'
			) 
		as xxx
    ");
    $rsPrioritas=$sqlPrioritas->fetch_object();

	$pagu_skrng=$rsPagu->subtotalall;
    $totalPrioritas=$rsPrioritas->subtotal;
    
	if($totalPrioritas > $pagu_skrng){
		echo "MAAF PAGU LEBIH KECIL DARI USULAN...!!!";
	}else{
		echo "OK|".$totalPrioritas."|".$pagu_skrng;
	}
?>
<?php include("../../close.php"); ?>