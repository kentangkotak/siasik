<?php include("../../conn.php"); ?>
<?php
$sqlkunci=$conn->query("select * from sppgu_heder where nosppgu='".$_GET['nosppgu']."' and kunci=1");
$jmlkunci=$sqlkunci->num_rows;
if($jmlkunci > 0){
	echo "MAAF DATA INI SUDAH TERKUNCI, ANDA TIDAK BISA MENAMBAH ATAU MENGHAPUS DATA YANG SUDAH ADA...!!!";
}else{
		$tglsppgu=in_tanggal("/",trim($_GET['tglsppgu']));
		$tglspj=in_tanggal("/",trim($_GET['tglspj']));
		$jumlahpengeluaran= str_replace(',','',$_GET['jumlahpengeluaran']);
		$nilai= str_replace(',','',$_GET['nilai']);
		
			if($_GET['nosppgu']==''){
				$sql=$conn->query("call nosppgu(@nomor);");
				$sql=$conn->query("select @nomor as nomor;");
				$jml=$sql->num_rows;
				if($jml>0){ 
					$rs=$sql->fetch_object();
					$counter=$rs->nomor+1;
				}		
				$kode=gennotran($counter,"SPP-GU");
				
				$conn->query("insert into sppgu_heder(nosppgu,tglsppgu,triwulan,kodebendaharapengeluaran,bendaharapengeluaran,jumlahpengeluaran,kodebank,
				namabank,norekening,tglentry,userentry) 
				values('".$kode."','".trim($tglsppgu)."','".trim($_GET['triwulan'])."','".trim($_GET['kodebendaharapengeluaran'])."','".trim($_GET['bendaharapengeluaran'])."',
				'".trim($jumlahpengeluaran)."','".trim($_GET['kodebank'])."','".trim($_GET['namabank'])."',
				'".trim($_GET['norekening'])."',
				'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."'
				)");
				
				$conn->query("insert into sppgu_rinci(nosppgu,nospj,tglspj,kegiatan,kodekegiatanblud,kegiatanblud,nilai,
				tglentry,userentry) 
				values('".$kode."','".trim($_GET['nospj'])."','".trim($tglspj)."','".trim($_GET['kegiatan'])."','".trim($_GET['kodekegiatanblud'])."',
				'".trim($_GET['kegiatanblud'])."','".trim($nilai)."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
				
				$conn->query("update spjpanjar_heder set flag='1',tglflag='".date('Y-m-d H:i:s')."',userflag='".$_SESSION["anggaran_kodeuser"]."' where nospjpanjar='".trim($_GET['nospj'])."' ");
				echo "OK|".$kode;
				
			}else{
				$kode=$_GET['nosppgu'];
				
				$conn->query("insert into sppgu_rinci(nosppgu,nospj,tglspj,kegiatan,kodekegiatanblud,kegiatanblud,nilai,
				tglentry,userentry) 
				values('".$kode."','".trim($_GET['nospj'])."','".trim($tglspj)."','".trim($_GET['kegiatan'])."','".trim($_GET['kodekegiatanblud'])."',
				'".trim($_GET['kegiatanblud'])."','".trim($nilai)."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
				
				$conn->query("update spjpanjar_heder set flag='1',tglflag='".date('Y-m-d H:i:s')."',userflag='".$_SESSION["anggaran_kodeuser"]."' where nospjpanjar='".trim($_GET['nospj'])."' ");
				echo "OK|".$kode;
			}
}		
		
?>
<?php include("../../close.php"); ?>