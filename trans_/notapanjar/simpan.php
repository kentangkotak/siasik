<?php include("../../conn.php"); ?>
<?php
	
		
		$tglnotapanjar=in_tanggal("/",trim($_GET['tglnotapanjar']));
		$total= str_replace(',','',$_GET['total']);
		
			if($_GET['nonotapanjar']==''){
				$sql=$conn->query("call notapanjar(@nomor);");
				$sql=$conn->query("select @nomor as nomor;");
				$jml=$sql->num_rows;
				if($jml>0){ 
					$rs=$sql->fetch_object();
					$counter=$rs->nomor+1;
				}		
				$kode=gennotran($counter,"NOTA-PAN");
				
				$conn->query("insert into notapanjar_heder(nonotapanjar,tglnotapanjar,nonpd,triwulan,kodepptk,pptk,program,kegiatan,kodekegiatanblud,kegiatanblud,kodebidang,bidang,userentry,tglentry) 
				values('".$kode."','".trim($tglnotapanjar)."','".trim($_GET['nonpd'])."','".trim($_GET['triwulan'])."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."','".trim($_GET['program'])."',
				'".trim($_GET['kegiatan'])."','".trim($_GET['kodekegiatanblud'])."','".trim($_GET['kegiatanblud'])."','".trim($_GET['kodebidang'])."','".trim($_GET['bidang'])."',
				'".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."')");
				
				$conn->query("insert into notapanjar_rinci(nonotapanjar,koderek50,rincianbelanja50,total,userentry,tglentry) 
				values('".$kode."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."','".trim($total)."',
				'".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."')");
				
				$conn->query("update npdpanjar_heder set flagnotapanjar='1' where nonpdpanjar='".trim($_GET['nonpd'])."' ");
				
				echo "OK|".$kode;
			}else{
				$kode=$_GET['nonotapanjar'];
				
				$conn->query("insert into notapanjar_rinci(nonotapanjar,koderek50,rincianbelanja50,total,userentry,tglentry) 
				values('".$kode."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."','".trim($total)."',
				'".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."')");
				
				$conn->query("update npdpanjar_heder set flagnotapanjar='1' where nonpdpanjar='".trim($_GET['nonpd'])."' ");
				echo "OK|".$kode;
			}
		
?>
<?php include("../../close.php"); ?>