<?php include "conn.php";?>
<?php
$sql=$conn->query("select notrans,kodekegiatan,kegiatanblud,koderek50,uraian50,koderek108,uraian108,usulan,jumlahacc,satuan,harga,awal,nousulan,idpp,itembelanja,
total,kepake,sisa
from(
select notrans,kodekegiatan,kegiatanblud,koderek50,uraian50,koderek108,uraian108,usulan,jumlahacc,satuan,harga,awal,nousulan,idpp,itembelanja,
round(sum(total),2) as total,round(sum(totalkepake),2) as kepake,round(awal+sum(total-totalkepake),2) as sisa
from(
		select penyesesuaianperioritas_heder.notrans as notrans,penyesesuaianperioritas_heder.kodekegiatan as kodekegiatan,penyesesuaianperioritas_heder.kegiatan as kegiatanblud,
		penyesesuaianperioritas_rinci.koderek50 as koderek50,penyesesuaianperioritas_rinci.uraian50 as uraian50,
		penyesesuaianperioritas_rinci.koderek108 as koderek108,penyesesuaianperioritas_rinci.uraian108 as uraian108,
		penyesesuaianperioritas_rinci.usulan as usulan,penyesesuaianperioritas_rinci.jumlahacc as jumlahacc,penyesesuaianperioritas_rinci.satuan as satuan,
		penyesesuaianperioritas_rinci.harga as harga,penyesesuaianperioritas_rinci.nilai as awal,penyesesuaianperioritas_rinci.nousulan as nousulan,
		penyesesuaianperioritas_rinci.id as idpp,penyesesuaianperioritas_rinci.usulan as itembelanja,'' as total,'' as totalkepake
		from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
		where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
		and year(penyesesuaianperioritas_heder.tgltrans)='".$_GET['thn']."'
		union all
		select notrans as notrans,kodekegiatanblud as kodekegiatan,'' as kegiatanblud,
		'' as koderek50,'' as uraian50,
		'' as koderek108,'' as uraian108,
		'' as usulan,'' as jumlahacc,'' as satuan,
		'' as harga,'' as awal,'' as nousulan,idpp as idpp,usulan as itembelanja,sum(totalbaru) as total,'' as totalkepake
		from perubahanrincianbelanja
		where operator='TAMBAH' and year(tglperubahan)='".$_GET['thn']."' group by kodekegiatanblud,idpp
		union all
		select notrans as notrans,kodekegiatanblud as kodekegiatan,'' as kegiatanblud,
		'' as koderek50,'' as uraian50,
		'' as koderek108,'' as uraian108,
		'' as usulan,'' as jumlahacc,'' as satuan,
		'' as harga,'' as awal,'' as nousulan,idpp as idpp,usulan as itembelanja,'' as total,sum(totalbaru) as totalkepake
		from perubahanrincianbelanja
		where operator='KURANG' and year(tglperubahan)='".$_GET['thn']."' group by idpp
		) as wew
group by idpp)as xxx");
while($rs=$sql->fetch_object()){
	// $sqlcek=$conn->query("select * from t_tampung where notrans='".$rs->notrans."' and idpp='".$rs->idpp."' 
							// and kodekegiatanblud='".$rs->kodekegiatan."' and tgl='".$_GET['thn']."'");
	// $jml=$sqlcek->num_rows;
	// if($jml > 0){
		$conn->query("update t_tampung set volumebaru='".$rs->jumlahacc."',hargabaru='".$rs->harga."',totalbaru='".$rs->sisa."' where notrans='".$rs->notrans."' and idpp='".$rs->idpp."' 
					and kodekegiatanblud='".$rs->kodekegiatan."' and tgl='".$_GET['thn']."'");
	// }else{
		// $conn->query("insert into t_tampung(notrans,idpp,usulan,nilai,koderek108,koderek50,kodekegiatanblud,tgl) values('".$rs->notrans."','".$rs->idpp."','".$rs->usulan."','".$rs->sisa."',
		// '".$rs->koderek108."','".$rs->koderek50."','".$rs->kodekegiatan."','".$_GET['thn']."'); ");
	// }	
	
}
echo "PROSES SELESAI...!!!";
?>
<?php include "close.php";?>