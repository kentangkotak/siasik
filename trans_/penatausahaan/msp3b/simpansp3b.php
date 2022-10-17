<?php include("../../../conn.php"); ?>
<?php
	$tanggal=in_tanggal("/",trim($_GET['tanggal']));
	$bulantahunx="01/".$_GET['bulantahun'];
	$bulantahun=in_tanggal("/",trim($bulantahunx));
	$data=explode("-",$bulantahun);
	$tahun=$data[0];
	$bulan=$data[1];
	
	 $sql_cek=$conn->query("select * from sp3b where year(bulan_realisasi) ='".$tahun."' and month(bulan_realisasi)='".$bulan."'");
	 $jml=$sql_cek->num_rows;
	if($jml > 0){
		$rs=$sql_cek->fetch_object();
		$nomor= $rs->nosp3b;
		// $conn->query("insert into sp3b(nosp3b,tanggal,bulan_realisasi,tgl_entry,user_entry) 
		// values('".$nomor."','".trim($tanggal)."','".trim($bulantahun)."',
		// '".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
		echo "OK|".$tahun."-".$bulan."|".$nomor;
	}else{
		$nomor= time()."-SP3B";
		$conn->query("insert into sp3b(nosp3b,tanggal,bulan_realisasi,tgl_entry,user_entry) 
		values('".$nomor."','".trim($tanggal)."','".trim($bulantahun)."',
		'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."'
		)");
		echo "OK|".$tahun."-".$bulan."|".$nomor;
	}		
?>
<?php include("../../../close.php"); ?>