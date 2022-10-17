<?php include "conn.php";?>
<?php
$sql=$conn->query("
		select penyesesuaianperioritas_heder.notrans as notrans,penyesesuaianperioritas_heder.kodekegiatan as kodekegiatan,penyesesuaianperioritas_heder.kegiatan as kegiatanblud,
		penyesesuaianperioritas_rinci.koderek50 as koderek50,penyesesuaianperioritas_rinci.uraian50 as uraian50,
		penyesesuaianperioritas_rinci.koderek108 as koderek108,penyesesuaianperioritas_rinci.uraian108 as uraian108,
		penyesesuaianperioritas_rinci.usulan as usulan,penyesesuaianperioritas_rinci.jumlahacc as jumlahacc,penyesesuaianperioritas_rinci.satuan as satuan,
		penyesesuaianperioritas_rinci.harga as harga,penyesesuaianperioritas_rinci.nilai as awal,penyesesuaianperioritas_rinci.nousulan as nousulan,
		penyesesuaianperioritas_rinci.volume as volume,penyesesuaianperioritas_rinci.harga as harga,
		penyesesuaianperioritas_rinci.id as idpp,penyesesuaianperioritas_rinci.usulan as itembelanja,'' as total,'' as totalkepake
		from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
		where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
		and year(penyesesuaianperioritas_heder.tgltrans)='".$_GET['thn']."'
		");
while($rs=$sql->fetch_object()){
	$sqlcek=$conn->query("select * from t_tampung where notrans='".$rs->notrans."' and idpp='".$rs->idpp."' 
							and kodekegiatanblud='".$rs->kodekegiatan."' and tgl='".$_GET['thn']."'");
	$jml=$sqlcek->num_rows;
	if($jml > 0){
		$conn->query("update t_tampung set pagu='".$rs->awal."',volume='".$rs->volume."',harga='".$rs->harga."',satuan='".$rs->satuan."' where notrans='".$rs->notrans."' and idpp='".$rs->idpp."' 
					and kodekegiatanblud='".$rs->kodekegiatan."' and tgl='".$_GET['thn']."'");
	}else{
		$conn->query("insert into t_tampung(notrans,idpp,usulan,pagu,koderek108,koderek50,kodekegiatanblud,tgl,volume,harga,satuan) values('".$rs->notrans."','".$rs->idpp."','".$rs->usulan."','".$rs->awal."',
		'".$rs->koderek108."','".$rs->koderek50."','".$rs->kodekegiatan."','".$_GET['thn']."','".$rs->volume."','".$rs->harga."','".$rs->satuan."'); ");
	}	
	
}
echo "PROSES SELESAI...!!!";
?>
<?php include "close.php";?>