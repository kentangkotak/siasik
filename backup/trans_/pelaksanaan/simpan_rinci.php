<?php include("../../conn.php"); ?>
<?php

	if($_POST['koderuangan']=='BX001'){
		echo "Maaf Ruangan Pegawai Tersebut Belum Di isi, Mohon Hubungi Bagian Kepegawaian Untuk Meminta Update Data Pegawai Tersebut...!!!";
	}else if($_POST['kategoripegawai']=='MTX000'){
		echo "Maaf Kategori Pegawai Tersebut Belum Di isi, Mohon Hubungi Bagian Kepegawaian Untuk Meminta Update Data Pegawai Tersebut...!!!";
	}else if($_POST['kodejabatan']=='JX001'){
		echo "Maaf Jabatan Pegawai Tersebut Belum Di isi, Mohon Hubungi Bagian Kepegawaian Untuk Meminta Update Data Pegawai Tersebut...!!!";
	}else if($_POST['kodependidikan']=='PX0001'){
		echo "Maaf Pendidikan Pegawai Tersebut Belum Di isi, Mohon Hubungi Bagian Kepegawaian Untuk Meminta Update Data Pegawai Tersebut...!!!";
	}else if($_POST['kodestatpegawai']=='PX1'){
		echo "Maaf Status Kepegawaian Pegawai Tersebut Belum Di isi, Mohon Hubungi Bagian Kepegawaian Untuk Meminta Update Data Pegawai Tersebut...!!!";
	}else if($_POST['kodestatpegawai']=='P04'){
		if($_POST['kodegolruang']=='GX0001'){
			echo "Maaf Golongan Ruang Pegawai Tersebut Belum Di isi, Mohon Hubungi Bagian Kepegawaian Untuk Meminta Update Data Pegawai Tersebut...!!!";
		}
	}else{	
		if($_POST['notrans']==''){
			$sql=$conn->query("call trans_diklat(@nomor);");
			$sql=$conn->query("select @nomor as nomor;");
			$jml=$sql->num_rows;
			if($jml>0){ 
				$rs=$sql->fetch_object();
				$counter=$rs->nomor+1;
			}
			$kodex=gennotran($counter,"DK");

			$file_type	= array('pdf');
			$explode	= explode('.',$_FILES['foto']['name']);
			$nama_baru = round(microtime(true)) . '.' . end($explode);
			$extensi	= $explode[count($explode)-1];

			$file_typex	= array('pdf');
			$explodex	= explode('.',$_FILES['fotox']['name']);
			$nama_barux = round(microtime(true)) . '.' . end($explodex);
			$extensix	= $explodex[count($explodex)-1];

			$kode=str_replace("/",".",$kodex);
			$nip=trim($_POST["nip"]);	

			//echo $kode;

			if(is_uploaded_file($_FILES['foto']['tmp_name'] )) {
				if ($_FILES["foto"]["size"] > 50000000) {
					echo "Maaf Ukuran file Depan tidak boleh lebih dari 500 kb";
				}else if(!in_array($extensi,$file_type)){
					echo "Maaf Format File Depan Harus PDF";
				}else if($_FILES["fotox"]["size"] > 50000000){
					echo "Maaf Ukuran file Belakang tidak boleh lebih dari 500 kb";
				}else if(!in_array($extensix,$file_typex)){
					echo "Maaf Format File Belakang Harus PDF";
				}else{
					$sourcePath = $_FILES['foto']['tmp_name'];
					$targetPath = "../../potos_folder/".$kode."/".$nip."/depan_".$nama_baru;
					if (!is_dir("../../potos_folder/".$kode."/".$nip)) {
						mkdir("../../potos_folder/".$kode."/".$nip, 0777, true);         
					}
				move_uploaded_file($sourcePath,$targetPath);

					$sourcePathx = $_FILES['fotox']['tmp_name'];
					$targetPathx = "../../potos_folder/".$kode."/".$nip."/belakang_".$nama_barux;
					if (!is_dir("../../potos_folder/".$kode."/".$nip)) {
						mkdir("../../potos_folder/".$kode."/".$nip, 0777, true);         
					}
				move_uploaded_file($sourcePathx,$targetPathx);
				$nama_baru1="depan_".$nama_baru;
				$nama_baru2="belakang_".$nama_barux;

					$conn->query("insert into rs33(rs1,rs2,rs3,rs4,rs5,rs6,rs7,rs8,rs9,rs10,rs11,rs12,rs13,rs14,rs15,rs16,rs17,rs18,rs19,rs20,rs21,rs22) values('".$kodex."','".trim($_POST['noverifx'])."','".trim($_POST['nousulanx'])."','".trim($_POST['nip'])."',
					'".date('Y-m-d H:i:s')."','".$_SESSION['silat_kodeuser']."','".trim($_POST['kodeusulanx'])."','".$nama_baru1."','".$nama_baru2."','".trim($_POST['nosttp'])."','".trim($_POST['koderuangan'])."','".trim($_POST['ruangan'])."','".trim($_POST['kategoripegawai'])."','".trim($_POST['kategoripeg'])."',
					'".trim($_POST['kodejabatan'])."','".trim($_POST['jabatan'])."','".trim($_POST['kodependidikan'])."','".trim($_POST['pendidikan'])."','".trim($_POST['kodegolruang'])."','".trim($_POST['golruang'])."','".trim($_POST['kodestatpegawai'])."','".trim($_POST['statpeg'])."') ");
					echo "OK|".$kodex;
				}
			}
		}else{
			$file_type	= array('pdf');
			$explode	= explode('.',$_FILES['foto']['name']);
			$nama_baru = round(microtime(true)) . '.' . end($explode);
			$extensi	= $explode[count($explode)-1];

			$kodex=trim($_POST["notrans"]);
			$kode=str_replace("/",".",$kodex);
			$nip=trim($_POST["nip"]);	


			$file_typex	= array('pdf');
			$explodex	= explode('.',$_FILES['fotox']['name']);
			$nama_barux = round(microtime(true)) . '.' . end($explodex);
			$extensix	= $explodex[count($explodex)-1];

			//echo $explode;

			if(is_uploaded_file($_FILES['foto']['tmp_name'] )) {
				if ($_FILES["foto"]["size"] > 50000000) {
					echo "Maaf Ukuran file Depan tidak boleh lebih dari 500 kb";
				}else if(!in_array($extensi,$file_type)){
					echo "Maaf Format File Depan Harus PDF";
				}else if($_FILES["fotox"]["size"] > 50000000){
					echo "Maaf Ukuran file Belakang tidak boleh lebih dari 500 kb";
				}else if(!in_array($extensix,$file_typex)){
					echo "Maaf Format File Belakang Harus PDF";
				}else{
					$sourcePath = $_FILES['foto']['tmp_name'];
					$targetPath = "../../potos_folder/".$kode."/".$nip."/depan_".$nama_baru;
					if (!is_dir("../../potos_folder/".$kode."/".$nip)) {
						mkdir("../../potos_folder/".$kode."/".$nip, 7777, true);         
					}
				move_uploaded_file($sourcePath,$targetPath);

					$sourcePathx = $_FILES['fotox']['tmp_name'];
					$targetPathx = "../../potos_folder/".$kode."/".$nip."/belakang_".$nama_barux;
					if (!is_dir("../../potos_folder/".$kode."/".$nip)) {
						mkdir("../../potos_folder/".$kode."/".$nip, 7777, true);         
					}
				move_uploaded_file($sourcePathx,$targetPathx);
				$nama_baru1="depan_".$nama_baru;
				$nama_baru2="belakang_".$nama_barux;

					$conn->query("insert into rs33(rs1,rs2,rs3,rs4,rs5,rs6,rs7,rs8,rs9,rs10,rs11,rs12,rs13,rs14,rs15,rs16,rs17,rs18,rs19,rs20,rs21,rs22) values('".$kodex."','".trim($_POST['noverifx'])."','".trim($_POST['nousulanx'])."','".trim($_POST['nip'])."',
					'".date('Y-m-d H:i:s')."','".$_SESSION['silat_kodeuser']."','".trim($_POST['kodeusulanx'])."','".$nama_baru1."','".$nama_baru2."','".trim($_POST['nosttp'])."','".trim($_POST['koderuangan'])."','".trim($_POST['ruangan'])."','".trim($_POST['kategoripegawai'])."','".trim($_POST['kategoripeg'])."',
					'".trim($_POST['kodejabatan'])."','".trim($_POST['jabatan'])."','".trim($_POST['kodependidikan'])."','".trim($_POST['pendidikan'])."','".trim($_POST['kodegolruang'])."','".trim($_POST['golruang'])."','".trim($_POST['kodestatpegawai'])."','".trim($_POST['statpeg'])."') ");
					echo "OK|".$kodex;
				}
			}
		}
	}

?>
<?php include("../../close.php"); ?>