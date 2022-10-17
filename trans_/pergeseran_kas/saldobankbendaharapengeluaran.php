<?php include("../../conn.php"); ?>
<?php
	// $bln=date('m');
	// $thn=date('Y');
	
	// if($bln==1){
		// $blnx=12;
		// $thnx=$thn-1;
		
	// }else{
		// $blnx=$bln-1;
		// $thnx=$thn;		
	// }
	
    
	if($_GET['x'] == 1){
		$sqlbank=$conn->query("select round(sum(awal),2)as awalx,round(sum(tambah),2) as tambahx,round(sum(kurang),2) as kurangx,round(sum(awal)+sum(tambah)-sum(kurang),2) as lope from(
							 select '' as awal,round(sum(jumlahspp),2) as tambah,'' as kurang from transSpm 
							 where year(tgltransSpp)='".$_SESSION["anggaran_tahun"]."'
							 union all
							 select '' as awal,sum(round(pergeseranTrinci.jumlah,2)) as tambah,'' as kurang 
							 from pergeseranTheder,pergeseranTrinci 
							 where pergeseranTheder.notrans=pergeseranTrinci.notrans and 
							 year(pergeseranTheder.tgltrans)='".$_SESSION["anggaran_tahun"]."' and pergeseranTheder.jenis='Kas Ke Bank'
							 union all 
							 select '' as awal,'' as tambah,sum(round(pergeseranTrinci.jumlah,2)) as kurang 
							 from pergeseranTheder,pergeseranTrinci 
							 where pergeseranTheder.notrans=pergeseranTrinci.notrans and 
							 year(pergeseranTheder.tgltrans)='".$_SESSION["anggaran_tahun"]."' and pergeseranTheder.jenis='Bank Ke Kas'
							)as wew");
		$rsbank=$sqlbank->fetch_object();
		$sisasaldobank=$rsbank->lope;
		echo rp($sisasaldobank).'|'.$sisasaldobank;
	}else{
		$sqltunai=$conn->query("select round(sum(awal),2) as awalx,round(sum(tambah),2) as tambahx,round(sum(kurang),2) as kurangx,round(sum(awal)+sum(tambah)-sum(kurang),2) as lope from(
								 select round(saldoTunaiBk.nominal,2) as awal,'' as tambah,'' as kurang from saldoTunaiBk 
								 where year(saldoTunaiBk.tglopname)='".$thnx."' and month(saldoTunaiBk.tglopname)='".$blnx."'
								 union all
								 select '' as awal,sum(round(pergeseranTheder.jumlah,2)) as tambah,'' as kurang from pergeseranTheder 
								 where year(pergeseranTheder.tgltrans)='".$thn."' and month(pergeseranTheder.tgltrans)='".$bln."' and pergeseranTheder.jenis='Bank Ke Kas'
								 union all
								 select '' as awal,sum(round(pengembalianpanjar_rinci.sisapanjar,2)) as tambah,'' as kurang from pengembalianpanjar_heder,pengembalianpanjar_rinci 
								 where pengembalianpanjar_heder.nopengembalianpanjar=pengembalianpanjar_rinci.nopengembalianpanjar and 
								 year(pengembalianpanjar_heder.tglpengembalianpanjar)='".$thn."' and month(pengembalianpanjar_heder.tglpengembalianpanjar)='".$bln."' 
								 union all
								 select '' as awal,'' as tambah,sum(round(pergeseranTrinci.jumlah,2)) as kurang 
								 from pergeseranTheder,pergeseranTrinci
								 where pergeseranTheder.notrans=pergeseranTrinci.notrans and
								 year(pergeseranTheder.tgltrans)='".$thn."' and month(pergeseranTheder.tgltrans)='".$bln."' and pergeseranTheder.jenis='Kas Ke Bank'
								)as wew");
		$rstunai=$sqltunai->fetch_object();
		$sisasaldotunai=$rstunai->lope;
		echo rp($sisasaldotunai).'|'.$sisasaldotunai;
	}
	
?>
<?php include("../../close.php"); ?>