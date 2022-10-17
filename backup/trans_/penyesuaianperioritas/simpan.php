<?php include("../../conn.php"); ?>
<?php
$total_penyesuaianx=$_GET['jumlahacc']*$_GET['harga'];
$sql_cekx=$conn->query("select penyesesuaianperioritas_heder.notrans as notrans,sum(penyesesuaianperioritas_rinci.nilai) as nilai
						from penyesesuaianperioritas_rinci,penyesesuaianperioritas_heder
						where penyesesuaianperioritas_rinci.notrans=penyesesuaianperioritas_heder.notrans and penyesesuaianperioritas_heder.kodekegiatan='".trim($_GET['kodekegiatan'])."' 
						and  year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
						group by penyesesuaianperioritas_heder.kodekegiatan");
$rs_cekx=$sql_cekx->fetch_object();
$total_penyesuaian=$total_penyesuaianx+$rs_cekx->nilai;

$sql_cek=$conn->query("select sum(total) as total from penetapan_pagu where kodekegiatan='".trim($_GET['kodekegiatan'])."' and tahun='".$_SESSION["anggaran_tahun"]."' group by kegiatanblud");
$rs_cek=$sql_cek->fetch_object();
$pagu=$rs_cek->total;
if($total_penyesuaian > $pagu ){
	echo "MAAF NILAI YANG ANDA MASUKKAN MELEBIHI PAGU KEGIATAN...!!!";
}else{
	$tanggaltrans=in_tanggal("/",trim($_GET['tgltrans']));
	$data=explode( '|', $_GET['ruangyangusul'] );
	$koderuang=$data[0];
	$ruang=$data[1];
	$harga= str_replace('.','',$_GET['harga']);
	$volume= str_replace('.','',$_GET['volume']);
	if($_GET['notrans']==''){
		$sql=$conn->query("call penyesesuaianperioritas(@nomor);");
		$sql=$conn->query("select @nomor as nomor;");
		$jml=$sql->num_rows;
		if($jml>0){ 
			$rs=$sql->fetch_object();
			$counter=$rs->nomor+1;
		}		
		$kode=gennotran($counter,"PP");
		
		$conn->query("insert into penyesesuaianperioritas_heder(notrans,kodepptk,pptk,kodebidang,namabidang,kodekegiatan,kegiatan,tgltrans,kdruang_pengusul,ruang_pengusul,
		tgl_entry,user_entry) 
		values('".$kode."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."','".trim($_GET['kodebidang'])."','".trim($_GET['namabidang'])."',
		'".trim($_GET['kodekegiatan'])."','".trim($_GET['kegiatan'])."','".$tanggaltrans."','".$koderuang."','".$ruang."','".date('Y-m-d H:i:s')."',
		'".$_SESSION["anggaran_kodeuser"]."')");
		
		$conn->query("insert into penyesesuaianperioritas_rinci(notrans,usulan,volume,harga,nilai,koderek108,uraian108,koderek50,uraian50,jumlahacc,tgl_entry,user_entry) 
		values('".$kode."','".trim($_GET['usulan'])."','".trim($volume)."','".trim($_GET['harga'])."','".trim($_GET['nilai'])."','".trim($_GET['koderek108'])."',
		'".trim($_GET['uraianrek108'])."','".trim($_GET['koderek50'])."','".trim($_GET['uraianrek50'])."','".trim($_GET['jumlahacc'])."','".date('Y-m-d H:i:s')."',
		'".$_SESSION["anggaran_kodeuser"]."')");
		
		$conn->query("update usulanHonor_r set flag='1' where notrans='".trim($_GET['nousulan'])."' and keterangan='".trim($_GET['usulan'])."' ");
		
		echo "OK|".$kode;
	}else{
		$kode=$_GET['notrans'];
		
		$conn->query("insert into penyesesuaianperioritas_rinci(notrans,usulan,volume,harga,nilai,koderek108,uraian108,koderek50,uraian50,jumlahacc,tgl_entry,user_entry) 
		values('".$kode."','".trim($_GET['usulan'])."','".trim($volume)."','".trim($_GET['harga'])."','".trim($_GET['nilai'])."','".trim($_GET['koderek108'])."',
		'".trim($_GET['uraianrek108'])."','".trim($_GET['koderek50'])."','".trim($_GET['uraianrek50'])."','".trim($_GET['jumlahacc'])."','".date('Y-m-d H:i:s')."',
		'".$_SESSION["anggaran_kodeuser"]."')");

		$conn->query("update usulanHonor_r set flag='1' where notrans='".trim($_GET['nousulan'])."' and keterangan='".trim($_GET['usulan'])."' ");
		
		echo "OK|".$kode;
	}
}

?>
<?php include("../../close.php"); ?>