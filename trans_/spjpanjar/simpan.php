<?php include("../../conn.php"); ?>
<?php
	$tglspjpanjar=in_tanggal("/",trim($_GET['tglspjpanjar']));
		
		$harga= str_replace(',','',$_GET['harga']);
		$volume= str_replace(',','',$_GET['volume']);
		$jumlahanggaran= str_replace(',','',$_GET['jumlahanggaran']);
		$jumlahpenerimaanpanjar= str_replace(',','',$_GET['jumlahpenerimaanpanjar']);
		$jumlahbelanjapanjar= str_replace(',','',$_GET['jumlahbelanjapanjar']);
		$sisapanjar= str_replace(',','',$_GET['sisapanjar']);
		$sisasaldo= str_replace(',','',$_GET['sisasaldo']);
		
		if($jumlahbelanjapanjar > $sisasaldo){
			echo "MAAF BELANJA ANDA MELEBIHI ANGGARAN ANDA...!! ";
		}else{
			if($_GET['nospjpanjar']==''){
				$sql=$conn->query("call spjpanjar(@nomor);");
				$sql=$conn->query("select @nomor as nomor;");
				$jml=$sql->num_rows;
				if($jml>0){ 
					$rs=$sql->fetch_object();
					$counter=$rs->nomor+1;
				}		
				$kode=gennotran($counter,"SPJ-PJ");
				
				$conn->query("insert into spjpanjar_heder(nospjpanjar,tglspjpanjar,notapanjar,kodepptk,namapptk,program,kegiatan,kodekegiatanblud,kegiatanblud,kodepihakketiga,pihakketiga,
				keterangan,userentry,tglentry) 
				values('".$kode."','".trim($tglspjpanjar)."','".trim($_GET['notapanjar'])."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."',
				'".trim($_GET['program'])."','".trim($_GET['kegiatan'])."','".$_GET['kodekegiatanblud']."','".$_GET['kegiatanblud']."','".$_GET['kodepihakketiga']."','".$_GET['pihakketiga']."',
				'".$_GET['keterangan']."','".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."')");
				
				$conn->query("insert into spjpanjar_rinci(nospjpanjar,nopp,nousulan,nonpdpanjar,koderek50,rincianbelanja50,iditembelanjanpd,itembelanja,volume,satuan,harga,
				jumlahanggaran,jumlahpenerimaanpanjar,jumlahbelanjapanjar,sisapanjar,userentry,tglentry,koderek108) 
				values('".$kode."','".trim($_GET['nopp'])."','".trim($_GET['nousulan'])."','".trim($_GET['nonpdpanjar'])."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."','".trim($_GET['iditembelanjanpd'])."',
				'".trim($_GET['itembelanja'])."',
				'".trim($volume)."','".trim($_GET['satuan'])."','".trim($harga)."','".trim($jumlahanggaran)."','".trim($jumlahpenerimaanpanjar)."','".trim($jumlahbelanjapanjar)."',
				'".trim($sisapanjar)."',
				'".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."','".trim($_GET['koderek108'])."')");
				
				// $conn->query("update notapanjar_heder set flag='1' where nonotapanjar='".trim($_GET['notapanjar'])."' ");
				// $conn->query("update npdpanjar_rinci set flag='1',tglkunci='".date('Y-m-d H:i:s')."',userkunci='".$_SESSION["anggaran_kodeuser"]."' 
				// where nonpdpanjar='".trim($_GET['nonpdpanjar'])."' and id='".trim($_GET['iditembelanjanpd'])."' ");
				echo "OK|".$kode;
			}else{
				$kode=$_GET['nospjpanjar'];
				
				$conn->query("insert into spjpanjar_rinci(nospjpanjar,nopp,nousulan,nonpdpanjar,koderek50,rincianbelanja50,iditembelanjanpd,itembelanja,volume,satuan,harga,
				jumlahanggaran,jumlahpenerimaanpanjar,jumlahbelanjapanjar,sisapanjar,userentry,tglentry,koderek108) 
				values('".$kode."','".trim($_GET['nopp'])."','".trim($_GET['nousulan'])."','".trim($_GET['nonpdpanjar'])."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."','".trim($_GET['iditembelanjanpd'])."',
				'".trim($_GET['itembelanja'])."',
				'".trim($volume)."','".trim($_GET['satuan'])."','".trim($harga)."','".trim($jumlahanggaran)."','".trim($jumlahpenerimaanpanjar)."','".trim($jumlahbelanjapanjar)."',
				'".trim($sisapanjar)."',
				'".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."','".trim($_GET['koderek108'])."')");
				
				 // $conn->query("update npdpanjar_rinci set flag='1',tglkunci='".date('Y-m-d H:i:s')."',userkunci='".$_SESSION["anggaran_kodeuser"]."' 
				 // where nonpdpanjar='".trim($_GET['nonpdpanjar'])."' and id='".trim($_GET['iditembelanjanpd'])."' ");
				 // echo "OK|".$kode."|".$_GET['kodekegiatanblud'];
			}
		}
		
?>
<?php include("../../close.php"); ?>