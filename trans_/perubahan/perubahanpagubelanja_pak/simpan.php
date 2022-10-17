<?php include("../../../conn.php"); ?>
<?php

$nominal= str_replace(',','',$_GET['nilairupiah']);
$nilaiperubahan= str_replace(',','',$_GET['nilaiperubahan']);
$selisih= $nilaiperubahan - $nominal;
	//----------------cek total pendapatan-------------------//
	$sqlpendapatan=$conn->query("select sum(totalpendapatan) as totalpendapatan from( 
									select sum(nilai) as totalpendapatan from anggaran_pendapatan 
									where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='' and statusperubahan_pak=''
									union all
									select sum(nilaibaru) as totalpendapatan from perubahan 
									where statusperubahan='1' and statusperubahan_pak='' and tahun='".$_SESSION["anggaran_tahun"]."'
									union all
									select sum(nilaibaru) as totalpendapatan from perubahan_pak 
									where statusperubahan='1' and tahun='".$_SESSION["anggaran_tahun"]."') as wew");
	$rspendapatan=$sqlpendapatan->fetch_object();
	$totalpendapatan=$rspendapatan->totalpendapatan;
		
		//----------------cek apakah notransaksi ini sudah pernah di input di tabel P.A.K-------------------//
		$sqlcekx=$conn->query("select * from perubahanpagu_pak where notransawal='".trim($_GET['notrans'])."' ");
		$jmlcekx=$sqlcekx->num_rows;
		if($jmlcekx > 0){
			//----------------cek total total pagu sekarang-------------------//		
			$conn->query("update perubahanpagu_pak set statusperubahan='2' where notransawal='".trim($_GET['notrans'])."'");
			$sqlx=$conn->query("select kodekegiatanx,sum(subtotal) as subtotalall from(
									select kodekegiatan as kodekegiatanx,total as subtotal 
									from penetapan_pagu 
									where tahun='".$_SESSION["anggaran_tahun"]."' and perubahan='' and perubahan_pak=''
									union all
									select kodekegiatan as kodekegiatanx,perubahan as subtotal 
									from perubahanpagu 
									where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1' and statusperubahan_pak=''
									union all
									select kodekegiatan as kodekegiatanx,perubahan as subtotal 
									from perubahanpagu_pak 
									where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1')
								as wew");
			$rsx=$sqlx->fetch_object();
			$totalpagu=$rsx->subtotalall;
			$totalpagux=$totalpagu+$nilaiperubahan;
			
			//----------------jika totalpendapatan tidak mencukupi-------------------//
			if($totalpagux > $totalpendapatan){
				$conn->query("update perubahanpagu_pak set statusperubahan='1' where notransawal='".trim($_GET['notrans'])."'");
				$sqlx2=$conn->query("select kodekegiatanx,sum(subtotal) as subtotalall from(
									select kodekegiatan as kodekegiatanx,perubahan as subtotal 
									from perubahanpagu 
									where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1' and statusperubahan_pak=''
									union all
									select kodekegiatan as kodekegiatanx,total as subtotal 
									from penetapan_pagu 
									where tahun='".$_SESSION["anggaran_tahun"]."' and perubahan='' and perubahan_pak=''
									union all
									select kodekegiatan as kodekegiatanx,perubahan as subtotal 
									from perubahanpagu_pak 
									where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1')
								as wew");
				$rsx2=$sqlx2->fetch_object();
				$totalpagu2=$rsx2->subtotalall;
				$sisapagu=$totalpendapatan-$totalpagu2;
				echo "MAAF SISA PENDAPATAN TIDAK MENCUKUPI....!!! SISA PENDAPATAN YANG BISA DIAMBIL SENILAI ".rpzx($totalpagux);
			}else{
				$sql=$conn->query("call perubahanpagu(@nomor);");
				$sql=$conn->query("select @nomor as nomor;");
				$jml=$sql->num_rows;
				$kode=time()."-PEGU-PAK";
				if($jml>0){ 
					$rs=$sql->fetch_object();
					$counter=$rs->nomor+1;
				}		
					$conn->query("update perubahanpagu_pak set statusperubahan='2' where notransawal='".trim($_GET['notrans'])."'");
					$conn->query("insert into perubahanpagu_pak(noperubahan,notransawal,tglperubahan,kodekegiatan,kegiatanblud,kodeorganisasi1,kodeorganisasi2,kodeorganisasi3,namaorganisasi,total,perubahan,selisih,tahun,tgl_entry,user_entry,statusperubahan) values(
					'".$kode."','".trim($_GET['notrans'])."','".date('Y-m-d H:i:s')."','".trim($_GET['kodekegiatanblud'])."','".trim($_GET['kegiatanblud'])."','".trim($_GET['kode1'])."','".trim($_GET['kode2'])."','".trim($_GET['kode3'])."',
					'".trim($_GET['organisasi_nama'])."','".$nominal."','".$nilaiperubahan."','".$selisih."',
					'".$_SESSION["anggaran_tahun"]."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','1')");
					
					echo "OK|".$kode;
			}
		}else{
			//----------------cek total total pagu sekarang-------------------//		
			$conn->query("update perubahanpagu set statusperubahan_pak='1' where notransawal='".trim($_GET['notrans'])."'");
			$conn->query("update penetapan_pagu set perubahan_pak='1' where notrans='".trim($_GET['notrans'])."'");
			$sqlx=$conn->query("select kodekegiatanx,sum(subtotal) as subtotalall from(
									select kodekegiatan as kodekegiatanx,total as subtotal 
									from penetapan_pagu 
									where tahun='".$_SESSION["anggaran_tahun"]."' and perubahan='' and perubahan_pak=''
									union all
									select kodekegiatan as kodekegiatanx,perubahan as subtotal 
									from perubahanpagu 
									where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1' and statusperubahan_pak=''
									union all
									select kodekegiatan as kodekegiatanx,perubahan as subtotal 
									from perubahanpagu_pak 
									where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1')
								as wew");
			$rsx=$sqlx->fetch_object();
			$totalpagu=$rsx->subtotalall;
			$totalpagux=$totalpagu+$nilaiperubahan;
			
			//----------------jika totalpendapatan tidak mencukupi-------------------//
			if($totalpagux > $totalpendapatan){
				$conn->query("update perubahanpagu_pak set statusperubahan_pak='' where notransawal='".trim($_GET['notrans'])."'");
				$conn->query("update penetapan_pagu set perubahan_pak='' where notrans='".trim($_GET['notrans'])."'");
				$sqlx2=$conn->query("select kodekegiatanx,sum(subtotal) as subtotalall from(
									select kodekegiatan as kodekegiatanx,perubahan as subtotal 
									from perubahanpagu 
									where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1' and statusperubahan_pak=''
									union all
									select kodekegiatan as kodekegiatanx,total as subtotal 
									from penetapan_pagu 
									where tahun='".$_SESSION["anggaran_tahun"]."' and perubahan='' and perubahan_pak=''
									union all
									select kodekegiatan as kodekegiatanx,perubahan as subtotal 
									from perubahanpagu_pak 
									where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1')
								as wew");
				$rsx2=$sqlx2->fetch_object();
				$totalpagu2=$rsx2->subtotalall;
				$sisapagu=$totalpendapatan-$totalpagu2;
				echo "MAAF SISA PENDAPATAN TIDAK MENCUKUPI....!!! SISA PENDAPATAN YANG BISA DIAMBIL SENILAI ".rpzx($sisapagu);
			}else{
				$sql=$conn->query("call perubahanpagu(@nomor);");
				$sql=$conn->query("select @nomor as nomor;");
				$jml=$sql->num_rows;
				$kode=time()."-PEGU-PAK";
				if($jml>0){ 
					$rs=$sql->fetch_object();
					$counter=$rs->nomor+1;
				}		
					$conn->query("update penetapan_pagu set perubahan_pak='1' where notrans='".trim($_GET['notrans'])."'");
					$conn->query("update perubahanpagu_pak set statusperubahan='2' where notransawal='".trim($_GET['notrans'])."'");
					$conn->query("insert into perubahanpagu_pak(noperubahan,notransawal,tglperubahan,kodekegiatan,kegiatanblud,kodeorganisasi1,kodeorganisasi2,kodeorganisasi3,namaorganisasi,total,perubahan,selisih,tahun,tgl_entry,user_entry,statusperubahan) values(
					'".$kode."','".trim($_GET['notrans'])."','".date('Y-m-d H:i:s')."','".trim($_GET['kodekegiatanblud'])."','".trim($_GET['kegiatanblud'])."','".trim($_GET['kode1'])."','".trim($_GET['kode2'])."','".trim($_GET['kode3'])."',
					'".trim($_GET['organisasi_nama'])."','".$nominal."','".$nilaiperubahan."','".$selisih."',
					'".$_SESSION["anggaran_tahun"]."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','1')");
					
					echo "OK|".$kode;
			}
			
		}
?>
<?php include("../../../close.php"); ?>