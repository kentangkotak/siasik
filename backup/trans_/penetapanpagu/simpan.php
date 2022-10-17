<?php include("../../conn.php"); ?>
<?php

$nominal= str_replace('.','',$_GET['nilairupiah']);
$sql_cek=$conn->query("select * from anggaran_pendapatan where tahun='".$_SESSION["anggaran_tahun"]."' ");
$cek=$sql_cek->num_rows; 
if($cek == 0){
	echo "PENDAPATAN UNTUK BIDANG ANDA BELUM TERENTRY UNTUK TAHUN DEPAN....!!";
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
			$kode=gennotran($counter,"AP");
			
			$conn->query("insert into penetapan_pagu(notrans,kodekegiatan,kegiatanblud,kodeorganisasi1,kodeorganisasi2,kodeorganisasi3,namaorganisasi,total,tahun,tgl_entry,user_entry) values(
			'".$kode."','".trim($_GET['kodekegiatanblud'])."','".trim($_GET['kegiatanblud'])."','".trim($_GET['kode1'])."','".trim($_GET['kode2'])."','".trim($_GET['kode3'])."',
			'".trim($_GET['organisasi_nama'])."','".$nominal."',
			'".$_SESSION["anggaran_tahun"]."','".date('Y-m-d H:i:s')."','')");
			echo "OK|".$kode;
		}
	}
}



?>
<?php include("../../close.php"); ?>