<?php include("../../../conn.php"); ?>
<?php

		$jumlahspp= str_replace(',','',$_GET['jumlahspp']);
		$total= str_replace(',','',$_GET['total']);
		$tanggaltrans=in_tanggal("/",trim($_GET['tgltrans']));
		$tglnpdpanjar=in_tanggal("/",trim($_GET['tglnpdpanjar']));
		$tanggaltransx=explode("-",$tanggaltrans);
		$tahun= $tanggaltransx[0];
		
		// $sqlx=$conn->query("select * from transsppup where year(tglTrans)='".$tahun."' ");
		// $jmlx=$sqlx->num_rows;
		
		// if($jmlx > 0){
			// echo "MAAF SPP UP HANYA BISA DILAKUKAN SEKALI DALAM SATU TAHUN";
		// }else{
			if($_GET['nosppup']==''){
				$sql=$conn->query("call nosppup(@nomor);");
				$sql=$conn->query("select @nomor as nomor;");
				$jml=$sql->num_rows;
				if($jml>0){ 
					$rs=$sql->fetch_object();
					$counter=$rs->nomor+1;
				}		
					$kode=gennotran($counter,"SPP-UP");
					
					$conn->query("insert into transsppup(nosppup,tglTrans,kdBendaharaKeluar,bendaharaKeluar,jumlahspp,bank,kodeRek,tglentry,userentry,uraian) values(
					'".$kode."','".$tanggaltrans."','".trim($_GET['nip'])."','".trim($_GET['bendaharapengeluaran'])."','".$jumlahspp."','".trim($_GET['namabank'])."',
					'".trim($_GET['norekening'])."',
					'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['uraian'])."')");
					
					// $conn->query("insert into transsppup_rinci(nosppup,nonpd,tglnpd,triwulan,kodepptk,pptk,program,kegiatan,kodekegiatanblud,kegiatanblud,total,tgl_entry,user_entry) values(
					// '".$kode."','".trim($_GET['nonpdpanjar'])."','".trim($tglnpdpanjar)."','".trim($_GET['triwulan'])."',
					// '".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."','".trim($_GET['program'])."','".trim($_GET['kegiatan'])."',
					// '".trim($_GET['kodekegiatanblud'])."','".trim($_GET['kegiatanblud'])."','".$total."',
					// '".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
					
					$totalwew=$jumlahspp+$total;
					$conn->query("update transsppup set jumlahspp='".$totalwew."' where nosppup='".trim($kode)."'");
					$conn->query("update npdpanjar_heder set flagspp=1 where nonpdpanjar='".trim($_GET['nonpdpanjar'])."'");
					echo "OK|".$kode."|".rpz($totalwew);
			}else{
					$kode=$_GET['nosppup'];
					
					// $conn->query("insert into transsppup_rinci(nosppup,nonpd,tglnpd,triwulan,kodepptk,pptk,program,kegiatan,kodekegiatanblud,kegiatanblud,total,tgl_entry,user_entry) values(
					// '".$kode."','".trim($_GET['nonpdpanjar'])."','".trim($tglnpdpanjar)."','".trim($_GET['triwulan'])."',
					// '".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."','".trim($_GET['program'])."','".trim($_GET['kegiatan'])."',
					// '".trim($_GET['kodekegiatanblud'])."','".trim($_GET['kegiatanblud'])."','".$total."',
					// '".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
					
					$totalwew=$jumlahspp+$total;
					$conn->query("update transsppup set jumlahspp='".$totalwew."' where nosppup='".trim($kode)."'");
					$conn->query("update npdpanjar_heder set flagspp=1 where nonpdpanjar='".trim($_GET['nonpdpanjar'])."'");
					echo "OK|".$kode."|".rpz($totalwew);
			}
		// }
		
		



?>
<?php include("../../../close.php"); ?>