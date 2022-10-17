<?php include("../../../conn.php"); ?>
<?php
	$nominal= str_replace(',','',$_GET['nilairupiah']);
	$nilaiperubahan= str_replace(',','',$_GET['nilaiperubahan']);
	$selisih= $nominal-$nilaiperubahan;
	
	// $sqlawal=$conn->query("select sum(nilai) as total from anggaran_pendapatan where tahun='".$_SESSION["anggaran_tahun"]."'");
	// $rsawal=$sqlawal->fetch_object();
	// $awal=$rsawal->total;
	
	
	// $sqlsaldo=$conn->query("select sum(pagu) as saldo from t_tampung_pendapatan where tahun='".$_SESSION["anggaran_tahun"]."'");
	// $rssaldo=$sqlsaldo->fetch_object();
	// $saldopagu=$rssaldo->saldo;
	
	
	// $sqlpenapatan=$conn->query("select * from t_tampung_pendapatan where notrans='".trim($_GET['notransawal'])."'");
	// $rspendapatan=$sqlpenapatan->fetch_object();
	// $saldopendapatan=$rspendapatan->saldo;

			
	// if($awal < $nilaiperubahan){
		// echo "MAAF SISA SALDO TIDAK MENCUKUPI, SISA SALDO ANDA SEBESAR ".rpzx($awal);
	// }else{
		$sql=$conn->query("call perubahan(@nomor);");
			$sql=$conn->query("select @nomor as nomor;");
			$jml=$sql->num_rows;
			if($jml>0){ 
				$rs=$sql->fetch_object();
				$counter=$rs->nomor+1;
			}		
			$kode=gennotran($counter,"UBAH");
			
			$conn->query("insert into perubahan(notrans,bidang,koderekeningblud,uraian_rekening,nilai,tahun,tgl_entry,user_entry,map79,kode79,statusperubahan,noperubahan,nilaibaru,selisih) values(
							'".trim($_GET['notransawal'])."','".trim($_GET['bidang'])."','".trim($_GET['koderekeningblud'])."','".trim($_GET['uraian'])."','".$nominal."',
							'".$_SESSION["anggaran_tahun"]."','".date('Y-m-d H:i:s')."','".$_SESSION['anggaran_username']."','".trim($_GET['map79'])."','".trim($_GET['kode79'])."','1',
							'".$kode."','".$nilaiperubahan."','".$selisih."')");
			
			$conn->query("update t_tampung_pendapatan set pagu='".$nilaiperubahan."' where notrans='".trim($_GET['notransawal'])."'");
			
			echo "OK|".$isisaldopendapatan;
	// }
			


?>
<?php include("../../../close.php"); ?>