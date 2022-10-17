<?php include("../../conn.php"); ?>
<?php

	$tanggaltrans=in_tanggal("/",trim($_GET['tgltrans']));
	$batas= str_replace(',','',$_GET['batas']);
	$jumlah= str_replace(',','',$_GET['jumlah']);
	$totalnpk= str_replace(',','',$_GET['totalnpk']);
	
	$data=explode( '|', $_GET['norek'] );
	$rek=$data[0];
	$namabank=$data[1];
	$kodebank=$data[2];
	
	if($_GET['jenis'] == 1){
		$jenis="Bank Ke Kas";
	}else{
		$jenis="Kas Ke Bank";
	}
	
	if($batas == 0.00){
		echo "MAAF JUMLAH SALDO ANDA 0 ...!!!";
	}else{
		if($jumlah > $batas){
			echo "MAAF JUMLAH YANG ANDA CAIRKAN MELEBIHI SALDO...!!!";
		}else{
			if($_GET['notrans']==''){
				$sql=$conn->query("call nogeser(@nomor);");
				$sql=$conn->query("select @nomor as nomor;");
				$jml=$sql->num_rows;
				if($jml>0){ 
					$rs=$sql->fetch_object();
					$counter=$rs->nomor+1;
				}		
				$kode=gennotran($counter,"T-GS");
				
				$conn->query("insert into pergeseranTheder(notrans,tgltrans,jenis,batasPergeseran,jumlah,norekening,namabank,kodebank,userentry,tglentry) 
				values('".$kode."','".$tanggaltrans."','".trim($jenis)."','".trim($batas)."','','".trim($rek)."','".trim($namabank)."','".trim($kodebank)."',
				'".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."')");
				
				$conn->query("insert into pergeseranTrinci(notrans,nonpk,keterangan,jumlah,tglentry,userentry,nonpd) 
				values('".$kode."','".trim($_GET['nonpk'])."','".trim($_GET['keterangan'])."','".trim($totalnpk)."','".date('Y-m-d H:i:s')."',
				'".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['nonpd'])."')");
				
				$conn->query("update npkpanjar_rinci set flag=1 where nonpd='".trim($_GET['nonpd'])."'");
				$conn->query("update npdpanjar_rinci set flaggeser=1 where nonpdpanjar='".trim($_GET['nonpd'])."'");
				echo "OK|".$kode;
			}else{
				$kode=$_GET['notrans'];
				
				$conn->query("insert into pergeseranTrinci(notrans,nonpk,keterangan,jumlah,tglentry,userentry,nonpd) 
				values('".$kode."','".trim($_GET['nonpk'])."','".trim($_GET['keterangan'])."','".trim($totalnpk)."','".date('Y-m-d H:i:s')."',
				'".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['nonpd'])."')");
				
				$conn->query("update npkpanjar_rinci set flag=1 where nonpd='".trim($_GET['nonpd'])."'");
				$conn->query("update npdpanjar_rinci set flaggeser=1 where nonpdpanjar='".trim($_GET['nonpd'])."'");
				echo "OK|".$kode;
			}
		}
	}
	

?>
<?php include("../../close.php"); ?>