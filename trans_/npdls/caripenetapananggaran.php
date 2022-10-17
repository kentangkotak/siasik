<?php include "../../conn.php";?>
<?php
	
    $sql=$conn->query("select penyesesuaianperioritas_heder.notrans as notrans,penyesesuaianperioritas_heder.kodekegiatan as kodekegiatan,penyesesuaianperioritas_heder.kegiatan as kegiatanblud,
	penyesesuaianperioritas_rinci.koderek50 as koderek50,penyesesuaianperioritas_rinci.uraian50 as uraian50,
	penyesesuaianperioritas_rinci.koderek108 as koderek108,penyesesuaianperioritas_rinci.uraian108 as uraian108,
	penyesesuaianperioritas_rinci.usulan as usulan,penyesesuaianperioritas_rinci.jumlahacc as jumlahacc,penyesesuaianperioritas_rinci.satuan as satuan,
	penyesesuaianperioritas_rinci.harga as harga,penyesesuaianperioritas_rinci.nilai as total,penyesesuaianperioritas_rinci.nousulan as nousulan,
	penyesesuaianperioritas_rinci.id as idpp,penyesesuaianperioritas_rinci.usulan as itembelanja,'' as totalkepake
	from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
	where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
	and penyesesuaianperioritas_rinci.koderek50='".$_GET["koderek50"]."'
	and penyesesuaianperioritas_rinci.kunci<>'2' 
	and penyesesuaianperioritas_rinci.koderek108='".$_GET["kode108"]."'
	and penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatanblud"]."' 
	and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'");
	$rs=$sql->fetch_object();
	echo $rs->jumlahacc.'|'.$rs->satuan.'|'.rpz($harga).'|'.rpz($rs->total);

?>
<?php include "../../close.php";?>
