<?php include("../../conn.php"); ?>
<?php

	$sql=$conn->query("select * from pihak_kertiga where nama='".$_GET['nama']."' ");
	$jml=$sql->num_rows;
		if($jml>0){ 
			echo "NAMA PERUSAHAAN INI SUDAH PERNAH DI ENTRY....!!!!";
		}else{
			if($_GET['kode']==''){
				$sql=$conn->query("call master_pihak_ketiga(@nomor);");
				$sql=$conn->query("select @nomor as nomor;");
				$jml=$sql->num_rows;
					if($jml>0){ 
						$rs=$sql->fetch_object();
						$counter=$rs->nomor+1;
					}
				$kodex="PK".$counter;
				$conn->query("insert into pihak_ketiga(kode,nama,alamat,telepon,npwp,norek,cp,bank,kodemapingrs,namasuplier) values('".$kodex."','".trim($_GET['namaperusahaan'])."','".trim($_GET['alamatperusahaan'])."',
							'".trim($_GET['teleponperusahaan'])."','".trim($_GET['npwp'])."','".trim($_GET['norek'])."','".trim($_GET['cp'])."','".trim($_GET['namabank'])."',
							'".trim($_GET['kodemapingrs'])."','".trim($_GET['namasuplier'])."')");				
				echo "OK|".$kodex;
			}else{
				$kodex= $_GET['kode'];
				
				$conn->query("update pihak_ketiga set nama='".trim($_GET['namaperusahaan'])."',alamat='".trim($_GET['alamatperusahaan'])."',telepon='".trim($_GET['teleponperusahaan'])."',
				npwp='".trim($_GET['npwp'])."',norek='".trim($_GET['norek'])."',cp='".trim($_GET['cp'])."',bank='".trim($_GET['namabank'])."',kodemapingrs='".trim($_GET['kodemapingrs'])."',
				namasuplier='".trim($_GET['namasuplier'])."' where kode='".$kodex."' ");				
				echo "OK|".$kodex;
			}
		}

?>
<?php include("../../close.php"); ?>