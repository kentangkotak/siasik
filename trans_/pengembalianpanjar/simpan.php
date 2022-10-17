<?php include("../../conn.php"); ?>
<?php
	$tglpengembalianpanjar=in_tanggal("/",trim($_GET['tglpengembalianpanjar']));
		
		$harga= str_replace(',','',$_GET['harga']);
		$volume= str_replace(',','',$_GET['volume']);
		$jumlahanggaran= str_replace(',','',$_GET['jumlahanggaran']);
		$jumlahpenerimaanpanjar= str_replace(',','',$_GET['jumlahpenerimaanpanjar']);
		$jumlahbelanjapanjar= str_replace(',','',$_GET['jumlahbelanjapanjar']);
		$sisapanjar= str_replace(',','',$_GET['sisapanjar']);
		
		if($jumlahbelanjapanjar > $jumlahanggaran){
			"MAAF BELANJA ANDA MELEBIHI ANGGARAN ANDA...!! ";
		}else{
			if($_GET['nopengembalianpanjar']==''){
				$sql=$conn->query("call pengembalianpanjar(@nomor);");
				$sql=$conn->query("select @nomor as nomor;");
				$jml=$sql->num_rows;
				if($jml>0){ 
					$rs=$sql->fetch_object();
					$counter=$rs->nomor+1;
				}		
				$kode=gennotran($counter,"BAL-JAR");
				
				$conn->query("insert into pengembalianpanjar_heder(nopengembalianpanjar,tglpengembalianpanjar,notapanjar,kodepptk,pptk,program,kegiatan,kodekegiatanblud,kegiatanblud,kodepihakketiga,pihakketiga,
				keterangan,tglentry,userentry) 
				values('".$kode."','".trim($tglpengembalianpanjar)."','".trim($_GET['notapanjar'])."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."',
				'".trim($_GET['program'])."','".trim($_GET['kegiatan'])."','".$_GET['kodekegiatanblud']."','".$_GET['kegiatanblud']."','".$_GET['kodepihakketiga']."','".$_GET['pihakketiga']."',
				'".$_GET['keterangan']."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
				
				$conn->query("insert into pengembalianpanjar_rinci(nopengembalianpanjar,nopp,nousulan,koderek50,rincianbelanja50,idnpdpanjar,itembelanja,volume,satuan,harga,
				jumlahanggaran,jumlahpenerimaanpanjar,jumlahbelanjapanjar,sisapanjar,tglentry,userentry) 
				values('".$kode."','".trim($_GET['nopp'])."','".trim($_GET['nousulan'])."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."','".trim($_GET['idnpdpanjar'])."',
				'".trim($_GET['itembelanja'])."',
				'".trim($volume)."','".trim($_GET['satuan'])."','".trim($harga)."','".trim($jumlahanggaran)."','".trim($jumlahpenerimaanpanjar)."','".trim($jumlahbelanjapanjar)."',
				'".trim($sisapanjar)."',
				'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
				
				//$conn->query("update npdpanjar_rinci set flag='1',tglkunci='".date('Y-m-d H:i:s')."',userkunci='".$_SESSION["anggaran_kodeuser"]."' 
				//where nonpdpanjar='".trim($_GET['nonpdpanjar'])."' and id='".trim($_GET['iditembelanjanpd'])."' ");
				echo "OK|".$kode;
			}else{
				$kode=$_GET['nopengembalianpanjar'];
				
				$conn->query("insert into pengembalianpanjar_rinci(nopengembalianpanjar,nopp,nousulan,koderek50,rincianbelanja50,idnpdpanjar,itembelanja,volume,satuan,harga,
				jumlahanggaran,jumlahpenerimaanpanjar,jumlahbelanjapanjar,sisapanjar,tglentry,userentry) 
				values('".$kode."','".trim($_GET['nopp'])."','".trim($_GET['nousulan'])."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."','".trim($_GET['idnpdpanjar'])."',
				'".trim($_GET['itembelanja'])."',
				'".trim($volume)."','".trim($_GET['satuan'])."','".trim($harga)."','".trim($jumlahanggaran)."','".trim($jumlahpenerimaanpanjar)."','".trim($jumlahbelanjapanjar)."',
				'".trim($sisapanjar)."',
				'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
				
				//$conn->query("update npdpanjar_rinci set flag='1',tglkunci='".date('Y-m-d H:i:s')."',userkunci='".$_SESSION["anggaran_kodeuser"]."' 
				//where nonpdpanjar='".trim($_GET['nonpdpanjar'])."' and id='".trim($_GET['iditembelanjanpd'])."' ");
				echo "OK|".$kode;
			}
		}
		
?>
<?php include("../../close.php"); ?>