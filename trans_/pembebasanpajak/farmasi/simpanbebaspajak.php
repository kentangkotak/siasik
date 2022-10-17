<?php include("../../../conn.php"); ?>
<?php
$sql=$conn->query("select * from bebaspajak_heder where nopenerimaan='".$_GET['nopenerimaan']."'");
$jml=$sql->num_rows;
if($jml > 0){
	echo "NO PENERIMAAN INI SUDAH DIBEBAS PAJAKKAN...!!!";
}else{
	$kode=time()."BEBAS-PJ";
	$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");
	$sql=$conn_simrs->query("select nopenerimaan,nofaktur,kodesuplier,suplier,tglfaktur,tgljatuhtempo,round(diskon),sum(subtotal) as totalbelumppn,round(sum(subtotal)*pajakppn/100,2) as ppn,
				round(sum(subtotal)+sum(subtotal)*pajakppn/100,2) as total from(
				  select rs81.rs1 as nopenerimaan,rs81.rs5 as nofaktur,rs81.rs3 as kodesuplier,rs89.rs2 as suplier,rs81.rs11 as tglfaktur,rs81.rs9 as tgljatuhtempo,round(rs81.rs13,2) as pajakppn,
				  rs82.rs2 as kode,rs32.rs2 as obat,if(rs82.rs3>0,rs82.rs3,rs82.rs4) as jumlah,rs82.rs11 as satuan,rs82.rs8 as diskon,if(rs82.rs3>0,rs82.rs3*rs82.rs14,
				  rs82.rs4*rs82.rs14) as subtotal
				  from rs32,rs81,rs82,rs89
				  where rs81.rs1=rs82.rs1 and rs82.rs2=rs32.rs1 and rs81.rs3=rs89.rs1 and rs81.rs19=''
				  and rs81.rs21<>'2'
				  and rs81.rs1='".$_GET['nopenerimaan']."') 
				  as xxx group by nopenerimaan");
	$rs=$sql->fetch_object();
	$conn->query("insert into bebaspajak_heder(notrans,nopenerimaan,nofaktur,kodesuplier,suplier,tgl_faktur,tgl_tempo,diskon,totalbelumppn,ppn,total,tglbebaspajak,userentry) 
			values('".$kode."','".trim($_GET['nopenerimaan'])."',
			'".$rs->nofaktur."','".$rs->kodesuplier."','".$rs->suplier."','".$rs->tglfaktur."','".$rs->tgljatuhtempo."','".$rs->diskon."','".$rs->totalbelumppn."','0',
			'".$rs->totalbelumppn."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."')");
	
	
	
	//$sqlx=$conn->query
	
	$sqlsim=$conn_simrs->query("select rs81.rs1 as notrans,rs82.*,rs32.rs2 as namaobat,rs32.kodejenisx as koderek50,
								rs32.kodegroupkodebarang as kode108,rs32.groupkodebarang as uraian,rs81.rs10 as jenispajak,rs81.rs13 as nominalpajak,rs81.rs5 as nofaktur
						from rs81,rs82,rs32 where rs81.rs1=rs82.rs1 and rs82.rs2=rs32.rs1 and rs81.rs1='".$_GET['nopenerimaan']."'");
	while($rs_sim=$sqlsim->fetch_object()){
		if($rs_sim->koderek50 == ''){
			echo "MAAF DALAM NOFAKTUR INI ADA OBAT YANG BELUM DI MAPPING DENGAN KODE REKEKNING 50...!!!";
		}else if($rs_sim->kode108 == ''){
			echo "MAAF DALAM NOFAKTUR INI ADA OBAT YANG BELUM DI MAPPING DENGAN KODE REKEKNING 108...!!!";
		}else{
			$conn->query("insert into bebaspajak_rinci(notrans,nopenerimaan,kodeobat,jumlahsatuanbesar,jumlahsatuankecil,netto,
			tglkadaluarsa,diskon,satuan,harga,jumlahppn,isi,gudang,namaobat,koderek50,kode108,uraian,jenispajak,nominalpajak,nofaktur) values('".$kode."','".trim($_GET['nopenerimaan'])."',
			'".$rs_sim->rs2."','".$rs_sim->rs3."','".$rs_sim->rs4."','".$rs_sim->rs14."','".$rs_sim->rs7."','".$rs_sim->rs8."','".$rs_sim->rs11."',
			'".$rs_sim->rs12."','0','".$rs_sim->rs15."','".$rs_sim->rs16."','".$rs_sim->namaobat."','".$rs_sim->koderek50."',
			'".$rs_sim->kode108."','".$rs_sim->uraian."','tanpa','0','".$rs_sim->nofaktur."')");
		}
	}
	echo "OK|".$kode;
 }

?>
<?php include("../../../close.php"); ?>