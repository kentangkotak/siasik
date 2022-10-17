<?php include "conn.php";?>
<?php
$sql=$conn->query("select notrans,kodekegiatan,kegiatanblud,koderek50,uraian50,koderek108,uraian108,usulan,jumlahacc,satuan,harga,awal,nousulan,idpp,itembelanja,
						kepake,sisa
						from(
								  select notrans,kodekegiatan,kegiatanblud,koderek50,uraian50,koderek108,uraian108,usulan,jumlahacc,satuan,harga,awal,nousulan,idpp,itembelanja,
								  round(sum(total),2) as total, round(sum(totalkepake),2) as kepake,round(awal+sum(total)-sum(totalkepake),2) as sisa
								  from(
											select penetapan_pagu.notrans as notrans,penyesesuaianperioritas_heder.kodekegiatan as kodekegiatan,penyesesuaianperioritas_heder.kegiatan as kegiatanblud,
											penyesesuaianperioritas_rinci.koderek50 as koderek50,penyesesuaianperioritas_rinci.uraian50 as uraian50,
											penyesesuaianperioritas_rinci.koderek108 as koderek108,penyesesuaianperioritas_rinci.uraian108 as uraian108,
											penyesesuaianperioritas_rinci.usulan as usulan,penyesesuaianperioritas_rinci.jumlahacc as jumlahacc,penyesesuaianperioritas_rinci.satuan as satuan,
											penyesesuaianperioritas_rinci.harga as harga,sum(penyesesuaianperioritas_rinci.nilai) as awal,penyesesuaianperioritas_rinci.nousulan as nousulan,
											penyesesuaianperioritas_rinci.id as idpp,penyesesuaianperioritas_rinci.usulan as itembelanja,'' as total,'' as totalkepake
											from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci,penetapan_pagu
											where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans
											and year(penyesesuaianperioritas_heder.tgltrans)='".$_GET['thn']."' 
											and penetapan_pagu.kodekegiatan=penyesesuaianperioritas_heder.kodekegiatan
											group by penyesesuaianperioritas_heder.kodekegiatan
											union all
											select '' as notrans,spjpanjar_heder.kodekegiatanblud as kodekegiatan,'' as kegiatanblud,
											'' as koderek50,'' as uraian50,
											'' as koderek108,'' as uraian108,
											'' as usulan,'' as jumlahacc,'' as satuan,
											'' as harga,'' as awal,'' as nousulan,
											npdpanjar_rinci.idpp as idpp,spjpanjar_rinci.itembelanja as itembelanja,'' as total,
                                            npdpanjar_rinci.totalpermintaanpanjar as totalkepake 
											from spjpanjar_heder,spjpanjar_rinci,npdpanjar_rinci
											where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_rinci.nonpdpanjar=npdpanjar_rinci.nonpdpanjar
											and spjpanjar_heder.verif=1 and year(spjpanjar_heder.tglspjpanjar)='".$_GET['thn']."' group by npdpanjar_rinci.id
											union all
											select '' as notrans,npkls_rinci.kodekegiatanblud as kodekegiatan,'' as kegiatanblud,
											'' as koderek50,'' as uraian50,
											'' as koderek108,'' as uraian108,
											'' as usulan,'' as jumlahacc,'' as satuan,
											'' as harga,'' as awal,'' as nousulan,
											npdls_rinci.idserahterima_rinci as idpp,npdls_rinci.itembelanja as itembelanja,'' as total,
                                            sum(npdls_rinci.totalls) as totalkepake
											from npdls_rinci,npdls_heder,npkls_rinci,npkls_heder
											where npdls_rinci.nonpdls=npdls_heder.nonpdls and npdls_heder.nonpdls=npkls_rinci.nonpdls 
											and npkls_heder.nonpk=npkls_rinci.nonpk
											and year(npkls_heder.tglnpk)='".$_GET['thn']."' group by npdls_rinci.idserahterima_rinci
											union all
                                    		select notrans as notrans,kodekegiatanblud as kodekegiatan,'' as kegiatanblud,
                                    		'' as koderek50,'' as uraian50,
                                    		'' as koderek108,'' as uraian108,
                                    		'' as usulan,'' as jumlahacc,'' as satuan,
                                    		'' as harga,'' as awal,'' as nousulan,idpp as idpp,usulan as itembelanja,sum(totalbaru) as total,'' as totalkepake
                                    		from perubahanrincianbelanja
                                    		where operator='TAMBAH' and year(tglperubahan)='".$_GET['thn']."' group by kodekegiatanblud
                                    		union all
                                    		select notrans as notrans,kodekegiatanblud as kodekegiatan,'' as kegiatanblud,
                                    		'' as koderek50,'' as uraian50,
                                    		'' as koderek108,'' as uraian108,
                                    		'' as usulan,'' as jumlahacc,'' as satuan,
                                    		'' as harga,'' as awal,'' as nousulan,idpp as idpp,usulan as itembelanja,'' as total,sum(totalbaru) as totalkepake
                                    		from perubahanrincianbelanja
                                    		where operator='KURANG' and year(tglperubahan)='".$_GET['thn']."' group by kodekegiatanblud
											) as wew 
								  group by kodekegiatan)
						as xxx");
while($rs=$sql->fetch_object()){
	$sqlcek=$conn->query("select * from t_tampung_pagu where tahun='".$_GET['thn']."' and kodekegiatanblud='".$rs->kodekegiatan."' ");
	$jml=$sqlcek->num_rows;
	if($jml > 0){
		$conn->query("update t_tampung_pagu set saldo='".$rs->sisa."' where kodekegiatanblud='".$rs->kodekegiatan."'");
	}else{
		$conn->query("insert into t_tampung_pagu(kodekegiatanblud,saldo,tahun) values('".$rs->kodekegiatan."','".$rs->sisa."','".$_GET['thn']."'); ");
	}
}
echo "PROSES SELESAI...!!!";
?>
<?php include "close.php";?>