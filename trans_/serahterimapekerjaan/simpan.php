<?php include("../../conn.php"); ?>
<?php

$sql=$conn->query("select * from serahterima_heder where noserahterimapekerjaan='".$_GET['noserahterimapekerjaan']."' and kunci=1");
$jml=$sql->num_rows;

$sql50cek=$conn->query("select * from serahterima50 where noserahterimapekerjaan='".$_GET['noserahterimapekerjaan']."'");
$jml50cek=$sql50cek->num_rows;
if($jml50cek > 0){
	if($jml > 0){
		echo "MAAF ANDA TIDAK BISA MENAMBAH DATA PADA TRANSAKSI INI, KARENA TRANSAKSI INI SUDAH TERKUNCI....!!!";
	}else{
		$tglmulaikontrak=in_tanggal("/",trim($_GET['tglmulaikontrak']));
		$tglakhirkontrak=in_tanggal("/",trim($_GET['tglakhirkontrak']));
		$tgltrans=in_tanggal("/",trim($_GET['tgltrans']));
		$tanggalfaktur=in_tanggal("/",trim($_GET['tanggalfaktur']));
		$tanggaljatuhtempo=in_tanggal("/",trim($_GET['tanggaljatuhtempo']));
		
		//$nilaikegiatan= str_replace(',','',$_GET['nilaikegiatan']);
		$nilaikontrak= str_replace(',','',$_GET['nilaikontrak']);
		$totalbelumppn= str_replace(',','',$_GET['totalbelumppn']);
		$harga= str_replace(',','',$_GET['harga']);
		$total= str_replace(',','',$_GET['total']);
		
		$volumepermintaanls= str_replace(',','',$_GET['volumepermintaanls']);
		$hargapermintaanls= str_replace(',','',$_GET['hargapermintaanls']);
		
		$tagihanpenerimaan= str_replace(',','',$_GET['tagihanpenerimaan']);
		$tagihanfaktur= str_replace(',','',$_GET['tagihanfaktur']);
		
		$diskon= str_replace(',','',$_GET['diskon']);
		
		$sqlceknilai=$conn->query("select sum(serahterima_rinci.tagihanfaktur) as totalnilai 
									from serahterima_heder,serahterima_rinci 
									where serahterima_heder.noserahterimapekerjaan=serahterima_rinci.noserahterimapekerjaan and 
									serahterima_heder.nokontrak='".$_GET['nokontrak']."'");
		$rsceknilai=$sqlceknilai->fetch_object();
		$totalnilai=$rsceknilai->totalnilai+$tagihanfaktur;
		
		if($nilaikontrak < $totalnilai){
			echo " MAAF NILAI TOTAL PENERIMAAN ANDA ".rpzx($totalnilai);
		}else{
			$kode=$_GET['noserahterimapekerjaan'];	
			$conn->query("insert into serahterima_rinci(noserahterimapekerjaan,nokontrak,tanggalfaktur,tanggaljatuhtempo,
						  totalbelumppn,
						  nopenerimaan,nofaktur,diskon,tagihanpenerimaan,tagihanfaktur,tglentry,userentry) 
						  values('".$kode."','".trim($_GET['nokontrak'])."','".$tanggalfaktur."','".$tanggaljatuhtempo."','".$totalbelumppn."',
						  '".trim($_GET['nopenerimaan'])."',
						  '".trim($_GET['nofaktur'])."','".trim($diskon)."','".trim($tagihanpenerimaan)."','".trim($tagihanfaktur)."',
						  '".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
							  $sqlcekbebas=$conn->query("select * from bebaspajak_heder where nopenerimaan='".$_GET['nopenerimaan']."'");
							  $jmlbebas=$sqlcekbebas->num_rows;
								if($jmlbebas > 0){
									$sqlcekbebasrinci=$conn->query("select * from bebaspajak_rinci where nopenerimaan='".$_GET['nopenerimaan']."'");
									while($rsbebasrinci=$sqlcekbebasrinci->fetch_object()){
											$conn->query("insert into serahterima_penerimaanrinci(noserahterimapekerjaan,nokontrak,nopenerimaan,kodeobat,jumlahsatuanbesar,jumlahsatuankecil,netto,
											tglkadaluarsa,diskon,satuan,harga,jumlahppn,isi,gudang,namaobat,koderek50,kode108,uraian,jenispajak,nominalpajak,nofaktur) values('".$kode."','".trim($_GET['nokontrak'])."','".trim($_GET['nopenerimaan'])."',
											'".$rsbebasrinci->kodeobat."','".$rsbebasrinci->jumlahsatuanbesar."','".$rsbebasrinci->jumlahsatuankecil."','".$rsbebasrinci->netto."','".$rsbebasrinci->tglkadaluarsa."','".$rsbebasrinci->diskon."','".$rsbebasrinci->satuan."',
											'".$rsbebasrinci->harga."','".$rsbebasrinci->harga."','".$rsbebasrinci->isi."','".$rsbebasrinci->gudang."','".$rsbebasrinci->namaobat."','".$rsbebasrinci->koderek50."',
											'".$rsbebasrinci->kode108."','".$rsbebasrinci->uraian."','".$rsbebasrinci->jenispajak."','".$rsbebasrinci->nominalpajak."','".$rs_sim->nofaktur."')");
									}
									$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");
									$conn_simrs->query("update rs81 set rs21=2,rs22='".trim($_GET['nokontrak'])."' where rs1='".$_GET['nopenerimaan']."'");
									echo "OK|".$kode;
								}else{
									$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");
									$conn_simrs->query("update rs81 set rs21=2,rs22='".trim($_GET['nokontrak'])."' where rs1='".$_GET['nopenerimaan']."'");
									$sqlsim=$conn_simrs->query("select rs81.rs1 as notrans,rs82.*,rs32.rs2 as namaobat,rs32.kodejenisx as koderek50,
																rs32.kodegroupkodebarang as kode108,rs32.groupkodebarang as uraian,rs81.rs10 as jenispajak,rs81.rs13 as nominalpajak,rs81.rs5 as nofaktur
														from rs81,rs82,rs32 where rs81.rs1=rs82.rs1 and rs82.rs2=rs32.rs1 and rs81.rs1='".$_GET['nopenerimaan']."'");
									while($rs_sim=$sqlsim->fetch_object()){
										if($rs_sim->koderek50 == ''){
											echo "MAAF DALAM NOFAKTUR INI ADA OBAT YANG BELUM DI MAPPING DENGAN KODE REKEKNING 50...!!!";
										}else if($rs_sim->kode108 == ''){
											echo "MAAF DALAM NOFAKTUR INI ADA OBAT YANG BELUM DI MAPPING DENGAN KODE REKEKNING 108...!!!";
										}else{
											$conn->query("insert into serahterima_penerimaanrinci(noserahterimapekerjaan,nokontrak,nopenerimaan,kodeobat,jumlahsatuanbesar,jumlahsatuankecil,netto,
											tglkadaluarsa,diskon,satuan,harga,jumlahppn,isi,gudang,namaobat,koderek50,kode108,uraian,jenispajak,nominalpajak,nofaktur) values('".$kode."','".trim($_GET['nokontrak'])."','".trim($_GET['nopenerimaan'])."',
											'".$rs_sim->rs2."','".$rs_sim->rs3."','".$rs_sim->rs4."','".$rs_sim->rs14."','".$rs_sim->rs7."','".$rs_sim->rs8."','".$rs_sim->rs11."',
											'".$rs_sim->rs12."','".$rs_sim->rs14."','".$rs_sim->rs15."','".$rs_sim->rs16."','".$rs_sim->namaobat."','".$rs_sim->koderek50."',
											'".$rs_sim->kode108."','".$rs_sim->uraian."','".$rs_sim->jenispajak."','".$rs_sim->nominalpajak."','".$rs_sim->nofaktur."')");
										}
									}
									echo "OK|".$kode;
								}
		}
	}
}else{
	echo "MAAF FORM KODE REKENING 50 HARUS DIISI TERLEBIH DAHULU...!!!";
}
?>
<?php include("../../close.php"); ?>