<?php include("../../conn.php"); ?>
<?php
	$bln=date('m');
	$thn=date('Y');
	
	if($bln==1){
		$blnx=12;
		$thnx=$thn-1;
		
	}else{
		$blnx=$bln-1;
		$thnx=$thn;		
	}
	
	$sql=$conn->query("select awal,tambah,kurang,sum(round(awal+tambah-kurang,2)) as lope
		from(
		 select round(saldoTunaiBk.nominal,2) as awal,'' as tambah,'' as kurang from saldoTunaiBk 
		 where year(saldoTunaiBk.tglopname)='".$thnx."' and month(saldoTunaiBk.tglopname)='".$blnx."'
		 union all
		 select '' as awal,sum(round(pergeseranTheder.jumlah,2)) as tambah,'' as kurang from pergeseranTheder 
		 where year(pergeseranTheder.tgltrans)='".$thn."' and month(pergeseranTheder.tgltrans)='".$bln."' and pergeseranTheder.jenis='Bank Ke Kas'
		 union all
		 select '' as awal,'' as tambah,sum(round(pergeseranTheder.jumlah,2)) as kurang from pergeseranTheder 
		 where year(pergeseranTheder.tgltrans)='".$thn."' and month(pergeseranTheder.tgltrans)='".$bln."' and pergeseranTheder.jenis='Kas Ke Bank'
  )as wew	");
	$rs=$sql->fetch_object();
	$sisasaldo=$rs->lope;
    echo $sisasaldo;
?>
<?php include("../../close.php"); ?>