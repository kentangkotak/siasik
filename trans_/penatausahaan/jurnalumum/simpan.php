<?php include("../../../conn.php"); ?>
<?php
	$tanggal=in_tanggal("/",trim($_GET['tanggal']));
	$jumlah= str_replace(',','',$_GET['jumlah']);
	
	$sql_cek=$conn->query('select * from jurnalumum_heder where nobukti ="'.$_GET['nobukti'].'" ');
	$jml=$sql_cek->num_rows;
	if($jml == ''){
		
		$conn->query("insert into jurnalumum_heder(nobukti,tanggal,keterangan,tgl_entry,user_entry) 
		values('".$_GET['nobukti']."','".trim($tanggal)."','".trim($_GET['keterangan'])."',
		'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."'
		)");
		
		if($_GET['debitkredit'] == 'DEBET'){
			$conn->query("insert into jurnalumum_rinci(nobukti,kodepsap13,uraianpsap13,debet,kredit,tgl_entry,user_entry) 
			values('".$_GET['nobukti']."','".trim($_GET['psap13'])."','".trim($_GET['uraianpsap13'])."','".trim($jumlah)."','',
			'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."'
			)");
			echo "OK|";
		}else{
			$conn->query("insert into jurnalumum_rinci(nobukti,kodepsap13,uraianpsap13,debet,kredit,tgl_entry,user_entry) 
			values('".$_GET['nobukti']."','".trim($_GET['psap13'])."','".trim($_GET['uraianpsap13'])."','','".trim($jumlah)."',
			'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."'
			)");
			echo "OK|";
		}
		
	}else{
		
		if($_GET['debitkredit'] == 'DEBET'){
			$conn->query("insert into jurnalumum_rinci(nobukti,kodepsap13,uraianpsap13,debet,kredit,tgl_entry,user_entry) 
			values('".$_GET['nobukti']."','".trim($_GET['psap13'])."','".trim($_GET['uraianpsap13'])."','".trim($jumlah)."','',
			'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."'
			)");
			echo "OK|";
		}else{
			$conn->query("insert into jurnalumum_rinci(nobukti,kodepsap13,uraianpsap13,debet,kredit,tgl_entry,user_entry) 
			values('".$_GET['nobukti']."','".trim($_GET['psap13'])."','".trim($_GET['uraianpsap13'])."','','".trim($jumlah)."',
			'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."'
			)");
			echo "OK|";
		}
	}
	
	
		
		
?>
<?php include("../../../close.php"); ?>