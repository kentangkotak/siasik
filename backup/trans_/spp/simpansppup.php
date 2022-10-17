<?php include("../../conn.php"); ?>
<?php

		$jumlahspp= str_replace('.','',$_GET['jumlahspp']);
		$tanggaltrans=in_tanggal("/",trim($_GET['tgltrans']));
		$tanggaltransx=explode("-",$tanggaltrans);
		$tahun= $tanggaltransx[0];
		
		$sqlx=$conn->query("select * from transsppup where year(tglTrans)='".$tahun."' ");
		$jmlx=$sqlx->num_rows;
		
		if($jmlx > 0){
			echo "MAAF SPP UP HANYA BISA DILAKUKAN SEKALI DALAM SATU TAHUN";
		}else{
			if($_GET['nosppup']==''){
			$sql=$conn->query("call nosppup(@nomor);");
			$sql=$conn->query("select @nomor as nomor;");
			$jml=$sql->num_rows;
			if($jml>0){ 
				$rs=$sql->fetch_object();
				$counter=$rs->nomor+1;
			}		
				$kode=gennotran($counter,"SPPUP");
				
				$conn->query("insert into transsppup(nosppup,tglTrans,kdBendaharaKeluar,bendaharaKeluar,jumlahspp,bank,kodeRek,tglentry,userentry,uraian) values(
				'".$kode."','".$tanggaltrans."','".trim($_GET['nip'])."','".trim($_GET['bendaharapengeluaran'])."','".$jumlahspp."','".trim($_GET['namabank'])."',
				'".trim($_GET['norekening'])."',
				'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['uraian'])."')");
				echo "OK|".$kode;
			}
		}
		
		



?>
<?php include("../../close.php"); ?>