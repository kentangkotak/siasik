<?php include("../../conn.php"); ?>
<?php
		$tglpengembaliansisapanjar=in_tanggal("/",trim($_GET['tglpengembaliansisapanjar']));
		
		$harga= str_replace(',','',$_GET['harga']);
		$volume= str_replace(',','',$_GET['volume']);
		$jumlahanggaran= str_replace(',','',$_GET['jumlahanggaran']);
		$jumlahpenerimaanpanjar= str_replace(',','',$_GET['jumlahpenerimaanpanjar']);
		$jumlahbelanjapanjar= str_replace(',','',$_GET['jumlahbelanjapanjar']);
		$sisapanjar= str_replace(',','',$_GET['sisapanjar']);
		
		
			if($_GET['nopengembaliansisapanjar']==''){
				$sql=$conn->query("call nopengembaliansisapanjar(@nomor);");
				$sql=$conn->query("select @nomor as nomor;");
				$jml=$sql->num_rows;
				if($jml>0){ 
					$rs=$sql->fetch_object();
					$counter=$rs->nomor+1;
				}		
				$kode=gennotran($counter,"PENG-SSPJ");
				
				$conn->query("insert into pengembaliansisapanjar_heder(nopengembaliansisapanjar,tglpengembaliansisapanjar,nospjpanjar,kodepptk,pptk,program,kegiatan,kodekegiatanblud,kegiatanblud,
				tglentry,userentry) 
				values('".$kode."','".trim($tglpengembaliansisapanjar)."','".trim($_GET['nospjpanjar'])."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."',
				'".trim($_GET['program'])."','".trim($_GET['kegiatan'])."','".$_GET['kodekegiatanblud']."','".$_GET['kegiatanblud']."',
				'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
				
				$conn->query("insert into pengembaliansisapanjar_rinci(nopengembaliansisapanjar,idspj,nopp,nousulan,koderek50,rincianbelanja50,itembelanja,volume,satuan,harga,
				jumlahanggaran,jumlahpenerimaanpanjar,jumlahbelanjapanjar,sisapanjar,userentry,tglentry) 
				values('".$kode."','".trim($_GET['idspj'])."','".trim($_GET['nopp'])."','".trim($_GET['nousulan'])."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."',
				'".trim($_GET['itembelanja'])."',
				'".trim($volume)."','".trim($_GET['satuan'])."','".trim($harga)."','".trim($jumlahanggaran)."','".trim($jumlahpenerimaanpanjar)."','".trim($jumlahbelanjapanjar)."',
				'".trim($sisapanjar)."',
				'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
				
				$conn->query("update spjpanjar_heder set flag='1',tglflag='".date('Y-m-d H:i:s')."',userflag='".$_SESSION["anggaran_kodeuser"]."' 
				where nospjpanjar='".trim($_GET['nospjpanjar'])."' ");
				echo "OK|".$kode;
			}else{
				$kode=$_GET['nopengembaliansisapanjar'];
				
				$conn->query("insert into pengembaliansisapanjar_rinci(nopengembaliansisapanjar,idspj,nopp,nousulan,koderek50,rincianbelanja50,itembelanja,volume,satuan,harga,
				jumlahanggaran,jumlahpenerimaanpanjar,jumlahbelanjapanjar,sisapanjar,userentry,tglentry) 
				values('".$kode."','".trim($_GET['idspj'])."','".trim($_GET['nopp'])."','".trim($_GET['nousulan'])."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."',
				'".trim($_GET['itembelanja'])."',
				'".trim($volume)."','".trim($_GET['satuan'])."','".trim($harga)."','".trim($jumlahanggaran)."','".trim($jumlahpenerimaanpanjar)."','".trim($jumlahbelanjapanjar)."',
				'".trim($sisapanjar)."',
				'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
				
				$conn->query("update spjpanjar_heder set flag='1',tglflag='".date('Y-m-d H:i:s')."',userflag='".$_SESSION["anggaran_kodeuser"]."' 
				where nospjpanjar='".trim($_GET['nospjpanjar'])."' ");
			
				echo "OK|".$kode;
			}
		
		
?>
<?php include("../../close.php"); ?>