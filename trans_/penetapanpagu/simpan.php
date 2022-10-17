<?php include("../../conn.php"); ?>
<?php

$nominal= str_replace('.','',$_GET['nilairupiah']);
$sql_cek=$conn->query("select * from anggaran_pendapatan where tahun='".$_SESSION["anggaran_tahun"]."' ");
$cek=$sql_cek->num_rows; 
$sql_cekx=$conn->query("select * from penetapan_pagu where tahun='".$_SESSION["anggaran_tahun"]."' and kodekegiatan='".trim($_GET['kodekegiatanblud'])."' ");
$cekx=$sql_cekx->num_rows;

if($cek == 0){
	echo "PENDAPATAN UNTUK BIDANG ANDA BELUM TERENTRY UNTUK TAHUN DEPAN....!!";
}elseif($cekx > 0 && $_GET['x'] == ''){
	echo "MAAF KEGIATAN INI SUDAH DITETAPKAN PAGUNYA PADA TAHUN INI...!!!";
}else{
	$sql_max=$conn->query("select sum(nilai) as pendapatan from anggaran_pendapatan where tahun='".$_SESSION["anggaran_tahun"]."'");
	$rs_max=$sql_max->fetch_object();
	if($rs_max->pendapatan < $nominal){
		echo "MAAF PAGU ANDA TELAH MELEBIHI PENDAPATAN DIBIDANG....!!!";
	}else{
		if($_GET['notrans']==''){
			$sql=$conn->query("call penetapan_pagu(@nomor);");
			$sql=$conn->query("select @nomor as nomor;");
			$jml=$sql->num_rows;
			if($jml>0){ 
				$rs=$sql->fetch_object();
				$counter=$rs->nomor+1;
			}		
			$kode=gennotran($counter,"PG");
			
			$conn->query("insert into penetapan_pagu(notrans,kodekegiatan,kegiatanblud,kodeorganisasi1,kodeorganisasi2,kodeorganisasi3,namaorganisasi,total,tahun,tgl_entry,user_entry) values(
			'".$kode."','".trim($_GET['kodekegiatanblud'])."','".trim($_GET['kegiatanblud'])."','".trim($_GET['kode1'])."','".trim($_GET['kode2'])."','".trim($_GET['kode3'])."',
			'".trim($_GET['organisasi_nama'])."','".$nominal."',
			'".$_SESSION["anggaran_tahun"]."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
			
			$conn->query("insert into t_tampung_pagu(kodekegiatanblud,pagu,tahun) values(
			'".trim($_GET['kodekegiatanblud'])."','".$nominal."','".$_SESSION["anggaran_tahun"]."')");
			echo "OK|".$kode;
		}else{
			$conn->query("update penetapan_pagu set kodekegiatan='".trim($_GET['kodekegiatanblud'])."',kegiatanblud='".trim($_GET['kegiatanblud'])."',kodeorganisasi1='".trim($_GET['kode1'])."',
			kodeorganisasi2='".trim($_GET['kode2'])."',kodeorganisasi3='".trim($_GET['kode3'])."',namaorganisasi='".trim($_GET['organisasi_nama'])."',total='".$nominal."' 
			where notrans='".$_GET['notrans']."'");
			
			$conn->query("update t_tampung_pagu set pagu='".$nominal."' where kodekegiatanblud='".$_GET['kodekegiatanblud']."' and tahun='".$_SESSION["anggaran_tahun"]."'");
			
			echo "OK|".$kode;
		}
	}
}



?>
<?php include("../../close.php"); ?>