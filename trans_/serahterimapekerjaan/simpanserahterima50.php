<?php include("../../conn.php"); ?>
<?php
$sql=$conn->query("select * from serahterima_heder where noserahterimapekerjaan='".$_GET['noserahterimapekerjaan']."' and kunci=1");
$jml=$sql->num_rows;
if($jml > 0){
	echo "MAAF ANDA TIDAK BISA MENAMBAH DATA PADA TRANSAKSI INI, KARENA TRANSAKSI INI SUDAH TERKUNCI....!!!";
}else{
	$tglmulaikontrak=in_tanggal("/",trim($_GET['tglmulaikontrak']));
	$tglakhirkontrak=in_tanggal("/",trim($_GET['tglakhirkontrak']));
	$tgltrans=in_tanggal("/",trim($_GET['tgltrans']));
	
	//$nilaikegiatan= str_replace(',','',$_GET['nilaikegiatan']);
	$nilaikontrak= str_replace(',','',$_GET['nilaikontrak']);
	
	
	/*$sql=$conn->query("call noserahterimapekerjaan(@nomor);");
	$sql=$conn->query("select @nomor as nomor;");
	$jml=$sql->num_rows;
	if($jml>0){ 
		$rs=$sql->fetch_object();
		$counter=$rs->nomor+1;
	}		
	$kode=gennotran($counter,"SERAH-PKJ");*/

	if(trim($_GET['noserahterimapekerjaan']) == ''){
		$sql=$conn->query("call noserahterimapekerjaan(@nomor);");
			$sql=$conn->query("select @nomor as nomor;");
			$jml=$sql->num_rows;
			if($jml>0){ 
				$rs=$sql->fetch_object();
				$counter=$rs->nomor+1;
			}
			$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
			$kode=$has.$counter."/".bulanrum(date('m'))."/STP/".date('Y');
		
		$conn->query("insert into serahterima_heder(noserahterimapekerjaan,nokontrak,kodepihakketiga,namaperusahaan,kodemapingrs,namasuplier,
				tglmulaikontrak,tglakhirkontrak,tgltrans,kodepptk,namapptk,program,kegiatan,
				kodekegiatanblud,kegiatanblud,kode50,uraianpekerjaan,nilaikegiatan,totalpermintaanls,tglentry,userentry) 
				values('".trim($kode)."','".trim($_GET['nokontrak'])."','".trim($_GET['kodepihakketiga'])."','".trim($_GET['namaperusahaan'])."',
				'".trim($_GET['kodemapingrs'])."','".trim($_GET['namasuplier'])."',
				'".$tglmulaikontrak."','".trim($tglakhirkontrak)."',
				'".trim($tgltrans)."','".trim($_GET['kodepptk'])."','".trim($_GET['namapptk'])."','".trim($_GET['program'])."',
				'".trim($_GET['kegiatan'])."','".trim($_GET['kodekegiatanblud'])."','".trim($_GET['kegiatanblud'])."',
				'','','','".$nilaikontrak."',
				'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
		$conn->query("update kontrakPengerjaan_header set flag=1 where nokontrak='".$_GET['nokontrak']."'");
				
		$conn->query("insert into serahterima50(noserahterimapekerjaan,nokontrak,koderek50,uraianrek50,tglentry,userentry) 
				values('".trim($kode)."','".trim($_GET['nokontrak'])."','".trim($_GET['koderek50'])."','".trim($_GET['uraianpekerjaan'])."',
				'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
			
		echo "OK|".$kode;
	}else{
		$kode=trim($_GET['noserahterimapekerjaan']);
		$sqlcek=$conn->query("select * from serahterima50 where noserahterimapekerjaan='".trim($kode)."' and koderek50='".trim($_GET['koderek50'])."'");
		$jmlcek=$sqlcek->num_rows;
		
		if($jmlcek > 0){
			echo "MAAF KODE REKEKNIG 50 ".trim($_GET['koderek50']." SUDAH PERNAH ANDA INPUT DI NO. SERAH TERIMA INI...!!!");
		}else{
			$conn->query("insert into serahterima50(noserahterimapekerjaan,nokontrak,koderek50,uraianrek50,tglentry,userentry) 
					values('".trim($kode)."','".trim($_GET['nokontrak'])."','".trim($_GET['koderek50'])."','".trim($_GET['uraianpekerjaan'])."',
					'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
				
			echo "OK|".$kode;
		}
	}				
}			

?>
<?php include("../../close.php"); ?>