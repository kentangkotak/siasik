<?php include("../../conn.php"); ?>
<?php
	if(!empty($_FILES['foto']['name'])){
			$file_type	= array('pdf');
			$explode	= explode('.',$_FILES['foto']['name']);
			$nama_baru = round(microtime(true)) . '.' . end($explode);
			$extensi	= $explode[count($explode)-1];

			
			$kodex=trim($_GET["notrans"]);
			$kode=str_replace("/",".",$kodex);
			$nip=trim($_POST["nip"]);	

			//echo $kode;

			if(is_uploaded_file($_FILES['foto']['tmp_name'] )) {
				if ($_FILES["foto"]["size"] > 200000000) {
					echo "MAAF UKURAN FILE TIDAK BOLEH LEBIH DARI 2 MB";
				}else if(!in_array($extensi,$file_type)){
					echo "MAAF FORMAT FILE HARUS PDF";
				}else{
					$sourcePath = $_FILES['foto']['tmp_name'];
					$targetPath = "../../potos_folder/".$kode."/".$nip."/".$nama_baru;
					if (!is_dir("../../potos_folder/".$kode."/".$nip)) {
						mkdir("../../potos_folder/".$kode."/".$nip, 0777, true);         
					}
				move_uploaded_file($sourcePath,$targetPath);

					$conn->query("update rs33 set rs8='".$nama_baru."' where rs1='".$kodex."' and rs4='".$nip."' ");
					echo "OK|".$kodex;
				}
			}else{
				echo "<script type='text/javascript'>alert('Nama File Belum Diisi...!!!');</script>";
				$sukses = 0 ;
			}
	}else{
		echo "wew2";
	}
		
?>
<?php include("../../close.php"); ?>