<?php include("../../conn.php"); ?>
<?php
	$nominal= str_replace('.','',$_GET['nilairupiah']);
	$nilaiperubahan= str_replace(',','',$_GET['nilaiperubahan']);
	$selisih= $nilaiperubahan-$nominal;
	
		//if($_GET['noperubahan']==''){
			$sql=$conn->query("call perubahan(@nomor);");
			$sql=$conn->query("select @nomor as nomor;");
			$jml=$sql->num_rows;
			if($jml>0){ 
				$rs=$sql->fetch_object();
				$counter=$rs->nomor+1;
			}		
			$kode=gennotran($counter,"UBAH");
			
			$sqlkuncicek=$conn->query("select * from anggaran_pendapatan where notrans='".trim($_GET['notransawal'])."' and kunciperubahan=1");
			$jmlcekkunci=$sqlkuncicek->num_rows;
			if($jmlcekkunci > 0){
				echo "MAAF DATA INI SUDAH TERKUNCI...!!!";
			}else{
				$sqlcek=$conn->query("select * from perubahan where notransawal='".trim($_GET['notransawal'])."' ");
				$jmlcek=$sqlcek->num_rows;
				
				if($jmlcek > 0){
					echo "MAAF PERUBAHAN PENDATAN INI SUDAH PERNAH DI INPUT...!!!";
				}else{
					$conn->query("insert into perubahan(noperubahan,notransawal,tglperubahan,bidang,koderekeningblud,uraian_rekening,nilai,nilaiperubahan,selisih,tahun,tgl_entry,user_entry,map79,kode79,statusperubahan) values(
					'".$kode."','".trim($_GET['notransawal'])."','".date('Y-m-d H:i:s')."','".trim($_GET['bidang'])."','".trim($_GET['koderekeningblud'])."','".trim($_GET['uraian'])."','".$nominal."',
					'".$nilaiperubahan."','".$selisih."',
					'".$_SESSION["anggaran_tahun"]."','".date('Y-m-d H:i:s')."','".$_SESSION['anggaran_username']."','".trim($_GET['map79'])."','".trim($_GET['kode79'])."','1')");
					
					$conn->query("update anggaran_pendapatan set statusperubahan=1 where notrans='".trim($_GET['notransawal'])."'");
					echo "OK|".$kode;
				}
			}
		//}
			


?>
<?php include("../../close.php"); ?>