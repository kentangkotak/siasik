<?php include("../../conn.php"); ?>
<?php

	$tglmulaikontrak=in_tanggal("/",trim($_GET['tglmulaikontrak']));
	$tglakhirkontrak=in_tanggal("/",trim($_GET['tglakhirkontrak']));
	$tgltrans=in_tanggal("/",trim($_GET['tgltrans']));
	
//	$volumepermintaanpanjar= str_replace(',','',$_GET['volumepermintaanpanjar']);
//	$hargapermintaanpanjar= str_replace(',','',$_GET['hargapermintaanpanjar']);
//	$sisaanggaran= str_replace(',','',$_GET['sisaanggaran']);
//	$nilai= $volumepermintaanpanjar*$hargapermintaanpanjar;
	
//	$harga= str_replace(',','',$_GET['harga']);
//	$volume= str_replace(',','',$_GET['volume']);
//	$total= str_replace(',','',$_GET['total']);
	
	//$nilaikegiatan= str_replace(',','',$_GET['nilaikegiatan']);
	$nilaikontrak= str_replace(',','',$_GET['nilaikontrak']);
	//$nilai= str_replace(',','',$_GET['nilai']);
	
	$data=explode( '|', $_GET['pptk'] );
	$kodepptk=$data[0];
	$namapptk=$data[1];
	
	$datax=explode( '|', $_GET['perusahaan'] );
	$kodeperusahaan=$datax[0];
	$namaperusahaan=$datax[1];
	$kodemapingrs=$datax[2];
	$namasuplier=$datax[3];
	
	//if($nilaikontrak > $nilaikegiatan){
	//	echo "MAAF NILAI MELEBIHI NILAI KEGIATAN....!!";
	//}else{
		if($_GET['nokontrak']==''){
			$sql=$conn->query("call kontrakPekerjaan(@nomor);");
			$sql=$conn->query("select @nomor as nomor;");
			$jml=$sql->num_rows;
			if($jml>0){ 
				$rs=$sql->fetch_object();
				$counter=$rs->nomor+1;
			}		
			//$kode=gennotran($counter,"K-P");
			$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
			$kode=$has.$counter."/".bulanrum(date('m'))."/KP/".date('Y');
			
			$conn->query("insert into kontrakPengerjaan_header(nokontrak,kodeperusahaan,namaperusahaan,tglmulaikontrak,tglakhirkontrak,tgltrans,kodepptk,namapptk,program,kegiatan,
							kodekegiatanblud,kegiatanblud,kode50,uraianpekerjaan,nilaikegiatan,userentry,tglentry,kodemapingrs,namasuplier,nilaikontrak) 
							values('".$kode."','".trim($kodeperusahaan)."','".trim($namaperusahaan)."','".$tglmulaikontrak."','".trim($tglakhirkontrak)."',
							'".trim($tgltrans)."','".trim($kodepptk)."','".trim($namapptk)."','".trim($_GET['program'])."',
							'".trim($_GET['kegiatan'])."','".trim($_GET['kodekegiatanblud'])."','".trim($_GET['kegiatanblud'])."',
							'','','',
							'".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."','".$kodemapingrs."','".$namasuplier."','".$nilaikontrak."')");
			
		//	$conn->query("insert into kontrakPengerjaan_rinci(nokontrak,idpprini,nopp,nousulan,rincianbelanja,volume,satuan,harga,total,volumels,
		//	hargals,nofaktur,keterangan,nilai,userentry,tglentry,satuanbaru) values('".$kode."','".trim($_GET['idpprini'])."','".trim($_GET['nopp'])."',
		//	'".trim($_GET['nousulan'])."','".trim($_GET['itembelanja'])."','".trim($volume)."','".trim($_GET['satuan'])."',
		//	'".trim($harga)."','".trim($total)."','".trim($volumepermintaanpanjar)."','".trim($hargapermintaanpanjar)."',
		//	'".trim($_GET['nofaktur'])."','".$_GET['keterangan']."','".$nilai."','".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."','".$_GET['satuanbaru']."')");
			
		//	$conn->query("update penyesesuaianperioritas_rinci set kunci='1' where id='".trim($_GET['idpprini'])."'");
			echo "OK|".$kode;
		//}else{
		//	$kode=$_GET['nokontrak'];
			
		//	$conn->query("insert into kontrakPengerjaan_rinci(nokontrak,idpprini,nopp,nousulan,rincianbelanja,volume,satuan,harga,total,volumels,
		//	hargals,nofaktur,keterangan,nilai,userentry,tglentry,satuanbaru) values('".$kode."','".trim($_GET['idpprini'])."','".trim($_GET['nopp'])."',
		//	'".trim($_GET['nousulan'])."','".trim($_GET['itembelanja'])."','".trim($volume)."','".trim($_GET['satuan'])."',
		//	'".trim($harga)."','".trim($total)."','".trim($volumepermintaanpanjar)."','".trim($hargapermintaanpanjar)."',
		//	'".trim($_GET['nofaktur'])."','".$_GET['keterangan']."','".$nilai."','".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."','".$_GET['satuanbaru']."')");
			
		//	$conn->query("update penyesesuaianperioritas_rinci set kunci='1' where id='".trim($_GET['idpprini'])."'");
		//	echo "MAAF NO KONTRAK INI SUDAH DI BUAT...!!!";
		}else{
			echo "MAAF UNTUK NO. KONTRAK INI SUDAH TERSIMPAN....!!!!";
		}
	//}

?>
<?php include("../../close.php"); ?>