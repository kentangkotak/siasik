<?php include "../../conn.php";?>
<?php
	$sql=$conn->query("select jumlah,sum(hargasetelahpajak) as hasil from(
								select jumlah,satuan,total,round(nominalpajak) as nominalpajakx,if(nominalpajak > 0,round(total+(total*(nominalpajak/100)),2),
								round(total,2)) as hargasetelahpajak from(
										select if(jumlahsatuanbesar > 0, sum(jumlahsatuanbesar),sum(jumlahsatuankecil))as jumlah,satuan as satuan,
										if(jumlahsatuanbesar > 0, sum(jumlahsatuanbesar*jumlahppn),sum(jumlahsatuankecil*jumlahppn))as total,
										nominalpajak as nominalpajak
										from serahterima_penerimaanrinci 
										where nokontrak='".$_GET['nokontrak']."' and kode108='".$_GET['koderek108']."' and flag='' GROUP by nopenerimaan,kodeobat) 
								as wew) 
					   as wewx");
	$rs=$sql->fetch_object();
	if($rs->hasil > 0){
		echo "OK|".$rs->jumlah."|".rpz($rs->hasil);
	}else{
		echo "TIDAK ADA HASIL UNTUK PENCARIAN INI, MOHON DI CEK KEMBALI TRANSAKSI ANDA...!!!";
	}
?>
<?php include "../../close.php";?>