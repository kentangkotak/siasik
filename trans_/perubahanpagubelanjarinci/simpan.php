<?php include("../../conn.php"); ?>
<?php
	$tgltrans=in_tanggal("/",trim($_GET['tgltrans']));
	$volume=str_replace(',','',$_GET['volume']);
	$harga=str_replace(',','',$_GET['harga']);
	$nilai=$volume*$harga;
		if(trim($_GET['noperubahan']) == ''){
			$kode=time()."/PP-BR";
		}else{
			$kode=trim($_GET['noperubahan']);
		}
			
			$conn->query("insert into perubahanpagubelanjarinci(noperubahan,notranslama,tgltransaksilama,tglperubahan,usulan,volume,harga,nilai,koderek108,uraian108,
						koderek50,uraian50,tgl_entry,user_entry,satuan,nousulan,kodepptk,pptk,kodebidang,namabidang,kodekegiatan,kegiatan) 
			values('".$kode."','".trim($_GET['notrans'])."','".trim($tgltrans)."','".date('Y-m-d')."','".trim($_GET['usulan'])."','".trim($volume)."',
			'".trim($harga)."','".trim($nilai)."','".trim($_GET['koderek108'])."','".trim($_GET['uraianrek108'])."','".trim($_GET['koderek50'])."',
			'".trim($_GET['uraianrek50'])."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['satuan'])."','".trim($_GET['nousulan'])."',
			'".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."','".trim($_GET['kodebidang'])."','".trim($_GET['namabidang'])."',
			'".trim($_GET['kodekegiatan'])."','".trim($_GET['kegiatan'])."')");
			
			echo "OK|".$kode;

?>
<?php include("../../close.php"); ?>