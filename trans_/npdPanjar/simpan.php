<?php include("../../conn.php"); ?>
<?php
	$tglnpd=in_tanggal("/",trim($_GET['tglnpd']));
	
	$bln=date('m',strtotime($tglnpd));
	$thn=date('Y',strtotime($tglnpd));
	//$bln=date('m');
	//$thn=date('Y');
	
	if($bln==01){
		$blnx=12;
		$thnx=$thn-1;
		
	}else{
		$blnx=$bln-1;
		$thnx=$thn;		
	}
	
	if($bln == '01' || $bln == '02' || $bln == '03'){
		$triwulan='TRIWULAN 1';
	}else if($bln == '04' || $bln == '05' || $bln == '06'){
		$triwulan='TRIWULAN 2';
	}else if($bln == '07' || $bln == '08' || $bln == '9'){
		$triwulan='TRIWULAN 3';
	}else{
		$triwulan='TRIWULAN 4';
	}
	
	$volumepermintaanpanjar= str_replace(',','',$_GET['volumepermintaanpanjar']);
	$hargapermintaanpanjar= str_replace(',','',$_GET['hargapermintaanpanjar']);
	$totalpermintaanpanjar= $volumepermintaanpanjar*$hargapermintaanpanjar;;
	
	$sisaanggaran= str_replace(',','',$_GET['sisaanggaran']);

	$harga= str_replace(',','',$_GET['harga']);
	$volume= str_replace(',','',$_GET['volume']);
	$total= str_replace(',','',$_GET['total']);
	
	$sqlcek=$conn->query("select * from transSpm");
	$jmlcek=$sqlcek->num_rows;
	if($jmlcek > 0){		
		if($sisaanggaran < $totalpermintaanpanjar){
			echo "MAAF PERMINTAAN ANDA MELEBIHI SISA ANGGARAN KEGIATAN ANDA...!!!, SISA ANGGARAN UNTUK KEGIATAN INI ADALAH ".rp($sisaanggaran);
		}else{
			if($_GET['nonpd']==''){
				if($_GET['kodebidang'] == "1.1.2"){
					$sql=$conn->query("call nonpdkeup(@nomor);");
					$sql=$conn->query("select @nomor as nomor;");
					$jml=$sql->num_rows;
						if($jml>0){ 
							$rs=$sql->fetch_object();
							$counter=$rs->nomor+1;
							$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
							$kode=$has.$counter."/".bulanrum(date('m'))."/".aliasx($_GET['kodebidang'])."/NPD-PANJAR/".date('Y');
						}		
				}else if($_GET['kodebidang'] == "1.1.1"){
					$sql=$conn->query("call nonpdumump(@nomor);");
					$sql=$conn->query("select @nomor as nomor;");
					$jml=$sql->num_rows;
						if($jml>0){ 
							$rs=$sql->fetch_object();
							$counter=$rs->nomor+1;
							$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
							$kode=$has.$counter."/".bulanrum(date('m'))."/".aliasx($_GET['kodebidang'])."/NPD-PANJAR/".date('Y');
						}	
				}else if($_GET['kodebidang'] == "1.2.2"){
					$sql=$conn->query("call nonpdpnmp(@nomor);");
					$sql=$conn->query("select @nomor as nomor;");
					$jml=$sql->num_rows;
						if($jml>0){ 
							$rs=$sql->fetch_object();
							$counter=$rs->nomor+1;
							$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
							$kode=$has.$counter."/".bulanrum(date('m'))."/".aliasx($_GET['kodebidang'])."/NPD-PANJAR/".date('Y');
						}
				}else if($_GET['kodebidang'] == "1.2.1"){
					$sql=$conn->query("call nonpdyanmedp(@nomor);");
					$sql=$conn->query("select @nomor as nomor;");
					$jml=$sql->num_rows;
						if($jml>0){ 
							$rs=$sql->fetch_object();
							$counter=$rs->nomor+1;
							$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
							$kode=$has.$counter."/".bulanrum(date('m'))."/".aliasx($_GET['kodebidang'])."/NPD-PANJAR/".date('Y');
						}
				}else if($_GET['kodebidang'] == "1.2.3"){
					$sql=$conn->query("call nonpdkeperawatanp(@nomor);");
					$sql=$conn->query("select @nomor as nomor;");
					$jml=$sql->num_rows;
						if($jml>0){ 
							$rs=$sql->fetch_object();
							$counter=$rs->nomor+1;
							$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
							$kode=$has.$counter."/".bulanrum(date('m'))."/".aliasx($_GET['kodebidang'])."/NPD-PANJAR/".date('Y');
						}
				}else if($_GET['kodebidang'] == "1.1.3"){
					$sql=$conn->query("call nonpdlitbangp(@nomor);");
					$sql=$conn->query("select @nomor as nomor;");
					$jml=$sql->num_rows;
						if($jml>0){ 
							$rs=$sql->fetch_object();
							$counter=$rs->nomor+1;
							$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
							$kode=$has.$counter."/".bulanrum(date('m'))."/".aliasx($_GET['kodebidang'])."/NPD-PANJAR/".date('Y');
						}
				}	
				
				$conn->query("insert into npdpanjar_heder(nonpdpanjar,tglnpdpanjar,triwulan,saldopanjar,kodepptk,pptk,program,kegiatan,kodekegiatanblud,kegiatanblud,
				userentry,tglentry,kodebidang,bidang) 
				values('".$kode."','".trim($tglnpd)."','".trim($triwulan)."','".trim($saldo)."','".trim($_GET['kodepptk'])."',
				'".trim($_GET['pptk'])."','".trim($_GET['program'])."','".trim($_GET['kegiatan'])."','".$_GET['kodekegiatanblud']."','".$_GET['kegiatanblud']."',
				'".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."','".$_GET['kodebidang']."','".$_GET['bidang']."'
				)");
				
				$conn->query("insert into npdpanjar_rinci(nonpdpanjar,nopp,nousulan,koderek50,rincianbelanja50,itembelanja,volume,satuan,harga,
				total,userentry,tglentry,volumepermintaanpanjar,hargapermintaanpanjar,totalpermintaanpanjar,idpp,koderek108,uraian108) 
				values('".$kode."','".trim($_GET['nopp'])."','".trim($_GET['nousulan'])."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."','".trim($_GET['itembelanja'])."',
				'".trim($volume)."','".trim($_GET['satuan'])."','".trim($harga)."','".trim($total)."',
				'".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."','".trim($volumepermintaanpanjar)."','".trim($hargapermintaanpanjar)."','".trim($totalpermintaanpanjar)."',
				'".trim($_GET['idpp'])."','".trim($_GET['koderek108'])."','".trim($_GET['uraian108'])."')");
				
				//$conn->query("update penyesesuaianperioritas_rinci set kunci='1' where notrans='".trim($_GET['nopp'])."' and id='".trim($_GET['idpp'])."'");
				
				echo "OK|".$kode;
			}else{
				$kode=$_GET['nonpd'];
				
				$sql=$conn->query("select * from npdpanjar_heder where nonpdpanjar='".$kode."' and kunci=1");
				$jml=$sql->num_rows;
				
				if($jml > 0){
					echo "MAAF TRANSAKSI INI SUDAH DI KUNCI....!!!";
				}else{
				
					$conn->query("insert into npdpanjar_rinci(nonpdpanjar,nopp,nousulan,koderek50,rincianbelanja50,itembelanja,volume,satuan,harga,
					total,userentry,tglentry,volumepermintaanpanjar,hargapermintaanpanjar,totalpermintaanpanjar,idpp,koderek108,uraian108) 
					values('".$kode."','".trim($_GET['nopp'])."','".trim($_GET['nousulan'])."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."','".trim($_GET['itembelanja'])."',
					'".trim($volume)."','".trim($_GET['satuan'])."','".trim($harga)."','".trim($total)."',
					'".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."','".trim($volumepermintaanpanjar)."','".trim($hargapermintaanpanjar)."','".trim($totalpermintaanpanjar)."',
					'".trim($_GET['idpp'])."','".trim($_GET['koderek108'])."','".trim($_GET['uraian108'])."')");

					//$conn->query("update penyesesuaianperioritas_rinci set kunci='1' where notrans='".trim($_GET['nopp'])."' and id='".trim($_GET['idpp'])."'");
			
					echo "OK|".$kode;
				}
			}
		}
	}else{
		//echo "MAAF DATA TIDAK BISA DI ENTRY, KARENA BELUM ADA SPP YANG DICAIRKAN..!!";
	}
	
	
		
		
?>
<?php include("../../close.php"); ?>