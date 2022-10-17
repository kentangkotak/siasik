<?php include("../../conn.php"); ?>
<?php
	
		
		$tglnpk=in_tanggal("/",trim($_GET['tglnpk']));
		$tglnpd=in_tanggal("/",trim($_GET['tglnpd']));
		$total= str_replace(',','',$_GET['total']);
		
			if($_GET['nonpk']==''){
				$sql=$conn->query("call nonpk(@nomor);");
				$sql=$conn->query("select @nomor as nomor;");
				$jml=$sql->num_rows;
				if($jml>0){ 
					$rs=$sql->fetch_object();
					$counter=$rs->nomor+1;
				}		
				$kode=gennotran($counter,"NPK-PAN");
				
				$conn->query("insert into npkpanjar_heder(nonpk,tglnpk,akun,userentry,tglentry,nonpdpanjar) values('".$kode."','".trim($tglnpk)."','".trim($_GET['akun'])."','".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."','".trim($_GET['nonpd'])."')");
				
				$conn->query("insert into npkpanjar_rinci(nonpk,nonpd,tglnpd,kegiatan,kodekegiatanblud,kegiatanblud,total,userentry,tglentry) 
				values('".$kode."','".trim($_GET['nonpd'])."','".trim($tglnpd)."','".trim($_GET['kegiatan'])."','".trim($_GET['kodekegiatanblud'])."',
				'".trim($_GET['kegiatanblud'])."','".trim($total)."','".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."')");
				
				$conn->query("update npdpanjar_heder set flag='1' where nonpdpanjar='".trim($_GET['nonpd'])."' ");
				
				echo "OK|".$kode;
			}else{
				$kode=$_GET['nonpk'];
				$sql=$conn->query("select * from npkpanjar_heder where nonpk='".$kode."' and kunci=1");
				$jml=$sql->num_rows;
				
				if($jml > 0){
					echo "MAAF TRANSAKSI INI SUDAH DIKUNCI....!!!";
				}else{
					$conn->query("insert into npkpanjar_rinci(nonpk,nonpd,tglnpd,kegiatan,kodekegiatanblud,kegiatanblud,total,userentry,tglentry) 
					values('".$kode."','".trim($_GET['nonpd'])."','".trim($tglnpd)."','".trim($_GET['kegiatan'])."','".trim($_GET['kodekegiatanblud'])."',
					'".trim($_GET['kegiatanblud'])."','".trim($total)."','".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."')");
					
					$conn->query("update npdpanjar_heder set flag='1' where nonpdpanjar='".trim($_GET['nonpd'])."' ");

					echo "OK|".$kode;
				}
				
				
			}
		
?>
<?php include("../../close.php"); ?>