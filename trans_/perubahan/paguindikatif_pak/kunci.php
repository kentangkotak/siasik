<?php include("../../../conn.php"); ?>
<?php
	$thn=$_SESSION["anggaran_tahun"];
	$sql=$conn->query("select round(sum(realisasi)-sum(kurangi),2) as realisasix from(
			   select '' as realisasi,'' as kurangi  
			   from penyesesuaianperioritas_heder,t_tampung
			   where penyesesuaianperioritas_heder.notrans=t_tampung.notrans 
			   and year(penyesesuaianperioritas_heder.tgltrans)= '".$thn."'
			   union all
			   select sum(npkls_rinci.total) as realisasi,'' as kurangi 
			   from npkls_rinci,npkls_heder
			   where npkls_heder.nopencairan=npkls_rinci.nopencairan 
			   and year(npkls_heder.tglpencairan) = '".$thn."'
			   union all
			   select sum(spjpanjar_rinci.jumlahbelanjapanjar) as realisasi,'' as kurangi 
			   from spjpanjar_heder,spjpanjar_rinci
			   where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_heder.verif=1
			   and year(spjpanjar_heder.tglspjpanjar) = '".$thn."'
			   union all
			   select '' as realisasi,sum(nominalcontrapost) as kurangi
			   from contrapost
			   where year(tglcontrapost) = '".$thn."'
	) as xxx");
	$rs=$sql->fetch_object();
	$realisasi=$rs->realisasix;
	
	$sql_pak = $conn->query("select sum(nilai) as jml from anggaran_pendapatan_pak where tahun='".$_SESSION["anggaran_tahun"]."'");
	$rs_pak=$sql_pak->fetch_object();
	$totalpendapatanpak=$rs_pak->jml;
	
	//echo rpzx($totalpendapatanpak)." ".rpzx($realisasi)
	if($realisasi > $totalpendapatanpak){
		echo "MAAF TOTAL TARGET PENDAPATAN ANDA KURANG DARI REALISASI BELANJA TAHUN INI...!!!";
	}else{
		$conn->query("update anggaran_pendapatan_pak set kunci='1' where notrans='".trim($_GET['notrans'])."' ");
		echo "OK";
	}
?>
<?php include("../../../close.php"); ?>