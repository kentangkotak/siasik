<?php include("../../conn.php"); ?>
<?php

	$tanggaltrans=in_tanggal("/",trim($_GET['tgltrans']));
	$harga= str_replace('.','',$_GET['harga']);
	$volume= str_replace('.','',$_GET['volume']);
	$nilai=$harga * $volume;
	$data=explode( '|', $_GET['bidangPengusul'] );
	$unit=$data[0];
	$kdUnit=$data[1];
	if($_GET['notrans']==''){
		$sql=$conn->query("call usulan_honor(@nomor);");
		$sql=$conn->query("select @nomor as nomor;");
		$jml=$sql->num_rows;
		if($jml>0){ 
			$rs=$sql->fetch_object();
			$counter=$rs->nomor+1;
		}		
		$kode=gennotran($counter,"UL");
		
		$conn->query("insert into usulanHonor_h(notrans,kodeRuangan,ruangan,tglTransaksi,kodeKegiatan,kegiatan,kodebagian,organisasi_nama,kode50,uraian,userEntry,tglEntry) 
		values('".$kode."','".trim($_GET['koderuang'])."','".trim($_GET['ruangan'])."','".$tanggaltrans."','".trim($_GET['kodekegiatan'])."',
		'".trim($_GET['kegiatan'])."','".trim($_GET['kodebagian'])."','".trim($_GET['organisasi_nama'])."','".trim($_GET['kode50'])."',
		'".trim($_GET['uraian'])."','".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."')");
		
		$conn->query("insert into usulanHonor_r(notrans,keterangan,volume,harga,nilai,tglEntry,userEntry,satuan,kodebidangpengusul,bidangPengusul) values('".$kode."','".trim($_GET['keterangan'])."','".trim($volume)."',
		'".$harga."','".$nilai."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['satuan'])."','".$unit."','".$kdUnit."')");
		
		echo "OK|".$kode;
	}else{
		$kode=$_GET['notrans'];
		
		$conn->query("insert into usulanHonor_r(notrans,keterangan,volume,harga,nilai,tglEntry,userEntry,satuan,kodebidangpengusul,bidangPengusul) values('".$kode."','".trim($_GET['keterangan'])."','".trim($volume)."',
		'".$harga."','".$nilai."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['satuan'])."','".$unit."','".$kdUnit."')");
		echo "OK|".$kode;
	}

?>
<?php include("../../close.php"); ?>