<?php include("../../../conn.php"); ?>
<?php
	
	if($_GET['x'] == "BELUM"){
		$sql_rinci=$conn->query("select * from penyesesuaianperioritas_rinci where notrans='".$_GET['notrans']."' and id='".$_GET['id']."'");
		$rs_rinci=$sql_rinci->fetch_object();
		$sql_belanja=$conn->query("select notrans,kodekegiatan,kegiatanblud,koderek50,uraian50,koderek108,uraian108,usulan,jumlahacc,satuan,harga,total,nousulan,idpp,itembelanja,
						kepake,sisa
						from(
								  select notrans,kodekegiatan,kegiatanblud,koderek50,uraian50,koderek108,uraian108,usulan,jumlahacc,satuan,harga,total,nousulan,idpp,itembelanja,
								  round(sum(totalkepake),2) as kepake,round(total-sum(totalkepake),2) as sisa
								  from(
											select penyesesuaianperioritas_heder.notrans as notrans,penyesesuaianperioritas_heder.kodekegiatan as kodekegiatan,penyesesuaianperioritas_heder.kegiatan as kegiatanblud,
											penyesesuaianperioritas_rinci.koderek50 as koderek50,penyesesuaianperioritas_rinci.uraian50 as uraian50,
											penyesesuaianperioritas_rinci.koderek108 as koderek108,penyesesuaianperioritas_rinci.uraian108 as uraian108,
											penyesesuaianperioritas_rinci.usulan as usulan,penyesesuaianperioritas_rinci.jumlahacc as jumlahacc,penyesesuaianperioritas_rinci.satuan as satuan,
											penyesesuaianperioritas_rinci.harga as harga,penyesesuaianperioritas_rinci.nilai as total,penyesesuaianperioritas_rinci.nousulan as nousulan,
											penyesesuaianperioritas_rinci.id as idpp,penyesesuaianperioritas_rinci.usulan as itembelanja,'' as totalkepake
											from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
											where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
											and penyesesuaianperioritas_rinci.koderek50='".$_GET['koderek50']."' 
											and penyesesuaianperioritas_rinci.usulan='".$rs_rinci->usulan."'
											and penyesesuaianperioritas_rinci.kunci='' and
											penyesesuaianperioritas_rinci.statusperubahan=''
											and penyesesuaianperioritas_heder.kodekegiatan='".$_GET['kodeblud']."'
											and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
											union all
											select '' as notrans,'' as kodekegiatan,'' as kegiatanblud,
											'' as koderek50,'' as uraian50,
											'' as koderek108,'' as uraian108,
											npdls_rinci.itembelanja as usulan,'' as jumlahacc,'' as satuan,
											'' as harga,'' as total,'' as nousulan,
											'' as idpp,npdls_rinci.itembelanja as itembelanja,npdls_rinci.totalls as totalkepake 
											from npdls_heder,npdls_rinci 
											where npdls_heder.nonpdls=npdls_rinci.nonpdls and npdls_heder.kodekegiatanblud='".$_GET["kodeblud"]."' 
											and npdls_rinci.itembelanja='".$rs_rinci->usulan."'
											and npdls_rinci.koderek50='".$_GET["koderek50"]."'
											and year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."') as wew 
								  group by itembelanja)
						as xxx");
	}else if($_GET['x'] == "SUDAH"){
		$sql_rinci=$conn->query("select perubahanrincianbelanja.koderek50 as koderek50,perubahanrincianbelanja.koderek108 as koderek108,perubahanrincianbelanja.nousulan as nousulan,
								perubahanrincianbelanja.idpp as idpp,perubahanrincianbelanja.usulan as usulan,perubahanrincianbelanja.volumebaru as jumlahacc,perubahanrincianbelanja.satuan as satuan,
								perubahanrincianbelanja.hargabaru as harga,perubahanrincianbelanja.uraian108 as uraian108,perubahanrincianbelanja.uraian50 as uraian50,perubahanrincianbelanja.totalbaru as nilai
								from perubahanrincianbelanja where perubahanrincianbelanja.notrans='".$_GET['notrans']."' and perubahanrincianbelanja.idpp='".$_GET['id']."'
								 and statusperubahan=1");
		$rs_rinci=$sql_rinci->fetch_object();
		$sql_belanja=$conn->query("select notrans,kodekegiatan,kegiatanblud,koderek50,uraian50,koderek108,uraian108,usulan,jumlahacc,satuan,harga,total,nousulan,idpp,itembelanja,
						kepake,sisa
						from(
								  select notrans,kodekegiatan,kegiatanblud,koderek50,uraian50,koderek108,uraian108,usulan,jumlahacc,satuan,harga,total,nousulan,idpp,itembelanja,
								  round(sum(totalkepake),2) as kepake,round(total-sum(totalkepake),2) as sisa
								  from(
											select penyesesuaianperioritas_heder.notrans as notrans,penyesesuaianperioritas_heder.kodekegiatan as kodekegiatan,penyesesuaianperioritas_heder.kegiatan as kegiatanblud,
											penyesesuaianperioritas_rinci.koderek50 as koderek50,penyesesuaianperioritas_rinci.uraian50 as uraian50,
											penyesesuaianperioritas_rinci.koderek108 as koderek108,penyesesuaianperioritas_rinci.uraian108 as uraian108,
											penyesesuaianperioritas_rinci.usulan as usulan,penyesesuaianperioritas_rinci.jumlahacc as jumlahacc,penyesesuaianperioritas_rinci.satuan as satuan,
											penyesesuaianperioritas_rinci.harga as harga,penyesesuaianperioritas_rinci.nilai as total,penyesesuaianperioritas_rinci.nousulan as nousulan,
											penyesesuaianperioritas_rinci.id as idpp,penyesesuaianperioritas_rinci.usulan as itembelanja,'' as totalkepake
											from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
											where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
											and penyesesuaianperioritas_rinci.koderek50='".$_GET['koderek50']."' 
											and penyesesuaianperioritas_rinci.usulan='".$rs_rinci->usulan."'
											and penyesesuaianperioritas_rinci.kunci='' and
											penyesesuaianperioritas_rinci.statusperubahan=''
											and penyesesuaianperioritas_heder.kodekegiatan='".$_GET['kodeblud']."'
											and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
											union all
											select penyesesuaianperioritas_heder.notrans as notrans,penyesesuaianperioritas_heder.kodekegiatan as kodekegiatan,penyesesuaianperioritas_heder.kegiatan as kegiatanblud,
											perubahanrincianbelanja.koderek50 as koderek50,perubahanrincianbelanja.uraian50 as uraian50,
											perubahanrincianbelanja.koderek108 as koderek108,perubahanrincianbelanja.uraian108 as uraian108,
											perubahanrincianbelanja.usulan as usulan,perubahanrincianbelanja.jumlahacc as jumlahacc,perubahanrincianbelanja.satuan as satuan,
											perubahanrincianbelanja.harga as harga,perubahanrincianbelanja.nilai as total,perubahanrincianbelanja.nousulan as nousulan,
											perubahanrincianbelanja.id as idpp,perubahanrincianbelanja.usulan as itembelanja,'' as totalkepake
											from penyesesuaianperioritas_heder,perubahanrincianbelanja
											where penyesesuaianperioritas_heder.notrans=perubahanrincianbelanja.notrans 
											and perubahanrincianbelanja.koderek50='".$_GET['koderek50']."' 
											and perubahanrincianbelanja.usulan='".$rs_rinci->usulan."'
											and perubahanrincianbelanja.statusperubahan='1' and perubahanrincianbelanja.statusperubahan_pak=''
											and penyesesuaianperioritas_heder.kodekegiatan='".$_GET['kodeblud']."'
											and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
                                            union all
											select '' as notrans,'' as kodekegiatan,'' as kegiatanblud,
											'' as koderek50,'' as uraian50,
											'' as koderek108,'' as uraian108,
											npdls_rinci.itembelanja as usulan,'' as jumlahacc,'' as satuan,
											'' as harga,'' as total,'' as nousulan,
											'' as idpp,npdls_rinci.itembelanja as itembelanja,npdls_rinci.totalls as totalkepake 
											from npdls_heder,npdls_rinci 
											where npdls_heder.nonpdls=npdls_rinci.nonpdls and npdls_heder.kodekegiatanblud='".$_GET['kodeblud']."' 
											and npdls_rinci.itembelanja='".$rs_rinci->usulan."'
											and npdls_rinci.koderek50='".$_GET['koderek50']."'
											and year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."') as wew 
								  group by itembelanja)
						as xxx");
	}
	$rs_belanja=$sql_belanja->fetch_object();
	$sisaanggaran=$rs_belanja->sisa;
	echo $rs_rinci->koderek50."|".$rs_rinci->koderek108."|".$rs_rinci->nousulan."|".rpz($sisaanggaran)."|".$rs_rinci->usulan."|".
		 rpz($rs_rinci->jumlahacc)."|".$rs_rinci->satuan."|".rpz($rs_rinci->harga)."|".$rs_rinci->uraian108."|".$rs_rinci->uraian50."|".rpz($rs_rinci->nilai)."|";
		
?>
<?php include("../../../close.php"); ?>
