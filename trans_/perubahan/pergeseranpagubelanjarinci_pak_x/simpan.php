<?php include("../../../conn.php"); ?>
<?php
$tglperubahan=in_tanggal("/",trim($_GET['tglperubahan']));
//-----------------cek kesedian pagu------------//
		
$sqlPagu=$conn->query("select kodekegiatanx,sum(subtotal) as subtotalall from(
							select kodekegiatan as kodekegiatanx,sum(total) as subtotal 
							from penetapan_pagu where tahun='".$_SESSION["anggaran_tahun"]."' and perubahan='' and perubahan_pak=''
							and kodekegiatan='".$_GET["kodekegiatan"]."'
							union all
							select kodekegiatan as kodekegiatanx,perubahan as subtotal 
							from perubahanpagu where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1' and statusperubahan_pak=''
							and kodekegiatan='".$_GET["kodekegiatan"]."'
							union all
							select kodekegiatan as kodekegiatanx,perubahan as subtotal from perubahanpagu_pak where tahun='".$_SESSION["anggaran_tahun"]."' 
							and statusperubahan='1' and kodekegiatan='".$_GET["kodekegiatan"]."') as xxx");
$rsPagu=$sqlPagu->fetch_object();
$pagu=$rsPagu->subtotalall;
//-------------KHUSUS USULAN BARU-----------//
if($_GET['status_x'] == 'wew_x'){
	//---cek melebihi pagu apa tidak---//
	$harga= str_replace(',','',$_GET['harga']);
	$volume= str_replace(',','',$_GET['volume']);
	$nilai=$harga*$volume;
	$hargabaru= str_replace(',','',$_GET['hargabaru']);
	$volumebaru= str_replace(',','',$_GET['volumebaru']);
	$selisih= str_replace(',','',$_GET['selisih']);
	$totalbaru=$hargabaru*$volumebaru;
	
	$conn->query("update perubahanrincianbelanja_pak_x set statusperubahan_pak='2' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
	$conn->query("update perubahanrincianbelanja_pak set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
	$conn->query("update penyesesuaianperioritas_rinci set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and id='".trim($_GET['idpp'])."'");
	$conn->query("update perubahanrincianbelanja set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
	$sqlperubahan=$conn->query("select sum(total) as subtotal from(
								select sum(penyesesuaianperioritas_rinci.nilai) as total 
								from penyesesuaianperioritas_rinci,penyesesuaianperioritas_heder 
								where penyesesuaianperioritas_rinci.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_rinci.statusperubahan='' and penyesesuaianperioritas_rinci.statusperubahan_pak=''
								and penyesesuaianperioritas_rinci.statusperubahan_pak_x=''
								and penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' 
								and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' 
								union all
								select sum(perubahanrincianbelanja.totalbaru) as total 
								from perubahanrincianbelanja,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja.statusperubahan='1' and perubahanrincianbelanja.statusperubahan_pak=''
								and perubahanrincianbelanja.statusperubahan_pak_x=''
								union all
								select sum(perubahanrincianbelanja_pak.totalbaru) as total 
								from perubahanrincianbelanja_pak,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja_pak.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja_pak.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja_pak.statusperubahan='1' and perubahanrincianbelanja_pak.statusperubahan_pak_x=''
								union all
								select sum(perubahanrincianbelanja_pak_x.totalbaru) as total 
								from perubahanrincianbelanja_pak_x,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja_pak_x.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja_pak_x.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja_pak_x.statusperubahan='1') 
							as xxx");
	$rsperubahan=$sqlperubahan->fetch_object();
	$perubahan=$rsperubahan->subtotal;
	$perubahanx=$perubahan+$totalbaru;
	if($perubahanx > $pagu){
		$conn->query("update perubahanrincianbelanja_pak_x set statusperubahan_pak='2' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
		$conn->query("update perubahanrincianbelanja_pak set statusperubahan_pak_x='' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
		$conn->query("update penyesesuaianperioritas_rinci set statusperubahan_pak_x='' where notrans='".trim($_GET['notrans'])."' and id='".trim($_GET['idpp'])."'");
		$conn->query("update perubahanrincianbelanja set statusperubahan_pak_x='' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
		$sqlperubahan2=$conn->query("select sum(total) as subtotal from(
								select sum(penyesesuaianperioritas_rinci.nilai) as total 
								from penyesesuaianperioritas_rinci,penyesesuaianperioritas_heder 
								where penyesesuaianperioritas_rinci.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_rinci.statusperubahan='' and penyesesuaianperioritas_rinci.statusperubahan_pak=''
								and penyesesuaianperioritas_rinci.statusperubahan_pak_x=''
								and penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' 
								and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' 
								union all
								select sum(perubahanrincianbelanja.totalbaru) as total 
								from perubahanrincianbelanja,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja.statusperubahan='1' and perubahanrincianbelanja.statusperubahan_pak=''
								and perubahanrincianbelanja.statusperubahan_pak_x=''
								union all
								select sum(perubahanrincianbelanja_pak.totalbaru) as total 
								from perubahanrincianbelanja_pak,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja_pak.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja_pak.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja_pak.statusperubahan='1' and perubahanrincianbelanja_pak.statusperubahan_pak_x=''
								union all
								select sum(perubahanrincianbelanja_pak_x.totalbaru) as total 
								from perubahanrincianbelanja_pak_x,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja_pak_x.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja_pak_x.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja_pak_x.statusperubahan='1') 
							as xxx");
		$rsperubahan2=$sqlperubahan2->fetch_object();
		$perubahan2=$rsperubahan2->subtotal;
		$sisapagu=$pagu-$perubahan2;
		echo "MAAF NILAI YANG ANDA MASUKKAN MELEBIHI PAGU...!!! SISA PAGU YANG BISA ANDA PAKE SEBESAR ".rpzx($sisapagu);
	}else{
			$conn->query("update perubahanrincianbelanja_pak_x set statusperubahan_pak='2' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
			$conn->query("update perubahanrincianbelanja_pak set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
			$conn->query("update penyesesuaianperioritas_rinci set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and id='".trim($_GET['idpp'])."'");
			$conn->query("update perubahanrincianbelanja set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
			$kode=time()."/P-RINCIANBELANJA-X";
			$conn->query("insert into perubahanrincianbelanja_pak_x(noperubahan,notrans,tglperubahan,usulan,volume,harga,nilai,volumebaru,hargabaru,totalbaru,selisih,
			koderek108,uraian108,koderek50,uraian50,jumlahacc,tgl_entry,user_entry,satuan,nousulan,kodepptk,pptk,kodekegiatanblud,uraianblud,kodebidang,bidang,idpp,statusperubahan) 
			values('".$kode."','".trim($_GET['notrans'])."','".trim($tglperubahan)."','".trim($_GET['usulan'])."','".trim($volume)."','".trim($harga)."','".$nilai."',
			'".trim($volumebaru)."','".trim($hargabaru)."','".trim($totalbaru)."','".trim($selisih)."',
			'".trim($_GET['koderek108'])."',
			'".trim($_GET['uraianrek108'])."','".trim($_GET['koderek50'])."','".trim($_GET['uraianrek50'])."','','".date('Y-m-d H:i:s')."',
			'".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['satuan'])."','".trim($_GET['nousulan'])."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."',
			'".trim($_GET['kodekegiatan'])."','".trim($_GET['kegiatan'])."','".trim($_GET['kodebidang'])."','".trim($_GET['namabidang'])."','".time().'x'."','1')");
			
			echo "OK|".$kode."|1|".$perubahan."|".$totalbaru."|".$perubahanx."|".$pagu;
	}
}else if($_GET['status_x'] == 'wew'){
	//---cek melebihi pagu apa tidak---//
	$harga= str_replace(',','',$_GET['harga']);
	$volume= str_replace(',','',$_GET['volume']);
	$nilai=$harga*$volume;
	$hargabaru= str_replace(',','',$_GET['hargabaru']);
	$volumebaru= str_replace(',','',$_GET['volumebaru']);
	$selisih= str_replace(',','',$_GET['selisih']);
	$totalbaru=$hargabaru*$volumebaru;
	
	$conn->query("update perubahanrincianbelanja_pak set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
	$conn->query("update penyesesuaianperioritas_rinci set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and id='".trim($_GET['idpp'])."'");
	$conn->query("update perubahanrincianbelanja set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
	$sqlperubahan=$conn->query("select sum(total) as subtotal from(
								select sum(penyesesuaianperioritas_rinci.nilai) as total 
								from penyesesuaianperioritas_rinci,penyesesuaianperioritas_heder 
								where penyesesuaianperioritas_rinci.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_rinci.statusperubahan='' and penyesesuaianperioritas_rinci.statusperubahan_pak=''
								and penyesesuaianperioritas_rinci.statusperubahan_pak_x=''
								and penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' 
								and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' 
								union all
								select sum(perubahanrincianbelanja.totalbaru) as total 
								from perubahanrincianbelanja,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja.statusperubahan='1' and perubahanrincianbelanja.statusperubahan_pak=''
								and perubahanrincianbelanja.statusperubahan_pak_x=''
								union all
								select sum(perubahanrincianbelanja_pak.totalbaru) as total 
								from perubahanrincianbelanja_pak,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja_pak.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja_pak.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja_pak.statusperubahan='1' and perubahanrincianbelanja_pak.statusperubahan_pak_x=''
								union all
								select sum(perubahanrincianbelanja_pak_x.totalbaru) as total 
								from perubahanrincianbelanja_pak_x,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja_pak_x.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja_pak_x.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja_pak_x.statusperubahan='1') 
							as xxx");
	$rsperubahan=$sqlperubahan->fetch_object();
	$perubahan=$rsperubahan->subtotal;
	$perubahanx=$perubahan+$totalbaru;
	if($perubahanx > $pagu){
		$conn->query("update perubahanrincianbelanja_pak set statusperubahan_pak_x='' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
		$conn->query("update penyesesuaianperioritas_rinci set statusperubahan_pak_x='' where notrans='".trim($_GET['notrans'])."' and id='".trim($_GET['idpp'])."'");
		$conn->query("update perubahanrincianbelanja set statusperubahan_pak_x='' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
		$sqlperubahan2=$conn->query("select sum(total) as subtotal from(
								select sum(penyesesuaianperioritas_rinci.nilai) as total 
								from penyesesuaianperioritas_rinci,penyesesuaianperioritas_heder 
								where penyesesuaianperioritas_rinci.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_rinci.statusperubahan='' and penyesesuaianperioritas_rinci.statusperubahan_pak=''
								and penyesesuaianperioritas_rinci.statusperubahan_pak_x=''
								and penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' 
								and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' 
								union all
								select sum(perubahanrincianbelanja.totalbaru) as total 
								from perubahanrincianbelanja,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja.statusperubahan='1' and perubahanrincianbelanja.statusperubahan_pak=''
								and perubahanrincianbelanja.statusperubahan_pak_x=''
								union all
								select sum(perubahanrincianbelanja_pak.totalbaru) as total 
								from perubahanrincianbelanja_pak,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja_pak.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja_pak.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja_pak.statusperubahan='1' and perubahanrincianbelanja_pak.statusperubahan_pak_x=''
								union all
								select sum(perubahanrincianbelanja_pak_x.totalbaru) as total 
								from perubahanrincianbelanja_pak_x,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja_pak_x.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja_pak_x.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja_pak_x.statusperubahan='1') 
							as xxx");
		$rsperubahan2=$sqlperubahan2->fetch_object();
		$perubahan2=$rsperubahan2->subtotal;
		$sisapagu=$pagu-$perubahan2;
		echo "MAAF NILAI YANG ANDA MASUKKAN MELEBIHI PAGU...!!! SISA PAGU YANG BISA ANDA PAKE SEBESAR ".rpzx($sisapagu);
	}else{
			$conn->query("update perubahanrincianbelanja_pak set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
			$conn->query("update penyesesuaianperioritas_rinci set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and id='".trim($_GET['idpp'])."'");
			$conn->query("update perubahanrincianbelanja set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
			$kode=time()."/P-RINCIANBELANJA-X";
			$conn->query("insert into perubahanrincianbelanja_pak_x(noperubahan,notrans,tglperubahan,usulan,volume,harga,nilai,volumebaru,hargabaru,totalbaru,selisih,
			koderek108,uraian108,koderek50,uraian50,jumlahacc,tgl_entry,user_entry,satuan,nousulan,kodepptk,pptk,kodekegiatanblud,uraianblud,kodebidang,bidang,idpp,statusperubahan) 
			values('".$kode."','".trim($_GET['notrans'])."','".trim($tglperubahan)."','".trim($_GET['usulan'])."','".trim($volume)."','".trim($harga)."','".$nilai."',
			'".trim($volumebaru)."','".trim($hargabaru)."','".trim($totalbaru)."','".trim($selisih)."',
			'".trim($_GET['koderek108'])."',
			'".trim($_GET['uraianrek108'])."','".trim($_GET['koderek50'])."','".trim($_GET['uraianrek50'])."','','".date('Y-m-d H:i:s')."',
			'".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['satuan'])."','".trim($_GET['nousulan'])."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."',
			'".trim($_GET['kodekegiatan'])."','".trim($_GET['kegiatan'])."','".trim($_GET['kodebidang'])."','".trim($_GET['namabidang'])."','".time().'x'."','1')");
			
			echo "OK|".$kode."|2|".$perubahan."|".$totalbaru."|".$perubahanx."|".$pagu;
	}
}else if($_GET['status_x'] == 'SUDAH'){
		//---cek melebihi pagu apa tidak---//
	$harga= str_replace(',','',$_GET['harga']);
	$volume= str_replace(',','',$_GET['volume']);
	$nilai=$harga*$volume;
	$hargabaru= str_replace(',','',$_GET['hargabaru']);
	$volumebaru= str_replace(',','',$_GET['volumebaru']);
	$selisih= str_replace(',','',$_GET['selisih']);
	$totalbaru=$hargabaru*$volumebaru;
	
	//$conn->query("update perubahanrincianbelanja_pak set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
	$conn->query("update penyesesuaianperioritas_rinci set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and id='".trim($_GET['idpp'])."'");
	$conn->query("update perubahanrincianbelanja set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
	$sqlperubahan=$conn->query("select sum(total) as subtotal from(
								select sum(penyesesuaianperioritas_rinci.nilai) as total 
								from penyesesuaianperioritas_rinci,penyesesuaianperioritas_heder 
								where penyesesuaianperioritas_rinci.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_rinci.statusperubahan='' and penyesesuaianperioritas_rinci.statusperubahan_pak=''
								and penyesesuaianperioritas_rinci.statusperubahan_pak_x=''
								and penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' 
								and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' 
								union all
								select sum(perubahanrincianbelanja.totalbaru) as total 
								from perubahanrincianbelanja,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja.statusperubahan='1' and perubahanrincianbelanja.statusperubahan_pak=''
								and perubahanrincianbelanja.statusperubahan_pak_x=''
								union all
								select sum(perubahanrincianbelanja_pak.totalbaru) as total 
								from perubahanrincianbelanja_pak,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja_pak.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja_pak.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja_pak.statusperubahan='1' and perubahanrincianbelanja_pak.statusperubahan_pak_x=''
								union all
								select sum(perubahanrincianbelanja_pak_x.totalbaru) as total 
								from perubahanrincianbelanja_pak_x,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja_pak_x.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja_pak_x.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja_pak_x.statusperubahan='1') 
							as xxx");
	$rsperubahan=$sqlperubahan->fetch_object();
	$perubahan=$rsperubahan->subtotal;
	$perubahanx=$perubahan+$totalbaru;
	if($perubahanx > $pagu){
	//	$conn->query("update perubahanrincianbelanja_pak set statusperubahan_pak_x='' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
		$conn->query("update penyesesuaianperioritas_rinci set statusperubahan_pak_x='' where notrans='".trim($_GET['notrans'])."' and id='".trim($_GET['idpp'])."'");
		$conn->query("update perubahanrincianbelanja set statusperubahan_pak_x='' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
		$sqlperubahan2=$conn->query("select sum(total) as subtotal from(
								select sum(penyesesuaianperioritas_rinci.nilai) as total 
								from penyesesuaianperioritas_rinci,penyesesuaianperioritas_heder 
								where penyesesuaianperioritas_rinci.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_rinci.statusperubahan='' and penyesesuaianperioritas_rinci.statusperubahan_pak=''
								and penyesesuaianperioritas_rinci.statusperubahan_pak_x=''
								and penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' 
								and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' 
								union all
								select sum(perubahanrincianbelanja.totalbaru) as total 
								from perubahanrincianbelanja,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja.statusperubahan='1' and perubahanrincianbelanja.statusperubahan_pak=''
								and perubahanrincianbelanja.statusperubahan_pak_x=''
								union all
								select sum(perubahanrincianbelanja_pak.totalbaru) as total 
								from perubahanrincianbelanja_pak,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja_pak.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja_pak.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja_pak.statusperubahan='1' and perubahanrincianbelanja_pak.statusperubahan_pak_x=''
								union all
								select sum(perubahanrincianbelanja_pak_x.totalbaru) as total 
								from perubahanrincianbelanja_pak_x,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja_pak_x.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja_pak_x.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja_pak_x.statusperubahan='1') 
							as xxx");
		$rsperubahan2=$sqlperubahan2->fetch_object();
		$perubahan2=$rsperubahan2->subtotal;
		$sisapagu=$pagu-$perubahan2;
		echo "MAAF NILAI YANG ANDA MASUKKAN MELEBIHI PAGU...!!! SISA PAGU YANG BISA ANDA PAKE SEBESAR ".rpzx($sisapagu);
	}else{
	//		$conn->query("update perubahanrincianbelanja_pak set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
			$conn->query("update penyesesuaianperioritas_rinci set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and id='".trim($_GET['idpp'])."'");
			$conn->query("update perubahanrincianbelanja set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
			$kode=time()."/P-RINCIANBELANJA-X";
			$conn->query("insert into perubahanrincianbelanja_pak_x(noperubahan,notrans,tglperubahan,usulan,volume,harga,nilai,volumebaru,hargabaru,totalbaru,selisih,
			koderek108,uraian108,koderek50,uraian50,jumlahacc,tgl_entry,user_entry,satuan,nousulan,kodepptk,pptk,kodekegiatanblud,uraianblud,kodebidang,bidang,idpp,statusperubahan) 
			values('".$kode."','".trim($_GET['notrans'])."','".trim($tglperubahan)."','".trim($_GET['usulan'])."','".trim($volume)."','".trim($harga)."','".$nilai."',
			'".trim($volumebaru)."','".trim($hargabaru)."','".trim($totalbaru)."','".trim($selisih)."',
			'".trim($_GET['koderek108'])."',
			'".trim($_GET['uraianrek108'])."','".trim($_GET['koderek50'])."','".trim($_GET['uraianrek50'])."','','".date('Y-m-d H:i:s')."',
			'".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['satuan'])."','".trim($_GET['nousulan'])."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."',
			'".trim($_GET['kodekegiatan'])."','".trim($_GET['kegiatan'])."','".trim($_GET['kodebidang'])."','".trim($_GET['namabidang'])."','".time().'x'."','1')");
			
			echo "OK|".$kode."|3|".$perubahan."|".$totalbaru."|".$perubahanx."|".$pagu;
	}
}else{
			//---cek melebihi pagu apa tidak---//
	$harga= str_replace(',','',$_GET['harga']);
	$volume= str_replace(',','',$_GET['volume']);
	$nilai=$harga*$volume;
	$hargabaru= str_replace(',','',$_GET['hargabaru']); 
	$volumebaru= str_replace(',','',$_GET['volumebaru']);
	$selisih= str_replace(',','',$_GET['selisih']);
	$totalbaru=$hargabaru*$volumebaru;
	
	//$conn->query("update perubahanrincianbelanja_pak set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
	$conn->query("update penyesesuaianperioritas_rinci set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and id='".trim($_GET['idpp'])."'");
	//$conn->query("update perubahanrincianbelanja set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
	$sqlperubahan=$conn->query("select sum(total) as subtotal from(
								select sum(penyesesuaianperioritas_rinci.nilai) as total 
								from penyesesuaianperioritas_rinci,penyesesuaianperioritas_heder 
								where penyesesuaianperioritas_rinci.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_rinci.statusperubahan='' and penyesesuaianperioritas_rinci.statusperubahan_pak=''
								and penyesesuaianperioritas_rinci.statusperubahan_pak_x=''
								and penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' 
								and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' 
								union all
								select sum(perubahanrincianbelanja.totalbaru) as total 
								from perubahanrincianbelanja,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja.statusperubahan='1' and perubahanrincianbelanja.statusperubahan_pak=''
								and perubahanrincianbelanja.statusperubahan_pak_x=''
								union all
								select sum(perubahanrincianbelanja_pak.totalbaru) as total 
								from perubahanrincianbelanja_pak,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja_pak.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja_pak.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja_pak.statusperubahan='1' and perubahanrincianbelanja_pak.statusperubahan_pak_x=''
								union all
								select sum(perubahanrincianbelanja_pak_x.totalbaru) as total 
								from perubahanrincianbelanja_pak_x,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja_pak_x.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja_pak_x.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja_pak_x.statusperubahan='1') 
							as xxx");
	$rsperubahan=$sqlperubahan->fetch_object();
	$perubahan=$rsperubahan->subtotal;
	$perubahanx=$perubahan+$totalbaru;
	if($perubahanx > $pagu){
	//	$conn->query("update perubahanrincianbelanja_pak set statusperubahan_pak_x='' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
		$conn->query("update penyesesuaianperioritas_rinci set statusperubahan_pak_x='' where notrans='".trim($_GET['notrans'])."' and id='".trim($_GET['idpp'])."'");
	//	$conn->query("update perubahanrincianbelanja set statusperubahan_pak_x='' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
		$sqlperubahan2=$conn->query("select sum(total) as subtotal from(
								select sum(penyesesuaianperioritas_rinci.nilai) as total 
								from penyesesuaianperioritas_rinci,penyesesuaianperioritas_heder 
								where penyesesuaianperioritas_rinci.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_rinci.statusperubahan='' and penyesesuaianperioritas_rinci.statusperubahan_pak=''
								and penyesesuaianperioritas_rinci.statusperubahan_pak_x=''
								and penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' 
								and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' 
								union all
								select sum(perubahanrincianbelanja.totalbaru) as total 
								from perubahanrincianbelanja,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja.statusperubahan='1' and perubahanrincianbelanja.statusperubahan_pak=''
								and perubahanrincianbelanja.statusperubahan_pak_x=''
								union all
								select sum(perubahanrincianbelanja_pak.totalbaru) as total 
								from perubahanrincianbelanja_pak,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja_pak.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja_pak.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja_pak.statusperubahan='1' and perubahanrincianbelanja_pak.statusperubahan_pak_x=''
								union all
								select sum(perubahanrincianbelanja_pak_x.totalbaru) as total 
								from perubahanrincianbelanja_pak_x,penyesesuaianperioritas_heder 
								where perubahanrincianbelanja_pak_x.notrans=penyesesuaianperioritas_heder.notrans and 
								penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."' and 
								year(perubahanrincianbelanja_pak_x.tglperubahan)='".$_SESSION["anggaran_tahun"]."' 
								and perubahanrincianbelanja_pak_x.statusperubahan='1') 
							as xxx"); 
		$rsperubahan2=$sqlperubahan2->fetch_object();
		$perubahan2=$rsperubahan2->subtotal;
		$sisapagu=$pagu-$perubahan2;
		echo "MAAF NILAI YANG ANDA MASUKKAN MELEBIHI PAGU...!!! SISA PAGU YANG BISA ANDA PAKE SEBESAR ".rpzx($sisapagu);
	}else{
	//		$conn->query("update perubahanrincianbelanja_pak set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
			$conn->query("update penyesesuaianperioritas_rinci set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and id='".trim($_GET['idpp'])."'");
	//		$conn->query("update perubahanrincianbelanja set statusperubahan_pak_x='1' where notrans='".trim($_GET['notrans'])."' and idpp='".trim($_GET['idpp'])."'");
			$kode=time()."/P-RINCIANBELANJA-X";
			$conn->query("insert into perubahanrincianbelanja_pak_x(noperubahan,notrans,tglperubahan,usulan,volume,harga,nilai,volumebaru,hargabaru,totalbaru,selisih,
			koderek108,uraian108,koderek50,uraian50,jumlahacc,tgl_entry,user_entry,satuan,nousulan,kodepptk,pptk,kodekegiatanblud,uraianblud,kodebidang,bidang,idpp,statusperubahan) 
			values('".$kode."','".trim($_GET['notrans'])."','".trim($tglperubahan)."','".trim($_GET['usulan'])."','".trim($volume)."','".trim($harga)."','".$nilai."',
			'".trim($volumebaru)."','".trim($hargabaru)."','".trim($totalbaru)."','".trim($selisih)."',
			'".trim($_GET['koderek108'])."',
			'".trim($_GET['uraianrek108'])."','".trim($_GET['koderek50'])."','".trim($_GET['uraianrek50'])."','','".date('Y-m-d H:i:s')."',
			'".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['satuan'])."','".trim($_GET['nousulan'])."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."',
			'".trim($_GET['kodekegiatan'])."','".trim($_GET['kegiatan'])."','".trim($_GET['kodebidang'])."','".trim($_GET['namabidang'])."','".time().'x'."','1')");
			
			echo "OK|".$kode."|4|".$perubahan."|".$totalbaru."|".$perubahanx."|".$pagu;
	}	
}
?>
<?php include("../../../close.php"); ?>